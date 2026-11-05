<?php

/** Register core assets and active custom definitions using the installed GLPI hook names. */
function plugin_agentbdmosassetsync_register_capture(): void
{
    global $PLUGIN_HOOKS, $DB;
    $types = plugin_agentbdmosassetsync_asset_types();
    // GLPI boots custom assets after plugin post_init. Register their exact names without early autoloading.
    foreach ($DB->request(['FROM' => \Glpi\Asset\AssetDefinition::getTable(), 'WHERE' => ['is_active' => 1]]) as $row) {
        $definition = new \Glpi\Asset\AssetDefinition();
        $definition->getFromResultSet($row);
        $types[] = $definition->getCustomObjectClassName();
    }
    $types = array_unique($types);
    foreach ($types as $type) {
        $PLUGIN_HOOKS['pre_item_update']['agentbdmosassetsync'][$type] = 'plugin_agentbdmosassetsync_capture_before';
        $PLUGIN_HOOKS['item_update']['agentbdmosassetsync'][$type] = 'plugin_agentbdmosassetsync_capture_after';
    }
    if (Plugin::isPluginActive('fields') && class_exists('PluginFieldsContainer')) {
        foreach ($DB->request(['FROM' => PluginFieldsContainer::getTable(), 'WHERE' => ['is_active' => 1]]) as $container) {
            foreach (PluginFieldsToolbox::decodeJSONItemtypes($container['itemtypes']) as $type) {
                if (!in_array($type, $types, true)) {
                    continue;
                }
                $class = PluginFieldsContainer::getClassname($type, $container['name']);
                if (!is_subclass_of($class, CommonDBTM::class)) {
                    continue;
                }
                $GLOBALS['plugin_agentbdmosassetsync_fields_classes'][$class] = $type;
                foreach (['pre_item_update', 'pre_item_add'] as $hook) {
                    $PLUGIN_HOOKS[$hook]['agentbdmosassetsync'][$class] = 'plugin_agentbdmosassetsync_capture_before';
                }
                foreach (['item_update', 'item_add'] as $hook) {
                    $PLUGIN_HOOKS[$hook]['agentbdmosassetsync'][$class] = 'plugin_agentbdmosassetsync_capture_after';
                }
            }
        }
    }
    plugin_agentbdmosassetsync_register_note_capture();
}

/** The first capture operation is a cheap local enabled-type check. */
function plugin_agentbdmosassetsync_capture_routes(string $type): array
{
    global $DB;
    if (!$DB->tableExists(PluginAgentbdmosassetsyncSetting::getTable())) {
        return [];
    }
    $routes = [];
    foreach ($DB->request(['FROM' => PluginAgentbdmosassetsyncSetting::getTable(), 'WHERE' => ['route_enabled' => 1]]) as $row) {
        if (in_array($type, json_decode($row['enabled_itemtypes_json'], true) ?? [], true)) {
            $routes[] = $row;
        }
    }
    return $routes;
}

function plugin_agentbdmosassetsync_capture_time(): string
{
    return (new DateTimeImmutable('now', new DateTimeZone('Asia/Brunei')))->format('Y-m-d\TH:i:sP');
}

/** Asset snapshots use the same session clock and database timezone as GLPI's Log::history(). */
function plugin_agentbdmosassetsync_capture_history_time(): string
{
    global $DB;
    $time = $_SESSION['glpi_currenttime'] ?? null;
    if (!is_string($time) || preg_match('/\A[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}\z/D', $time) !== 1) {
        throw new RuntimeException('Native field history timestamp is unavailable');
    }
    $row = $DB->fetchAssoc($DB->doQuery('SELECT UNIX_TIMESTAMP(' . $DB::quoteValue($time) . ') AS `edited_at`'));
    if (!is_numeric($row['edited_at'] ?? null) || (int) $row['edited_at'] <= 0) {
        throw new RuntimeException('Native field history timestamp is unavailable');
    }
    return (new DateTimeImmutable('@' . (int) $row['edited_at']))->setTimezone(new DateTimeZone('Asia/Brunei'))
        ->format('Y-m-d\TH:i:sP');
}

