<?php

function plugin_agentbdmosassetsync_mapping_map(array $route, string $type): array
{
    $mappings = [];
    foreach (json_decode($route['field_mappings_json'], false, 512, JSON_THROW_ON_ERROR) as $mapping) {
        if ($mapping->enabled && $mapping->itemtype === $type) {
            $mappings[$mapping->mapping_id] = $mapping;
        }
    }
    return $mappings;
}

function plugin_agentbdmosassetsync_evidence_time($value): ?DateTimeImmutable
{
    if (!is_string($value) || !str_ends_with($value, '+08:00')) {
        return null;
    }
    $time = DateTimeImmutable::createFromFormat('!Y-m-d\TH:i:sP', $value);
    return $time && $time->format('Y-m-d\TH:i:sP') === $value ? $time : null;
}

function plugin_agentbdmosassetsync_snapshot_scope(array $work, array $route, CommonDBTM $asset, array $row): stdClass
{
    if ($row['route_id'] !== $work['route_id'] || $row['itemtype'] !== $work['itemtype']
        || (int) $row['settings_version'] !== (int) $route['settings_version']
        || (int) $row['entities_id'] !== (int) $work['entities_id']
        || (int) $row['a_entities_id'] !== (int) $work['a_entities_id']) {
        throw new RuntimeException('Correction snapshot route/type/entity/settings mismatch: ' . $row['id']);
    }
    $identity = json_decode($row['identity_json'], false, 512, JSON_THROW_ON_ERROR);
    if (!plugin_agentbdmosassetsync_object_keys($identity, ['a_items_id', 'b_items_id', 'serial'])
        || $identity->b_items_id !== (int) $asset->getID()
        || ($identity->a_items_id !== null && $identity->a_items_id !== (int) $work['a_items_id'])) {
        throw new RuntimeException('Correction snapshot identity mismatch: ' . $row['id']);
    }
    $fields = json_decode($row['changed_fields_json'], false, 512, JSON_THROW_ON_ERROR);
    if (!$fields instanceof stdClass || get_object_vars($fields) === []) {
        throw new RuntimeException('Snapshot has no complete changed-field evidence: ' . $row['id']);
    }
    $mappings = plugin_agentbdmosassetsync_mapping_map($route, $work['itemtype']);
    foreach (get_object_vars($fields) as $id => $field) {
        if (!isset($mappings[$id]) || !plugin_agentbdmosassetsync_object_keys($field, ['value', 'changed_at', 'reliable'])
            || $field->reliable !== true || plugin_agentbdmosassetsync_evidence_time($field->changed_at) === null
            || (!is_scalar($field->value) && $field->value !== null)) {
            throw new RuntimeException('Snapshot mapping or genuine field evidence unavailable: ' . $row['id']);
        }
        plugin_agentbdmosassetsync_field_descriptor($asset, $mappings[$id]->b_field, $mappings[$id]->source === 'A');
    }
    return $fields;
}

function plugin_agentbdmosassetsync_validate_corrections(array $work, array $route, CommonDBTM $asset): array
{
    $rows = [];
    foreach (json_decode($work['handled_change_ids_json'], true, 512, JSON_THROW_ON_ERROR) as $id) {
        $change = new PluginAgentbdmosassetsyncChange();
        if (!$change->getFromDB($id) || !$change->can($id, UPDATE) || !$change->can($id, READ)) {
            throw new RuntimeException('Correction snapshot missing or not permitted: ' . $id);
        }
        if (!in_array($change->fields['status'], ['Pending', 'Done'], true)) {
            throw new RuntimeException('Correction snapshot status is invalid: ' . $id);
        }
        plugin_agentbdmosassetsync_snapshot_scope($work, $route, $asset, $change->fields);
        $rows[$id] = $change->fields;
    }
    return $rows;
}

function plugin_agentbdmosassetsync_begin_corrections(array $work, CommonDBTM $asset): void
{
    plugin_agentbdmosassetsync_route_action($work, static function () use ($work, $asset) {
        $route = plugin_agentbdmosassetsync_current_route($work);
        $fresh = plugin_agentbdmosassetsync_find_existing($work);
        if ($fresh->getID() != $asset->getID()) {
            throw new RuntimeException('Hold: correction link changed');
        }
        $rows = plugin_agentbdmosassetsync_validate_corrections($work, $route, $fresh);
        foreach ($rows as $id => $row) {
            if ($row['status'] === 'Pending' && !(new PluginAgentbdmosassetsyncChange())->recordCorrectionAttempt($id)) {
                $fresh = new PluginAgentbdmosassetsyncChange();
                if (!$fresh->getFromDB($id) || $fresh->fields['status'] !== 'Done') {
                    throw new RuntimeException('Hold: correction attempt could not be recorded: ' . $id);
                }
            }
        }
    });
}

