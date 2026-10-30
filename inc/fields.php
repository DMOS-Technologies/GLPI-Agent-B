<?php

/** Request-local state cannot be enabled by a REST payload. Nested sync saves stay guarded. */
function plugin_agentbdmosassetsync_sync_guard(callable $save)
{
    $GLOBALS['plugin_agentbdmosassetsync_sync_depth'] = ($GLOBALS['plugin_agentbdmosassetsync_sync_depth'] ?? 0) + 1;
    try {
        return $save();
    } finally {
        --$GLOBALS['plugin_agentbdmosassetsync_sync_depth'];
    }
}

function plugin_agentbdmosassetsync_is_sync_write(): bool
{
    return ($GLOBALS['plugin_agentbdmosassetsync_sync_depth'] ?? 0) > 0;
}

function plugin_agentbdmosassetsync_asset_types(): array
{
    global $CFG_GLPI;
    return array_values(array_filter($CFG_GLPI['asset_types'] ?? [],
        static fn($type) => is_string($type) && is_subclass_of($type, CommonDBTM::class)));
}

/** A descriptor identifies an actual scalar storage column, never a joined search value. */
function plugin_agentbdmosassetsync_field_descriptor(CommonDBTM $asset, stdClass $selector, bool $forWrite = true,
    bool $participation = false, bool $metadataOnly = false): array
{
    global $DB;
    if ($metadataOnly && ($forWrite || $asset->getID() > 0)) {
        throw new RuntimeException('Metadata resolution requires an empty parent and cannot authorize a value read or write');
    }
    $permitted = $metadataOnly ? Session::haveRight('config', READ)
        : ($forWrite ? $asset::canUpdate() : ($asset->getID() > 0 && $asset->can($asset->getID(), READ)));
    if (!$permitted || ($asset->isEntityAssign() && !Session::haveAccessToEntity($asset->getEntityID()))) {
        throw new RuntimeException($forWrite ? 'Asset field write permission denied' : 'Asset field read permission denied');
    }
    if ($selector->kind === 'native' && $asset instanceof \Glpi\Asset\Asset
        && str_starts_with($selector->name, 'custom_')) {
        return plugin_agentbdmosassetsync_custom_descriptor($asset, $selector->name, $forWrite, $metadataOnly);
    }
    $column = $selector->name;
    $class = $asset::class;
    $kind = null;
    $dropdown = null;
    $containerId = null;
    if ($selector->kind === 'fields') {
        if (!Plugin::isPluginActive('fields') || !class_exists('PluginFieldsContainer')) {
            throw new RuntimeException('Fields plugin is unavailable');
        }
        $containers = iterator_to_array($DB->request(['FROM' => PluginFieldsContainer::getTable(),
            'WHERE' => ['name' => $selector->container, 'is_active' => 1]]));
        $containers = array_filter($containers, static fn($row) => in_array($asset::class,
            PluginFieldsToolbox::decodeJSONItemtypes($row['itemtypes']), true));
        if (count($containers) !== 1) {
            throw new RuntimeException('Fields container missing or ambiguous: ' . $selector->container);
        }
        $container = reset($containers);
        $containerId = (int) $container['id'];
        $entities = (int) $container['is_recursive']
            ? getSonsOf('glpi_entities', (int) $container['entities_id']) : [(int) $container['entities_id']];
        if ($asset->isEntityAssign() && !in_array((int) $asset->getEntityID(), array_map('intval', $entities), true)) {
            throw new RuntimeException('Fields container is outside asset entity scope');
        }
        if (!$metadataOnly) {
            $profileId = (int) ($_SESSION['glpiactiveprofile']['id'] ?? 0);
            $containerRight = PluginFieldsProfile::getRightOnContainer($profileId, $containerId);
            if ($profileId < 1 || ($forWrite ? $containerRight <= READ : $containerRight < READ)) {
                throw new RuntimeException($forWrite ? 'Fields container write permission denied' : 'Fields container read permission denied');
            }
        }
        $rows = iterator_to_array($DB->request(['FROM' => PluginFieldsField::getTable(), 'WHERE' => [
            'plugin_fields_containers_id' => $containerId, 'name' => $column, 'is_active' => 1]]));
        if (count($rows) !== 1) {
            throw new RuntimeException('Fields definition missing or ambiguous: ' . $column);
        }
        $field = reset($rows);
        if (($forWrite && !$participation && (int) $field['is_readonly']) || (int) $field['multiple']) {
            throw new RuntimeException('Fields definition is read-only or multiple');
        }
        $kinds = ['text' => 'text', 'textarea' => 'text', 'url' => 'text', 'number' => 'number',
            'yesno' => 'boolean', 'date' => 'date', 'datetime' => 'datetime'];
        $kind = $kinds[$field['type']] ?? null;
        if ($field['type'] === 'dropdown') {
            $dropdown = PluginFieldsDropdown::getClassname($column);
            $column = 'plugin_fields_' . $column . 'dropdowns_id';
        } elseif (str_starts_with($field['type'], 'dropdown-')) {
            $dropdown = substr($field['type'], 9);
        }
        $class = PluginFieldsContainer::getClassname($asset::class, $container['name']);
    } elseif ($selector->kind === 'native') {
        if ($asset instanceof \Glpi\Asset\Asset) {
            foreach ($asset::getDefinition()->getDecodedFieldsField() as $definition) {
                if ($definition['key'] === $column) {
                    plugin_agentbdmosassetsync_custom_options($definition['field_options'] ?? [], $forWrite, $metadataOnly);
                }
            }
        }
        if (in_array($column, ['id', 'entities_id', 'is_recursive', 'is_deleted', 'is_template',
            'date_creation', 'date_mod', 'assets_assetdefinitions_id', 'template_name', 'is_dynamic'], true)) {
            throw new RuntimeException('Generated, scope, or lifecycle field is not a mapped value');
        }
        foreach (Search::getOptions($asset::class) as $option) {
            if (!is_array($option) || !isset($option['table'], $option['field'])) {
                continue;
            }
            $localColumn = $option['linkfield'] ?? getForeignKeyFieldForTable($option['table']);
            if ($option['table'] !== $asset::getTable() && $localColumn === $column
                && in_array($option['datatype'] ?? '', ['dropdown', 'itemlink'], true)
                && empty($option['joinparams'])) {
                $dropdown = getItemTypeForTable($option['table']);
                break;
            }
            if ($option['table'] === $asset::getTable() && $option['field'] === $column
                && empty($option['joinparams']) && empty($option['computation'])) {
                $kind = ['string' => 'text', 'text' => 'text', 'itemlink' => 'text',
                    'integer' => 'integer', 'number' => 'number', 'decimal' => 'number',
                    'bool' => 'boolean', 'date' => 'date', 'datetime' => 'datetime'][$option['datatype'] ?? ''] ?? null;
            }
        }
    }
    if ($dropdown !== null) {
        if (!is_subclass_of($dropdown, CommonDBTM::class)) {
            throw new RuntimeException('Dropdown class is unavailable');
        }
        $kind = 'dropdown';
    }
    if ($kind === null || !is_subclass_of($class, CommonDBTM::class) || !$DB->fieldExists($class::getTable(), $column)) {
        throw new RuntimeException('No supported scalar storage for field: ' . $selector->name);
    }
    $sql = $DB->getField($class::getTable(), $column);
    if (!preg_match('/\A(?:varchar|char|text|mediumtext|longtext|tinyint|smallint|mediumint|int|bigint|decimal|float|double|date|datetime|timestamp)\b/i', $sql['Type'])) {
        throw new RuntimeException('Unsupported storage type for field: ' . $selector->name);
    }
    return ['storage_class' => $class, 'table' => $class::getTable(), 'column' => $column,
        'kind' => $kind, 'dropdown_class' => $dropdown, 'container_id' => $containerId,
        'custom_field_id' => null, 'value_column' => $column, 'sql' => $sql];
}