function plugin_agentbdmosassetsync_capture_type(CommonDBTM $storage): string
{
    return $GLOBALS['plugin_agentbdmosassetsync_fields_classes'][$storage::class] ?? $storage::class;
}

/** Fields' generated storage also saves during asset creation, which is not an outbound edit. */
function plugin_agentbdmosassetsync_capture_owner(CommonDBTM $storage, string $type): ?CommonDBTM
{
    if ($storage::class === $type) {
        return $storage;
    }
    foreach (debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT | DEBUG_BACKTRACE_IGNORE_ARGS) as $frame) {
        if (($frame['function'] ?? '') === 'add' && ($frame['object'] ?? null) instanceof $type) {
            return null;
        }
    }
    $asset = new $type();
    $id = (int) ($storage->input['items_id'] ?? $storage->fields['items_id'] ?? 0);
    if (!$asset->getFromDB($id)) {
        throw new RuntimeException('Fields owner asset could not be reread');
    }
    return $asset;
}

function plugin_agentbdmosassetsync_capture_candidate(CommonDBTM $storage, stdClass $selector, bool $before = false): bool
{
    $names = [$selector->name];
    if ($selector->kind === 'fields') {
        $names[] = 'plugin_fields_' . $selector->name . 'dropdowns_id';
    }
    $changed = $before || !isset($storage->input['id']) ? array_keys($storage->input) : ($storage->updates ?? []);
    if ($selector->kind === 'native' && str_starts_with($selector->name, 'custom_')) {
        $names[] = 'custom_fields';
    }
    return (bool) array_intersect($names, $changed);
}

function plugin_agentbdmosassetsync_capture_mappings(array $route, CommonDBTM $asset, CommonDBTM $storage,
    bool $before = false): array
{
    $eligible = [];
    foreach (json_decode($route['field_mappings_json'], false, 512, JSON_THROW_ON_ERROR) as $mapping) {
        if (!$mapping->enabled || $mapping->itemtype !== $asset::class) {
            continue;
        }
        $selector = $mapping->b_field;
        if (($selector->kind === 'fields') !== ($asset::class !== $storage::class)
            || ($selector->kind === 'fields'
                && PluginFieldsContainer::getClassname($asset::class, $selector->container) !== $storage::class)) {
            continue;
        }
        if (plugin_agentbdmosassetsync_capture_candidate($storage, $selector, $before)) {
            $eligible[] = $mapping;
        }
    }
    return $eligible;
}

/** The pre hook precedes GLPI's updates array. Skip a barrier only for a provably unchanged input copy. */
function plugin_agentbdmosassetsync_capture_input_unchanged(CommonDBTM $storage, CommonDBTM $asset,
    stdClass $mapping): bool
{
    try {
        $descriptor = plugin_agentbdmosassetsync_field_descriptor($asset, $mapping->b_field, false);
        $column = $descriptor['value_column'];
        if (!array_key_exists($column, $storage->input)) {
            return false;
        }
        if ($descriptor['custom_field_id'] !== null
            && !array_key_exists($descriptor['column'], $storage->fields)) {
            throw new RuntimeException('Custom field storage column is missing');
        }
        $before = $descriptor['custom_field_id'] !== null
            ? plugin_agentbdmosassetsync_custom_stored_value($descriptor, $storage->fields[$descriptor['column']])
            : (array_key_exists($column, $storage->fields) ? $storage->fields[$column] : $descriptor['sql']['Default']);
        $incoming = $storage->input[$column];
        $before = plugin_agentbdmosassetsync_capture_input_value($descriptor, $before);
        $incoming = plugin_agentbdmosassetsync_capture_input_value($descriptor, $incoming);
        if ($descriptor['kind'] === 'dropdown') {
            if (($before === null || $before === 0) && ($incoming === null || $incoming === 0)) {
                return true;
            }
            return $before === $incoming; // Equal labels do not prove equal selected option IDs.
        }
        return plugin_agentbdmosassetsync_scalar_equal(plugin_agentbdmosassetsync_field_value($descriptor, $before),
            plugin_agentbdmosassetsync_field_value($descriptor, $incoming));
    } catch (Throwable $e) {
        return false;
    }
}

