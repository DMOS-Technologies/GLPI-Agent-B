<?php

require_once __DIR__ . '/write.php';
require_once __DIR__ . '/firstcopy.php';
require_once __DIR__ . '/results.php';
require_once __DIR__ . '/scope.php';
require_once __DIR__ . '/both.php';
require_once __DIR__ . '/notes.php';

function plugin_agentbdmosassetsync_process_batch(CronTask $task): int
{
    global $DB;
    $lock = 'agentbdmosassetsync-worker';
    $row = $DB->fetchAssoc($DB->doQuery("SELECT GET_LOCK('$lock', 0) AS acquired"));
    if ((int) $row['acquired'] !== 1) {
        return 0;
    }
    $count = 0;
    try {
        $rows = iterator_to_array($DB->request(['FROM' => PluginAgentbdmosassetsyncWork::getTable(),
            'WHERE' => ['status' => 'Accepted'], 'ORDER' => 'id ASC', 'LIMIT' => 20]));
        foreach ($rows as $row) {
            $work = new PluginAgentbdmosassetsyncWork();
            if (!$work->getFromDB($row['id']) || $work->fields['status'] !== 'Accepted') {
                continue;
            }
            if ($work->fields['processing_started_at'] !== null) {
                $work->saveProcessorFields((int) $row['id'], ['status' => 'Held',
                    'error' => 'Uncertain previous processing: reconcile saved outcomes before issuing new Work']);
            } else {
                if (!$work->saveProcessorFields((int) $row['id'], ['processing_started_at' => Session::getCurrentTime()])) {
                    continue;
                }
                plugin_agentbdmosassetsync_process_existing($work);
            }
            ++$count;
        }
        $task->addVolume($count);
        return $count > 0 ? 1 : 0;
    } finally {
        $DB->doQuery("SELECT RELEASE_LOCK('$lock')");
    }
}

/** Rebuild actual current authorizations; cron/inventory bypasses never enter an asset action. */
function plugin_agentbdmosassetsync_as_submitter(array $work, callable $action)
{
    $previous = $_SESSION;
    $entered = false;
    try {
        if (Session::isRightChecksDisabled()) {
            throw new RuntimeException('Permission check bypass is active');
        }
        $user = new User();
        $now = Session::getCurrentTime();
        if (!$user->getFromDB((int) $work['submitted_users_id'])
            || !$user->fields['is_active'] || $user->fields['is_deleted']
            || ($user->fields['begin_date'] !== null && $user->fields['begin_date'] >= $now)
            || ($user->fields['end_date'] !== null && $user->fields['end_date'] <= $now)) {
            throw new RuntimeException('Submitting user is missing, inactive, deleted, or outside validity dates');
        }
        unset($_SESSION['glpicronuserrunning'], $_SESSION['glpiinventoryuserrunning'],
            $_SESSION['glpiactiveprofile'], $_SESSION['glpiactiveentities'], $_SESSION['glpigroups']);
        $_SESSION['glpiID'] = (int) $user->getID();
        $_SESSION['glpiname'] = $user->fields['name'];
        $_SESSION['glpidefault_entity'] = $user->fields['entities_id'];
        Session::initEntityProfiles($user->getID());
        $profile = (int) $work['submitted_profiles_id'];
        if (!isset($_SESSION['glpiprofiles'][$profile])) {
            throw new RuntimeException('Submitting profile authorization was removed');
        }
        Session::changeProfile($profile);
        if (($_SESSION['glpiactiveprofile']['id'] ?? null) != $profile
            || ($_SESSION['glpiactiveprofile']['interface'] ?? null) !== 'central'
            || Session::isCron() || Session::isInventory()
            || !Session::haveRight(PluginAgentbdmosassetsyncWork::$rightname, READ)
            || !Session::haveRight(PluginAgentbdmosassetsyncWork::$rightname, CREATE)) {
            throw new RuntimeException('Submitting profile lacks current Work authorization');
        }
        // Expand authorized entities before selecting one: changeActiveEntities alone permits ancestors.
        Session::changeActiveEntities('all');
        if (!Session::haveAccessToEntity((int) $work['entities_id'])
            || !Session::changeActiveEntities((int) $work['entities_id'], false)) {
            throw new RuntimeException('Submitting user lacks current routed entity authorization');
        }
        $entered = true;
        return $action();
    } catch (RuntimeException $e) {
        if ($entered) {
            throw $e;
        }
        throw new RuntimeException('Hold: ' . $e->getMessage(), 0, $e);
    } finally {
        $_SESSION = $previous;
    }
}