function plugin_agentbdmosassetsync_genuine_time(array $work, CommonDBTM $asset, string $mappingId, $value,
    bool $lockCurrent = false): array
{
    global $DB;
    if (!Session::haveRight(PluginAgentbdmosassetsyncChange::$rightname, READ)) {
        return ['changed_at' => null, 'reliable' => false];
    }
    $criteria = ['FROM' => PluginAgentbdmosassetsyncChange::getTable(), 'WHERE' => [
        'route_id' => $work['route_id'], 'itemtype' => $work['itemtype'],
        'entities_id' => (int) $work['entities_id'], 'a_entities_id' => (int) $work['a_entities_id'],
        'settings_version' => (int) $work['settings_version']], 'ORDER' => 'id DESC'];
    if ($lockCurrent) {
        // A locking read sees changes committed while the actual Fields storage lock was awaited.
        $query = new DBmysqlIterator($DB);
        $query->buildQuery($criteria);
        $rows = [];
        $stored = $DB->doQuery($query->getSql() . ' FOR UPDATE');
        while ($row = $DB->fetchAssoc($stored)) {
            $rows[] = $row;
        }
    } else {
        $rows = $DB->request($criteria);
    }
    foreach ($rows as $row) {
        $identity = json_decode($row['identity_json'], false, 512, JSON_THROW_ON_ERROR);
        if (!$identity instanceof stdClass || ($identity->b_items_id ?? null) !== (int) $asset->getID()
            || ($identity->a_items_id !== null && $identity->a_items_id !== (int) $work['a_items_id'])) {
            continue;
        }
        $fields = json_decode($row['changed_fields_json'], false, 512, JSON_THROW_ON_ERROR);
        if (!$fields instanceof stdClass || !property_exists($fields, $mappingId)) {
            continue;
        }
        $change = new PluginAgentbdmosassetsyncChange();
        if ($lockCurrent) {
            $change->getFromResultSet($row);
        } elseif (!$change->getFromDB($row['id'])) {
            break;
        }
        if (!$change->can($row['id'], READ)) {
            break;
        }
        $field = $fields->$mappingId;
        if (plugin_agentbdmosassetsync_object_keys($field, ['value', 'changed_at', 'reliable'])
            && plugin_agentbdmosassetsync_scalar_equal($field->value, $value) && $field->reliable === true
            && plugin_agentbdmosassetsync_evidence_time($field->changed_at) !== null) {
            return ['changed_at' => $field->changed_at, 'reliable' => true];
        }
        break; // A later genuine edit cannot be replaced with an older coincidentally matching value.
    }
    return ['changed_at' => null, 'reliable' => false];
}

function plugin_agentbdmosassetsync_return_value(array $work, stdClass $mapping, int $assetId): array
{
    return plugin_agentbdmosassetsync_route_action($work, static function () use ($work, $mapping, $assetId) {
        $route = plugin_agentbdmosassetsync_current_route($work);
        $asset = plugin_agentbdmosassetsync_find_existing($work);
        $mappings = plugin_agentbdmosassetsync_mapping_map($route, $work['itemtype']);
        if ($asset->getID() != $assetId || !isset($mappings[$mapping->mapping_id]) || $mappings[$mapping->mapping_id] != $mapping) {
            throw new RuntimeException('Hold: B return mapping or link changed');
        }
        $field = plugin_agentbdmosassetsync_field_descriptor($asset, $mapping->b_field, false);
        $value = plugin_agentbdmosassetsync_field_read($asset, $field);
        return ['value' => $value] + plugin_agentbdmosassetsync_genuine_time($work, $asset, $mapping->mapping_id, $value);
    });
}

function plugin_agentbdmosassetsync_snapshot_returned(stdClass $fields, stdClass $returns): bool
{
    foreach (get_object_vars($fields) as $mappingId => $field) {
        if (!property_exists($returns, $mappingId)) {
            return false;
        }
        $returned = $returns->$mappingId;
        $time = plugin_agentbdmosassetsync_evidence_time($returned['changed_at']);
        if (!plugin_agentbdmosassetsync_scalar_equal($returned['value'], $field->value) || !$returned['reliable'] || $time === null
            || $time < plugin_agentbdmosassetsync_evidence_time($field->changed_at)) {
            return false;
        }
    }
    return true;
}