/** Return transport values. Dropdowns always leave B as readable local labels. */
function plugin_agentbdmosassetsync_field_read(CommonDBTM $asset, array $descriptor)
{
    $class = $descriptor['storage_class'];
    $stored = new $class();
    $found = $descriptor['container_id'] === null ? $stored->getFromDB($asset->getID())
        : $stored->getFromDBByCrit(['items_id' => $asset->getID()]);
    if (!$found) {
        throw new RuntimeException('Field storage row is missing');
    }
    $value = $stored->fields[$descriptor['value_column']];
    // Fields saves cleared nullable scalar controls as an empty string.
    if ($value === '' && $descriptor['container_id'] !== null
        && in_array($descriptor['kind'], ['date', 'datetime', 'number'], true)
        && $descriptor['sql']['Null'] === 'YES') {
        $value = null;
    }
    return plugin_agentbdmosassetsync_field_value($descriptor, $value);
}

/** Normalize a saved scalar through the same transport rules as a local reread. */
function plugin_agentbdmosassetsync_field_value(array $descriptor, $value)
{
    if ($descriptor['kind'] === 'dropdown') {
        if ($value === null || (int) $value <= 0) {
            throw new RuntimeException('Dropdown has no readable selected option');
        }
        $dropdownClass = $descriptor['dropdown_class'];
        $dropdown = new $dropdownClass();
        if (!$dropdown->getFromDB((int) $value) || !$dropdown->can((int) $value, READ)) {
            throw new RuntimeException('Dropdown option missing or unreadable');
        }
        $label = $dropdown->fields[$dropdown instanceof CommonTreeDropdown ? 'completename' : 'name'] ?? null;
        if (!is_string($label) || $label === '') {
            throw new RuntimeException('Dropdown option label is empty or unsupported');
        }
        return $label;
    }
    if ($value === null) {
        return null;
    }
    if ($descriptor['kind'] === 'boolean') {
        if (!is_bool($value) && !in_array((string) $value, ['0', '1'], true)) {
            throw new RuntimeException('Invalid stored boolean');
        }
        return (bool) $value;
    }
    if (in_array($descriptor['kind'], ['integer', 'number'], true)) {
        if (!is_numeric($value) || !is_finite((float) $value)) {
            throw new RuntimeException('Invalid stored number');
        }
        $number = plugin_agentbdmosassetsync_number($value);
        if ($descriptor['kind'] === 'integer' && !is_int($number)) {
            throw new RuntimeException('Stored integer is fractional or outside the exact local integer range');
        }
        return $number;
    }
    if (in_array($descriptor['kind'], ['date', 'datetime'], true)) {
        $format = $descriptor['kind'] === 'date' ? 'Y-m-d' : 'Y-m-d H:i:s';
        $time = is_string($value) ? DateTimeImmutable::createFromFormat('!' . $format, $value) : false;
        if (!$time || $time->format($format) !== $value) {
            throw new RuntimeException('Invalid stored ' . $descriptor['kind'] . ' format');
        }
    }
    if (!is_scalar($value)) {
        throw new RuntimeException('Stored field is not scalar');
    }
    return (string) $value;
}

