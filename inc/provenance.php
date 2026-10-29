<?php

/** Immutable Change rows are human-edit history; this row describes only the value present now. */
function plugin_agentbdmosassetsync_provenance_keys(array $scope, CommonDBTM $asset, string $mappingId): array
{
    return ['route_id' => $scope['route_id'], 'itemtype' => $asset::class,
        'b_items_id' => (int) $asset->getID(), 'mapping_id' => $mappingId];
}

function plugin_agentbdmosassetsync_provenance_parent(CommonDBTM $asset): ?array
{
    $created = $asset->fields['date_creation'] ?? null;
    if (!$asset->isEntityAssign() || $asset->getID() < 1) {
        return null;
    }
    return ['itemtype' => $asset::class, 'table' => $asset::getTable(), 'id' => (int) $asset->getID(),
        'entities_id' => (int) $asset->getEntityID(),
        'date_creation' => is_string($created) && $created !== '' ? $created : null];
}

function plugin_agentbdmosassetsync_provenance_row(array $keys, bool $locking = false): ?array
{
    global $DB;
    $query = new DBmysqlIterator($DB);
    $query->buildQuery(['FROM' => 'glpi_plugin_agentbdmosassetsync_scalarstates', 'WHERE' => $keys]);
    $result = $DB->doQuery($query->getSql() . ($locking ? ' FOR UPDATE' : ''));
    return $DB->fetchAssoc($result) ?: null;
}

function plugin_agentbdmosassetsync_provenance_state(?array $row): ?array
{
    try {
        $state = json_decode($row['state_json'] ?? '', true, 512, JSON_THROW_ON_ERROR);
        return is_array($state) && ($state['version'] ?? null) === 1 ? $state : null;
    } catch (Throwable $e) {
        return null;
    }
}

function plugin_agentbdmosassetsync_provenance_storage(CommonDBTM $asset, array $descriptor, bool $locking = false): ?array
{
    global $DB;
    $where = $descriptor['container_id'] === null ? ['id' => (int) $asset->getID()] : ['items_id' => (int) $asset->getID()];
    $query = new DBmysqlIterator($DB);
    $query->buildQuery(['SELECT' => ['id'], 'FROM' => $descriptor['table'], 'WHERE' => $where]);
    $result = $DB->doQuery($query->getSql() . ($locking ? ' FOR UPDATE' : ''));
    $rows = [];
    while ($row = $DB->fetchAssoc($result)) {
        $rows[] = $row;
    }
    if (count($rows) !== 1) {
        return null;
    }
    $row = reset($rows);
    return ['table' => $descriptor['table'], 'id' => (int) $row['id'], 'column' => $descriptor['column'],
        'custom_field_id' => $descriptor['custom_field_id']];
}

function plugin_agentbdmosassetsync_provenance_scope(array $scope, CommonDBTM $asset, int $aId): array
{
    return ['a_entities_id' => (int) $scope['a_entities_id'], 'entities_id' => (int) $scope['entities_id'],
        'a_items_id' => $aId];
}

/** A token plus exact-byte comparison prevents an older save from restoring over a later capture. */
function plugin_agentbdmosassetsync_provenance_replace(array $keys, string $expected, string $next): bool
{
    global $DB;
    $parts = [];
    foreach ($keys as $key => $value) {
        $parts[] = '`' . $key . '` = ' . $DB::quoteValue($value);
    }
    $DB->doQuery('UPDATE `glpi_plugin_agentbdmosassetsync_scalarstates` SET `state_json` = '
        . $DB::quoteValue($next) . ' WHERE ' . implode(' AND ', $parts)
        . ' AND BINARY `state_json` = BINARY ' . $DB::quoteValue($expected));
    $saved = plugin_agentbdmosassetsync_provenance_row($keys, true);
    return $saved !== null && $saved['state_json'] === $next;
}

function plugin_agentbdmosassetsync_provenance_matches(?array $row, ?array $state, array $scope,
    CommonDBTM $asset, int $aId, array $binding): bool
{
    if ($row === null || $state === null || ($state['parent'] ?? null) !== plugin_agentbdmosassetsync_provenance_parent($asset)
        || ($state['parent'] ?? null) === null || ($state['generation'] ?? null) !== $binding['generation']
        || ($state['binding_hash'] ?? null) !== $binding['binding_hash']) {
        return false;
    }
    foreach (plugin_agentbdmosassetsync_provenance_scope($scope, $asset, $aId) as $key => $value) {
        if ((int) $row[$key] !== $value) {
            return false;
        }
    }
    return true;
}

