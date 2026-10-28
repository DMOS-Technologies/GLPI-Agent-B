<?php

class PluginAgentbdmosassetsyncSetting extends CommonDBTM
{
    public static $rightname = 'plugin_agentbdmosassetsync_setting';
    private ?array $clientCreateInput = null;

    public static function getTypeName($nb = 0)
    {
        return 'Agent-B-DMOS-AssetSync Setting';
    }

    public static function canDelete(): bool { return false; }
    public static function canPurge(): bool { return false; }
    public function pre_deleteItem() { return false; }
    public function pre_purgeItem() { return false; }

    public function getRights($interface = 'central')
    {
        return [READ => __('Read'), CREATE => __('Create'), UPDATE => __('Update')];
    }

    public function can($ID, int $right, ?array &$input = null): bool
    {
        // V1 adds _add and a default entity after this call. Keep the actual client input.
        if ($right === CREATE && $input !== null) {
            $this->clientCreateInput = $input;
        }
        return in_array($right, [READ, CREATE, UPDATE], true)
            && Session::haveRight(static::$rightname, $right)
            && parent::can($ID, $right, $input);
    }

    public function rawSearchOptions()
    {
        return plugin_agentbdmosassetsync_search_options(static::getTable(), [
            'id', 'route_id', 'settings_version', 'entities_id', 'a_entities_id', 'route_enabled',
        ]);
    }

    private static function contentFields(): array
    {
        return ['a_entities_id', 'entities_id', 'route_enabled', 'settings_version',
            'enabled_itemtypes_json', 'field_mappings_json'];
    }

    private function validateSetting(array $input, bool $creating): void
    {
        $allowed = array_merge(self::contentFields(), ['route_id', 'notes_itemtypes_json']);
        if (!$creating) {
            $allowed[] = 'id';
        }
        plugin_agentbdmosassetsync_check_fields($input, $allowed, $creating ? ['id'] : []);
        $required = array_merge(self::contentFields(), [$creating ? 'route_id' : 'id']);
        plugin_agentbdmosassetsync_require_fields($input, $required);

        $invalid = [];
        foreach (['a_entities_id', 'entities_id'] as $field) {
            if (!plugin_agentbdmosassetsync_is_uint($input[$field])) {
                $invalid[] = $field;
            }
        }
        if (array_key_exists('id', $input) && !plugin_agentbdmosassetsync_is_uint($input['id'], 1)) {
            $invalid[] = 'id';
        }
        if (array_key_exists('route_id', $input) && !plugin_agentbdmosassetsync_is_key($input['route_id'])) {
            $invalid[] = 'route_id';
        }
        if (!is_int($input['route_enabled']) || !in_array($input['route_enabled'], [0, 1], true)) {
            $invalid[] = 'route_enabled';
        }
        if (!plugin_agentbdmosassetsync_is_uint($input['settings_version'], 1)) {
            $invalid[] = 'settings_version';
        }
        $decoded = [];
        $jsonFields = ['enabled_itemtypes_json', 'field_mappings_json'];
        if (array_key_exists('notes_itemtypes_json', $input)) {
            $jsonFields[] = 'notes_itemtypes_json';
        }
        foreach ($jsonFields as $field) {
            try {
                $decoded[$field] = plugin_agentbdmosassetsync_json($field, $input[$field]);
                if (!is_array($decoded[$field])) {
                    $invalid[] = $field;
                }
            } catch (RuntimeException $e) {
                $invalid[] = $field;
            }
        }
        if ($invalid) {
            sort($invalid, SORT_STRING);
            plugin_agentbdmosassetsync_fail('ASB_INVALID_FIELD: field=' . $invalid[0]);
        }
        $this->validateMappings($decoded['enabled_itemtypes_json'], $decoded['field_mappings_json'], $input['entities_id']);
        if (array_key_exists('notes_itemtypes_json', $decoded)) {
            $this->validateNotes($decoded['enabled_itemtypes_json'], $decoded['notes_itemtypes_json'], $input['entities_id']);
        }
    }

    private function validateNotes(array $types, array $noteTypes, int $entity): void
    {
        $seen = [];
        foreach ($noteTypes as $type) {
            if (!is_string($type) || $type === '' || strlen($type) > 255 || in_array($type, $seen, true)
                || !in_array($type, $types, true)) {
                plugin_agentbdmosassetsync_fail('ASB_INVALID_FIELD: field=notes_itemtypes_json');
            }
            $seen[] = $type;
        }
        foreach ($noteTypes as $type) {
            if (!plugin_agentbdmosassetsync_notes_capable($type)) {
                plugin_agentbdmosassetsync_fail('ASB_UNSUPPORTED_ITEMTYPE: itemtype=' . $type);
            }
            $parent = new $type();
            $parent->getEmpty();
            $parent->fields['entities_id'] = $entity;
            plugin_agentbdmosassetsync_notes_check_parent($parent, [
                'itemtype' => $type, 'entities_id' => $entity,
            ], UPDATENOTE);
        }
    }