/** Canonical wire numbers: 1 and 1.0 agree, without rounding a large integer into a float. */
function plugin_agentbdmosassetsync_number($value)
{
    if ((!is_int($value) && !is_float($value) && !is_string($value))
        || !is_numeric($value) || !is_finite((float) $value)) {
        throw new RuntimeException('Invalid finite number');
    }
    $text = is_string($value) ? $value : json_encode($value, JSON_THROW_ON_ERROR);
    $canonical = plugin_agentbdmosassetsync_number_text($text);
    $number = json_decode($canonical, false, 512, JSON_THROW_ON_ERROR | JSON_BIGINT_AS_STRING);
    if (is_string($number)) {
        $number = (float) $number;
    }
    if (!is_finite((float) $number)
        || plugin_agentbdmosassetsync_number_text(json_encode($number, JSON_THROW_ON_ERROR)) !== $canonical) {
        throw new RuntimeException('Number cannot be represented on the JSON wire without precision loss');
    }
    return $number;
}

function plugin_agentbdmosassetsync_number_text(string $value): string
{
    if (preg_match('/\A(-?)([0-9]+)(?:\.([0-9]+))?(?:[eE]([+-]?[0-9]+))?\z/D', $value, $parts) !== 1) {
        throw new RuntimeException('Invalid numeric representation');
    }
    $fraction = $parts[3] ?? '';
    $exponent = (int) ($parts[4] ?? 0);
    if (abs($exponent) > 1024) {
        throw new RuntimeException('Number exponent exceeds supported exact wire representation');
    }
    $digits = $parts[2] . $fraction;
    $point = strlen($parts[2]) + $exponent;
    if ($point <= 0) {
        $whole = '0';
        $fraction = str_repeat('0', -$point) . $digits;
    } elseif ($point >= strlen($digits)) {
        $whole = $digits . str_repeat('0', $point - strlen($digits));
        $fraction = '';
    } else {
        $whole = substr($digits, 0, $point);
        $fraction = substr($digits, $point);
    }
    $whole = ltrim($whole, '0') ?: '0';
    $fraction = rtrim($fraction, '0');
    $normalized = $whole . ($fraction !== '' ? '.' . $fraction : '');
    return ($parts[1] === '-' && $normalized !== '0' ? '-' : '') . $normalized;
}

function plugin_agentbdmosassetsync_scalar_equal($left, $right): bool
{
    if ((is_int($left) || is_float($left)) && (is_int($right) || is_float($right))) {
        return plugin_agentbdmosassetsync_number($left) === plugin_agentbdmosassetsync_number($right);
    }
    return $left === $right;
}