/** No transaction is started here: callers place the durable barrier before the possible native write. */
function plugin_agentbdmosassetsync_provenance_barrier(array $scope, CommonDBTM $asset, stdClass $mapping,
    int $aId, ?array $binding, ?int $workId, bool $preservePrevious = true): array
{
    global $DB;
    $keys = plugin_agentbdmosassetsync_provenance_keys($scope, $asset, $mapping->mapping_id);
    $row = plugin_agentbdmosassetsync_provenance_row($keys);
    $previous = plugin_agentbdmosassetsync_provenance_state($row);
    $valid = $preservePrevious && $binding !== null
        && plugin_agentbdmosassetsync_provenance_matches($row, $previous, $scope, $asset, $aId, $binding);
    $token = bin2hex(random_bytes(24));
    $state = ['version' => 1, 'parent' => plugin_agentbdmosassetsync_provenance_parent($asset),
        'generation' => $binding['generation'] ?? null, 'binding_hash' => $binding['binding_hash'] ?? null,
        'current' => null, 'barrier' => ['token' => $token, 'work_id' => $workId,
            'previous' => $valid ? ($previous['current'] ?? null) : null]];
    $json = json_encode($state, JSON_THROW_ON_ERROR | JSON_PRESERVE_ZERO_FRACTION);
    $values = $keys + plugin_agentbdmosassetsync_provenance_scope($scope, $asset, $aId) + ['state_json' => $json];
    if (!$preservePrevious) {
        // A human save cannot be blocked after losing a CAS race. It may only discard trust here.
        $DB->updateOrInsert('glpi_plugin_agentbdmosassetsync_scalarstates', $values, $keys);
    } elseif ($row === null) {
        $columns = array_map(static fn($column) => '`' . $column . '`', array_keys($values));
        $quoted = array_map(static fn($value) => $DB::quoteValue($value), array_values($values));
        $DB->doQuery('INSERT INTO `glpi_plugin_agentbdmosassetsync_scalarstates` (' . implode(', ', $columns)
            . ') VALUES (' . implode(', ', $quoted) . ') ON DUPLICATE KEY UPDATE `id` = `id`');
    } else {
        $assignments = [];
        foreach (plugin_agentbdmosassetsync_provenance_scope($scope, $asset, $aId) + ['state_json' => $json] as $key => $value) {
            $assignments[] = '`' . $key . '` = ' . $DB::quoteValue($value);
        }
        $DB->doQuery('UPDATE `glpi_plugin_agentbdmosassetsync_scalarstates` SET ' . implode(', ', $assignments)
            . ' WHERE `id` = ' . (int) $row['id'] . ' AND BINARY `state_json` = BINARY ' . $DB::quoteValue($row['state_json']));
    }
    $saved = plugin_agentbdmosassetsync_provenance_row($keys);
    if ($saved === null || $saved['state_json'] !== $json) {
        throw new RuntimeException('Scalar evidence invalidation could not be verified');
    }
    $context = ['keys' => $keys, 'json' => $json, 'state' => $state, 'binding' => $binding,
        'previous_json' => $valid ? $row['state_json'] : null, 'token' => $token];
    if ($workId !== null) {
        $GLOBALS['plugin_agentbdmosassetsync_provenance'][$token] = ['work_id' => $workId, 'json' => $json];
    }
    return $context;
}

function plugin_agentbdmosassetsync_provenance_begin(array $work, CommonDBTM $asset, stdClass $mapping,
    array $descriptor): array
{
    $route = plugin_agentbdmosassetsync_current_route($work);
    $binding = plugin_agentbdmosassetsync_evidence_binding($route, $mapping, $descriptor);
    return plugin_agentbdmosassetsync_provenance_barrier($route, $asset, $mapping, (int) $work['a_items_id'],
        $binding, (int) $work['id']);
}

function plugin_agentbdmosassetsync_provenance_end(?array $barrier): void
{
    if ($barrier !== null) {
        unset($GLOBALS['plugin_agentbdmosassetsync_provenance'][$barrier['token']]);
    }
}