function plugin_agentbdmosassetsync_covered_returns(array $work, array $result): array
{
    global $DB;
    return plugin_agentbdmosassetsync_route_action($work, static function () use ($work, $result, $DB) {
        $route = plugin_agentbdmosassetsync_current_route($work);
        $asset = plugin_agentbdmosassetsync_find_existing($work);
        $covered = [];
        if (!Session::haveRight(PluginAgentbdmosassetsyncChange::$rightname, READ)) {
            return [];
        }
        foreach ($DB->request(['FROM' => PluginAgentbdmosassetsyncChange::getTable(),
            'WHERE' => ['route_id' => $work['route_id'], 'itemtype' => $work['itemtype'], 'status' => 'Pending'],
            'ORDER' => 'id ASC']) as $row) {
            try {
                $change = new PluginAgentbdmosassetsyncChange();
                if (!$change->getFromDB($row['id']) || !$change->can($row['id'], READ)) {
                    continue;
                }
                $fields = plugin_agentbdmosassetsync_snapshot_scope($work, $route, $asset, $row);
                if (plugin_agentbdmosassetsync_snapshot_returned($fields, $result['b_values_for_a'])) {
                    $covered[] = (int) $row['id'];
                }
            } catch (RuntimeException $e) {
                continue; // A different/old snapshot is never represented by this result.
            }
        }
        return $covered;
    });
}

function plugin_agentbdmosassetsync_correction_coverage(array $work, array $route, CommonDBTM $asset,
    array $row, array $result): void
{
    $fields = plugin_agentbdmosassetsync_snapshot_scope($work, $route, $asset, $row);
    $mappings = plugin_agentbdmosassetsync_mapping_map($route, $work['itemtype']);
    $outcomes = array_column($result['field_outcomes'], 'outcome', 'mapping_id');
    $aValues = json_decode($work['a_values_json'], false, 512, JSON_THROW_ON_ERROR);
    foreach (get_object_vars($fields) as $id => $snapshot) {
        $mapping = $mappings[$id];
        if (!property_exists($aValues, $id) || !isset($outcomes[$id])) {
            throw new RuntimeException('Snapshot field was not fully handled: ' . $id);
        }
        $field = plugin_agentbdmosassetsync_field_descriptor($asset, $mapping->b_field, false);
        $current = plugin_agentbdmosassetsync_locked_value($work, $asset, $field);
        $aValue = plugin_agentbdmosassetsync_exact_work_value($work, $id, $aValues->$id);
        if ($mapping->source === 'Both') {
            $expected = plugin_agentbdmosassetsync_comparison_value($field, $mapping, $aValue);
            if (!plugin_agentbdmosassetsync_scalar_equal($current, $expected)) {
                throw new RuntimeException('Both snapshot still awaits matching A handling: ' . $id);
            }
            if ($outcomes[$id] === 'AlreadyEqual') {
                continue;
            }
            $aTimes = json_decode($work['a_change_times_json'], false, 512, JSON_THROW_ON_ERROR);
            $evidence = $aTimes->$id ?? null;
            $aTime = $evidence instanceof stdClass && $evidence->reliable === true
                ? plugin_agentbdmosassetsync_evidence_time($evidence->changed_at) : null;
            if ($outcomes[$id] === 'AppliedToB' && $aTime !== null
                && $aTime > plugin_agentbdmosassetsync_evidence_time($snapshot->changed_at)) {
                continue;
            }
            throw new RuntimeException('Both snapshot has no complete verified winning outcome: ' . $id);
        }
        $expected = plugin_agentbdmosassetsync_field_value($field,
            plugin_agentbdmosassetsync_write_value($asset, $field, $mapping, $aValue));
        if ($current !== $expected) {
            throw new RuntimeException('Current field differs from the verified A handling: ' . $id);
        }
        if ($mapping->source === 'A' && in_array($outcomes[$id], ['AppliedToB', 'AlreadyEqual'], true)) {
            continue;
        }
        if ($mapping->source === 'B' && $outcomes[$id] === 'ReturnToA'
            && plugin_agentbdmosassetsync_scalar_equal($current, $snapshot->value)
            && plugin_agentbdmosassetsync_snapshot_returned((object) [$id => $snapshot], $result['b_values_for_a'])) {
            continue;
        }
        throw new RuntimeException('Snapshot field has no complete winning outcome: ' . $id);
    }
}

