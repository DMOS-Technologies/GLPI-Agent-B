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
    // Validate the asset before Fields performs a nested save in its pre-item hook.
    $hooks = $PLUGIN_HOOKS['pre_item_update'] ?? [];
    $ours = $hooks['agentbdmosassetsync'] ?? [];
    unset($hooks['agentbdmosassetsync']);
    $PLUGIN_HOOKS['pre_item_update'] = ['agentbdmosassetsync' => $ours] + $hooks;
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

function plugin_agentbdmosassetsync_capture_candidate(CommonDBTM $storage, stdClass $selector, bool $saved = false): bool
{
    $names = [$selector->name];
    if ($selector->kind === 'fields') {
        $names[] = 'plugin_fields_' . $selector->name . 'dropdowns_id';
    } elseif (!$saved && str_starts_with($selector->name, 'custom_') && array_key_exists('custom_fields', $storage->input)) {
        return true;
    }
    if ($saved) {
        $changed = !isset($storage->input['id']) ? array_keys($storage->input) : ($storage->updates ?? []);
        if ($selector->kind === 'native' && str_starts_with($selector->name, 'custom_')) {
            $names[] = 'custom_fields';
        }
        return (bool) array_intersect($names, $changed);
    }
    foreach ($names as $name) {
        if (array_key_exists($name, $storage->input)
            && (!array_key_exists($name, $storage->fields) || $storage->input[$name] !== $storage->fields[$name])) {
            return true;
        }
    }
    return false;
}

function plugin_agentbdmosassetsync_capture_before(CommonDBTM $storage): void
{
    $type = plugin_agentbdmosassetsync_capture_type($storage);
    $routes = plugin_agentbdmosassetsync_capture_routes($type);
    if (!$routes || plugin_agentbdmosassetsync_is_sync_write()) {
        return;
    }
    if (isset($GLOBALS['plugin_agentbdmosassetsync_capture_failure'])) {
        throw new RuntimeException($GLOBALS['plugin_agentbdmosassetsync_capture_failure']);
    }
    $asset = plugin_agentbdmosassetsync_capture_owner($storage, $type);
    if ($asset === null) {
        return;
    }
    $key = spl_object_id($storage);
    $GLOBALS['plugin_agentbdmosassetsync_captures'][$key] = ['asset' => clone $asset,
        'routes' => $routes, 'time' => plugin_agentbdmosassetsync_capture_time(), 'rows' => []];
    foreach ($routes as $route) {
        if (!$asset->isEntityAssign() || (int) $asset->getEntityID() !== (int) $route['entities_id']
            || plugin_agentbdmosassetsync_capture_identity($asset, $route) === null) {
            continue;
        }
        foreach (json_decode($route['field_mappings_json']) as $mapping) {
            if (!$mapping->enabled || $mapping->itemtype !== $type
                || !plugin_agentbdmosassetsync_capture_candidate($storage, $mapping->b_field)) {
                continue;
            }
            if ($storage::class !== $type && ($mapping->b_field->kind !== 'fields'
                || PluginFieldsContainer::getClassname($type, $mapping->b_field->container) !== $storage::class)) {
                continue;
            }
            try {
                $descriptor = plugin_agentbdmosassetsync_field_descriptor($asset, $mapping->b_field);
                $name = $descriptor['value_column'];
                if (array_key_exists($name, $storage->input)) {
                    plugin_agentbdmosassetsync_field_value($descriptor, $storage->input[$name]);
                }
            } catch (Throwable $e) {
                throw new RuntimeException('ASB_CAPTURE_REJECTED: mapping_id=' . $mapping->mapping_id . ' reason=' . $e->getMessage(), 0, $e);
            }
        }
    }
}

