<?php

function plugin_agentbdmosassetsync_route_action(array $work, callable $action)
{
    global $DB;
    $lock = 'asb-setting-' . sha1($work['route_id']);
    $row = $DB->fetchAssoc($DB->doQuery("SELECT GET_LOCK('$lock', 5) AS acquired"));
    if ((int) $row['acquired'] !== 1) {
        throw new RuntimeException('Hold: route is busy');
    }
    try {
        return plugin_agentbdmosassetsync_as_submitter($work, $action);
    } finally {
        try {
            $DB->doQuery("SELECT RELEASE_LOCK('$lock')");
        } catch (Throwable $e) {
            throw new RuntimeException('Hold: route lock release is uncertain; reconcile Work evidence', 0, $e);
        }
    }
}

function plugin_agentbdmosassetsync_process_control(PluginAgentbdmosassetsyncWork $record, array &$result): void
{
    $work = $record->fields;
    plugin_agentbdmosassetsync_route_action($work, static function () use ($record, $work, &$result) {
        plugin_agentbdmosassetsync_current_route($work);
        $asset = plugin_agentbdmosassetsync_find_existing($work, false, true, true);
        plugin_agentbdmosassetsync_check_asset($asset, $work, READ);
        // Human edits are not captured while suspended; Resume cannot revive their old proof.
        plugin_agentbdmosassetsync_provenance_invalidate_parent($work, $asset);
        $result['b_items_id'] = (int) $asset->getID();
        $state = $work['operation'] === 'Suspend' ? 'Suspended' : 'Active';
        // One local Work update commits successful control state and completion together.
        if (!$record->saveProcessorFields((int) $work['id'], ['b_items_id' => (int) $asset->getID(),
            'link_state' => $state, 'status' => 'Done', 'result_json' => json_encode($result, JSON_THROW_ON_ERROR),
            'error' => null, 'completed_at' => Session::getCurrentTime()])) {
            throw new RuntimeException('Hold: scope control could not be verified');
        }
    });
}