    private function validateMappings(array $types, array $mappings, int $entity): void
    {
        global $CFG_GLPI;

        $seenTypes = [];
        foreach ($types as $type) {
            if (!is_string($type) || $type === '' || strlen($type) > 255 || in_array($type, $seenTypes, true)) {
                plugin_agentbdmosassetsync_fail('ASB_INVALID_FIELD: field=enabled_itemtypes_json');
            }
            $seenTypes[] = $type;
        }
        foreach ($types as $type) {
            if (!in_array($type, $CFG_GLPI['asset_types'], true)
                || !is_subclass_of($type, CommonDBTM::class)) {
                plugin_agentbdmosassetsync_fail('ASB_UNSUPPORTED_ITEMTYPE: itemtype=' . $type);
            }
        }

        $seenIds = [];
        $targets = [];
        foreach ($mappings as $mapping) {
            $id = $mapping instanceof stdClass && is_string($mapping->mapping_id ?? null)
                ? $mapping->mapping_id : '';
            if (!plugin_agentbdmosassetsync_object_keys($mapping, [
                'mapping_id', 'itemtype', 'enabled', 'a_field', 'b_field', 'source', 'value_mode',
            ]) || preg_match('/\A[a-z][a-z0-9_]{0,63}\z/D', $id) !== 1
                || in_array($id, $seenIds, true)
                || !is_string($mapping->itemtype) || $mapping->itemtype === '' || strlen($mapping->itemtype) > 255
                || !is_bool($mapping->enabled)
                || !in_array($mapping->source, ['A', 'B', 'Both'], true)
                || !in_array($mapping->value_mode, [
                    'direct', 'dropdown_label_to_text', 'text_to_dropdown', 'dropdown_label_to_dropdown',
                ], true)) {
                plugin_agentbdmosassetsync_fail('ASB_INVALID_MAPPING: mapping_id=' . $id);
            }
            $seenIds[] = $id;
            if (!in_array($mapping->itemtype, $CFG_GLPI['asset_types'], true)
                || !is_subclass_of($mapping->itemtype, CommonDBTM::class)) {
                plugin_agentbdmosassetsync_fail('ASB_UNSUPPORTED_ITEMTYPE: itemtype=' . $mapping->itemtype);
            }
            foreach (['a_field', 'b_field'] as $side) {
                if (!$this->validSelector($mapping->$side)) {
                    plugin_agentbdmosassetsync_fail('ASB_UNSUPPORTED_MAPPING: mapping_id=' . $id);
                }
                $selector = $mapping->$side;
                // First copy always writes B; B/Both can also return values for A to write.
                $isWriteTarget = $side === 'b_field' || in_array($mapping->source, ['B', 'Both'], true);
                if ($isWriteTarget && $selector->kind === 'native'
                    && in_array($selector->name, ['id', 'date_creation', 'date_mod', 'entities_id', 'is_deleted'], true)) {
                    plugin_agentbdmosassetsync_fail('ASB_UNSUPPORTED_MAPPING: mapping_id=' . $id);
                }
            }
            if ($mapping->enabled) {
                $selector = $mapping->b_field;
                $target = json_encode([$mapping->itemtype, $selector->kind,
                    $selector->container ?? null, $selector->name], JSON_THROW_ON_ERROR);
                if (!in_array($mapping->itemtype, $types, true) || in_array($target, $targets, true)) {
                    plugin_agentbdmosassetsync_fail('ASB_INVALID_MAPPING: mapping_id=' . $id);
                }
                $targets[] = $target;
                try {
                    $asset = new ($mapping->itemtype)();
                    $asset->getEmpty();
                    $asset->fields['entities_id'] = $entity;
                    $descriptor = plugin_agentbdmosassetsync_field_descriptor($asset, $mapping->b_field);
                    $allowedModes = match ($descriptor['kind']) {
                        'dropdown' => ['text_to_dropdown', 'dropdown_label_to_dropdown'],
                        'text' => ['direct', 'dropdown_label_to_text'],
                        default => ['direct'],
                    };
                    if (!in_array($mapping->value_mode, $allowedModes, true)) {
                        plugin_agentbdmosassetsync_fail('ASB_UNSUPPORTED_MAPPING: mapping_id=' . $id);
                    }
                } catch (Throwable $e) {
                    plugin_agentbdmosassetsync_fail('ASB_UNSUPPORTED_MAPPING: mapping_id=' . $id);
                }
            }
        }
    }