/** Each actual native/Fields storage save gets its own immutable snapshot before returning. */
function plugin_agentbdmosassetsync_capture_after(CommonDBTM $storage): void
{
    $type = plugin_agentbdmosassetsync_capture_type($storage);
    $routes = plugin_agentbdmosassetsync_capture_routes($type);
    if (!$routes || plugin_agentbdmosassetsync_is_sync_write()) {
        return;
    }
    $key = spl_object_id($storage);
    if (!isset($GLOBALS['plugin_agentbdmosassetsync_captures'][$key])) {
        return; // Presave deliberately excluded asset creation.
    }
    $GLOBALS['plugin_agentbdmosassetsync_captures'][$key]['saved_fields'] = $storage->fields;
    $GLOBALS['plugin_agentbdmosassetsync_captures'][$key]['saved_updates'] = $storage->updates ?? [];
    try {
        plugin_agentbdmosassetsync_capture_collect($key, $storage);
        plugin_agentbdmosassetsync_capture_flush($key);
    } catch (Throwable $e) {
        $reason = 'ASB_CAPTURE_OUTCOME_UNKNOWN: asset save may have completed; capture incomplete; reason=' . $e->getMessage();
        $GLOBALS['plugin_agentbdmosassetsync_capture_failure'] = $reason;
        // Preserve the failed request-local snapshot; never retry blindly at shutdown.
        throw new RuntimeException($reason, 0, $e);
    }
}
/** Durable verified Work links, rather than a client-supplied ID, determine suspension/identity. */
function plugin_agentbdmosassetsync_capture_identity(CommonDBTM $asset, array $route): ?array
{
    global $DB;
    $links = [];
    foreach ($DB->request(['FROM' => PluginAgentbdmosassetsyncWork::getTable(), 'WHERE' => [
        'route_id' => $route['route_id'], 'itemtype' => $asset::class,
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
        $identity = plugin_agentbdmosassetsync_capture_identity($asset, $route);
        if ($identity === null) {
            continue;
        }
        foreach (json_decode($route['field_mappings_json']) as $mapping) {
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
            if (!plugin_agentbdmosassetsync_capture_candidate($storage, $selector, true)) {
                continue;
            }
            $descriptor = plugin_agentbdmosassetsync_field_descriptor($asset, $selector);
            if (!plugin_agentbdmosassetsync_capture_changed($storage, $capture, $descriptor)) {
                continue;
            }
            $value = plugin_agentbdmosassetsync_capture_value($storage, $asset, $descriptor);
            $capture['rows'][$route['route_id']] ??= ['route' => $route, 'identity' => $identity, 'fields' => []];
            $capture['rows'][$route['route_id']]['fields'][$mapping->mapping_id] = [
                'value' => $value, 'changed_at' => $capture['time'], 'reliable' => true];
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
    return $changed || (!isset($storage->input['id']) && array_key_exists($column, $storage->input));
}

function plugin_agentbdmosassetsync_capture_value(CommonDBTM $storage, CommonDBTM $asset, array $descriptor)
{
    $saved = $storage->fields[$descriptor['column']];
    if ($descriptor['custom_field_id'] !== null) {
        $values = json_decode($saved, true, 512, JSON_THROW_ON_ERROR);
        $saved = $descriptor['custom_type']->formatValueFromDB($values[$descriptor['custom_field_id']] ?? null);
    }
    $value = plugin_agentbdmosassetsync_field_value($descriptor, $saved);
    if ($value !== plugin_agentbdmosassetsync_field_read($asset, $descriptor)) {
        throw new RuntimeException('Saved field changed before capture verification');
    }
    return $value;
}

function plugin_agentbdmosassetsync_capture_flush(int $key): void
{
    $capture = &$GLOBALS['plugin_agentbdmosassetsync_captures'][$key];
    foreach ($capture['rows'] as $routeId => $row) {
        $route = $row['route'];
        $change = new PluginAgentbdmosassetsyncChange();
        $change->createCapturedChange(['route_id' => $route['route_id'],
            'settings_version' => (int) $route['settings_version'],
            'a_entities_id' => (int) $route['a_entities_id'], 'entities_id' => (int) $route['entities_id'],
            'itemtype' => $capture['asset']::class,
            'identity_json' => json_encode($row['identity'], JSON_THROW_ON_ERROR),
            'changed_fields_json' => json_encode((object) $row['fields'], JSON_THROW_ON_ERROR)]);
        unset($capture['rows'][$routeId]); // Only a verified persisted row may leave capture state.
    }
    unset($GLOBALS['plugin_agentbdmosassetsync_captures'][$key]);
}