function plugin_agentbdmosassetsync_finish_corrections(PluginAgentbdmosassetsyncWork $record, array &$result): array
{
    global $DB;
    $work = $record->fields;
    $failures = [];
    foreach (json_decode($work['handled_change_ids_json'], true, 512, JSON_THROW_ON_ERROR) as $id) {
        try {
            plugin_agentbdmosassetsync_route_action($work, static function () use ($record, $work, $id, &$result, $DB) {
                $DB->beginTransaction();
                try {
                    $snapshot = $DB->fetchAssoc($DB->doQuery('SELECT * FROM `' . PluginAgentbdmosassetsyncChange::getTable()
                        . '` WHERE `id` = ' . $id . ' FOR UPDATE'));
                    $route = plugin_agentbdmosassetsync_current_route($work);
                    $asset = plugin_agentbdmosassetsync_find_existing($work);
                    plugin_agentbdmosassetsync_lock_current_asset($work, $asset, READ);
                    $change = new PluginAgentbdmosassetsyncChange();
                    if ($snapshot) {
                        $change->getFromResultSet($snapshot);
                    }
                    if (!$snapshot || !$change->can($id, UPDATE) || !$change->can($id, READ)) {
                        throw new RuntimeException('Correction snapshot missing or not permitted: ' . $id);
                    }
                    plugin_agentbdmosassetsync_correction_coverage($work, $route, $asset, $change->fields, $result);
                    if ($change->fields['status'] !== 'Done' && !$change->markDoneInternally($id)) {
                        throw new RuntimeException('Exact snapshot completion was not verified');
                    }
                    $result['handled_change_ids_done'][] = $id;
                    if (!$record->saveProcessorFields((int) $work['id'], ['result_json' => json_encode($result, JSON_THROW_ON_ERROR)])) {
                        throw new RuntimeException('Correction progress could not be saved');
                    }
                    $DB->commit();
                } catch (Throwable $e) {
                    $result['handled_change_ids_done'] = array_values(array_diff($result['handled_change_ids_done'], [$id]));
                    try {
                        $DB->rollBack();
                    } catch (Throwable $rollbackError) {
                        throw new RuntimeException('Hold: correction completion/rollback is uncertain; reconcile exact snapshot ' . $id,
                            0, $rollbackError);
                    }
                    throw $e;
                }
            });
        } catch (Throwable $e) {
            $reason = 'Snapshot ' . $id . ': ' . ($e instanceof RuntimeException ? $e->getMessage() : 'uncertain correction outcome');
            $failures[] = $reason;
            try {
                plugin_agentbdmosassetsync_note_correction_failure($work, $id, $reason);
            } catch (Throwable $metadataError) {
                $failures[] = 'Correction metadata could not be verified for snapshot ' . $id;
            }
        }
    }
    return $failures;
}

function plugin_agentbdmosassetsync_lock_field(CommonDBTM $asset, array $field): void
{
    global $DB;
    $key = $field['container_id'] === null ? 'id' : 'items_id';
    $DB->doQuery('SELECT `id` FROM `' . $field['table'] . '` WHERE `' . $key . '` = '
        . (int) $asset->getID() . ' FOR UPDATE');
}

/** Hydrate the current locking row; a consistent reread may still see the old transaction snapshot. */
function plugin_agentbdmosassetsync_lock_current_asset(array $work, CommonDBTM $asset, int $right): void
{
    global $DB;
    if ($asset::class !== $work['itemtype']) {
        throw new RuntimeException('Hold: current asset concrete type changed');
    }
    $query = new DBmysqlIterator($DB);
    $query->buildQuery(['FROM' => $asset::getTable(), 'WHERE' =>
        ['id' => (int) $asset->getID()] + $asset::getSystemSQLCriteria()]);
    $rows = $DB->doQuery($query->getSql() . ' FOR UPDATE');
    if ($DB->numrows($rows) !== 1) {
        throw new RuntimeException('Hold: current asset is missing or belongs to another concrete type');
    }
    $asset->getFromResultSet($DB->fetchAssoc($rows));
    $asset->post_getFromDB();
    if ((int) $asset->getEntityID() !== (int) $work['entities_id']
        || !empty($asset->fields['is_deleted']) || !empty($asset->fields['is_template'])
        || !$asset->can($asset->getID(), $right)) {
        throw new RuntimeException('Hold: current locked asset scope or submitting permission changed');
    }
    $query->buildQuery(['FROM' => PluginAgentbdmosassetsyncWork::getTable(), 'WHERE' =>
        ['itemtype' => $work['itemtype'], 'b_items_id' => (int) $asset->getID()]]);
    $owners = $DB->doQuery($query->getSql() . ' FOR UPDATE');
    while ($owner = $DB->fetchAssoc($owners)) {
        if ($owner['route_id'] !== $work['route_id'] || (int) $owner['a_items_id'] !== (int) $work['a_items_id']) {
            throw new RuntimeException('Hold: current B asset has competing retained ownership');
        }
    }
}

