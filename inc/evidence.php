<?php

/** Stable order makes JSON object formatting irrelevant to binding identity. */
function plugin_agentbdmosassetsync_evidence_canonical($value)
{
    if ($value instanceof stdClass) {
        $properties = get_object_vars($value);
        ksort($properties, SORT_STRING);
        foreach ($properties as &$property) {
            $property = plugin_agentbdmosassetsync_evidence_canonical($property);
        }
        unset($property);
        return (object) $properties;
    }
    if (is_array($value)) {
        foreach ($value as &$entry) {
            $entry = plugin_agentbdmosassetsync_evidence_canonical($entry);
        }
        unset($entry);
    }
    return $value;
}

/** Bind evidence to the real local definition, not only its reusable display/name selector. */
function plugin_agentbdmosassetsync_evidence_fingerprint(array $route, stdClass $mapping, array $descriptor): string
{
    global $DB;
    $definition = [
        'storage_class' => $descriptor['storage_class'], 'table' => $descriptor['table'],
        'column' => $descriptor['column'], 'value_column' => $descriptor['value_column'],
        'kind' => $descriptor['kind'], 'dropdown_class' => $descriptor['dropdown_class'],
        'container_id' => $descriptor['container_id'], 'custom_field_id' => $descriptor['custom_field_id'],
        'sql_type' => $descriptor['sql']['Type'], 'sql_nullable' => $descriptor['sql']['Null'],
    ];
    if ($descriptor['container_id'] !== null) {
        $fields = iterator_to_array($DB->request(['FROM' => PluginFieldsField::getTable(), 'WHERE' => [
            'plugin_fields_containers_id' => $descriptor['container_id'], 'name' => $mapping->b_field->name,
            'is_active' => 1]]));
        if (count($fields) !== 1) {
            throw new RuntimeException('Field binding definition is unavailable');
        }
        $field = reset($fields);
        $definition['fields_field_id'] = (int) $field['id'];
        $definition['fields_type'] = $field['type'];
        $definition['fields_multiple'] = (int) $field['multiple'];
    }
    if (is_a($mapping->itemtype, \Glpi\Asset\Asset::class, true)) {
        $assetDefinition = ($mapping->itemtype)::getDefinition();
        $definition['asset_definition_id'] = (int) $assetDefinition->getID();
        if ($descriptor['custom_field_id'] !== null) {
            $found = false;
            foreach ($assetDefinition->getCustomFieldDefinitions() as $custom) {
                if ((int) $custom->getID() !== $descriptor['custom_field_id']) {
                    continue;
                }
                // Core post_getFromDB() decodes these raw options without resolving profile restrictions.
                $definition['custom_type'] = $custom->fields['type'];
                $definition['custom_options'] = (object) $custom->fields['field_options'];
                $definition['custom_itemtype'] = $custom->fields['itemtype'];
                $definition['custom_default'] = $custom->fields['default_value'];
                $found = true;
                break;
            }
            if (!$found) {
                throw new RuntimeException('Custom field binding definition is unavailable');
            }
        } else {
            foreach ($assetDefinition->getDecodedFieldsField() as $field) {
                if ($field['key'] === $mapping->b_field->name) {
                    $definition['native_options'] = (object) ($field['field_options'] ?? []);
                    break;
                }
            }
        }
    }
    $identity = ['route_id' => $route['route_id'], 'a_entities_id' => (int) $route['a_entities_id'],
        'entities_id' => (int) $route['entities_id'], 'mapping' => $mapping, 'definition' => (object) $definition];
    return hash('sha256', json_encode(plugin_agentbdmosassetsync_evidence_canonical((object) $identity),
        JSON_THROW_ON_ERROR | JSON_PRESERVE_ZERO_FRACTION));
}

/** Only an exact current publication can authorize the continuation of an evidence generation. */
function plugin_agentbdmosassetsync_evidence_manifest(array $route): ?stdClass
{
    try {
        $manifest = json_decode($route['evidence_bindings_json'] ?? '', false, 512, JSON_THROW_ON_ERROR);
        if (!plugin_agentbdmosassetsync_object_keys($manifest, ['version', 'settings_version', 'bindings'])
            || $manifest->version !== 1 || $manifest->settings_version !== (int) $route['settings_version']
            || !$manifest->bindings instanceof stdClass) {
            return null;
        }
        return $manifest;
    } catch (Throwable $e) {
        return null;
    }
}

function plugin_agentbdmosassetsync_evidence_active(array $route, stdClass $mapping): bool
{
    return (int) $route['route_enabled'] === 1 && $mapping->enabled === true
        && in_array($mapping->itemtype, json_decode($route['enabled_itemtypes_json'], true, 512, JSON_THROW_ON_ERROR), true);
}

function plugin_agentbdmosassetsync_evidence_entry($entry, int $version): bool
{
    return plugin_agentbdmosassetsync_object_keys($entry, ['generation', 'binding_hash', 'since_version'])
        && is_string($entry->generation) && preg_match('/\A[a-f0-9]{64}\z/D', $entry->generation) === 1
        && is_string($entry->binding_hash) && preg_match('/\A[a-f0-9]{64}\z/D', $entry->binding_hash) === 1
        && plugin_agentbdmosassetsync_is_uint($entry->since_version, 1) && $entry->since_version <= $version;
}

