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
    $primaryFailure = null;
    $copyEvidence = null;
    $finalized = false;
    try {
        plugin_agentbdmosassetsync_first_copy_check_previous($work);
        if (!$record->saveProcessorFields((int) $work['id'], ['error' => 'ASB_FIRST_COPY_IN_FLIGHT'], true)) {
            throw new RuntimeException('Hold: first-copy reservation could not be saved', 9101);
        }
        plugin_agentbdmosassetsync_first_copy_isolation();
        // Native CronTask does not open a transaction; the durable start save already committed.
        // saveFirstCopyEvidence deliberately performs no begin/commit of its own.
        try {
            $DB->beginTransaction();
        } catch (Throwable $e) {
            throw new RuntimeException('First-copy transaction start is uncertain; stop this worker', 9101, $e);
        }
        $transaction = true;
        plugin_agentbdmosassetsync_as_submitter($work, static function () use ($work, $record, &$result, &$attempted,
            &$preparedIds, &$copyEvidence, $DB) {
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
            plugin_agentbdmosassetsync_field_sync_transactional($asset, ['table' => $asset::getTable()]);
            [$input, $containers, $seeds] = plugin_agentbdmosassetsync_first_copy_values($asset, $route, $work, $result);
            $preparedIds = array_column($seeds, 'mapping_id');
            foreach ($seeds as $seed) {
                if ($seed['binding'] === null) {
                    throw new RuntimeException('Hold: first-copy field binding is not proven');
                }
            }
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
            $pendingResult = $result;
            $pendingResult['created_b_items_id'] = null;
            if (!$record->saveFirstCopyEvidence((int) $work['id'], ['b_items_id' => (int) $id,
                'link_state' => 'Active', 'result_json' => json_encode($pendingResult, JSON_THROW_ON_ERROR)])) {
                throw new RuntimeException('Save failed: verified first-copy link could not be saved atomically');
            }
            $copyEvidence = plugin_agentbdmosassetsync_provenance_first_copy($work, $asset, $seeds);
        });
        $completionAttempted = true;
        try {
            $DB->commit();
        } catch (Throwable $e) {
            throw new RuntimeException('First-copy transaction completion is uncertain; stop this worker', 9101, $e);
        }
        $transaction = false;
        plugin_agentbdmosassetsync_provenance_first_copy_visible($work, $copyEvidence);
        try {
            if (!$record->saveProcessorFields((int) $work['id'], ['status' => 'Done', 'error' => null,
                'result_json' => json_encode($result, JSON_THROW_ON_ERROR),
                'completed_at' => Session::getCurrentTime()], true)) {
                throw new RuntimeException('First-copy completion could not be saved');
            }
            // Human edits may legitimately advance current proof after the verified asset commit.
            plugin_agentbdmosassetsync_provenance_first_copy_visible($work, ['work' => $record->fields, 'states' => []]);
            $finalized = true;
        } catch (Throwable $e) {
            throw new RuntimeException('First-copy completion evidence is uncertain; stop this worker', 9101, $e);
        }
    } catch (Throwable $e) {
        $primaryFailure = $e;
        if ($e->getCode() === 9101) {
            throw $e;
        }
        $uncertain = $completionAttempted || $attempted;
        if ($transaction) {
            try {
                $DB->rollBack();
                $transaction = false;
            } catch (Throwable $rollbackError) {
                $primaryFailure = new RuntimeException('First-copy transaction rollback is uncertain; stop this worker',
                    9101, $rollbackError);
                throw $primaryFailure;
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
            throw new RuntimeException('Hold: first-copy outcome is uncertain; reconcile asset/link before new Work', 9103, $e);
        }
        throw new RuntimeException($e instanceof RuntimeException ? $e->getMessage()
            : 'First copy did not apply; inspect its rejected fields before a new request', 9102, $e);
    } finally {
        try {
            $released = $DB->fetchAssoc($DB->doQuery("SELECT RELEASE_LOCK('$lock') AS released"));
            if ((int) ($released['released'] ?? 0) !== 1) {
                throw new RuntimeException('First-copy route lock release was not confirmed');
            }
        } catch (Throwable $e) {
            if ($primaryFailure !== null && $primaryFailure->getCode() === 9101) {
                throw $primaryFailure;
            }
            $result['created_b_items_id'] = null;
            throw new RuntimeException('Hold: first-copy route lock release failed; reconcile saved asset/link before new Work',
                $finalized ? 9101 : 9103, $e);
        }
    }
}

/** A different request ID is not evidence that an earlier unassociated creation had no effects. */
function plugin_agentbdmosassetsync_first_copy_check_previous(array $work): void
{
    global $DB;
    foreach ($DB->request(['FROM' => PluginAgentbdmosassetsyncWork::getTable(), 'WHERE' => [
        'subject' => 'Asset', 'operation' => 'Sync', 'route_id' => $work['route_id'],
        'itemtype' => $work['itemtype'], 'a_items_id' => (int) $work['a_items_id'],
        'a_entities_id' => (int) $work['a_entities_id'], 'entities_id' => (int) $work['entities_id'],
        'b_items_id' => null]]) as $previous) {
        if ((int) $previous['id'] === (int) $work['id'] || $previous['processing_started_at'] === null) {
            continue;
        }
        $error = $previous['error'] ?? '';
        if ($error === 'ASB_FIRST_COPY_NOT_APPLIED' || str_starts_with($error, 'ASB_FIRST_COPY_NOT_APPLIED: ')) {
            continue;
        }
        // Historical unmarked starts cannot prove which native creation stages executed.
        throw new RuntimeException('Hold: an earlier unassociated asset operation needs reconciliation before creation');
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
            plugin_agentbdmosassetsync_field_sync_transactional($asset, $field);
            $local = plugin_agentbdmosassetsync_write_value($asset, $field, $mapping,
                plugin_agentbdmosassetsync_exact_work_value($work, $mapping->mapping_id, $values->{$mapping->mapping_id}));
            $expected = plugin_agentbdmosassetsync_field_value($field, $local);
            try {
                $binding = plugin_agentbdmosassetsync_evidence_binding($route, $mapping, $field);
            } catch (Throwable $e) {
                throw new RuntimeException('Hold: first-copy field binding is not proven', 9102, $e);
            }
            if ($field['container_id'] === null) {
                $input[$field['value_column']] = $local;
            } else {
                $id = $field['container_id'];
                $containers[$id]['field'] = $field;
                $containers[$id]['values'][$field['value_column']] = $local;
                $containers[$id]['selectors'][] = $mapping->b_field;
            }
            $seeds[] = ['mapping_id' => $mapping->mapping_id, 'mapping' => $mapping,
                'binding' => $binding, 'field' => $field, 'expected' => $expected];
        } catch (RuntimeException $e) {
            if ($e->getCode() === 9102) {
                throw $e;
            }
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
