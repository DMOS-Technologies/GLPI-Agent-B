<?php

/** Only an explicit complete, permitted zero-match lookup can reach this path. */
function plugin_agentbdmosassetsync_first_copy(PluginAgentbdmosassetsyncWork $record, array &$result): void
{
    global $DB;
    $work = $record->fields;
    $lock = 'asb-setting-' . sha1($work['route_id']);
    $row = $DB->fetchAssoc($DB->doQuery("SELECT GET_LOCK('$lock', 5) AS acquired"));
    if ((int) $row['acquired'] !== 1) {
        throw new RuntimeException('Hold: route is busy before first copy');
    }
    $attempted = false;
    $completionAttempted = false;
    $transaction = false;
    $preparedIds = [];
    try {
        plugin_agentbdmosassetsync_first_copy_isolation();
        // Native CronTask does not open a transaction; the durable start save already committed.
        // saveFirstCopyEvidence deliberately performs no begin/commit of its own.
        $DB->beginTransaction();
        $transaction = true;
        plugin_agentbdmosassetsync_as_submitter($work, static function () use ($work, $record, &$result, &$attempted, &$preparedIds, $DB) {
            $route = plugin_agentbdmosassetsync_current_route($work);
            $type = $work['itemtype'];
            $identity = json_decode($work['identity_json'], false, 512, JSON_THROW_ON_ERROR);
            if (plugin_agentbdmosassetsync_find_existing($work, true) !== null) {
                throw new RuntimeException('Hold: an existing asset appeared before first copy; nothing was created');
            }
            // At repeatable-read/serializable isolation this predicate also prevents an insert phantom.
            $criteria = plugin_agentbdmosassetsync_serial_criteria($work, $identity->serial);
            $criteria['SELECT'] = ['id', 'serial'];
            $query = new DBmysqlIterator($DB);
            $query->buildQuery($criteria);
            $lockedMatches = $DB->doQuery($query->getSql() . ' FOR UPDATE');
            while ($match = $DB->fetchAssoc($lockedMatches)) {
                if ($match['serial'] === $identity->serial) {
                    throw new RuntimeException('Hold: serial now matches an existing asset; nothing was created');
                }
            }
            if (plugin_agentbdmosassetsync_find_existing($work, true) !== null) {
                throw new RuntimeException('Hold: serial now matches an existing asset; nothing was created');
            }
            $asset = new $type();
            $asset->getEmpty();
            $asset->fields['entities_id'] = (int) $route['entities_id'];
            if (!$type::canCreate()) {
                throw new RuntimeException('Hold: submitting user lacks current asset CREATE permission');
            }
            [$input, $containers, $seeds] = plugin_agentbdmosassetsync_first_copy_values($asset, $route, $work, $result);
            $preparedIds = array_column($seeds, 'mapping_id');
            // The installed Fields pre/post-add hooks validate/save one container during native add.
            if ($containers) {
                $first = reset($containers);
                foreach ($first['values'] as $column => $value) {
                    if (array_key_exists($column, $input) && $input[$column] !== $value) {
                        throw new RuntimeException('Hold: native and Fields add inputs collide for field ' . $column);
                    }
                    $input[$column] = $value;
                }
                $input['c_id'] = $first['field']['container_id'];
            }
            $id = plugin_agentbdmosassetsync_as_submitter($work, static function () use ($work, $asset, $input, &$attempted) {
                plugin_agentbdmosassetsync_current_route($work);
                if (plugin_agentbdmosassetsync_find_existing($work, true) !== null) {
                    throw new RuntimeException('Hold: first-copy zero-match proof no longer holds');
                }
                $permissionInput = $input;
                if (!$asset->can(-1, CREATE, $permissionInput)) {
                    throw new RuntimeException('Hold: submitting user cannot create the routed asset');
                }
                $attempted = true;
                return plugin_agentbdmosassetsync_sync_guard(static fn() => $asset->add($input));
            });
            if ($id === false || (int) $id <= 0) {
                throw new RuntimeException('Save failed: GLPI declined first-copy creation');
            }
            if (!$asset->getFromDB((int) $id)) {
                throw new RuntimeException('Save failed: new B asset could not be reread');
            }
            plugin_agentbdmosassetsync_check_asset($asset, $work, READ);
            foreach ($containers as $containerId => $container) {
                if ((int) $containerId === (int) ($input['c_id'] ?? 0)) {
                    continue;
                }
                plugin_agentbdmosassetsync_as_submitter($work, static function () use ($work, $asset, $container) {
                    plugin_agentbdmosassetsync_current_route($work);
                    plugin_agentbdmosassetsync_check_asset($asset, $work, UPDATE);
                    foreach ($container['selectors'] as $selector) {
                        plugin_agentbdmosassetsync_field_descriptor($asset, $selector);
                    }
                    $saved = plugin_agentbdmosassetsync_sync_guard(static fn() =>
                        plugin_agentbdmosassetsync_write_fields_values($asset, $container['field'], $container['values']));
                    if (!$saved) {
                        throw new RuntimeException('Save failed: Fields first-copy container save was declined');
                    }
                });
            }
            if (!$asset->getFromDB((int) $id)) {
                throw new RuntimeException('Save failed: new B asset disappeared before verification');
            }
            plugin_agentbdmosassetsync_check_asset($asset, $work, READ);
            foreach ($seeds as $seed) {
                if (plugin_agentbdmosassetsync_field_read($asset, $seed['field']) !== $seed['expected']) {
                    throw new RuntimeException('Save failed: first-copy value verification failed for ' . $seed['mapping_id']);
                }
                $result['field_outcomes'][] = ['mapping_id' => $seed['mapping_id'], 'outcome' => 'AppliedToB', 'reason' => null];
            }
            $result['b_items_id'] = (int) $id;
            $result['created_b_items_id'] = (int) $id;
            // Leave status Accepted until the outer commit is confirmed. Its start marker remains durable.
            if (!$record->saveFirstCopyEvidence((int) $work['id'], ['b_items_id' => (int) $id,
                'link_state' => 'Active', 'result_json' => json_encode($result, JSON_THROW_ON_ERROR)])) {
                throw new RuntimeException('Save failed: verified first-copy link could not be saved atomically');
            }
        });
        $completionAttempted = true;
        $DB->commit();
        $transaction = false;
    } catch (Throwable $e) {
        $uncertain = $completionAttempted || ($attempted
            && !($e instanceof RuntimeException && str_starts_with($e->getMessage(), 'Save failed:')));
        if ($transaction) {
            try {
                $DB->rollBack();
                $transaction = false;
            } catch (Throwable $rollbackError) {
                $uncertain = true;
            }
        }
        // A returned ID is never claimed as confirmed when transaction completion is uncertain.
        $result['created_b_items_id'] = null;
        $record->getFromDB((int) $work['id']);
        $result['b_items_id'] = $record->fields['b_items_id'] === null ? null : (int) $record->fields['b_items_id'];
        foreach ($result['field_outcomes'] as &$outcome) {
            if ($outcome['outcome'] === 'AppliedToB') {
                $outcome['outcome'] = $uncertain ? 'Skipped' : 'Failed';
                $outcome['reason'] = $uncertain ? 'First-copy transaction outcome is uncertain; reconcile saved values'
                    : 'First-copy transaction was rolled back';
            }
        }
        unset($outcome);
        foreach (array_diff($preparedIds, array_column($result['field_outcomes'], 'mapping_id')) as $mappingId) {
            $result['field_outcomes'][] = ['mapping_id' => $mappingId,
                'outcome' => $attempted && !$uncertain ? 'Failed' : 'Skipped',
                'reason' => $uncertain ? 'First-copy transaction outcome is uncertain; reconcile saved values'
                    : ($attempted ? 'First-copy transaction was rolled back' : 'First copy was not attempted: ' . $e->getMessage())];
        }
        if ($uncertain) {
            throw new RuntimeException('Hold: first-copy outcome is uncertain; reconcile asset/link before new Work', 0, $e);
        }
        throw $e;
    } finally {
        try {
            $DB->doQuery("SELECT RELEASE_LOCK('$lock')");
        } catch (Throwable $e) {
            $result['created_b_items_id'] = null;
            throw new RuntimeException('Hold: first-copy route lock release failed; reconcile saved asset/link before new Work', 0, $e);
        }
    }
}