/** Normalize capture copies only; GLPI and Fields own their saved input. */
function plugin_agentbdmosassetsync_capture_input_value(array $descriptor, $value)
{
    if (in_array($descriptor['kind'], ['date', 'datetime'], true)
        && ($value === '' || $value === null
            || ($value === 'NULL' && $descriptor['custom_field_id'] === null))) {
        if ($descriptor['custom_field_id'] === null && $descriptor['sql']['Null'] !== 'YES') {
            throw new RuntimeException('Date input cannot be empty for non-nullable storage');
        }
        return null;
    }
    if ($descriptor['kind'] === 'number' && $descriptor['container_id'] !== null) {
        if ($value === '' || $value === null) {
            if ($descriptor['sql']['Null'] !== 'YES') {
                throw new RuntimeException('Number input cannot be empty for non-nullable storage');
            }
            return null;
        }
        // Match Fields' scalar representation without changing the asset input.
        if (is_string($value)) {
            return str_replace(',', '.', $value);
        }
    }
    if ($descriptor['kind'] === 'dropdown') {
        if ($value === null) {
            return null;
        }
        if (is_string($value) && preg_match('/\A[0-9]+\z/D', $value) === 1) {
            $value = strlen($value) <= 10 ? (int) $value : $value;
        }
        if (!plugin_agentbdmosassetsync_is_uint($value)) {
            throw new RuntimeException('Dropdown input must be a local option ID');
        }
    }
    return $value;
}

/** Capture must not turn a successful GLPI save into an error response. */
function plugin_agentbdmosassetsync_capture_log(CommonDBTM $storage, string $stage, Throwable $error,
    ?string $routeId = null, ?string $mappingId = null): void
{
    global $PHPLOGGER;
    $reason = $mappingId !== null || str_starts_with($error->getMessage(), 'ASB_')
        ? $error->getMessage() : $error::class;
    $type = plugin_agentbdmosassetsync_capture_type($storage);
    $assetId = $type === $storage::class ? ($storage->fields['id'] ?? 0)
        : ($storage->input['items_id'] ?? $storage->fields['items_id'] ?? 0);
    $message = 'ASB_CAPTURE_SKIPPED: stage=' . $stage . ' itemtype=' . $type
        . ' asset_id=' . (int) $assetId . ' route_id=' . ($routeId ?? '-')
        . ' mapping_id=' . ($mappingId ?? '-') . ' reason=' . $reason;
    try {
        $PHPLOGGER->warning($message);
    } catch (Throwable $loggingError) {
        try {
            error_log($message);
        } catch (Throwable $fallbackError) {
            // If both existing loggers fail, still leave the GLPI save alone.
        }
    }
}

function plugin_agentbdmosassetsync_capture_before(CommonDBTM $storage): void
{
    if (plugin_agentbdmosassetsync_is_sync_write()) {
        return;
    }
    $key = spl_object_id($storage);
    unset($GLOBALS['plugin_agentbdmosassetsync_captures'][$key]);
    try {
        $type = plugin_agentbdmosassetsync_capture_type($storage);
        $routes = plugin_agentbdmosassetsync_capture_routes($type);
        if (!$routes) {
            return;
        }
        $asset = plugin_agentbdmosassetsync_capture_owner($storage, $type);
        if ($asset === null) {
            return;
        }
        $GLOBALS['plugin_agentbdmosassetsync_captures'][$key] = ['asset' => clone $asset,
            'storage_fields' => $storage->fields, 'routes' => $routes,
            'time' => plugin_agentbdmosassetsync_capture_history_time(), 'rows' => [], 'provenance' => []];
        foreach ($routes as $route) {
            if (!$asset->isEntityAssign() || (int) $asset->getEntityID() !== (int) $route['entities_id']) {
                continue;
            }
            try {
                if (array_key_exists('entities_id', $storage->input)
                    && (int) $storage->input['entities_id'] !== (int) $asset->getEntityID()) {
                    plugin_agentbdmosassetsync_provenance_invalidate_parent($route, $asset);
                }
                $identity = plugin_agentbdmosassetsync_capture_identity($asset, $route);
                if ($identity === null) {
                    continue;
                }
                foreach (plugin_agentbdmosassetsync_capture_mappings($route, $asset, $storage, true) as $mapping) {
                    try {
                        if (plugin_agentbdmosassetsync_capture_input_unchanged($storage, $asset, $mapping)) {
                            continue;
                        }
                        $GLOBALS['plugin_agentbdmosassetsync_captures'][$key]['provenance'][$route['route_id']][$mapping->mapping_id]
                            = plugin_agentbdmosassetsync_provenance_capture_begin($route, $asset, $mapping, $identity);
                    } catch (Throwable $e) {
                        plugin_agentbdmosassetsync_capture_log($storage, 'evidence_before', $e, $route['route_id'], $mapping->mapping_id);
                    }
                }
            } catch (Throwable $e) {
                plugin_agentbdmosassetsync_capture_log($storage, 'evidence_route', $e, $route['route_id']);
            }
        }
    } catch (Throwable $e) {
        plugin_agentbdmosassetsync_capture_log($storage, 'before', $e);
    }
}

