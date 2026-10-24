<?php

class PluginAgentbdmosassetsyncChange extends CommonDBTM
{
    public static $rightname = 'plugin_agentbdmosassetsync_change';
    private bool $internalDone = false;
    private bool $internalCreate = false;

    public static function getTypeName($nb = 0)
    {
        return 'Agent-B-DMOS-AssetSync Change';
    }

    public static function canCreate(): bool { return false; }
    public static function canDelete(): bool { return false; }
    public static function canPurge(): bool { return false; }
    public function pre_deleteItem() { return false; }
    public function pre_purgeItem() { return false; }

    public function can($ID, int $right, ?array &$input = null): bool
    {
        return in_array($right, [READ, UPDATE], true)
            && Session::haveRight(static::$rightname, $right)
            && parent::can($ID, $right, $input);
    }

    public function getRights($interface = 'central')
    {
        return [READ => __('Read'), UPDATE => __('Update')];
    }

    public function rawSearchOptions()
    {
        return plugin_agentbdmosassetsync_search_options(static::getTable(), [
            'id', 'status', 'route_id', 'settings_version', 'entities_id', 'itemtype',
        ]);
    }

    public function add(array $input, $options = [], $history = true)
    {
        plugin_agentbdmosassetsync_fail('ASB_CHANGE_CREATE_FORBIDDEN');
    }

    public function prepareInputForAdd($input)
    {
        return $this->internalCreate ? $input : false;
    }

    /** A standard REST request can call add(), never this trusted local capture entry point. */
    public function createCapturedChange(array $input): int
    {
        global $DB;
        $required = ['route_id', 'settings_version', 'a_entities_id', 'entities_id', 'itemtype',
            'identity_json', 'changed_fields_json'];
        plugin_agentbdmosassetsync_check_fields($input, $required);
        plugin_agentbdmosassetsync_require_fields($input, $required);
        if (!plugin_agentbdmosassetsync_is_key($input['route_id'])
            || !plugin_agentbdmosassetsync_is_uint($input['settings_version'], 1)
            || !plugin_agentbdmosassetsync_is_uint($input['a_entities_id'])
            || !plugin_agentbdmosassetsync_is_uint($input['entities_id'])
            || !in_array($input['itemtype'], plugin_agentbdmosassetsync_asset_types(), true)) {
            plugin_agentbdmosassetsync_fail('ASB_CAPTURE_INVALID_SCOPE');
        }
        $identity = plugin_agentbdmosassetsync_json('identity_json', $input['identity_json']);
        if (!plugin_agentbdmosassetsync_object_keys($identity, ['a_items_id', 'b_items_id', 'serial'])
            || ($identity->a_items_id !== null && !plugin_agentbdmosassetsync_is_uint($identity->a_items_id, 1))
            || !plugin_agentbdmosassetsync_is_uint($identity->b_items_id, 1)
            || ($identity->serial !== null && (!is_string($identity->serial) || $identity->serial === ''))) {
            plugin_agentbdmosassetsync_fail('ASB_INVALID_FIELD: field=identity_json');
        }
        $fields = plugin_agentbdmosassetsync_json('changed_fields_json', $input['changed_fields_json']);
        if (!$fields instanceof stdClass || !get_object_vars($fields)) {
            plugin_agentbdmosassetsync_fail('ASB_INVALID_FIELD: field=changed_fields_json');
        }
        foreach (get_object_vars($fields) as $mapping => $field) {
            if (preg_match('/\A[a-z][a-z0-9_]{0,63}\z/D', $mapping) !== 1
                || !plugin_agentbdmosassetsync_object_keys($field, ['value', 'changed_at', 'reliable'])
                || !(is_scalar($field->value) || $field->value === null)
                || (is_float($field->value) && !is_finite($field->value))
                || $field->reliable !== true || !is_string($field->changed_at)) {
                plugin_agentbdmosassetsync_fail('ASB_INVALID_FIELD: field=changed_fields_json');
            }
            $time = DateTimeImmutable::createFromFormat('!Y-m-d\TH:i:sP', $field->changed_at);
            if (!$time || $time->format('Y-m-d\TH:i:sP') !== $field->changed_at
                || !str_ends_with($field->changed_at, '+08:00')) {
                plugin_agentbdmosassetsync_fail('ASB_INVALID_FIELD: field=changed_fields_json');
            }
        }
        $input += ['status' => 'Pending', 'retry_count' => 0, 'error' => null, 'done_at' => null];
        $DB->beginTransaction();
        $this->internalCreate = true;
        try {
            $id = parent::add($input);
            if (!$id || !$this->getFromDB((int) $id)) {
                plugin_agentbdmosassetsync_fail('ASB_CAPTURE_SAVE_FAILED');
            }
            foreach ($input as $field => $value) {
                if (($value === null && $this->fields[$field] !== null)
                    || ($value !== null && (string) $this->fields[$field] !== (string) $value)) {
                    plugin_agentbdmosassetsync_fail('ASB_CAPTURE_VERIFY_FAILED: field=' . $field);
                }
            }
            $DB->commit();
            return (int) $id;
        } catch (Throwable $e) {
            $DB->rollBack();
            throw $e;
        } finally {
            $this->internalCreate = false;
        }
    }

    public function update(array $input, $history = true, $options = [])
    {
        // The acknowledgement validator is a separate assigned part.
        plugin_agentbdmosassetsync_fail('ASB_CHANGE_ACKNOWLEDGEMENT_UNAVAILABLE: foundation_stage');
    }

    public function prepareInputForUpdate($input)
    {
        return $this->internalDone ? $input : false;
    }

    /** REST can update a record, but cannot call this local-only method. */
    public function markDoneInternally(int $id): bool
    {
        global $DB;

        if (!plugin_agentbdmosassetsync_is_uint($id, 1)) {
            plugin_agentbdmosassetsync_fail('ASB_INVALID_FIELD: field=ids');
        }
        $DB->beginTransaction();
        try {
            // Lock the exact row so an acknowledgement/correction cannot race this transition.
            $DB->doQuery('SELECT `id` FROM `' . static::getTable() . '` WHERE `id` = ' . $id . ' FOR UPDATE');
            if (!$this->getFromDB($id) || $this->fields['status'] !== 'Pending') {
                $DB->rollBack();
                return false;
            }
            $before = $this->fields;
            $doneAt = Session::getCurrentTime();
            $this->internalDone = true;
            $saved = parent::update(['id' => $id, 'status' => 'Done', 'done_at' => $doneAt]);
            if (!$saved || !$this->getFromDB($id)
                || $this->fields['status'] !== 'Done' || $this->fields['done_at'] !== $doneAt) {
                $DB->rollBack();
                return false;
            }
            foreach ($before as $field => $value) {
                if (!in_array($field, ['status', 'done_at', 'date_mod'], true)
                    && $this->fields[$field] !== $value) {
                    $DB->rollBack();
                    return false;
                }
            }
            $DB->commit();
            return true;
        } catch (Throwable $e) {
            $DB->rollBack();
            throw $e;
        } finally {
            $this->internalDone = false;
        }
    }
}