/** Restore only after positively confirmed no-write completion. Uncertainty retains the barrier. */
function plugin_agentbdmosassetsync_provenance_restore(?array $barrier): void
{
    if ($barrier !== null && $barrier['previous_json'] !== null) {
        plugin_agentbdmosassetsync_provenance_replace($barrier['keys'], $barrier['json'], $barrier['previous_json']);
    }
}

/** A copied value is not a human edit. Unknown Work receipts cannot establish its reliable origin. */
function plugin_agentbdmosassetsync_provenance_receipt(array $scope, CommonDBTM $asset, string $id,
    array $proof, bool $locking): bool
{
    global $DB;
    $record = $proof['origin'] === 'Local' ? new PluginAgentbdmosassetsyncChange() : new PluginAgentbdmosassetsyncWork();
    if ($locking) {
        $row = $DB->fetchAssoc($DB->doQuery('SELECT * FROM `' . $record::getTable()
            . '` WHERE `id` = ' . (int) $proof['record_id'] . ' FOR UPDATE'));
        if (!$row) {
            return false;
        }
        $record->getFromResultSet($row);
    } elseif (!$record->getFromDB($proof['record_id'])) {
        return false;
    }
    if (!$record->can($proof['record_id'], READ)) {
        return false;
    }
    if ($proof['origin'] === 'Local') {
        $identity = json_decode($record->fields['identity_json'], true, 512, JSON_THROW_ON_ERROR);
        $fields = json_decode($record->fields['changed_fields_json'], true, 512, JSON_THROW_ON_ERROR);
        $field = $fields[$id] ?? null;
        $valid = is_array($field) && ($field['reliable'] ?? null) === true
            && ($field['changed_at'] ?? null) === $proof['changed_at']
            && plugin_agentbdmosassetsync_scalar_equal($field['value'] ?? null, $proof['value'])
            && (int) ($identity['b_items_id'] ?? 0) === (int) $asset->getID()
            && (int) ($identity['a_items_id'] ?? 0) === (int) $scope['a_items_id'];
    } else {
        if (!in_array($record->fields['status'], ['Done', 'Held', 'Failed'], true)
            || (int) $record->fields['b_items_id'] !== (int) $asset->getID()
            || (int) $record->fields['a_items_id'] !== (int) $scope['a_items_id']) {
            return false;
        }
        $result = json_decode($record->fields['result_json'] ?? '', true, 512, JSON_THROW_ON_ERROR);
        $outcomes = array_column($result['field_outcomes'] ?? [], null, 'mapping_id');
        $field = $outcomes[$id] ?? null;
        $valid = is_array($field) && ($field['outcome'] ?? null) === 'AppliedToB';
        if (($proof['first_copy'] ?? false) === true) {
            $identity = json_decode($record->fields['identity_json'], true, 512, JSON_THROW_ON_ERROR);
            $valid = $valid && $record->fields['status'] === 'Done' && $record->fields['operation'] === 'Sync'
                && $record->fields['link_state'] === 'Active' && $record->fields['completed_at'] !== null
                && ($identity['b_items_id'] ?? null) === null
                && ($result['created_b_items_id'] ?? null) === (int) $asset->getID()
                && ($result['b_items_id'] ?? null) === (int) $asset->getID();
        }
        if (plugin_agentbdmosassetsync_field_sync_enabled($record->fields)) {
            $valid = $valid && plugin_agentbdmosassetsync_field_sync_journal($record->fields) !== null
                && ($field['certainty'] ?? null) === 'VerifiedApplied'
                && (($result['field_sync']['in_flight']['mapping_id'] ?? null) !== $id);
        }
    }
    foreach (['route_id', 'itemtype'] as $key) {
        $valid = $valid && $record->fields[$key] === $scope[$key];
    }
    foreach (['a_entities_id', 'entities_id'] as $key) {
        $valid = $valid && (int) $record->fields[$key] === (int) $scope[$key];
    }
    return $valid && ($record->fields['subject'] ?? 'Asset') === 'Asset';
}