/** Safe configuration causes are separate from an absent genuine edit timestamp. */
function plugin_agentbdmosassetsync_evidence_binding_issue(array $route, stdClass $mapping, array $descriptor): ?string
{
    if (plugin_agentbdmosassetsync_evidence_upgrade_pending()) {
        return 'UPGRADE_PENDING';
    }
    try {
        $manifest = plugin_agentbdmosassetsync_evidence_manifest($route);
        if ($manifest === null) {
            return 'MANIFEST_UNAVAILABLE';
        }
        if (!plugin_agentbdmosassetsync_evidence_active($route, $mapping)) {
            return 'MAPPING_INACTIVE';
        }
        if (!property_exists($manifest->bindings, $mapping->mapping_id)) {
            return 'BINDING_MISSING';
        }
        $entry = $manifest->bindings->{$mapping->mapping_id};
        if (!plugin_agentbdmosassetsync_evidence_entry($entry, (int) $route['settings_version'])) {
            return 'BINDING_INVALID';
        }
        return $entry->binding_hash === plugin_agentbdmosassetsync_evidence_fingerprint($route, $mapping, $descriptor)
            ? null : 'BINDING_CHANGED';
    } catch (Throwable $e) {
        return 'BINDING_UNVERIFIABLE';
    }
}

function plugin_agentbdmosassetsync_evidence_binding(array $route, stdClass $mapping, array $descriptor): ?array
{
    if (plugin_agentbdmosassetsync_evidence_binding_issue($route, $mapping, $descriptor) !== null) {
        return null;
    }
    return get_object_vars(plugin_agentbdmosassetsync_evidence_manifest($route)->bindings->{$mapping->mapping_id});
}

/** Never use Config/CFG cache here: a pending operation must close the current-proof gate. */
function plugin_agentbdmosassetsync_evidence_upgrade_row(?DBmysql $connection = null, bool $locking = false): ?array
{
    global $DB;
    $connection ??= $DB;
    $query = 'SELECT `value` FROM `glpi_configs` WHERE `context` = '
        . $connection::quoteValue('plugin:agentbdmosassetsync') . ' AND `name` = '
        . $connection::quoteValue('evidence_upgrade');
    $result = $connection->doQuery($query . ($locking ? ' LOCK IN SHARE MODE' : ''));
    if ($connection->numrows($result) > 1) {
        throw new RuntimeException('Upgrade continuity marker is ambiguous');
    }
    return $connection->fetchAssoc($result) ?: null;
}

function plugin_agentbdmosassetsync_evidence_upgrade_pending(): bool
{
    try {
        $row = plugin_agentbdmosassetsync_evidence_upgrade_row(null, true);
        return $row !== null && $row['value'] !== '{"version":1,"state":"ready"}';
    } catch (Throwable $e) {
        return true;
    }
}

function plugin_agentbdmosassetsync_evidence_upgrade_marker_matches(array $context, ?array $row): bool
{
    try {
        $marker = json_decode($row['value'] ?? '', true, 512, JSON_THROW_ON_ERROR);
        return ($marker['version'] ?? null) === 1 && ($marker['state'] ?? null) === 'pending'
            && ($marker['token_hash'] ?? null) === hash('sha256', $context['token'])
            && ($marker['snapshot_hash'] ?? null) === hash('sha256', $context['snapshot_json'])
            && ($marker['source_version'] ?? null) === $context['source_version']
            && ($marker['target_version'] ?? null) === $context['target_version'];
    } catch (Throwable $e) {
        return false;
    }
}

/** A named lock is only the liveness check for the independently enforced offline/read-guard protocol. */
function plugin_agentbdmosassetsync_evidence_upgrade_guard(array $context, ?DBmysql $connection = null): void
{
    global $DB;
    $connection ??= $DB;
    $owner = $connection->fetchAssoc($connection->doQuery('SELECT DATABASE() AS database_name, '
        . '@@server_uuid AS server_uuid, CONNECTION_ID() AS connection_id, IS_USED_LOCK('
        . $connection::quoteValue($context['guard_lock']) . ') AS guard_owner'));
    if (!$owner || (int) $owner['guard_owner'] !== $context['guard_owner_id']
        || (int) $owner['connection_id'] === $context['guard_owner_id']
        || $owner['database_name'] !== $context['backend_identity']['database']
        || $owner['server_uuid'] !== $context['backend_identity']['server_uuid']) {
        throw new RuntimeException('Upgrade read-guard continuity is unavailable', 9101);
    }
}

/** Compare the old columns only; a supported additive installation may introduce new nullable columns. */
function plugin_agentbdmosassetsync_evidence_upgrade_route(array $before, array $after, bool $manifest = true): void
{
    foreach ($before as $key => $value) {
        if (!$manifest && $key === 'evidence_bindings_json') {
            continue;
        }
        if (!array_key_exists($key, $after) || ($value === null ? $after[$key] !== null
            : (string) $after[$key] !== (string) $value)) {
            throw new RuntimeException('Upgrade route snapshot changed', 9101);
        }
    }
}

