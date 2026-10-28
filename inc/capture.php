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

function plugin_agentbdmosassetsync_capture_candidate(CommonDBTM $storage, stdClass $selector): bool
{
    $names = [$selector->name];
    if ($selector->kind === 'fields') {
        $names[] = 'plugin_fields_' . $selector->name . 'dropdowns_id';
    }
    $changed = !isset($storage->input['id']) ? array_keys($storage->input) : ($storage->updates ?? []);
    if ($selector->kind === 'native' && str_starts_with($selector->name, 'custom_')) {
        $names[] = 'custom_fields';
    }
    return (bool) array_intersect($names, $changed);
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
            'time' => plugin_agentbdmosassetsync_capture_time(), 'rows' => []];
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
            foreach (json_decode($route['field_mappings_json'], false, 512, JSON_THROW_ON_ERROR) as $mapping) {
                if (!$mapping->enabled || $mapping->itemtype !== $asset::class) {
                    continue;
                }
                $selector = $mapping->b_field;
                if (($selector->kind === 'fields') !== ($asset::class !== $storage::class)) {
                    continue;
                }
                if ($selector->kind === 'fields'
                    && PluginFieldsContainer::getClassname($asset::class, $selector->container) !== $storage::class) {
                    continue;
                }
                if (plugin_agentbdmosassetsync_capture_candidate($storage, $selector)) {
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
                    $descriptor = plugin_agentbdmosassetsync_field_descriptor($asset, $mapping->b_field);
                    if (!plugin_agentbdmosassetsync_capture_changed($storage, $capture, $descriptor)) {
                        continue;
                    }
                    $value = plugin_agentbdmosassetsync_capture_value($storage, $asset, $descriptor);
                    $capture['rows'][$route['route_id']] ??= ['route' => $route, 'identity' => $identity, 'fields' => []];
                    $capture['rows'][$route['route_id']]['fields'][$mapping->mapping_id] = [
                        'value' => $value, 'changed_at' => $capture['time'], 'reliable' => true];
                } catch (Throwable $e) {
                    plugin_agentbdmosassetsync_capture_log($storage, 'field', $e, $route['route_id'], $mapping->mapping_id);
                }
            }
        } catch (Throwable $e) {
            plugin_agentbdmosassetsync_capture_log($storage, 'route', $e, $route['route_id']);
        }
    }
}

function plugin_agentbdmosassetsync_capture_changed(CommonDBTM $storage, array $capture, array $descriptor): bool
{
    $column = $descriptor['column'];
    $changed = in_array($column, $storage->updates ?? [], true);
    if ($descriptor['custom_field_id'] !== null) {
        $name = $descriptor['value_column'];
        $values = json_decode($storage->fields[$column], true, 512, JSON_THROW_ON_ERROR);
        $after = $descriptor['custom_type']->formatValueFromDB($values[$descriptor['custom_field_id']] ?? null);
        return $changed && ($capture['asset']->fields[$name] ?? null) !== $after;
    }
    if (!$changed && (isset($storage->input['id']) || !array_key_exists($column, $storage->input))) {
        return false;
    }
    $before = array_key_exists($column, $capture['storage_fields'])
        ? $capture['storage_fields'][$column] : $descriptor['sql']['Default'];
    $before = $before === null ? null : plugin_agentbdmosassetsync_capture_input_value($descriptor, $before);
    $after = plugin_agentbdmosassetsync_capture_input_value($descriptor, $storage->fields[$column]);
    return $before !== $after;
}

function plugin_agentbdmosassetsync_capture_value(CommonDBTM $storage, CommonDBTM $asset, array $descriptor)
{
    $saved = $storage->fields[$descriptor['column']];
    if ($descriptor['custom_field_id'] !== null) {
        $values = json_decode($saved, true, 512, JSON_THROW_ON_ERROR);
        $saved = $descriptor['custom_type']->formatValueFromDB($values[$descriptor['custom_field_id']] ?? null);
    }
    $value = plugin_agentbdmosassetsync_field_value($descriptor,
        plugin_agentbdmosassetsync_capture_input_value($descriptor, $saved));
    $class = $descriptor['storage_class'];
    $stored = new $class();
    $found = $descriptor['container_id'] === null ? $stored->getFromDB($asset->getID())
        : $stored->getFromDBByCrit(['items_id' => $asset->getID()]);
    if (!$found) {
        throw new RuntimeException('Field storage row is missing');
    }
    $reread = plugin_agentbdmosassetsync_field_value($descriptor,
        plugin_agentbdmosassetsync_capture_input_value($descriptor, $stored->fields[$descriptor['value_column']]));
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
            $change->createCapturedChange(['route_id' => $route['route_id'],
                'settings_version' => (int) $route['settings_version'],
                'a_entities_id' => (int) $route['a_entities_id'], 'entities_id' => (int) $route['entities_id'],
                'itemtype' => $capture['asset']::class,
                'identity_json' => json_encode($row['identity'], JSON_THROW_ON_ERROR),
                'changed_fields_json' => json_encode((object) $row['fields'], JSON_THROW_ON_ERROR)]);
        } catch (Throwable $e) {
            plugin_agentbdmosassetsync_capture_log($capture['asset'], 'queue', $e, $routeId);
        }
    }
}