function plugin_agentbdmosassetsync_provenance_read(array $work, CommonDBTM $asset, stdClass $mapping,
    array $descriptor, $value, bool $locking = false): array
{
    $unknown = ['changed_at' => null, 'reliable' => false];
    try {
        $route = plugin_agentbdmosassetsync_current_route($work);
        $binding = plugin_agentbdmosassetsync_evidence_binding($route, $mapping, $descriptor);
        if ($binding === null) {
            return $unknown;
        }
        $row = plugin_agentbdmosassetsync_provenance_row(
            plugin_agentbdmosassetsync_provenance_keys($work, $asset, $mapping->mapping_id), $locking);
        $state = plugin_agentbdmosassetsync_provenance_state($row);
        if (!plugin_agentbdmosassetsync_provenance_matches($row, $state, $work, $asset, (int) $work['a_items_id'], $binding)) {
            return $unknown;
        }
        $proof = $state['current'] ?? null;
        $barrier = $state['barrier'] ?? null;
        $owned = is_array($barrier) ? ($GLOBALS['plugin_agentbdmosassetsync_provenance'][$barrier['token'] ?? ''] ?? null) : null;
        if ($proof === null && is_array($owned) && $owned['work_id'] === (int) $work['id']
            && $owned['json'] === $row['state_json']) {
            $proof = $barrier['previous'];
        }
        if (!is_array($proof) || !in_array($proof['origin'] ?? null, ['Local', 'Copied'], true)
            || ($proof['reliable'] ?? null) !== true || !array_key_exists('value', $proof)
            || !plugin_agentbdmosassetsync_scalar_equal($proof['value'], $value)
            || ($proof['storage'] ?? null) === null
            || $proof['storage'] !== plugin_agentbdmosassetsync_provenance_storage($asset, $descriptor, $locking)
            || plugin_agentbdmosassetsync_evidence_time($proof['changed_at'] ?? null) === null
            || !plugin_agentbdmosassetsync_provenance_receipt($work, $asset, $mapping->mapping_id, $proof, $locking)) {
            return $unknown;
        }
        return ['changed_at' => $proof['changed_at'], 'reliable' => true];
    } catch (Throwable $e) {
        return $unknown;
    }
}

/** This replacement shares the native transaction; final public receipts must still confirm it. */
function plugin_agentbdmosassetsync_provenance_copied(array $work, CommonDBTM $asset, stdClass $mapping,
    array $descriptor, $value, array $barrier, bool $firstCopy = false): void
{
    $route = plugin_agentbdmosassetsync_current_route($work);
    $binding = plugin_agentbdmosassetsync_evidence_binding($route, $mapping, $descriptor);
    if ($binding === null && $barrier['binding'] === null) {
        return; // A authority may save without inventing reliable provenance for an unknown binding.
    }
    if ($binding === null || $binding !== $barrier['binding']) {
        throw new RuntimeException('Copied-value field binding changed');
    }
    $times = json_decode($work['a_change_times_json'], true, 512, JSON_THROW_ON_ERROR);
    $time = $times[$mapping->mapping_id] ?? [];
    $reliable = ($time['reliable'] ?? null) === true
        && plugin_agentbdmosassetsync_evidence_time($time['changed_at'] ?? null) !== null;
    $state = $barrier['state'];
    $state['barrier'] = null;
    $state['current'] = ['origin' => 'Copied', 'record_id' => (int) $work['id'], 'value' => $value,
        'changed_at' => $reliable ? $time['changed_at'] : null, 'reliable' => $reliable,
        'storage' => plugin_agentbdmosassetsync_provenance_storage($asset, $descriptor, true)];
    if ($firstCopy) {
        $state['current']['first_copy'] = true;
    }
    if (!plugin_agentbdmosassetsync_provenance_replace($barrier['keys'], $barrier['json'],
        json_encode($state, JSON_THROW_ON_ERROR | JSON_PRESERVE_ZERO_FRACTION))) {
        throw new RuntimeException('Copied-value evidence changed before verification');
    }
}