/** New tokens authorize future capture only; no saved value or historical proof is certified here. */
function plugin_agentbdmosassetsync_evidence_upgrade_manifest(array $route, array $tables, string $repairSeed): string
{
    if (!Session::haveRight('config', READ)) {
        throw new RuntimeException('ASB_EVIDENCE_INITIALIZATION_REQUIRES_ADMIN: metadata READ permission is required', 9101);
    }
    $manifest = plugin_agentbdmosassetsync_evidence_manifest($route);
    $bindings = $manifest?->bindings ?? new stdClass();
    $repairMissing = $manifest !== null || ($route['evidence_bindings_json'] ?? null) === null;
    $mappings = json_decode($route['field_mappings_json'], false, 512, JSON_THROW_ON_ERROR);
    $kept = new stdClass();
    foreach ($mappings as $mapping) {
        try {
            if (!$mapping instanceof stdClass || !is_string($mapping->mapping_id ?? null)
                || !plugin_agentbdmosassetsync_evidence_active($route, $mapping)) {
                continue;
            }
            $id = $mapping->mapping_id;
            $matches = array_filter($mappings, static fn($candidate) =>
                $candidate instanceof stdClass && ($candidate->mapping_id ?? null) === $id);
            if (count($matches) !== 1) {
                continue;
            }
            $present = property_exists($bindings, $id);
            $entry = $present ? $bindings->$id : null;
            if ($present && !plugin_agentbdmosassetsync_evidence_entry($entry, (int) $route['settings_version'])) {
                continue;
            }
            $asset = new ($mapping->itemtype)();
            $asset->getEmpty();
            $asset->fields['entities_id'] = (int) $route['entities_id'];
            $descriptor = plugin_agentbdmosassetsync_field_descriptor($asset, $mapping->b_field, false, false, true);
            $required = [$asset::getTable(), $descriptor['table'], Entity::getTable()];
            if ($descriptor['container_id'] !== null) {
                $required[] = PluginFieldsContainer::getTable();
                $required[] = PluginFieldsField::getTable();
            }
            if ($asset instanceof \Glpi\Asset\Asset) {
                $required[] = \Glpi\Asset\AssetDefinition::getTable();
                if ($descriptor['custom_field_id'] !== null) {
                    $required[] = \Glpi\Asset\CustomFieldDefinition::getTable();
                }
            }
            foreach ($required as $table) {
                if (!in_array($table, $tables, true)) {
                    throw new RuntimeException('Upgrade read guard does not cover an existing binding', 9101);
                }
            }
            $hash = plugin_agentbdmosassetsync_evidence_fingerprint($route, $mapping, $descriptor);
            if ($present && $entry->binding_hash === $hash) {
                $kept->$id = $entry;
            } elseif (!$present && $repairMissing) {
                // Stable within this private guarded operation, unique across operations and unrelated to values.
                $identity = json_encode([$route['route_id'], $id, $hash], JSON_THROW_ON_ERROR);
                $kept->$id = (object) ['generation' => hash_hmac('sha256', $identity, $repairSeed),
                    'binding_hash' => $hash, 'since_version' => (int) $route['settings_version']];
            }
        } catch (Throwable $e) {
            if ($e->getCode() === 9101) {
                throw $e;
            }
            // An unavailable/changed definition stays unproven; no value or timestamp can recreate its identity.
        }
    }
    if ($manifest !== null && $kept == $manifest->bindings) {
        return $route['evidence_bindings_json'];
    }
    return json_encode(['version' => 1, 'settings_version' => (int) $route['settings_version'], 'bindings' => $kept],
        JSON_THROW_ON_ERROR);
}