    private function validSelector($selector): bool
    {
        if (!$selector instanceof stdClass || !is_string($selector->kind ?? null)) {
            return false;
        }
        $keys = $selector->kind === 'fields' ? ['kind', 'container', 'name'] : ['kind', 'name'];
        if (!in_array($selector->kind, ['native', 'fields'], true)
            || !plugin_agentbdmosassetsync_object_keys($selector, $keys)) {
            return false;
        }
        foreach (array_diff($keys, ['kind']) as $key) {
            if (!is_string($selector->$key) || trim($selector->$key) === '') {
                return false;
            }
        }
        return true;
    }

    private function lockRoute(string $route): string
    {
        global $DB;

        // The connection lock spans GLPI's complete local write and verification.
        $lock = 'asb-setting-' . sha1($route);
        $row = $DB->fetchAssoc($DB->doQuery("SELECT GET_LOCK('$lock', 5) AS acquired"));
        if ((int) $row['acquired'] !== 1) {
            plugin_agentbdmosassetsync_fail('ASB_SETTING_BUSY');
        }
        return $lock;
    }

    private function verifySaved(int $id, array $input): void
    {
        if (!$this->getFromDB($id)) {
            plugin_agentbdmosassetsync_fail('ASB_SETTING_VERIFY_FAILED');
        }
        foreach ($input as $field => $value) {
            if ((string) $this->fields[$field] !== (string) $value) {
                plugin_agentbdmosassetsync_fail('ASB_SETTING_VERIFY_FAILED');
            }
        }
    }

    public function add(array $input, $options = [], $history = true)
    {
        global $DB;

        $raw = $this->clientCreateInput ?? $input;
        $this->clientCreateInput = null;
        $raw += ['notes_itemtypes_json' => '[]'];
        $this->validateSetting($raw, true);
        if (!static::canCreate() || !Session::haveAccessToEntity($raw['entities_id'])) {
            return false;
        }
        $lock = $this->lockRoute($raw['route_id']);
        try {
            if (plugin_agentbdmosassetsync_read_setting($raw['route_id']) !== null) {
                plugin_agentbdmosassetsync_fail('ASB_ROUTE_EXISTS: route_id=' . $raw['route_id']);
            }
            $id = parent::add($raw, $options, $history);
            if ($id !== false) {
                $this->verifySaved((int) $id, $raw);
            }
            return $id;
        } finally {
            $DB->doQuery("SELECT RELEASE_LOCK('$lock')");
        }
    }

    public function update(array $input, $history = true, $options = [])
    {
        global $DB;

        $this->validateSetting($input, false);
        if (!$this->getFromDB($input['id']) || !$this->can($input['id'], UPDATE)) {
            return false;
        }
        $lock = $this->lockRoute($this->fields['route_id']);
        try {
            if (!$this->getFromDB($input['id'])) {
                return false;
            }
            if (!array_key_exists('notes_itemtypes_json', $input)) {
                // Legacy replacements preserve Notes, while still validating the new enabled-type list.
                $this->validateNotes(
                    plugin_agentbdmosassetsync_json('enabled_itemtypes_json', $input['enabled_itemtypes_json']),
                    plugin_agentbdmosassetsync_json('notes_itemtypes_json', $this->fields['notes_itemtypes_json']),
                    $input['entities_id']
                );
            }
            foreach (['route_id', 'a_entities_id', 'entities_id'] as $field) {
                if (array_key_exists($field, $input) && (string) $input[$field] !== (string) $this->fields[$field]) {
                    plugin_agentbdmosassetsync_fail('ASB_IMMUTABLE_FIELD: field=' . $field);
                }
            }
            if ($input['settings_version'] <= (int) $this->fields['settings_version']) {
                plugin_agentbdmosassetsync_fail('ASB_SETTINGS_VERSION_NOT_NEWER: submitted='
                    . $input['settings_version'] . ' stored=' . $this->fields['settings_version']);
            }
            $saved = parent::update($input, $history, $options);
            if ($saved) {
                $this->verifySaved($input['id'], $input);
            }
            return $saved;
        } finally {
            $DB->doQuery("SELECT RELEASE_LOCK('$lock')");
        }
    }
}