/** A new asset, its association, receipt and copied proof share the first-copy transaction. */
function plugin_agentbdmosassetsync_provenance_first_copy(array $work, CommonDBTM $asset, array $seeds): array
{
    global $DB;
    $route = plugin_agentbdmosassetsync_current_route($work);
    plugin_agentbdmosassetsync_lock_current_asset($work, $asset, READ);
    $row = $DB->fetchAssoc($DB->doQuery('SELECT * FROM `' . PluginAgentbdmosassetsyncWork::getTable()
        . '` WHERE `id` = ' . (int) $work['id'] . ' FOR UPDATE'));
    if (!$row) {
        throw new RuntimeException('Save failed: first-copy association or receipt is unavailable');
    }
    $result = json_decode($row['result_json'] ?? '', true, 512, JSON_THROW_ON_ERROR);
    $identity = json_decode($work['identity_json'], true, 512, JSON_THROW_ON_ERROR);
    if (($row['subject'] ?? 'Asset') !== 'Asset' || $row['operation'] !== 'Sync'
        || $row['status'] !== 'Accepted' || $row['processing_started_at'] === null
        || ($identity['b_items_id'] ?? null) !== null || $work['b_items_id'] !== null
        || (int) $row['b_items_id'] !== (int) $asset->getID() || $row['link_state'] !== 'Active'
        || !array_key_exists('created_b_items_id', $result) || $result['created_b_items_id'] !== null
        || ($result['b_items_id'] ?? null) !== (int) $asset->getID()) {
        throw new RuntimeException('Save failed: first-copy association or receipt is unavailable');
    }
    foreach (['route_id', 'itemtype', 'a_entities_id', 'entities_id', 'a_items_id', 'settings_version'] as $key) {
        if ((string) $row[$key] !== (string) $work[$key]) {
            throw new RuntimeException('Save failed: first-copy receipt scope changed');
        }
    }
    $mappings = plugin_agentbdmosassetsync_mapping_map($route, $work['itemtype']);
    $outcomes = array_column($result['field_outcomes'] ?? [], null, 'mapping_id');
    $evidence = ['work' => $row, 'states' => []];
    foreach ($seeds as $seed) {
        $id = $seed['mapping_id'];
        $mapping = $mappings[$id] ?? null;
        if ($mapping === null || $mapping != $seed['mapping']
            || ($outcomes[$id]['outcome'] ?? null) !== 'AppliedToB') {
            throw new RuntimeException('Save failed: first-copy mapping receipt changed');
        }
        $descriptor = plugin_agentbdmosassetsync_field_descriptor($asset, $mapping->b_field, false);
        $binding = plugin_agentbdmosassetsync_evidence_binding($route, $mapping, $descriptor);
        if ($binding === null || $binding !== $seed['binding']) {
            throw new RuntimeException('Save failed: first-copy field binding changed');
        }
        plugin_agentbdmosassetsync_field_sync_transactional($asset, $descriptor);
        if (!plugin_agentbdmosassetsync_scalar_equal(
            plugin_agentbdmosassetsync_locked_value($work, $asset, $descriptor), $seed['expected'])
            || plugin_agentbdmosassetsync_provenance_storage($asset, $descriptor, true) === null) {
            throw new RuntimeException('Save failed: first-copy field proof could not be verified');
        }
        $keys = plugin_agentbdmosassetsync_provenance_keys($work, $asset, $id);
        if (plugin_agentbdmosassetsync_provenance_row($keys, true) !== null) {
            throw new RuntimeException('Save failed: first-copy field already has current provenance');
        }
        $barrier = plugin_agentbdmosassetsync_provenance_barrier($route, $asset, $mapping,
            (int) $work['a_items_id'], $binding, null);
        plugin_agentbdmosassetsync_provenance_copied($work, $asset, $mapping, $descriptor,
            $seed['expected'], $barrier, true);
        $evidence['states'][] = plugin_agentbdmosassetsync_provenance_row($keys, true);
    }
    return $evidence;
}

/** Native hooks can leak a nested transaction; same-session readback cannot establish commit. */
function plugin_agentbdmosassetsync_provenance_first_copy_visible(array $work, array $evidence): void
{
    global $DB;
    $lock = 'asb-setting-' . sha1($work['route_id']);
    $observer = null;
    $failure = null;
    try {
        $owner = $DB->fetchAssoc($DB->doQuery('SELECT CONNECTION_ID() AS id'));
        $ownerId = (int) ($owner['id'] ?? 0);
        if ($ownerId < 1) {
            throw new RuntimeException('First-copy lock owner is unavailable');
        }
        $observer = new DB();
        plugin_agentbdmosassetsync_field_sync_reconcile_initialize($observer, $lock, $ownerId);
        $visible = $observer->fetchAssoc($observer->doQuery('SELECT * FROM `'
            . PluginAgentbdmosassetsyncWork::getTable() . '` WHERE `id` = ' . (int) $work['id']));
        if ($visible !== $evidence['work']) {
            throw new RuntimeException('First-copy association or receipt is not independently visible');
        }
        foreach ($evidence['states'] as $state) {
            $visible = $observer->fetchAssoc($observer->doQuery('SELECT * FROM `glpi_plugin_agentbdmosassetsync_scalarstates`'
                . ' WHERE `id` = ' . (int) $state['id']));
            if ($visible !== $state) {
                throw new RuntimeException('First-copy field proof is not independently visible');
            }
        }
    } catch (Throwable $e) {
        $failure = new RuntimeException('First-copy commit evidence is uncertain; stop this worker', 9101, $e);
    } finally {
        if ($observer instanceof DBmysql && $observer->connected) {
            try {
                if (!$observer->close()) {
                    throw new RuntimeException('First-copy observer did not close');
                }
            } catch (Throwable $e) {
                $failure = $failure ?? new RuntimeException('First-copy observer cleanup is uncertain; stop this worker', 9101, $e);
            }
        }
    }
    if ($failure !== null) {
        throw $failure;
    }
}