/** Called only by the fresh native CLI child after the old-source raw guard has become ready. */
function plugin_agentbdmosassetsync_evidence_upgrade_begin(array $context): void
{
    global $DB;
    if (PHP_SAPI !== 'cli' || ($context['version'] ?? null) !== 1
        || !is_string($context['token'] ?? null) || preg_match('/\A[a-f0-9]{64}\z/D', $context['token']) !== 1
        || !is_int($context['guard_owner_id'] ?? null) || $context['guard_owner_id'] < 1
        || !is_string($context['guard_lock'] ?? null) || strlen($context['guard_lock']) > 64
        || !str_starts_with($context['guard_lock'], 'asb-upgrade-')
        || !is_string($context['snapshot_json'] ?? null)
        || !in_array($context['source_version'] ?? null, ['0.4.1', '0.5.0', '0.5.1', '0.5.2'], true)
        || ($context['target_version'] ?? null) !== '0.6.0'
        || ($context['backend_identity']['database'] ?? '') === ''
        || ($context['backend_identity']['server_uuid'] ?? '') === ''
        || (new Plugin())->isPluginsExecutionSuspended()) {
        throw new RuntimeException('Unsupported controlled-upgrade context', 9101);
    }
    plugin_agentbdmosassetsync_evidence_upgrade_guard($context);
    if (!plugin_agentbdmosassetsync_evidence_upgrade_marker_matches($context,
        plugin_agentbdmosassetsync_evidence_upgrade_row())) {
        throw new RuntimeException('Upgrade marker does not match this operation', 9101);
    }
    $snapshot = json_decode($context['snapshot_json'], true, 512, JSON_THROW_ON_ERROR);
    if (($snapshot['version'] ?? null) !== 1 || ($snapshot['plugin']['state'] ?? null) !== Plugin::ACTIVATED
        || ($snapshot['plugin']['version'] ?? null) !== $context['source_version']
        || ($snapshot['database'] ?? null) !== $context['backend_identity']['database']
        || ($snapshot['server_uuid'] ?? null) !== $context['backend_identity']['server_uuid']
        || !is_array($snapshot['routes'] ?? null) || !is_array($snapshot['tables'] ?? null)) {
        throw new RuntimeException('Upgrade baseline does not establish active continuity', 9101);
    }
    $plugin = $DB->request(['FROM' => Plugin::getTable(), 'WHERE' => ['directory' => 'agentbdmosassetsync']])->current();
    // The fresh kernel may already have performed its native version check before this helper loads.
    $catalogAllowed = $plugin && (((int) $plugin['state'] === Plugin::ACTIVATED
        && $plugin['version'] === $context['source_version'])
        || ((int) $plugin['state'] === Plugin::NOTUPDATED && $plugin['version'] === $context['target_version']));
    if (!$catalogAllowed
        || count(iterator_to_array($DB->request(['SELECT' => ['id'],
            'FROM' => PluginAgentbdmosassetsyncSetting::getTable()]))) !== count($snapshot['routes'])) {
        throw new RuntimeException('Upgrade baseline is no longer the active installation', 9101);
    }
    $expected = [];
    foreach ($snapshot['routes'] as $route) {
        $current = $DB->request(['FROM' => PluginAgentbdmosassetsyncSetting::getTable(),
            'WHERE' => ['id' => (int) $route['id']]])->current();
        if (!$current) {
            throw new RuntimeException('Upgrade route baseline is unavailable', 9101);
        }
        plugin_agentbdmosassetsync_evidence_upgrade_route($route, $current);
        $expected[(int) $route['id']] = plugin_agentbdmosassetsync_evidence_upgrade_manifest($route, $snapshot['tables'], $context['token']);
    }
    $context['snapshot'] = $snapshot;
    $context['expected_manifests'] = $expected;
    $context['activation_checked'] = false;
    $context['writer_id'] = (int) $DB->fetchAssoc($DB->doQuery('SELECT CONNECTION_ID() AS id'))['id'];
    $GLOBALS['plugin_agentbdmosassetsync_upgrade_context'] = $context;
}

/** No persisted token can enable this path: the native CLI invocation must own its live capability. */
function plugin_agentbdmosassetsync_evidence_upgrade_activate(): bool
{
    global $DB;
    $context = $GLOBALS['plugin_agentbdmosassetsync_upgrade_context'] ?? null;
    if ($context === null) {
        return false;
    }
    if (PHP_SAPI !== 'cli' || !is_array($context)) {
        throw new RuntimeException('Controlled upgrade requires its native CLI invocation', 9101);
    }
    plugin_agentbdmosassetsync_evidence_upgrade_guard($context);
    if (!plugin_agentbdmosassetsync_evidence_upgrade_marker_matches($context,
        plugin_agentbdmosassetsync_evidence_upgrade_row())) {
        throw new RuntimeException('Upgrade marker changed before activation', 9101);
    }
    foreach ($context['snapshot']['routes'] as $route) {
        $current = $DB->request(['FROM' => PluginAgentbdmosassetsyncSetting::getTable(),
            'WHERE' => ['id' => (int) $route['id']]])->current();
        if (!$current) {
            throw new RuntimeException('Upgrade route disappeared before activation', 9101);
        }
        plugin_agentbdmosassetsync_evidence_upgrade_route($route, $current,
            plugin_agentbdmosassetsync_evidence_manifest($route) !== null);
        if (plugin_agentbdmosassetsync_evidence_upgrade_manifest($route, $context['snapshot']['tables'], $context['token'])
            !== $context['expected_manifests'][(int) $route['id']]) {
            throw new RuntimeException('Upgrade binding meaning changed during installation', 9101);
        }
        $value = $context['expected_manifests'][(int) $route['id']];
        if ($current['evidence_bindings_json'] !== $value
            && !$DB->update(PluginAgentbdmosassetsyncSetting::getTable(), ['evidence_bindings_json' => $value],
                ['id' => (int) $route['id']])) {
            throw new RuntimeException('Unverifiable upgrade binding could not be invalidated', 9101);
        }
    }
    plugin_agentbdmosassetsync_evidence_upgrade_guard($context);
    $GLOBALS['plugin_agentbdmosassetsync_upgrade_context']['activation_checked'] = true;
    return true;
}

