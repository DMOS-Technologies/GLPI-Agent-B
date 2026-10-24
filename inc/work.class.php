<?php

class PluginAgentbdmosassetsyncWork extends CommonDBTM
{
    public static $rightname = 'plugin_agentbdmosassetsync_work';

    public static function getTypeName($nb = 0)
    {
        return 'Agent-B-DMOS-AssetSync Work';
    }

    public static function canUpdate(): bool { return false; }
    public static function canDelete(): bool { return false; }
    public static function canPurge(): bool { return false; }
    public function pre_deleteItem() { return false; }
    public function pre_purgeItem() { return false; }

    public function can($ID, int $right, ?array &$input = null): bool
    {
        return in_array($right, [READ, CREATE], true)
            && Session::haveRight(static::$rightname, $right)
            && parent::can($ID, $right, $input);
    }

    public function getRights($interface = 'central')
    {
        return [READ => __('Read'), CREATE => __('Create')];
    }

    public function rawSearchOptions()
    {
        return plugin_agentbdmosassetsync_search_options(static::getTable(), [
            'id', 'work_id', 'status', 'route_id', 'settings_version', 'entities_id', 'itemtype',
        ]);
    }

    public function add(array $input, $options = [], $history = true)
    {
        // Admission belongs to the next part; do not persist partially validated work.
        plugin_agentbdmosassetsync_fail('ASB_WORK_ADMISSION_UNAVAILABLE: foundation_stage');
    }

    public function update(array $input, $history = true, $options = [])
    {
        plugin_agentbdmosassetsync_fail('ASB_WORK_IMMUTABLE');
    }

    public static function cronInfo($name)
    {
        return $name === 'processWork'
            ? ['description' => 'Agent-B-DMOS-AssetSync foundation task (no processor yet)'] : [];
    }

    public static function cronProcessWork(CronTask $task)
    {
        // The foundation explicitly registers an empty task. Processing is a later part.
        return 0;
    }
}