function plugin_agentbdmosassetsync_provenance_capture_begin(array $route, CommonDBTM $asset,
    stdClass $mapping, array $identity): array
{
    $manifest = plugin_agentbdmosassetsync_evidence_manifest($route);
    $entry = $manifest?->bindings->{$mapping->mapping_id} ?? null;
    $binding = plugin_agentbdmosassetsync_evidence_entry($entry, (int) $route['settings_version'])
        ? get_object_vars($entry) : null;
    try {
        return plugin_agentbdmosassetsync_provenance_barrier($route, $asset, $mapping,
            (int) ($identity['a_items_id'] ?? 0), $binding, null);
    } catch (Throwable $e) {
        return plugin_agentbdmosassetsync_provenance_barrier($route, $asset, $mapping,
            (int) ($identity['a_items_id'] ?? 0), $binding, null, false);
    }
}

/** A failed/skipped capture leaves its barrier; a later coincidentally matching value cannot revive it. */
function plugin_agentbdmosassetsync_provenance_capture_finish(array $barrier, array $route, CommonDBTM $asset,
    stdClass $mapping, array $descriptor, $value, string $time, int $changeId): void
{
    $current = plugin_agentbdmosassetsync_read_setting($route['route_id']);
    $binding = $current === null ? null : plugin_agentbdmosassetsync_evidence_binding($current, $mapping, $descriptor);
    if ($binding === null || $binding !== $barrier['binding']
        || plugin_agentbdmosassetsync_provenance_parent($asset) !== $barrier['state']['parent']) {
        return;
    }
    $state = $barrier['state'];
    $state['barrier'] = null;
    $state['current'] = ['origin' => 'Local', 'record_id' => $changeId, 'value' => $value,
        'changed_at' => $time, 'reliable' => true,
        'storage' => plugin_agentbdmosassetsync_provenance_storage($asset, $descriptor)];
    plugin_agentbdmosassetsync_provenance_replace($barrier['keys'], $barrier['json'],
        json_encode($state, JSON_THROW_ON_ERROR | JSON_PRESERVE_ZERO_FRACTION));
}

/** Controls close periods where local capture is deliberately suspended; no field value is written. */
function plugin_agentbdmosassetsync_provenance_invalidate_parent(array $work, CommonDBTM $asset): void
{
    global $DB;
    $criteria = ['route_id' => $work['route_id'], 'itemtype' => $asset::class, 'b_items_id' => (int) $asset->getID()];
    foreach ($DB->request(['FROM' => 'glpi_plugin_agentbdmosassetsync_scalarstates', 'WHERE' => $criteria]) as $row) {
        $state = ['version' => 1, 'parent' => plugin_agentbdmosassetsync_provenance_parent($asset),
            'generation' => null, 'binding_hash' => null, 'current' => null, 'barrier' => null,
            'invalidated' => bin2hex(random_bytes(24))];
        $json = json_encode($state, JSON_THROW_ON_ERROR);
        if (!$DB->update('glpi_plugin_agentbdmosassetsync_scalarstates', ['state_json' => $json], ['id' => (int) $row['id']])) {
            throw new RuntimeException('Scalar parent evidence invalidation failed');
        }
        $saved = plugin_agentbdmosassetsync_provenance_row($criteria + ['mapping_id' => $row['mapping_id']], true);
        if ($saved === null || $saved['state_json'] !== $json) {
            throw new RuntimeException('Scalar parent evidence invalidation is uncertain');
        }
    }
}