function plugin_agentbdmosassetsync_exact_work_value(array $work, string $mappingId, $decoded)
{
    if (!is_int($decoded) && !is_float($decoded)) {
        return $decoded; // A JSON string remains a string even when its contents look numeric.
    }
    // Admission already requires a flat scalar object. Read its original tokens before PHP rounds numbers.
    $json = $work['a_values_json'];
    $offset = strpos($json, '{') + 1;
    $string = '"(?:[^"\\\\]|\\\\.)*"';
    $scalar = $string . '|true|false|null|-?(?:0|[1-9][0-9]*)(?:\\.[0-9]+)?(?:[eE][+-]?[0-9]+)?';
    $pattern = '/\\G\\s*(' . $string . ')\\s*:\\s*(' . $scalar . ')\\s*([,}])/s';
    $selected = null;
    while (preg_match($pattern, $json, $parts, 0, $offset) === 1) {
        $offset += strlen($parts[0]);
        if (json_decode($parts[1], false, 512, JSON_THROW_ON_ERROR) === $mappingId) {
            $selected = $parts[2]; // json_decode selects the final member when a key is repeated.
        }
        if ($parts[3] === '}') {
            break;
        }
    }
    if ($selected !== null) {
        return plugin_agentbdmosassetsync_number($selected);
    }
    throw new RuntimeException('Original numeric scalar could not be read exactly');
}


function plugin_agentbdmosassetsync_custom_options(array $options, bool $forWrite = true, bool $metadataOnly = false): void
{
    $profile = (int) ($_SESSION['glpiactiveprofile']['id'] ?? 0);
    foreach (['readonly', 'hidden'] as $restriction) {
        if ($metadataOnly || ($restriction === 'readonly' && !$forWrite)) {
            continue;
        }
        $profiles = $options[$restriction] ?? [];
        // GLPI getOptionValues() resolves profile restrictions to booleans; core definitions retain ID lists.
        $restricted = $profiles === true;
        if (is_array($profiles)) {
            $ids = array_map('intval', $profiles);
            $restricted = in_array(-1, $ids, true) || in_array($profile, $ids, true);
        }
        if ($restricted) {
            throw new RuntimeException('Custom asset field is ' . $restriction . ' for current profile');
        }
    }
    if (!empty($options['multiple']) || !empty($options['enable_richtext'])) {
        throw new RuntimeException('Custom asset field is multiple or rich text');
    }
}

/** GLPI 11 definitions expose virtual custom_* inputs backed by the custom_fields JSON column. */
function plugin_agentbdmosassetsync_custom_descriptor(\Glpi\Asset\Asset $asset, string $name, bool $forWrite = true,
    bool $metadataOnly = false): array
{
    global $DB;
    foreach ($asset::getDefinition()->getCustomFieldDefinitions() as $definition) {
        if ('custom_' . $definition->fields['system_name'] !== $name) {
            continue;
        }
        $type = $definition->getFieldType();
        plugin_agentbdmosassetsync_custom_options($type->getOptionValues(), $forWrite, $metadataOnly);
        $kinds = [
            \Glpi\Asset\CustomFieldType\StringType::class => 'text',
            \Glpi\Asset\CustomFieldType\TextType::class => 'text',
            \Glpi\Asset\CustomFieldType\URLType::class => 'text',
            \Glpi\Asset\CustomFieldType\NumberType::class => 'number',
            \Glpi\Asset\CustomFieldType\BooleanType::class => 'boolean',
            \Glpi\Asset\CustomFieldType\DateType::class => 'date',
            \Glpi\Asset\CustomFieldType\DateTimeType::class => 'datetime',
            \Glpi\Asset\CustomFieldType\DropdownType::class => 'dropdown',
        ];
        $kind = $kinds[$type::class] ?? null;
        if ($kind === null) {
            throw new RuntimeException('Unsupported custom asset scalar field type');
        }
        $dropdown = $kind === 'dropdown' ? $definition->fields['itemtype'] : null;
        if ($dropdown !== null && !is_subclass_of($dropdown, CommonDBTM::class)) {
            throw new RuntimeException('Custom asset dropdown class is unavailable');
        }
        return ['storage_class' => $asset::class, 'table' => $asset::getTable(), 'column' => 'custom_fields',
            'value_column' => $name, 'kind' => $kind, 'dropdown_class' => $dropdown, 'container_id' => null,
            'custom_field_id' => (int) $definition->getID(), 'custom_type' => $type,
            'custom_default' => $definition->fields['default_value'], 'sql' => $DB->getField($asset::getTable(), 'custom_fields')];
    }
    throw new RuntimeException('Custom asset field definition is missing: ' . $name);
}