function plugin_agentbdmosassetsync_current_route(array $work): array
{
    $route = plugin_agentbdmosassetsync_read_setting($work['route_id']);
    if ($route === null || !(int) $route['route_enabled']
        || (int) $route['settings_version'] !== (int) $work['settings_version']
        || (int) $route['entities_id'] !== (int) $work['entities_id']
        || (int) $route['a_entities_id'] !== (int) $work['a_entities_id']) {
        throw new RuntimeException('Settings or route/entity mismatch, disabled route, or route unavailable');
    }
    if (!in_array($work['itemtype'], json_decode($route['enabled_itemtypes_json'], true, 512, JSON_THROW_ON_ERROR), true)
        || !in_array($work['itemtype'], plugin_agentbdmosassetsync_asset_types(), true)) {
        throw new RuntimeException('Disabled or unavailable asset type');
    }
    return $route;
}

function plugin_agentbdmosassetsync_find_existing(array $work, bool $allowMissing = false,
    bool $allowSuspended = false, bool $requireRetained = false): ?CommonDBTM
{
    global $DB;
    $type = $work['itemtype'];
    $asset = new $type();
    if (!$type::canView() || !$asset->isEntityAssign()) {
        throw new RuntimeException('Asset read permission denied or no entity scope metadata');
    }
    $identity = json_decode($work['identity_json'], false, 512, JSON_THROW_ON_ERROR);
    $links = iterator_to_array($DB->request(['FROM' => PluginAgentbdmosassetsyncWork::getTable(),
        'WHERE' => ['subject' => 'Asset', 'route_id' => $work['route_id'], 'itemtype' => $type,
            'a_items_id' => (int) $work['a_items_id'], 'b_items_id' => ['>', 0]], 'ORDER' => 'id DESC']));
    $ids = array_unique(array_column($links, 'b_items_id'));
    if (count($ids) > 1) {
        throw new RuntimeException('Competing retained B links for this A asset');
    }
    if ($links) {
        $link = reset($links);
        $state = $link['link_state'];
        foreach ($links as $evidence) {
            if ($evidence['status'] === 'Done' && in_array($evidence['operation'], ['Suspend', 'Resume'], true)) {
                $state = $evidence['link_state'];
                break;
            }
        }
        if ($state === 'Suspended' && !$allowSuspended) {
            throw new RuntimeException('Retained link is Suspended; Sync cannot reactivate it');
        }
        $id = (int) $link['b_items_id'];
        if ($identity->b_items_id !== null && $identity->b_items_id !== $id) {
            throw new RuntimeException('Claimed B ID differs from retained verified link');
        }
        if (!$asset->getFromDB($id)) {
            throw new RuntimeException('Retained B asset is missing');
        }
    } else {
        if ($requireRetained) {
            throw new RuntimeException('Scope control requires an existing verified retained link');
        }
        if ($identity->b_items_id !== null) {
            throw new RuntimeException('Claimed B ID has no retained verified link evidence');
        }
        if ($identity->serial === null || trim($identity->serial) === '' || !$DB->fieldExists($type::getTable(), 'serial')) {
            throw new RuntimeException('No usable supported serial and no verified link');
        }
        $matches = iterator_to_array($DB->request(plugin_agentbdmosassetsync_serial_criteria($work, $identity->serial)));
        $matches = array_values(array_filter($matches,
            static fn($row) => $row['serial'] === $identity->serial));
        if (count($matches) > 1) {
            throw new RuntimeException('Serial match is ambiguous in routed B entity');
        }
        if (!$matches) {
            if ($allowMissing) {
                return null;
            }
            throw new RuntimeException('Complete serial lookup found no asset');
        }
        if (!$asset->getFromDB($matches[0]['id'])) {
            throw new RuntimeException('Serial match could not be reread');
        }
    }
    plugin_agentbdmosassetsync_check_asset($asset, $work, READ);
    $owners = $DB->request(['FROM' => PluginAgentbdmosassetsyncWork::getTable(),
        'WHERE' => ['subject' => 'Asset', 'itemtype' => $type, 'b_items_id' => (int) $asset->getID()]]);
    foreach ($owners as $owner) {
        if ($owner['route_id'] !== $work['route_id'] || (int) $owner['a_items_id'] !== (int) $work['a_items_id']) {
            throw new RuntimeException('B asset has competing retained source ownership');
        }
    }
    return $asset;
}