/** Each actual native/Fields storage save gets its own immutable snapshot before returning. */
function plugin_agentbdmosassetsync_capture_after(CommonDBTM $storage): void
{
    if (plugin_agentbdmosassetsync_is_sync_write()) {
        return;
    }
    $key = spl_object_id($storage);
    if (!isset($GLOBALS['plugin_agentbdmosassetsync_captures'][$key])) {
        return; // Presave deliberately excluded asset creation.
    }
    try {
        plugin_agentbdmosassetsync_capture_collect($key, $storage);
        plugin_agentbdmosassetsync_capture_flush($key);
    } catch (Throwable $e) {
        plugin_agentbdmosassetsync_capture_log($storage, 'after', $e);
    } finally {
        unset($GLOBALS['plugin_agentbdmosassetsync_captures'][$key]);
    }
}
/** Durable verified Work links, rather than a client-supplied ID, determine suspension/identity. */
function plugin_agentbdmosassetsync_capture_identity(CommonDBTM $asset, array $route): ?array
{
    global $DB;
    $links = [];
    foreach ($DB->request(['FROM' => PluginAgentbdmosassetsyncWork::getTable(), 'WHERE' => [
        'route_id' => $route['route_id'], 'itemtype' => $asset::class, 'subject' => 'Asset',
        'entities_id' => (int) $route['entities_id'], 'a_entities_id' => (int) $route['a_entities_id'],
        'b_items_id' => (int) $asset->getID(), 'link_state' => ['Active', 'Suspended']],
        'ORDER' => ['id DESC']]) as $work) {
        $aId = (int) $work['a_items_id'];
        if ($aId > 0 && !isset($links[$aId])) {
            $links[$aId] = $work['link_state'];
        }
    }
    if (count($links) > 1) {
        throw new RuntimeException('Competing verified links for asset ' . $asset->getID());
    }
    if ($links && reset($links) === 'Suspended') {
        return null;
    }
    $serial = $asset->fields['serial'] ?? null;
    return ['a_items_id' => $links ? (int) array_key_first($links) : null,
        'b_items_id' => (int) $asset->getID(), 'serial' => is_string($serial) && $serial !== '' ? $serial : null];
}

