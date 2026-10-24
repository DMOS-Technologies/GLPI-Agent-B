<?php

class PluginAgentbdmosassetsyncChange extends CommonDBTM
{
    public static $rightname = 'plugin_agentbdmosassetsync_change';
    private bool $internalDone = false;

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
        plugin_agentbdmosassetsync_fail('ASB_CHANGE_CAPTURE_UNAVAILABLE: foundation_stage');
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