function plugin_agentbdmosassetsync_serial_criteria(array $work, string $serial): array
{
    $type = $work['itemtype'];
    return ['FROM' => $type::getTable(), 'WHERE' => [
        'entities_id' => (int) $work['entities_id'], 'serial' => $serial,
    ] + $type::getSystemSQLCriteria()];
}

function plugin_agentbdmosassetsync_check_asset(CommonDBTM $asset, array $work, int $right): void
{
    global $DB;
    // getFromDB(id) alone does not constrain GLPI custom assets' shared storage table.
    if ($asset::class !== $work['itemtype'] || count($DB->request(['FROM' => $asset::getTable(),
        'WHERE' => ['id' => $asset->getID()] + $asset::getSystemSQLCriteria()])) !== 1) {
        throw new RuntimeException('Asset concrete itemtype does not match requested type');
    }
    if ((int) $asset->getEntityID() !== (int) $work['entities_id']
        || !empty($asset->fields['is_deleted']) || !empty($asset->fields['is_template'])) {
        throw new RuntimeException('Asset scope mismatch, deleted asset, or template');
    }
    if (!$asset->can($asset->getID(), $right)) {
        throw new RuntimeException('Submitting user lacks current asset permission');
    }
}

function plugin_agentbdmosassetsync_process_existing(PluginAgentbdmosassetsyncWork $record): void
{
    if (($record->fields['subject'] ?? 'Asset') === 'Note') {
        plugin_agentbdmosassetsync_process_note_work($record);
        return;
    }
    $work = $record->fields;
    $result = ['b_items_id' => null, 'created_b_items_id' => null, 'b_values_for_a' => new stdClass(),
        'covered_change_ids' => [], 'handled_change_ids_done' => [], 'field_outcomes' => []];
    $status = 'Done';
    $reason = null;
    $correctionAttempted = false;
    try {
        if ($work['operation'] !== 'Sync') {
            plugin_agentbdmosassetsync_process_control($record, $result);
            return;
        }
        $handledIds = json_decode($work['handled_change_ids_json'], true, 512, JSON_THROW_ON_ERROR);
        [$route, $asset] = plugin_agentbdmosassetsync_as_submitter($work, static function () use ($work, $handledIds) {
            $route = plugin_agentbdmosassetsync_current_route($work);
            $asset = plugin_agentbdmosassetsync_find_existing($work, $handledIds === []);
            if ($handledIds !== []) {
                plugin_agentbdmosassetsync_validate_corrections($work, $route, $asset);
            }
            return [$route, $asset];
        });
        if ($asset === null) {
            plugin_agentbdmosassetsync_first_copy($record, $result);
            $status = 'Done';
            $reason = null;
            if (!$record->saveProcessorFields((int) $work['id'], ['status' => $status, 'error' => $reason,
                'result_json' => json_encode($result, JSON_THROW_ON_ERROR),
                'completed_at' => $status === 'Done' ? Session::getCurrentTime() : null])) {
                throw new RuntimeException('Cannot finalize verified first copy; started marker prevents replay');
            }
            return;
        }
        $result['b_items_id'] = (int) $asset->getID();
        if (!$record->saveProcessorFields((int) $work['id'], ['b_items_id' => $result['b_items_id'], 'link_state' => 'Active'])) {
            throw new RuntimeException('Cannot persist verified existing link');
        }
        if ($handledIds !== []) {
            $correctionAttempted = true;
            plugin_agentbdmosassetsync_begin_corrections($work, $asset);
        }
        $values = json_decode($work['a_values_json'], false, 512, JSON_THROW_ON_ERROR);
        foreach (json_decode($route['field_mappings_json'], false, 512, JSON_THROW_ON_ERROR) as $mapping) {
            if (!$mapping->enabled || $mapping->itemtype !== $work['itemtype']) {
                continue;
            }
            $outcome = ['mapping_id' => $mapping->mapping_id, 'outcome' => 'Skipped', 'reason' => null];
            if ($mapping->source === 'B') {
                try {
                    $result['b_values_for_a']->{$mapping->mapping_id} = plugin_agentbdmosassetsync_return_value($work, $mapping,
                        $result['b_items_id']);
                    $outcome['outcome'] = 'ReturnToA';
                } catch (RuntimeException $e) {
                    $outcome['reason'] = $e->getMessage();
                    $status = $status === 'Failed' ? 'Failed' : 'Held';
                    $reason = $e->getMessage();
                }
            } elseif (!property_exists($values, $mapping->mapping_id)) {
                $outcome['reason'] = 'A supplied no value for this enabled mapping';
                if ($mapping->source === 'Both') {
                    $outcome['outcome'] = 'Conflict';
                    $status = $status === 'Failed' ? 'Failed' : 'Held';
                    $reason = $outcome['reason'];
                }
            } else {
                try {
                    $decision = plugin_agentbdmosassetsync_write_mapping($work, $mapping,
                        $result['b_items_id'], plugin_agentbdmosassetsync_exact_work_value($work,
                            $mapping->mapping_id, $values->{$mapping->mapping_id}));
                    $outcome['outcome'] = $decision['outcome'];
                    $outcome['reason'] = $decision['reason'];
                    if ($decision['return'] !== null) {
                        $result['b_values_for_a']->{$mapping->mapping_id} = $decision['return'];
                    }
                    if ($decision['outcome'] === 'Conflict') {
                        $status = $status === 'Failed' ? 'Failed' : 'Held';
                        $reason = $decision['reason'];
                    }
                } catch (RuntimeException $e) {
                    $outcome['reason'] = $e->getMessage();
                    if (str_starts_with($e->getMessage(), 'Save failed:')) {
                        $outcome['outcome'] = 'Failed';
                        $status = 'Failed';
                        $reason = $e->getMessage();
                    } elseif (str_starts_with($e->getMessage(), 'Hold:')) {
                        $status = $status === 'Failed' ? 'Failed' : 'Held';
                        $reason = $e->getMessage();
                    }
                }
            }
            $result['field_outcomes'][] = $outcome;
            if (!$record->saveProcessorFields((int) $work['id'], [
                'result_json' => json_encode($result, JSON_THROW_ON_ERROR)])) {
                throw new RuntimeException('Cannot persist partial verified field outcomes');
            }
        }
        $result['covered_change_ids'] = plugin_agentbdmosassetsync_covered_returns($work, $result);
        if ($handledIds !== []) {
            $failures = plugin_agentbdmosassetsync_finish_corrections($record, $result);
            if ($failures !== []) {
                $status = $status === 'Failed' ? 'Failed' : 'Held';
                $reason = implode('; ', $failures);
            }
            $result['covered_change_ids'] = array_values(array_diff($result['covered_change_ids'], $result['handled_change_ids_done']));
        }
    } catch (Throwable $e) {
        $status = $e instanceof RuntimeException && str_starts_with($e->getMessage(), 'Save failed:') ? 'Failed' : 'Held';
        $reason = $e instanceof RuntimeException ? $e->getMessage() : 'Processing interrupted; outcome requires review';
        if ($correctionAttempted) {
            foreach ($handledIds as $id) {
                try {
                    plugin_agentbdmosassetsync_note_correction_failure($work, $id, $reason);
                } catch (Throwable $metadataError) {
                    $reason .= '; correction metadata could not be verified for snapshot ' . $id;
                }
            }
        }
    }
    if (!$record->saveProcessorFields((int) $work['id'], ['status' => $status, 'error' => $reason,
        'result_json' => json_encode($result, JSON_THROW_ON_ERROR),
        'completed_at' => $status === 'Done' ? Session::getCurrentTime() : null])) {
        throw new RuntimeException('Cannot persist final Work outcome; started marker prevents replay');
    }
}