/** The fresh observer, not this writer's transaction snapshot, establishes durable completion. */
function plugin_agentbdmosassetsync_evidence_upgrade_finish(DBmysql $observer): array
{
    global $DB;
    $context = $GLOBALS['plugin_agentbdmosassetsync_upgrade_context'] ?? null;
    if (!is_array($context) || ($context['activation_checked'] ?? null) !== true) {
        throw new RuntimeException('Upgrade activation was not verified', 9101);
    }
    $session = $observer->fetchAssoc($observer->doQuery('SELECT CONNECTION_ID() AS id, @@autocommit AS autocommit'));
    if ($observer === $DB || !$session || (int) $session['id'] === $context['writer_id']
        || (int) $session['autocommit'] !== 1) {
        throw new RuntimeException('Upgrade completion requires its fresh autocommit observer', 9101);
    }
    plugin_agentbdmosassetsync_evidence_upgrade_guard($context, $observer);
    $plugin = $observer->request(['FROM' => Plugin::getTable(), 'WHERE' => ['directory' => 'agentbdmosassetsync']])->current();
    if (!$plugin || (int) $plugin['state'] !== Plugin::ACTIVATED || $plugin['version'] !== $context['target_version']) {
        throw new RuntimeException('Completed upgrade is not independently active', 9101);
    }
    if (count(iterator_to_array($observer->request(['SELECT' => ['id'],
        'FROM' => PluginAgentbdmosassetsyncSetting::getTable()]))) !== count($context['snapshot']['routes'])) {
        throw new RuntimeException('Upgrade route set changed', 9101);
    }
    foreach ($context['snapshot']['routes'] as $route) {
        $current = $observer->request(['FROM' => PluginAgentbdmosassetsyncSetting::getTable(),
            'WHERE' => ['id' => (int) $route['id']]])->current();
        if (!$current || $current['evidence_bindings_json'] !== $context['expected_manifests'][(int) $route['id']]) {
            throw new RuntimeException('Upgrade binding completion is not independently visible', 9101);
        }
        plugin_agentbdmosassetsync_evidence_upgrade_route($route, $current, false);
        $writer = $DB;
        try {
            $DB = $observer;
            if (plugin_agentbdmosassetsync_evidence_upgrade_manifest($route, $context['snapshot']['tables'], $context['token'])
                !== $context['expected_manifests'][(int) $route['id']]) {
                throw new RuntimeException('Upgrade binding meaning is not independently verified', 9101);
            }
        } finally {
            $DB = $writer;
        }
    }
    plugin_agentbdmosassetsync_evidence_upgrade_verify_stores($observer, $context['snapshot']);
    plugin_agentbdmosassetsync_evidence_upgrade_guard($context);
    $row = plugin_agentbdmosassetsync_evidence_upgrade_row();
    if (!plugin_agentbdmosassetsync_evidence_upgrade_marker_matches($context, $row)) {
        throw new RuntimeException('Upgrade marker changed before completion', 9101);
    }
    $DB->doQuery('UPDATE `glpi_configs` SET `value` = '
        . $DB::quoteValue('{"version":1,"state":"ready"}') . ' WHERE `context` = '
        . $DB::quoteValue('plugin:agentbdmosassetsync') . ' AND `name` = ' . $DB::quoteValue('evidence_upgrade')
        . ' AND BINARY `value` = BINARY ' . $DB::quoteValue($row['value'])
        . ' AND IS_USED_LOCK(' . $DB::quoteValue($context['guard_lock']) . ') = ' . $context['guard_owner_id']);
    if ((plugin_agentbdmosassetsync_evidence_upgrade_row($observer)['value'] ?? null) !== '{"version":1,"state":"ready"}') {
        throw new RuntimeException('Upgrade marker completion is not independently visible', 9101);
    }
    plugin_agentbdmosassetsync_evidence_upgrade_guard($context, $observer);
    $counts = ['retained' => 0, 'initialized' => 0, 'unavailable' => 0];
    foreach ($context['snapshot']['routes'] as $route) {
        $before = plugin_agentbdmosassetsync_evidence_manifest($route)?->bindings ?? new stdClass();
        $after = json_decode($context['expected_manifests'][(int) $route['id']], false, 512, JSON_THROW_ON_ERROR)->bindings;
        foreach (json_decode($route['field_mappings_json'], false, 512, JSON_THROW_ON_ERROR) as $mapping) {
            if (!plugin_agentbdmosassetsync_evidence_active($route, $mapping)) {
                continue;
            }
            $id = $mapping->mapping_id;
            $key = !property_exists($after, $id) ? 'unavailable'
                : (property_exists($before, $id) ? 'retained' : 'initialized');
            ++$counts[$key];
        }
    }
    unset($GLOBALS['plugin_agentbdmosassetsync_upgrade_context']);
    return $counts;
}