function plugin_agentbdmosassetsync_capture_collect(int $key, CommonDBTM $storage): void
{
    $capture = &$GLOBALS['plugin_agentbdmosassetsync_captures'][$key];
    $asset = clone $capture['asset'];
    if (!$asset->getFromDB((int) $asset->getID())) {
        throw new RuntimeException('Saved owner asset could not be reread');
    }
    foreach ($capture['routes'] as $route) {
        if (!$asset->isEntityAssign() || (int) $asset->getEntityID() !== (int) $route['entities_id']) {
            continue;
        }
        try {
            $eligible = [];
            $changedMappings = plugin_agentbdmosassetsync_capture_mappings($route, $asset, $storage);
            foreach (json_decode($route['field_mappings_json'], false, 512, JSON_THROW_ON_ERROR) as $mapping) {
                if (!$mapping->enabled || $mapping->itemtype !== $asset::class) {
                    continue;
                }
                $proof = $capture['provenance'][$route['route_id']][$mapping->mapping_id] ?? null;
                if ($proof !== null || in_array($mapping, $changedMappings)) {
                    $eligible[] = $mapping;
                }
            }
            if (!$eligible) {
                continue;
            }
            $identity = plugin_agentbdmosassetsync_capture_identity($asset, $route);
            if ($identity === null) {
                continue;
            }
            foreach ($eligible as $mapping) {
                try {
                    $proof = $capture['provenance'][$route['route_id']][$mapping->mapping_id] ?? null;
                    if ($proof === null && plugin_agentbdmosassetsync_capture_candidate($storage, $mapping->b_field)) {
                        try {
                            $proof = plugin_agentbdmosassetsync_provenance_capture_begin($route, $asset, $mapping, $identity);
                        } catch (Throwable $e) {
                            plugin_agentbdmosassetsync_capture_log($storage, 'evidence_after', $e, $route['route_id'], $mapping->mapping_id);
                        }
                    }
                    $descriptor = plugin_agentbdmosassetsync_field_descriptor($asset, $mapping->b_field);
                    if (!plugin_agentbdmosassetsync_capture_changed($storage, $capture, $descriptor)) {
                        plugin_agentbdmosassetsync_provenance_restore($proof);
                        continue;
                    }
                    $value = plugin_agentbdmosassetsync_capture_value($storage, $asset, $descriptor);
                    if ($value === null && plugin_agentbdmosassetsync_capture_null_input($storage, $descriptor)) {
                        $column = $descriptor['column'];
                        $before = array_key_exists($column, $capture['storage_fields'])
                            ? $capture['storage_fields'][$column] : $descriptor['sql']['Default'];
                        $before = plugin_agentbdmosassetsync_capture_input_value($descriptor, $before);
                        if ($before === null || ($descriptor['kind'] === 'dropdown' && $before === 0)) {
                            plugin_agentbdmosassetsync_provenance_restore($proof);
                            continue;
                        }
                    }
                    $capture['rows'][$route['route_id']] ??= ['route' => $route, 'identity' => $identity, 'fields' => []];
                    $capture['rows'][$route['route_id']]['fields'][$mapping->mapping_id] = [
                        'value' => $value, 'changed_at' => $capture['time'], 'reliable' => true];
                    $capture['rows'][$route['route_id']]['proofs'][$mapping->mapping_id] = [
                        'context' => $proof, 'mapping' => $mapping, 'descriptor' => $descriptor, 'asset' => clone $asset];
                } catch (Throwable $e) {
                    plugin_agentbdmosassetsync_capture_log($storage, 'field', $e, $route['route_id'], $mapping->mapping_id);
                }
            }
        } catch (Throwable $e) {
            plugin_agentbdmosassetsync_capture_log($storage, 'route', $e, $route['route_id']);
        }
    }
}

/** SQL NULL's native input token may remain in model memory after the database saved null. */
function plugin_agentbdmosassetsync_capture_null_input(CommonDBTM $storage, array $descriptor): bool
{
    $column = $descriptor['column'];
    return $descriptor['custom_field_id'] === null && $descriptor['sql']['Null'] === 'YES'
        && array_key_exists($column, $storage->input) && array_key_exists($column, $storage->fields)
        && in_array($storage->input[$column], ['NULL', 'null'], true)
        && in_array($storage->fields[$column], ['NULL', 'null'], true);
}