/** Validate the actual Fields owner and scope before using its locked storage values. */
function plugin_agentbdmosassetsync_locked_fields_row(CommonDBTM $asset, array $field): ?array
{
    global $DB;
    $rows = $DB->doQuery('SELECT * FROM `' . $field['table'] . '` WHERE `items_id` = '
        . (int) $asset->getID() . ' FOR UPDATE');
    if ($DB->numrows($rows) > 1) {
        throw new RuntimeException('Hold: current Fields storage is ambiguous');
    }
    $row = $DB->fetchAssoc($rows) ?: null;
    if ($row !== null && ((int) $row['items_id'] !== (int) $asset->getID()
        || $row['itemtype'] !== $asset::class
        || (int) $row['plugin_fields_containers_id'] !== $field['container_id']
        || ($asset->isEntityAssign() && (!array_key_exists('entities_id', $row)
            || (int) $row['entities_id'] !== (int) $asset->getEntityID())))) {
        throw new RuntimeException('Hold: current Fields row owner, container, or entity changed');
    }
    $rows = $DB->doQuery('SELECT * FROM `' . PluginFieldsContainer::getTable() . '` WHERE `id` = '
        . (int) $field['container_id'] . ' FOR UPDATE');
    $container = $DB->fetchAssoc($rows);
    if (!$container || !$container['is_active']
        || !in_array($asset::class, PluginFieldsToolbox::decodeJSONItemtypes($container['itemtypes']), true)
        || PluginFieldsContainer::getClassname($asset::class, $container['name']) !== $field['storage_class']) {
        throw new RuntimeException('Hold: current Fields container is unavailable for this concrete type');
    }
    $entities = $container['is_recursive'] ? getSonsOf('glpi_entities', (int) $container['entities_id'])
        : [(int) $container['entities_id']];
    if (($asset->isEntityAssign() && !in_array((int) $asset->getEntityID(), array_map('intval', $entities), true))
        || PluginFieldsProfile::getRightOnContainer((int) ($_SESSION['glpiactiveprofile']['id'] ?? 0),
            $field['container_id']) < READ) {
        throw new RuntimeException('Hold: current Fields container scope or read permission changed');
    }
    return $row;
}

/** Read the locked row itself, rather than an older repeatable-read snapshot. */
function plugin_agentbdmosassetsync_locked_value(array $work, CommonDBTM $asset, array $field, bool $allowMissing = false)
{
    plugin_agentbdmosassetsync_lock_current_asset($work, $asset, READ);
    $row = $field['container_id'] === null ? $asset->fields
        : plugin_agentbdmosassetsync_locked_fields_row($asset, $field);
    if ($row === null) {
        if ($allowMissing) {
            return null;
        }
        throw new RuntimeException('Hold: current field storage is missing');
    }
    $value = $row[$field['column']];
    if ($field['custom_field_id'] !== null) {
        $values = json_decode($value ?? '[]', true, 512, JSON_THROW_ON_ERROR);
        $value = $field['custom_type']->formatValueFromDB($values[$field['custom_field_id']] ?? $field['custom_default']);
    }
    if ($field['kind'] === 'dropdown' && ($value === null || (int) $value === 0)) {
        return null;
    }
    return plugin_agentbdmosassetsync_field_value($field, $value);
}

function plugin_agentbdmosassetsync_note_correction_failure(array $work, int $id, string $reason): void
{
    plugin_agentbdmosassetsync_route_action($work, static function () use ($work, $id, $reason) {
        $route = plugin_agentbdmosassetsync_current_route($work);
        $asset = plugin_agentbdmosassetsync_find_existing($work);
        $change = new PluginAgentbdmosassetsyncChange();
        if (!$change->getFromDB($id) || !$change->can($id, READ) || !$change->can($id, UPDATE)) {
            throw new RuntimeException('Correction failure metadata is not currently permitted');
        }
        plugin_agentbdmosassetsync_snapshot_scope($work, $route, $asset, $change->fields);
        if ($change->fields['status'] === 'Pending' && !$change->recordCorrectionFailure($id, $reason)) {
            throw new RuntimeException('Correction failure metadata was not verified');
        }
    });
}