function plugin_agentbdmosassetsync_evidence_upgrade_verify_stores(DBmysql $observer, array $snapshot): void
{
    if (!is_array($snapshot['protected'] ?? null)) {
        throw new RuntimeException('Upgrade protected-store baseline is unavailable', 9101);
    }
    foreach (['works', 'changes', 'notelinks', 'scalarstates'] as $suffix) {
        $table = 'glpi_plugin_agentbdmosassetsync_' . $suffix;
        $saved = $snapshot['protected'][$table] ?? null;
        if (!is_array($saved) || !is_array($saved['columns'] ?? null) || !is_array($saved['rows'] ?? null)) {
            throw new RuntimeException('Upgrade protected-store baseline is incomplete', 9101);
        }
        $current = iterator_to_array($observer->request(['SELECT' => $saved['columns'], 'FROM' => $table, 'ORDER' => 'id']));
        if (count($current) !== count($saved['rows'])) {
            throw new RuntimeException('Upgrade protected-store row count changed', 9101);
        }
        foreach ($current as $row) {
            $hash = hash('sha256', json_encode(plugin_agentbdmosassetsync_evidence_canonical((object) $row),
                JSON_THROW_ON_ERROR | JSON_PRESERVE_ZERO_FRACTION));
            if (($saved['rows'][(string) $row['id']] ?? null) !== $hash) {
                throw new RuntimeException('Upgrade protected-store content changed', 9101);
            }
        }
    }
}

/** Administrative lifecycle failure must leave the gate closed, without throwing from human-save lookup. */
function plugin_agentbdmosassetsync_evidence_upgrade_block_reset(): void
{
    global $DB;
    $value = '{"version":1,"state":"resetting"}';
    if (!$DB->updateOrInsert('glpi_configs', ['context' => 'plugin:agentbdmosassetsync',
        'name' => 'evidence_upgrade', 'value' => $value],
        ['context' => 'plugin:agentbdmosassetsync', 'name' => 'evidence_upgrade'])
        || (plugin_agentbdmosassetsync_evidence_upgrade_row()['value'] ?? null) !== $value) {
        throw new RuntimeException('Continuity reset could not be fenced', 9101);
    }
}

/** Only a successfully verified FULL reset may reopen a failed/pending operation conservatively. */
function plugin_agentbdmosassetsync_evidence_upgrade_clear_after_reset(): void
{
    global $DB;
    if (!$DB->updateOrInsert('glpi_configs', ['context' => 'plugin:agentbdmosassetsync',
        'name' => 'evidence_upgrade', 'value' => '{"version":1,"state":"ready"}'],
        ['context' => 'plugin:agentbdmosassetsync', 'name' => 'evidence_upgrade'])
        || (plugin_agentbdmosassetsync_evidence_upgrade_row()['value'] ?? null) !== '{"version":1,"state":"ready"}') {
        throw new RuntimeException('Reset upgrade marker could not be verified', 9101);
    }
}

/** Publication is configuration activity. Only unchanged, continuously enabled bindings keep their token. */
function plugin_agentbdmosassetsync_evidence_publication(array $next, ?array $previous, bool $metadataOnly = false): string
{
    if ($metadataOnly && !Session::haveRight('config', READ)) {
        throw new RuntimeException('ASB_EVIDENCE_INITIALIZATION_REQUIRES_ADMIN: initialize a permitted native administrator session');
    }
    $manifest = $previous === null ? null : plugin_agentbdmosassetsync_evidence_manifest($previous);
    $bindings = new stdClass();
    foreach (json_decode($next['field_mappings_json'], false, 512, JSON_THROW_ON_ERROR) as $mapping) {
        if (!plugin_agentbdmosassetsync_evidence_active($next, $mapping)) {
            continue;
        }
        try {
            $asset = new ($mapping->itemtype)();
            $asset->getEmpty();
            $asset->fields['entities_id'] = (int) $next['entities_id'];
            $descriptor = $metadataOnly
                ? plugin_agentbdmosassetsync_field_descriptor($asset, $mapping->b_field, false, false, true)
                : plugin_agentbdmosassetsync_field_descriptor($asset, $mapping->b_field);
            $hash = plugin_agentbdmosassetsync_evidence_fingerprint($next, $mapping, $descriptor);
            $old = $manifest?->bindings->{$mapping->mapping_id} ?? null;
            $preserve = $previous !== null && $manifest !== null
                && (int) $previous['route_enabled'] === 1
                && $previous['route_id'] === $next['route_id']
                && (int) $previous['a_entities_id'] === (int) $next['a_entities_id']
                && (int) $previous['entities_id'] === (int) $next['entities_id']
                && plugin_agentbdmosassetsync_evidence_entry($old, (int) $previous['settings_version'])
                && $old->binding_hash === $hash;
            $bindings->{$mapping->mapping_id} = $preserve ? $old : (object) [
                'generation' => bin2hex(random_bytes(32)), 'binding_hash' => $hash,
                'since_version' => (int) $next['settings_version']];
        } catch (Throwable $e) {
            // An unavailable incarnation cannot inherit trust. A later valid publication starts fresh.
        }
    }
    return json_encode(['version' => 1, 'settings_version' => (int) $next['settings_version'], 'bindings' => $bindings],
        JSON_THROW_ON_ERROR);
}