function plugin_agentbdmosassetsync_capture_changed(CommonDBTM $storage, array $capture, array $descriptor): bool
{
    $column = $descriptor['column'];
    $changed = in_array($column, $storage->updates ?? [], true);
    if ($descriptor['custom_field_id'] !== null) {
        if (!$changed) {
            return false;
        }
        if (!array_key_exists($column, $capture['storage_fields']) || !array_key_exists($column, $storage->fields)) {
            throw new RuntimeException('Custom field storage column is missing');
        }
        $before = plugin_agentbdmosassetsync_custom_stored_value($descriptor, $capture['storage_fields'][$column]);
        $after = plugin_agentbdmosassetsync_custom_stored_value($descriptor, $storage->fields[$column]);
        return !plugin_agentbdmosassetsync_scalar_equal($before, $after);
    }
    if (!$changed && (isset($storage->input['id']) || !array_key_exists($column, $storage->input))) {
        return false;
    }
    if (plugin_agentbdmosassetsync_capture_null_input($storage, $descriptor)) {
        return true; // Verify the fresh database value before treating a token as an actual null.
    }
    $before = array_key_exists($column, $capture['storage_fields'])
        ? $capture['storage_fields'][$column] : $descriptor['sql']['Default'];
    $before = $before === null ? null : plugin_agentbdmosassetsync_capture_input_value($descriptor, $before);
    $after = plugin_agentbdmosassetsync_capture_input_value($descriptor, $storage->fields[$column]);
    if ($descriptor['kind'] === 'dropdown' && ($before === null || $before === 0)
        && ($after === null || $after === 0)) {
        return false;
    }
    return $before !== $after;
}

function plugin_agentbdmosassetsync_capture_value(CommonDBTM $storage, CommonDBTM $asset, array $descriptor)
{
    if (!array_key_exists($descriptor['column'], $storage->fields)) {
        throw new RuntimeException('Field storage column is missing');
    }
    $saved = $storage->fields[$descriptor['column']];
    $class = $descriptor['storage_class'];
    $stored = new $class();
    $found = $descriptor['container_id'] === null ? $stored->getFromDB($asset->getID())
        : $stored->getFromDBByCrit(['items_id' => $asset->getID()]);
    if (!$found) {
        throw new RuntimeException('Field storage row is missing');
    }
    if (!array_key_exists($descriptor['column'], $stored->fields)) {
        throw new RuntimeException('Field storage column is missing');
    }
    if (plugin_agentbdmosassetsync_capture_null_input($storage, $descriptor)
        && $stored->fields[$descriptor['column']] === null) {
        $saved = null;
    }
    if ($descriptor['custom_field_id'] !== null) {
        $saved = plugin_agentbdmosassetsync_custom_stored_value($descriptor, $saved);
    }
    $value = plugin_agentbdmosassetsync_field_value($descriptor,
        plugin_agentbdmosassetsync_capture_input_value($descriptor, $saved));
    $reread = $descriptor['custom_field_id'] !== null
        ? plugin_agentbdmosassetsync_custom_stored_value($descriptor, $stored->fields[$descriptor['column']])
        : $stored->fields[$descriptor['value_column']];
    $reread = plugin_agentbdmosassetsync_field_value($descriptor,
        plugin_agentbdmosassetsync_capture_input_value($descriptor, $reread));
    if ($value !== $reread) {
        throw new RuntimeException('Saved field changed before capture verification');
    }
    return $value;
}

function plugin_agentbdmosassetsync_capture_flush(int $key): void
{
    $capture = &$GLOBALS['plugin_agentbdmosassetsync_captures'][$key];
    foreach ($capture['rows'] as $routeId => $row) {
        $route = $row['route'];
        try {
            $change = new PluginAgentbdmosassetsyncChange();
            $changeId = $change->createCapturedChange(['route_id' => $route['route_id'],
                'settings_version' => (int) $route['settings_version'],
                'a_entities_id' => (int) $route['a_entities_id'], 'entities_id' => (int) $route['entities_id'],
                'itemtype' => $capture['asset']::class,
                'identity_json' => json_encode($row['identity'], JSON_THROW_ON_ERROR),
                'changed_fields_json' => json_encode((object) $row['fields'], JSON_THROW_ON_ERROR)]);
            foreach ($row['proofs'] as $id => $proof) {
                if ($proof['context'] === null) {
                    continue;
                }
                try {
                    plugin_agentbdmosassetsync_provenance_capture_finish($proof['context'], $route, $proof['asset'],
                        $proof['mapping'], $proof['descriptor'], $row['fields'][$id]['value'],
                        $row['fields'][$id]['changed_at'], $changeId);
                } catch (Throwable $e) {
                    plugin_agentbdmosassetsync_capture_log($capture['asset'], 'evidence_after', $e, $routeId, $id);
                }
            }
        } catch (Throwable $e) {
            plugin_agentbdmosassetsync_capture_log($capture['asset'], 'queue', $e, $routeId);
        }
    }
}