function plugin_agentbdmosassetsync_first_copy_values(CommonDBTM $asset, array $route, array $work, array &$result): array
{
    $values = json_decode($work['a_values_json'], false, 512, JSON_THROW_ON_ERROR);
    $input = ['entities_id' => (int) $route['entities_id']];
    $containers = [];
    $seeds = [];
    foreach (json_decode($route['field_mappings_json'], false, 512, JSON_THROW_ON_ERROR) as $mapping) {
        if (!$mapping->enabled || $mapping->itemtype !== $work['itemtype']) {
            continue;
        }
        try {
            if (!property_exists($values, $mapping->mapping_id)) {
                throw new RuntimeException('A supplied no value for this enabled first-copy mapping');
            }
            $field = plugin_agentbdmosassetsync_field_descriptor($asset, $mapping->b_field);
            $local = plugin_agentbdmosassetsync_write_value($asset, $field, $mapping,
                plugin_agentbdmosassetsync_exact_work_value($work, $mapping->mapping_id, $values->{$mapping->mapping_id}));
            $expected = plugin_agentbdmosassetsync_field_value($field, $local);
            if ($field['container_id'] === null) {
                $input[$field['value_column']] = $local;
            } else {
                $id = $field['container_id'];
                $containers[$id]['field'] = $field;
                $containers[$id]['values'][$field['value_column']] = $local;
                $containers[$id]['selectors'][] = $mapping->b_field;
            }
            $seeds[] = ['mapping_id' => $mapping->mapping_id, 'field' => $field, 'expected' => $expected];
        } catch (RuntimeException $e) {
            $result['field_outcomes'][] = ['mapping_id' => $mapping->mapping_id, 'outcome' => 'Skipped', 'reason' => $e->getMessage()];
        }
    }
    return [$input, $containers, $seeds];
}

/** Locking a missing serial must protect its insertion gap, not just existing rows. */
function plugin_agentbdmosassetsync_first_copy_isolation(): void
{
    global $DB;
    $variables = $DB->doQuery("SHOW SESSION VARIABLES WHERE Variable_name IN ('transaction_isolation', 'tx_isolation')");
    while ($row = $DB->fetchAssoc($variables)) {
        if (in_array(strtoupper($row['Value']), ['REPEATABLE-READ', 'SERIALIZABLE'], true)) {
            return;
        }
    }
    throw new RuntimeException('Hold: database isolation cannot protect complete first-copy serial lookup');
}