/** Supported plugin lifecycle operations close the capture gap before old evidence can be reused. */
function plugin_agentbdmosassetsync_evidence_reset(?string $dependency = null, ?callable $affected = null,
    bool $initialize = false): void
{
    global $DB;
    $table = PluginAgentbdmosassetsyncSetting::getTable();
    if (!$DB->tableExists($table) || !$DB->fieldExists($table, 'evidence_bindings_json')) {
        return;
    }
    if ($initialize && !Session::haveRight('config', READ)) {
        throw new RuntimeException('ASB_EVIDENCE_INITIALIZATION_REQUIRES_ADMIN: initialize a permitted native administrator session');
    }
    foreach ($DB->request(['FROM' => $table]) as $route) {
        $lock = 'asb-setting-' . sha1($route['route_id']);
        $acquired = $DB->fetchAssoc($DB->doQuery("SELECT GET_LOCK('$lock', 5) AS acquired"));
        if ((int) ($acquired['acquired'] ?? 0) !== 1) {
            throw new RuntimeException('ASB_EVIDENCE_RESET_BUSY');
        }
        try {
            $current = plugin_agentbdmosassetsync_read_setting($route['route_id']);
            if ($current === null) {
                continue;
            }
            // A definition/deactivation hook may lack metadata rights: invalidation must still close old trust.
            $json = Session::haveRight('config', READ)
                ? plugin_agentbdmosassetsync_evidence_publication($current, null, true)
                : json_encode(['version' => 1, 'settings_version' => (int) $current['settings_version'],
                    'bindings' => new stdClass()], JSON_THROW_ON_ERROR);
            if ($dependency === 'fields' || $affected !== null) {
                $old = plugin_agentbdmosassetsync_evidence_manifest($current);
                $fresh = json_decode($json, false, 512, JSON_THROW_ON_ERROR);
                $bindings = $old?->bindings ?? new stdClass();
                $changed = false;
                foreach (json_decode($current['field_mappings_json'], false, 512, JSON_THROW_ON_ERROR) as $mapping) {
                    if (($dependency === 'fields' && $mapping->b_field->kind !== 'fields')
                        || ($affected !== null && !$affected($mapping))) {
                        continue;
                    }
                    $changed = true;
                    unset($bindings->{$mapping->mapping_id});
                    if (property_exists($fresh->bindings, $mapping->mapping_id)) {
                        $bindings->{$mapping->mapping_id} = $fresh->bindings->{$mapping->mapping_id};
                    }
                }
                if (!$changed) {
                    continue;
                }
                $fresh->bindings = $bindings;
                $json = json_encode($fresh, JSON_THROW_ON_ERROR);
            }
            if (!$DB->update($table, ['evidence_bindings_json' => $json], ['id' => (int) $current['id']])) {
                throw new RuntimeException('ASB_EVIDENCE_RESET_FAILED');
            }
            $verified = plugin_agentbdmosassetsync_read_setting($route['route_id']);
            if ($verified === null || $verified['evidence_bindings_json'] !== $json) {
                throw new RuntimeException('ASB_EVIDENCE_RESET_UNCERTAIN');
            }
        } finally {
            $released = $DB->fetchAssoc($DB->doQuery("SELECT RELEASE_LOCK('$lock') AS released"));
            if ((int) ($released['released'] ?? 0) !== 1) {
                throw new RuntimeException('ASB_EVIDENCE_RESET_RELEASE_UNCERTAIN');
            }
        }
    }
}

function plugin_agentbdmosassetsync_evidence_plugin_lifecycle(string $plugin): void
{
    if ($plugin === 'fields') {
        plugin_agentbdmosassetsync_evidence_reset('fields');
    }
}

function plugin_agentbdmosassetsync_evidence_definition_keys(CommonDBTM $definition): array
{
    return match ($definition::class) {
        'PluginFieldsField' => ['name', 'type', 'multiple', 'plugin_fields_containers_id', 'is_active'],
        'PluginFieldsContainer' => ['name', 'itemtypes', 'entities_id', 'is_recursive', 'is_active'],
        \Glpi\Asset\CustomFieldDefinition::class =>
            ['system_name', 'type', 'assets_assetdefinitions_id', 'field_options', 'itemtype', 'default_value'],
        \Glpi\Asset\AssetDefinition::class => ['system_name', 'is_active', 'fields_display', 'capacities'],
        default => [],
    };
}

