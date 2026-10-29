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

function plugin_agentbdmosassetsync_evidence_binding(array $route, stdClass $mapping, array $descriptor): ?array
{
    $manifest = plugin_agentbdmosassetsync_evidence_manifest($route);
    $entry = $manifest?->bindings->{$mapping->mapping_id} ?? null;
    if ($manifest === null || !plugin_agentbdmosassetsync_evidence_active($route, $mapping)
        || !plugin_agentbdmosassetsync_evidence_entry($entry, (int) $route['settings_version'])
        || $entry->binding_hash !== plugin_agentbdmosassetsync_evidence_fingerprint($route, $mapping, $descriptor)) {
        return null;
    }
    return get_object_vars($entry);
}

/** Publication is configuration activity. Only unchanged, continuously enabled bindings keep their token. */
function plugin_agentbdmosassetsync_evidence_publication(array $next, ?array $previous): string
{
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
            $descriptor = plugin_agentbdmosassetsync_field_descriptor($asset, $mapping->b_field);
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
function plugin_agentbdmosassetsync_evidence_reset(?string $dependency = null, ?callable $affected = null): void
{
    global $DB;
    $table = PluginAgentbdmosassetsyncSetting::getTable();
    if (!$DB->tableExists($table) || !$DB->fieldExists($table, 'evidence_bindings_json')) {
        return;
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
            $json = plugin_agentbdmosassetsync_evidence_publication($current, null);
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