function plugin_agentbdmosassetsync_evidence_definition_value($value, string $key)
{
    if (is_string($value) && in_array($key, ['itemtypes', 'field_options', 'fields_display', 'capacities'], true)) {
        try {
            $value = json_decode($value, false, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            return $value;
        }
    }
    if ($key === 'field_options' && is_array($value)) {
        $value = (object) $value;
    }
    if ($key === 'fields_display' && is_array($value)) {
        $options = [];
        foreach ($value as $field) {
            $field = is_array($field) ? (object) $field : $field;
            if (!$field instanceof stdClass || !is_string($field->key ?? null)) {
                return json_encode(plugin_agentbdmosassetsync_evidence_canonical($value), JSON_THROW_ON_ERROR);
            }
            $options[$field->key] = (object) ($field->field_options ?? []);
        }
        $value = (object) $options;
    }
    if ($key === 'itemtypes' && is_array($value) && array_is_list($value)) {
        sort($value, SORT_STRING);
    }
    return (is_array($value) || $value instanceof stdClass)
        ? json_encode(plugin_agentbdmosassetsync_evidence_canonical($value), JSON_THROW_ON_ERROR)
        : ($value === null ? null : (string) $value);
}

/** PRE_ITEM_UPDATE runs before GLPI resets/populates updates: inspect this input and stored definition. */
function plugin_agentbdmosassetsync_evidence_definition_before(CommonDBTM $definition): void
{
    $input = $definition->input ?? [];
    $stored = $definition->fields;
    if ($definition instanceof \Glpi\Asset\CustomFieldDefinition) {
        // Core prepareInputForAddAndUpdate() always writes field_options, even when omitted.
        $input += ['field_options' => []];
    }
    if ($definition instanceof \Glpi\Asset\AssetDefinition && array_key_exists('fields_display', $input)
        && is_array($input['fields_display'])) {
        // Core prepares the display list from keys/options; ordering alone does not change a binding.
        $display = [];
        foreach ($input['fields_display'] as $key) {
            $display[$key] = (object) ($input['field_options'][$key] ?? []);
        }
        $oldDisplay = [];
        foreach ($definition->getDecodedFieldsField() as $field) {
            $oldDisplay[$field['key']] = (object) ($field['field_options'] ?? []);
        }
        $input['fields_display'] = (object) $display;
        $stored['fields_display'] = (object) $oldDisplay;
    }
    foreach (plugin_agentbdmosassetsync_evidence_definition_keys($definition) as $key) {
        if (array_key_exists($key, $input)
            && plugin_agentbdmosassetsync_evidence_definition_value($input[$key], $key)
                !== plugin_agentbdmosassetsync_evidence_definition_value($stored[$key] ?? null, $key)) {
            plugin_agentbdmosassetsync_evidence_definition_update($definition, true);
            return;
        }
    }
}

/** Definition administration can create a capture gap even while Agent B stays enabled. */
function plugin_agentbdmosassetsync_evidence_definition_update(CommonDBTM $definition, bool $force = false): void
{
    $class = $definition::class;
    $fields = $definition->fields;
    $input = $definition->input ?? [];
    $changes = $definition->updates ?? [];
    if (!$force) {
        $meaningChanged = false;
        foreach (array_intersect(plugin_agentbdmosassetsync_evidence_definition_keys($definition), $changes) as $key) {
            if (!array_key_exists($key, $definition->oldvalues ?? [])
                || plugin_agentbdmosassetsync_evidence_definition_value($definition->oldvalues[$key], $key)
                    !== plugin_agentbdmosassetsync_evidence_definition_value($fields[$key] ?? null, $key)) {
                $meaningChanged = true;
                break;
            }
        }
        if (!$meaningChanged) {
            return;
        }
    }
    if ($class === 'PluginFieldsField') {
        $names = array_unique([$fields['name'] ?? null, $input['name'] ?? null]);
        $containers = [];
        foreach (array_unique([$fields['plugin_fields_containers_id'] ?? 0,
            $input['plugin_fields_containers_id'] ?? 0]) as $id) {
            $container = new PluginFieldsContainer();
            if ($id > 0 && $container->getFromDB($id)) {
                $containers[] = $container->fields['name'];
            }
        }
        plugin_agentbdmosassetsync_evidence_reset(null, static fn(stdClass $mapping) =>
            $mapping->b_field->kind === 'fields' && in_array($mapping->b_field->name, $names, true)
            && in_array($mapping->b_field->container, $containers, true));
    } elseif ($class === 'PluginFieldsContainer') {
        $names = array_unique([$fields['name'] ?? null, $input['name'] ?? null]);
        plugin_agentbdmosassetsync_evidence_reset(null, static fn(stdClass $mapping) =>
            $mapping->b_field->kind === 'fields' && in_array($mapping->b_field->container, $names, true));
    } elseif ($definition instanceof \Glpi\Asset\CustomFieldDefinition) {
        $names = array_map(static fn($name) => 'custom_' . $name,
            array_unique([$fields['system_name'] ?? '', $input['system_name'] ?? '']));
        $types = [];
        foreach (array_unique([$fields['assets_assetdefinitions_id'] ?? 0,
            $input['assets_assetdefinitions_id'] ?? 0]) as $id) {
            $assetDefinition = new \Glpi\Asset\AssetDefinition();
            if ($id > 0 && $assetDefinition->getFromDB($id)) {
                $types[] = $assetDefinition->getCustomObjectClassName();
            }
        }
        plugin_agentbdmosassetsync_evidence_reset(null, static fn(stdClass $mapping) =>
            $mapping->b_field->kind === 'native' && in_array($mapping->itemtype, $types, true)
            && in_array($mapping->b_field->name, $names, true));
    } elseif ($definition instanceof \Glpi\Asset\AssetDefinition) {
        $type = $definition->getCustomObjectClassName();
        plugin_agentbdmosassetsync_evidence_reset(null, static fn(stdClass $mapping) => $mapping->itemtype === $type);
    }
}

function plugin_agentbdmosassetsync_evidence_definition_lifecycle(CommonDBTM $definition): void
{
    plugin_agentbdmosassetsync_evidence_definition_update($definition, true);
}
