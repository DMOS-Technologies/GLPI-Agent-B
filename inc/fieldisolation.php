<?php

/** Only a non-null immutable request opts in; malformed opt-ins never fall back. */
function plugin_agentbdmosassetsync_field_sync_enabled(array $work): bool
{
    return array_key_exists('field_sync_json', $work) && $work['field_sync_json'] !== null;
}

function plugin_agentbdmosassetsync_field_sync_options(array $work): stdClass
{
    $options = json_decode($work['field_sync_json'], false, 512, JSON_THROW_ON_ERROR);
    $keys = ['version', 'mapping_ids'];
    if (($options->version ?? null) === 2) {
        $keys[] = 'reconcile_work_id';
    }
    if (!plugin_agentbdmosassetsync_object_keys($options, $keys)
        || !in_array($options->version, [1, 2], true)
        || ($options->version === 2 && !plugin_agentbdmosassetsync_is_uint($options->reconcile_work_id, 1))
        || !is_array($options->mapping_ids)
        || !array_is_list($options->mapping_ids)
        || count(array_unique($options->mapping_ids, SORT_REGULAR)) !== count($options->mapping_ids)) {
        throw new RuntimeException('Invalid immutable field selection');
    }
    foreach ($options->mapping_ids as $id) {
        if (!is_string($id) || $id === '') {
            throw new RuntimeException('Invalid immutable mapping reference');
        }
    }
    return $options;
}

function plugin_agentbdmosassetsync_field_sync_initial_result(stdClass $options, array $enabledMappingIds): array
{
    $result = ['b_items_id' => null, 'created_b_items_id' => null, 'b_values_for_a' => new stdClass(),
        'covered_change_ids' => [], 'handled_change_ids_done' => [], 'field_outcomes' => [],
        'field_sync' => ['version' => $options->version, 'mapping_ids' => $options->mapping_ids, 'in_flight' => null,
            'error_code' => null, 'reason' => null, 'snapshot_outcomes' => []]];
    if ($options->version === 2) {
        $result['field_sync']['reconcile_work_id'] = $options->reconcile_work_id;
    }
    foreach ($enabledMappingIds as $id) {
        $selected = in_array($id, $options->mapping_ids, true);
        $result['field_outcomes'][] = ['mapping_id' => $id, 'outcome' => $selected ? 'Pending' : 'Excluded',
            'certainty' => 'NotAttempted', 'error_code' => null,
            'reason' => $selected ? null : 'Mapping not selected for this Work'];
    }
    return $result;
}

/** The old request identifies the relationship; its missing outcome is never reconstructed. */
function plugin_agentbdmosassetsync_field_sync_reconcile_reference(array $work, stdClass $options): array
{
    $old = new PluginAgentbdmosassetsyncWork();
    $identity = json_decode($work['identity_json'], false, 512, JSON_THROW_ON_ERROR);
    if ($options->version !== 2 || !$old->getFromDB($options->reconcile_work_id)
        || !$old->can($options->reconcile_work_id, READ)
        || ($old->fields['subject'] ?? 'Asset') !== 'Asset' || $old->fields['operation'] !== 'Sync'
        || !in_array($old->fields['status'], ['Done', 'Held', 'Failed'], true)
        || $old->fields['work_id'] === $work['work_id']) {
        throw new RuntimeException('Reconciliation requires a readable terminal Asset Sync request');
    }
    foreach (['route_id', 'itemtype'] as $key) {
        if ($old->fields[$key] !== $work[$key]) {
            throw new RuntimeException('Reconciliation request has a different scope');
        }
    }
    foreach (['a_entities_id', 'entities_id'] as $key) {
        if ((int) $old->fields[$key] !== (int) $work[$key]) {
            throw new RuntimeException('Reconciliation request has a different entity pair');
        }
    }
    $previous = json_decode($old->fields['identity_json'], false, 512, JSON_THROW_ON_ERROR);
    if (!plugin_agentbdmosassetsync_object_keys($previous, ['a_items_id', 'b_items_id', 'serial'])
        || !plugin_agentbdmosassetsync_is_uint($previous->b_items_id, 1)
        || $previous->b_items_id !== $identity->b_items_id || $previous->a_items_id !== $identity->a_items_id
        || (int) $old->fields['settings_version'] > (int) $work['settings_version']) {
        throw new RuntimeException('Reconciliation requires the same existing linked identity');
    }
    return $old->fields;
}

/** Invalid evidence is retained byte-for-byte; current settings cannot reconstruct admission history. */
function plugin_agentbdmosassetsync_field_sync_journal(array $work): ?array
{
    try {
        $options = plugin_agentbdmosassetsync_field_sync_options($work);
        $journal = json_decode($work['result_json'] ?? '', false, 512, JSON_THROW_ON_ERROR);
        $syncKeys = ['version', 'mapping_ids', 'in_flight', 'error_code', 'reason', 'snapshot_outcomes'];
        if ($options->version === 2) {
            $syncKeys[] = 'reconcile_work_id';
        }
        $resultKeys = ['b_items_id', 'created_b_items_id', 'b_values_for_a',
            'covered_change_ids', 'handled_change_ids_done', 'field_outcomes', 'field_sync'];
        if (plugin_agentbdmosassetsync_participation_enabled($work)) {
            $state = plugin_agentbdmosassetsync_participation_state($work);
            if ($state === null || json_encode($journal->participation ?? null, JSON_THROW_ON_ERROR)
                !== json_encode($state['progress'], JSON_THROW_ON_ERROR)) {
                return null;
            }
            $resultKeys[] = 'participation';
        }
        if (!plugin_agentbdmosassetsync_object_keys($journal, $resultKeys)
            || !plugin_agentbdmosassetsync_object_keys($journal->field_sync, $syncKeys)
            || $journal->field_sync->version !== $options->version
            || ($options->version === 2 && $journal->field_sync->reconcile_work_id !== $options->reconcile_work_id)
            || $journal->field_sync->mapping_ids !== $options->mapping_ids
            || !$journal->b_values_for_a instanceof stdClass || !is_array($journal->field_outcomes)
            || !array_is_list($journal->field_outcomes) || !is_array($journal->covered_change_ids)
            || !is_array($journal->handled_change_ids_done) || !is_array($journal->field_sync->snapshot_outcomes)
            || ($journal->field_sync->error_code !== null && !is_string($journal->field_sync->error_code))
            || ($journal->field_sync->reason !== null && !is_string($journal->field_sync->reason))
            || $journal->created_b_items_id !== null
            || ($journal->b_items_id !== null && (!is_int($journal->b_items_id) || $journal->b_items_id < 1))) {
            return null;
        }
        $seen = [];
        $expected = ['Pending' => 'NotAttempted', 'Excluded' => 'NotAttempted', 'Rejected' => 'NotAttempted',
            'ReturnToA' => 'NotAttempted', 'Conflict' => 'NotAttempted', 'AlreadyEqual' => 'VerifiedEqual',
            'AppliedToB' => 'VerifiedApplied', 'Unknown' => 'Unknown'];
        foreach ($journal->field_outcomes as $field) {
            if (!plugin_agentbdmosassetsync_object_keys($field, ['mapping_id', 'outcome', 'certainty', 'error_code', 'reason'])
                || !is_string($field->mapping_id) || $field->mapping_id === '' || isset($seen[$field->mapping_id])
                || !is_string($field->outcome) || !isset($expected[$field->outcome])
                || $field->certainty !== $expected[$field->outcome]
                || (($field->outcome === 'Excluded') === in_array($field->mapping_id, $options->mapping_ids, true))
                || ($field->error_code !== null && !is_string($field->error_code))
                || ($field->reason !== null && !is_string($field->reason))) {
                return null;
            }
            $seen[$field->mapping_id] = $field;
        }
        if (array_diff($options->mapping_ids, array_keys($seen)) !== []) {
            return null;
        }
        foreach ([$journal->covered_change_ids, $journal->handled_change_ids_done] as $ids) {
            if (!array_is_list($ids)) {
                return null;
            }
            foreach ($ids as $id) {
                if (!is_int($id) || $id < 1) {
                    return null;
                }
            }
        }
        foreach ($journal->field_sync->snapshot_outcomes as $snapshot) {
            if (!plugin_agentbdmosassetsync_object_keys($snapshot, ['id', 'error_code', 'reason'])
                || !is_int($snapshot->id) || $snapshot->id < 1 || !is_string($snapshot->error_code)
                || !is_string($snapshot->reason)) {
                return null;
            }
        }
        foreach (get_object_vars($journal->b_values_for_a) as $id => $returned) {
            if (!in_array($id, $options->mapping_ids, true)
                || !plugin_agentbdmosassetsync_object_keys($returned, ['value', 'changed_at', 'reliable'])
                || (!is_scalar($returned->value) && $returned->value !== null) || !is_bool($returned->reliable)
                || ($returned->changed_at !== null && !is_string($returned->changed_at))) {
                return null;
            }
        }
        $marker = $journal->field_sync->in_flight;
        if ($marker !== null && (!plugin_agentbdmosassetsync_object_keys($marker, ['mapping_id', 'verified'])
            || !is_string($marker->mapping_id) || !is_bool($marker->verified)
            || !in_array($marker->mapping_id, $options->mapping_ids, true)
            || $seen[$marker->mapping_id]->outcome !== 'Unknown')) {
            return null;
        }
        $result = json_decode($work['result_json'], true, 512, JSON_THROW_ON_ERROR);
        $result['b_values_for_a'] = (object) $result['b_values_for_a'];
        return $result;
    } catch (Throwable $e) {
        return null;
    }
}

function plugin_agentbdmosassetsync_field_sync_reconcile_enabled(array $work): bool
{
    $options = json_decode($work['field_sync_json'] ?? 'null');
    return $options instanceof stdClass && ($options->version ?? null) === 2;
}

function plugin_agentbdmosassetsync_owned_session_enabled(array $work): bool
{
    return plugin_agentbdmosassetsync_field_sync_reconcile_enabled($work)
        || plugin_agentbdmosassetsync_participation_enabled($work);
}

/** Fresh connections need the same native read decoding established during GLPI kernel boot. */
function plugin_agentbdmosassetsync_field_sync_reconcile_initialize(DBmysql $connection, string $lock, int $ownerId): void
{
    if (!$connection->connected || $connection->isSlave()
        || !is_callable([$connection, 'setMustUnsanitizeData'])) {
        throw new RuntimeException('Reconciliation requires a supported primary database session', 9101);
    }
    $owner = $connection->fetchAssoc($connection->doQuery("SELECT IS_USED_LOCK('$lock') AS owner"));
    if ((int) ($owner['owner'] ?? 0) !== $ownerId || !$connection->tableExists('glpi_configs')) {
        throw new RuntimeException('Reconciliation database configuration cannot be established', 9101);
    }
    $mustUnsanitize = $connection->request(['FROM' => 'glpi_configs', 'WHERE' => [
        'name' => 'must_unsanitize_db_data', 'context' => 'core']])->current()['value'] ?? true;
    $connection->setMustUnsanitizeData((bool) $mustUnsanitize);
}

/** The original session retains the worker lock while this Work uses its own native DB object. */
function plugin_agentbdmosassetsync_field_sync_reconcile_guard(array $work, bool $lockWork = false): void
{
    global $DB;
    if (!plugin_agentbdmosassetsync_owned_session_enabled($work)) {
        return;
    }
    $context = $GLOBALS['plugin_agentbdmosassetsync_reconcile_context'] ?? null;
    if (!is_array($context) || $DB !== $context['writer'] || (int) $work['id'] !== $context['work_id']) {
        throw new RuntimeException('Reconciliation has no owned database session', 9101);
    }
    try {
        $row = $DB->fetchAssoc($DB->doQuery("SELECT IS_USED_LOCK('" . $context['lock'] . "') AS owner, "
            . "IS_USED_LOCK('agentbdmosassetsync-worker') AS worker"));
        if ((int) ($row['owner'] ?? 0) !== $context['owner_id']
            || (int) ($row['worker'] ?? 0) !== $context['owner_id']) {
            throw new RuntimeException('Reconciliation worker ownership changed');
        }
        if ($lockWork) {
            $current = $DB->fetchAssoc($DB->doQuery('SELECT * FROM `'
                . PluginAgentbdmosassetsyncWork::getTable() . '` WHERE `id` = ' . (int) $work['id'] . ' FOR UPDATE'));
            if (!$current || $current['status'] !== 'Accepted') {
                throw new RuntimeException('Reconciliation Work is no longer Accepted');
            }
            foreach (['work_id', 'route_id', 'itemtype', 'a_entities_id', 'entities_id', 'a_items_id',
                'settings_version', 'submitted_users_id', 'submitted_profiles_id', 'subject', 'operation',
                'identity_json', 'a_values_json', 'a_change_times_json', 'handled_change_ids_json', 'field_sync_json',
                'participation_json'] as $key) {
                if ((string) $current[$key] !== (string) $work[$key]) {
                    throw new RuntimeException('Reconciliation immutable request changed');
                }
            }
        }
    } catch (Throwable $e) {
        throw new RuntimeException('Reconciliation worker ownership is uncertain; stop this worker', 9101, $e);
    }
}

/** A fresh observer cannot mistake this writer's uncommitted rows for durable proof. */
function plugin_agentbdmosassetsync_field_sync_reconcile_visible(array $work, array $expected): void
{
    if (!plugin_agentbdmosassetsync_owned_session_enabled($work)) {
        return;
    }
    plugin_agentbdmosassetsync_field_sync_reconcile_guard($work);
    $context = $GLOBALS['plugin_agentbdmosassetsync_reconcile_context'];
    $observer = null;
    $failure = null;
    try {
        $observer = new DB();
        plugin_agentbdmosassetsync_field_sync_reconcile_initialize($observer, $context['lock'], $context['owner_id']);
        $row = $observer->fetchAssoc($observer->doQuery('SELECT * FROM `'
            . PluginAgentbdmosassetsyncWork::getTable() . '` WHERE `id` = ' . (int) $work['id']));
        if (!$row) {
            throw new RuntimeException('Committed Work evidence is unavailable');
        }
        foreach ($expected as $key => $value) {
            if (($value === null && $row[$key] !== null)
                || ($value !== null && (string) $row[$key] !== (string) $value)) {
                throw new RuntimeException('Committed Work evidence did not match');
            }
        }
    } catch (Throwable $e) {
        $failure = new RuntimeException('Reconciliation evidence visibility is uncertain; stop this worker', 9101, $e);
    } finally {
        if ($observer instanceof DBmysql && $observer->connected) {
            try {
                if (!$observer->close()) {
                    throw new RuntimeException('Independent observer did not close');
                }
            } catch (Throwable $e) {
                $failure = $failure ?? new RuntimeException('Reconciliation observer cleanup is uncertain; stop this worker', 9101, $e);
            }
        }
    }
    if ($failure !== null) {
        throw $failure;
    }
}

/** Fresh DB instances reset native transaction bookkeeping without closing the lock owner's session. */
function plugin_agentbdmosassetsync_field_sync_reconcile_task(int $id): bool
{
    global $DB;
    $owner = $DB;
    $writer = null;
    $lock = 'asb-reconcile-' . bin2hex(random_bytes(12));
    $barrierAcquired = false;
    $failure = null;
    $processed = false;
    try {
        $row = $owner->fetchAssoc($owner->doQuery("SELECT CONNECTION_ID() AS id, "
            . "IS_USED_LOCK('agentbdmosassetsync-worker') AS worker"));
        $ownerId = (int) ($row['id'] ?? 0);
        if ($ownerId < 1 || (int) ($row['worker'] ?? 0) !== $ownerId) {
            throw new RuntimeException('Worker lock ownership is unavailable');
        }
        $acquired = $owner->fetchAssoc($owner->doQuery("SELECT GET_LOCK('$lock', 0) AS acquired"));
        if ((int) ($acquired['acquired'] ?? 0) !== 1) {
            throw new RuntimeException('Reconciliation session barrier is unavailable');
        }
        $barrierAcquired = true;
        $writer = new DB();
        plugin_agentbdmosassetsync_field_sync_reconcile_initialize($writer, $lock, $ownerId);
        $GLOBALS['plugin_agentbdmosassetsync_reconcile_context'] = ['writer' => $writer,
            'lock' => $lock, 'owner_id' => $ownerId, 'work_id' => $id];
        $DB = $writer;
        $work = new PluginAgentbdmosassetsyncWork();
        if ($work->getFromDB($id) && $work->fields['status'] === 'Accepted') {
            plugin_agentbdmosassetsync_field_sync_reconcile_guard($work->fields);
            if ($work->fields['processing_started_at'] !== null) {
                plugin_agentbdmosassetsync_process_interrupted($work);
            } else {
                $started = Session::getCurrentTime();
                if (!$work->saveProcessorFields($id, ['processing_started_at' => $started], true)) {
                    throw new RuntimeException('Reconciliation start could not be saved');
                }
                plugin_agentbdmosassetsync_field_sync_reconcile_visible($work->fields,
                    ['status' => 'Accepted', 'processing_started_at' => $started]);
                plugin_agentbdmosassetsync_process_existing($work);
            }
            plugin_agentbdmosassetsync_field_sync_reconcile_visible($work->fields,
                array_intersect_key($work->fields, array_flip(['status', 'result_json', 'error', 'completed_at'])));
            $processed = true;
        }
    } catch (Throwable $e) {
        $failure = $e->getCode() === 9101 ? $e
            : new RuntimeException('Reconciliation database session is uncertain; stop this worker', 9101, $e);
    } finally {
        $DB = $owner;
        unset($GLOBALS['plugin_agentbdmosassetsync_reconcile_context']);
        if ($writer instanceof DBmysql && $writer->connected) {
            try {
                if (!$writer->close()) {
                    throw new RuntimeException('Owned reconciliation session did not close');
                }
            } catch (Throwable $e) {
                $failure = $failure ?? new RuntimeException('Reconciliation cleanup is uncertain; stop this worker', 9101, $e);
            }
        }
        try {
            $released = $owner->fetchAssoc($owner->doQuery("SELECT RELEASE_LOCK('$lock') AS released"));
            if ($barrierAcquired && (int) ($released['released'] ?? 0) !== 1) {
                throw new RuntimeException('Reconciliation barrier release was not confirmed');
            }
        } catch (Throwable $e) {
            $failure = $failure ?? new RuntimeException('Reconciliation barrier cleanup is uncertain; stop this worker', 9101, $e);
        }
    }
    if ($failure !== null) {
        throw $failure;
    }
    return $processed;
}

function plugin_agentbdmosassetsync_field_sync_unreadable(PluginAgentbdmosassetsyncWork $record): void
{
    $record->saveProcessorFields((int) $record->getID(), ['status' => 'Held',
        'error' => 'ASB_FIELD_JOURNAL_UNREADABLE'], true);
}

/** A cleanup failure must not hide the fatal signal from an uncertain transaction. */
function plugin_agentbdmosassetsync_field_sync_route_action(array $work, callable $action, bool $asSubmitter = true)
{
    global $DB;
    $lock = 'asb-setting-' . sha1($work['route_id']);
    try {
        $row = $DB->fetchAssoc($DB->doQuery("SELECT GET_LOCK('$lock', 5) AS acquired"));
    } catch (Throwable $e) {
        throw new RuntimeException('Route lock acquisition is uncertain; stop this worker', 9101, $e);
    }
    if ((int) ($row['acquired'] ?? 0) !== 1) {
        throw new RuntimeException('Route is busy', 9104);
    }
    $failure = null;
    $value = null;
    try {
        $value = $asSubmitter ? plugin_agentbdmosassetsync_as_submitter($work, $action) : $action();
    } catch (Throwable $e) {
        $failure = $e;
    }
    try {
        $released = $DB->fetchAssoc($DB->doQuery("SELECT RELEASE_LOCK('$lock') AS released"));
        if ((int) ($released['released'] ?? 0) !== 1) {
            throw new RuntimeException('Route release was not confirmed');
        }
    } catch (Throwable $e) {
        $failure = $failure !== null && $failure->getCode() === 9101 ? $failure
            : new RuntimeException('Route lock release is uncertain; stop this worker', 9101, $e);
    }
    if ($failure !== null) {
        throw $failure;
    }
    return $value;
}

function plugin_agentbdmosassetsync_field_sync_outcome(array &$result, string $id, string $outcome,
    string $certainty, ?string $code = null, ?string $reason = null): void
{
    foreach ($result['field_outcomes'] as &$field) {
        if ($field['mapping_id'] === $id) {
            $field = ['mapping_id' => $id, 'outcome' => $outcome, 'certainty' => $certainty,
                'error_code' => $code, 'reason' => $reason];
            return;
        }
    }
    unset($field);
    throw new RuntimeException('Mapping is absent from the immutable result journal');
}

/** A lost metadata response is resolved only by an exact readback, never by replay. */
function plugin_agentbdmosassetsync_field_sync_store(PluginAgentbdmosassetsyncWork $record, array $result): bool
{
    $id = (int) $record->getID();
    $json = json_encode($result, JSON_THROW_ON_ERROR);
    plugin_agentbdmosassetsync_field_sync_reconcile_guard($record->fields);
    try {
        if ($record->saveProcessorFields($id, ['result_json' => $json], true)) {
            plugin_agentbdmosassetsync_field_sync_reconcile_visible($record->fields, ['result_json' => $json]);
            return true;
        }
    } catch (Throwable $e) {
        if ($e->getCode() === 9101) {
            throw $e;
        }
        // The metadata commit may have succeeded despite an unavailable response.
    }
    if (plugin_agentbdmosassetsync_field_sync_reconcile_enabled($record->fields)) {
        plugin_agentbdmosassetsync_field_sync_reconcile_visible($record->fields, ['result_json' => $json]);
        return true;
    }
    try {
        return $record->getFromDB($id) && $record->fields['result_json'] === $json;
    } catch (Throwable $e) {
        return false;
    }
}

/** Retained evidence must positively establish Active, rather than merely not Suspended. */
function plugin_agentbdmosassetsync_field_sync_parent(array $work): CommonDBTM
{
    global $DB;
    $identity = json_decode($work['identity_json'], false, 512, JSON_THROW_ON_ERROR);
    if (!is_int($identity->b_items_id) || $identity->b_items_id < 1) {
        throw new RuntimeException('A verified positive parent reference is required');
    }
    $asset = plugin_agentbdmosassetsync_find_existing($work, false, false, true);
    $links = iterator_to_array($DB->request(['FROM' => PluginAgentbdmosassetsyncWork::getTable(),
        'WHERE' => ['subject' => 'Asset', 'route_id' => $work['route_id'], 'itemtype' => $work['itemtype'],
            'a_items_id' => (int) $work['a_items_id'], 'b_items_id' => ['>', 0]], 'ORDER' => 'id DESC']));
    $latestLink = reset($links);
    $state = $latestLink['link_state'] ?? null;
    foreach ($links as $link) {
        if ($link['status'] === 'Done' && in_array($link['operation'], ['Suspend', 'Resume'], true)) {
            $state = $link['link_state'];
            break;
        }
    }
    if ($state !== 'Active' || (int) $asset->getID() !== $identity->b_items_id) {
        throw new RuntimeException('The retained parent is not verified Active');
    }
    return $asset;
}

/** The caller is already running with the actual submitting user's authorizations. */
function plugin_agentbdmosassetsync_field_sync_context(array $work, stdClass $options, string &$code): array
{
    $code = 'SETTING_SCOPE';
    $route = plugin_agentbdmosassetsync_current_route($work);
    $mappings = plugin_agentbdmosassetsync_mapping_map($route, $work['itemtype']);
    foreach ($options->mapping_ids as $id) {
        if (!isset($mappings[$id])) {
            throw new RuntimeException('Selection no longer matches the exact current Setting');
        }
    }
    $code = 'PARENT_SCOPE';
    $asset = plugin_agentbdmosassetsync_field_sync_parent($work);
    if ($options->version === 2) {
        plugin_agentbdmosassetsync_field_sync_reconcile_guard($work);
        $code = 'RECONCILE_SCOPE';
        plugin_agentbdmosassetsync_field_sync_reconcile_reference($work, $options);
        $code = 'RECONCILE_PENDING';
        global $DB;
        if (count($DB->request(['FROM' => PluginAgentbdmosassetsyncWork::getTable(), 'WHERE' => [
            'subject' => 'Asset', 'status' => 'Accepted', 'route_id' => $work['route_id'],
            'itemtype' => $work['itemtype'], 'a_items_id' => (int) $work['a_items_id'],
            'id' => ['<>', (int) $work['id']]]])) > 0) {
            throw new RuntimeException('Another Asset Work for this relationship remains Accepted');
        }
    }
    return [$route, $asset, $mappings];
}

/** A started opt-in is never replayed, even if its last metadata write was lost. */
function plugin_agentbdmosassetsync_field_sync_interrupted(PluginAgentbdmosassetsyncWork $record, bool $routeLocked = false): void
{
    $work = $record->fields;
    if (plugin_agentbdmosassetsync_field_sync_reconcile_enabled($work) && !$routeLocked) {
        plugin_agentbdmosassetsync_field_sync_route_action($work, static function () use ($record) {
            if ($record->getFromDB((int) $record->getID()) && $record->fields['status'] === 'Accepted') {
                plugin_agentbdmosassetsync_field_sync_reconcile_guard($record->fields);
                plugin_agentbdmosassetsync_field_sync_interrupted($record, true);
            }
        }, false);
        return;
    }
    $result = plugin_agentbdmosassetsync_field_sync_journal($work);
    if ($result === null) {
        plugin_agentbdmosassetsync_field_sync_unreadable($record);
        return;
    }
    $inFlight = $result['field_sync']['in_flight'];
    if ($inFlight !== null) {
        plugin_agentbdmosassetsync_field_sync_outcome($result, $inFlight['mapping_id'], 'Unknown', 'Unknown',
            'INTERRUPTED', 'Processing stopped before completion and cleanup were confirmed');
    }
    $result['field_sync']['error_code'] = 'INTERRUPTED';
    $result['field_sync']['reason'] = 'Started Work requires reconciliation; no fields were replayed';
    $record->saveProcessorFields((int) $work['id'], ['status' => 'Held', 'error' => $result['field_sync']['reason'],
        'result_json' => json_encode($result, JSON_THROW_ON_ERROR)], true);
}

/** Verify only the actual storage whose value and journal must commit together. */
function plugin_agentbdmosassetsync_field_sync_transactional(CommonDBTM $asset, array $field): void
{
    global $DB;
    foreach (array_unique([$asset::getTable(), $field['table'], PluginAgentbdmosassetsyncWork::getTable(),
        'glpi_plugin_agentbdmosassetsync_scalarstates']) as $table) {
        $row = $DB->fetchAssoc($DB->doQuery("SHOW TABLE STATUS WHERE `Name` = '" . $DB->escape($table) . "'"));
        if (!$row || strcasecmp($row['Engine'] ?? '', 'InnoDB') !== 0) {
            throw new RuntimeException('Transactional field and Work storage could not be established');
        }
    }
}

/** The marker remains public Unknown until commit, route release and final journal save succeed. */
function plugin_agentbdmosassetsync_field_sync_mapping(PluginAgentbdmosassetsyncWork $record, array $work,
    stdClass $options, stdClass $mapping, array &$result, $value): bool
{
    global $DB;
    $id = $mapping->mapping_id;
    $result['field_sync']['in_flight'] = ['mapping_id' => $id, 'verified' => false];
    plugin_agentbdmosassetsync_field_sync_outcome($result, $id, 'Unknown', 'Unknown', 'WRITE_UNCERTAIN',
        'Field processing has not yet confirmed completion');
    if (!plugin_agentbdmosassetsync_field_sync_store($record, $result)) {
        return false;
    }
    $lock = 'asb-setting-' . sha1($work['route_id']);
    $locked = false;
    $lockRequestUncertain = false;
    $transaction = false;
    $attempted = false;
    $commitAttempted = false;
    $stage = 'ACCOUNT_DENIED';
    $decision = null;
    $failure = null;
    $barrier = null;
    try {
        $stage = 'ROUTE_BUSY';
        $lockRequestUncertain = true;
        $row = $DB->fetchAssoc($DB->doQuery("SELECT GET_LOCK('$lock', 5) AS acquired"));
        $lockRequestUncertain = false;
        if ((int) ($row['acquired'] ?? 0) !== 1) {
            throw new RuntimeException('Route lock could not be acquired');
        }
        $locked = true;
        $stage = 'ACCOUNT_DENIED';
        $decision = plugin_agentbdmosassetsync_as_submitter($work, static function () use ($record, $work, $options,
            $mapping, $id, $value, &$result, &$transaction, &$attempted, &$commitAttempted, &$stage, &$barrier, $DB) {
            [$route, $asset, $mappings] = plugin_agentbdmosassetsync_field_sync_context($work, $options, $stage);
            if (!isset($mappings[$id]) || $mappings[$id] != $mapping
                || (int) $asset->getID() !== $result['b_items_id']) {
                $stage = 'SETTING_SCOPE';
                throw new RuntimeException('Selected mapping or retained parent changed');
            }
            if ($mapping->source !== 'B') {
                $stage = 'FIELD_UNAVAILABLE';
                $descriptor = plugin_agentbdmosassetsync_field_descriptor($asset, $mapping->b_field, false);
                $stage = 'JOURNAL_UNCERTAIN';
                $barrier = plugin_agentbdmosassetsync_provenance_begin($work, $asset, $mapping, $descriptor);
            }
            $stage = 'STORAGE_UNSUPPORTED';
            try {
                $DB->beginTransaction();
            } catch (Throwable $e) {
                throw new RuntimeException('Field transaction start is uncertain; stop this worker without replay', 9101, $e);
            }
            $transaction = true;
            $stage = 'PARENT_SCOPE';
            plugin_agentbdmosassetsync_lock_current_asset($work, $asset, READ);
            $stage = 'FIELD_UNAVAILABLE';
            $field = plugin_agentbdmosassetsync_field_descriptor($asset, $mapping->b_field, false);
            $current = plugin_agentbdmosassetsync_locked_value($work, $asset, $field);
            if ($mapping->source === 'B' && plugin_agentbdmosassetsync_blank_text_equal($field, $value, $current)
                && property_exists(json_decode($work['a_values_json'], false, 512, JSON_THROW_ON_ERROR), $id)) {
                $decision = ['outcome' => 'AlreadyEqual', 'certainty' => 'VerifiedEqual', 'reason' => null, 'return' => null];
            } elseif ($mapping->source === 'B') {
                $decision = ['outcome' => 'ReturnToA', 'certainty' => 'NotAttempted', 'reason' => null,
                    'return' => ['value' => $current]
                        + plugin_agentbdmosassetsync_genuine_time($work, $asset, $id, $current, true)];
            } else {
                if ($mapping->source === 'Both') {
                    $stage = 'INVALID_VALUE';
                    $decision = plugin_agentbdmosassetsync_both_decision($work, $asset, $mapping, $field, $value, $current);
                    if ($decision['outcome'] !== 'AppliedToB') {
                        $decision['certainty'] = $decision['outcome'] === 'AlreadyEqual' ? 'VerifiedEqual' : 'NotAttempted';
                    }
                }
                if ($mapping->source === 'A' || $decision['outcome'] === 'AppliedToB') {
                    $stage = 'PARENT_SCOPE';
                    if (!$asset->can($asset->getID(), UPDATE)) {
                        throw new RuntimeException('Current asset field write permission is denied');
                    }
                    $stage = 'FIELD_PERMISSION';
                    $field = plugin_agentbdmosassetsync_field_descriptor($asset, $mapping->b_field, true);
                    $stage = $field['kind'] === 'dropdown' && is_string($value) && $value !== ''
                        ? 'DROPDOWN_UNRESOLVED' : 'INVALID_VALUE';
                    if ($field['kind'] === 'text' && plugin_agentbdmosassetsync_blank_text_equal($field,
                        plugin_agentbdmosassetsync_comparison_value($field, $mapping, $value), $current)) {
                        $expected = $current; // Equality needs no nullable writer or representation change.
                        $local = null;
                    } else {
                        $local = plugin_agentbdmosassetsync_write_value($asset, $field, $mapping, $value);
                        $expected = plugin_agentbdmosassetsync_field_value($field, $local);
                    }
                    if (plugin_agentbdmosassetsync_scalar_equal($current, $expected)) {
                        $decision = ['outcome' => 'AlreadyEqual', 'certainty' => 'VerifiedEqual', 'reason' => null, 'return' => null];
                    } else {
                        $stage = 'STORAGE_UNSUPPORTED';
                        plugin_agentbdmosassetsync_field_sync_transactional($asset, $field);
                        $prepared = $field['container_id'] === null ? null
                            : plugin_agentbdmosassetsync_field_sync_fields_input($asset, $field, $local, $stage);
                        $stage = 'SAVE_UNCONFIRMED';
                        $saved = plugin_agentbdmosassetsync_sync_guard(static function () use ($asset, $field, $local,
                            $prepared, $work, &$attempted) {
                            plugin_agentbdmosassetsync_field_sync_reconcile_guard($work, true);
                            $attempted = true;
                            if ($prepared !== null) {
                                return plugin_agentbdmosassetsync_field_sync_fields_save($asset, $field, $prepared);
                            }
                            return $asset->update(['id' => $asset->getID(), $field['value_column'] => $local]);
                        });
                        if (!$saved) {
                            throw new RuntimeException('Native writer did not confirm a save');
                        }
                        $stage = 'VERIFICATION_FAILED';
                        if (!$asset->getFromDB((int) $result['b_items_id'])
                            || !plugin_agentbdmosassetsync_scalar_equal(
                                plugin_agentbdmosassetsync_locked_value($work, $asset, $field), $expected)) {
                            throw new RuntimeException('Reread did not verify the intended value');
                        }
                        $stage = 'JOURNAL_UNCERTAIN';
                        plugin_agentbdmosassetsync_provenance_copied($work, $asset, $mapping, $field, $expected, $barrier);
                        $result['field_sync']['in_flight']['verified'] = true;
                        $stage = 'JOURNAL_UNCERTAIN';
                        if (!$record->saveFieldSyncEvidence((int) $work['id'], $result)) {
                            throw new RuntimeException('Provisional field evidence was not saved');
                        }
                        $decision = ['outcome' => 'AppliedToB', 'certainty' => 'VerifiedApplied', 'reason' => null, 'return' => null];
                    }
                }
            }
            plugin_agentbdmosassetsync_field_sync_reconcile_guard($work, true);
            $stage = 'COMMIT_UNCERTAIN';
            $commitAttempted = true;
            $DB->commit();
            $transaction = false;
            if (!$attempted) {
                plugin_agentbdmosassetsync_provenance_restore($barrier);
            }
            plugin_agentbdmosassetsync_field_sync_reconcile_visible($work,
                ['result_json' => json_encode($result, JSON_THROW_ON_ERROR)]);
            return $decision;
        });
    } catch (Throwable $e) {
        if ($e->getCode() === 9101) {
            throw $e;
        }
        $failure = $stage;
        if ($transaction) {
            try {
                $DB->rollBack();
                $transaction = false;
            } catch (Throwable $rollbackError) {
                // The earlier independently committed Unknown marker is the durable evidence.
                throw new RuntimeException('Field rollback is uncertain; stop this worker without replay', 9101, $rollbackError);
            }
        }
        if (!$attempted && !$commitAttempted) {
            plugin_agentbdmosassetsync_provenance_restore($barrier);
        }
    } finally {
        plugin_agentbdmosassetsync_provenance_end($barrier);
        if ($locked || $lockRequestUncertain) {
            try {
                $released = $DB->fetchAssoc($DB->doQuery("SELECT RELEASE_LOCK('$lock') AS released"));
                if ($locked && (int) ($released['released'] ?? 0) !== 1) {
                    $failure = 'LOCK_RELEASE_UNCERTAIN';
                }
            } catch (Throwable $releaseError) {
                $failure = 'LOCK_RELEASE_UNCERTAIN';
            }
        }
    }
    if ($failure !== null) {
        if ($attempted) {
            try {
                $savedWork = new PluginAgentbdmosassetsyncWork();
                if (!$savedWork->getFromDB((int) $work['id'])) {
                    return false;
                }
                $durable = json_decode($savedWork->fields['result_json'], true, 512, JSON_THROW_ON_ERROR);
                $marker = $durable['field_sync']['in_flight'] ?? null;
                if (!is_array($marker) || ($marker['mapping_id'] ?? null) !== $id
                    || !is_bool($marker['verified'] ?? null)) {
                    return false;
                }
                // Rollback may have removed the provisional proof; do not recreate it outside its transaction.
                $result['field_sync']['in_flight'] = $marker;
            } catch (Throwable $readError) {
                return false;
            }
        }
        $uncertain = $attempted || $commitAttempted
            || in_array($failure, ['LOCK_RELEASE_UNCERTAIN', 'JOURNAL_UNCERTAIN'], true);
        $contextFailure = in_array($failure, ['ACCOUNT_DENIED', 'SETTING_SCOPE', 'PARENT_SCOPE', 'ROUTE_BUSY',
            'RECONCILE_SCOPE', 'RECONCILE_PENDING'], true);
        plugin_agentbdmosassetsync_field_sync_outcome($result, $id,
            $uncertain ? 'Unknown' : ($contextFailure ? 'Pending' : 'Rejected'),
            $uncertain ? 'Unknown' : 'NotAttempted', $contextFailure && !$uncertain ? null : $failure,
            $uncertain ? 'Field effects or completion require reconciliation'
                : ($contextFailure ? null : 'Selected field was rejected before a native writer was called'));
        if (!$uncertain) {
            $result['field_sync']['in_flight'] = null;
        }
        if ($uncertain || $contextFailure) {
            $result['field_sync']['error_code'] = $failure;
            $result['field_sync']['reason'] = $uncertain ? 'Field effects or completion require reconciliation'
                : 'Current account, route or retained parent does not permit this Work';
        }
    } else {
        plugin_agentbdmosassetsync_field_sync_outcome($result, $id, $decision['outcome'], $decision['certainty'],
            $decision['outcome'] === 'Conflict' ? ($decision['error_code'] ?? 'EVIDENCE_CONFLICT') : null, $decision['reason']);
        if ($decision['return'] !== null) {
            $result['b_values_for_a']->$id = $decision['return'];
        }
        $result['field_sync']['in_flight'] = null;
    }
    return plugin_agentbdmosassetsync_field_sync_store($record, $result);
}

function plugin_agentbdmosassetsync_process_field_sync(PluginAgentbdmosassetsyncWork $record): void
{
    $work = $record->fields;
    $result = plugin_agentbdmosassetsync_field_sync_journal($work);
    if ($result === null) {
        plugin_agentbdmosassetsync_field_sync_unreadable($record);
        return;
    }
    $options = plugin_agentbdmosassetsync_field_sync_options($work);
    $stage = 'ACCOUNT_DENIED';
    $status = 'Done';
    $reason = null;
    $eligibleSnapshots = [];
    try {
        [$route, $asset, $mappings, $eligibleSnapshots] = plugin_agentbdmosassetsync_as_submitter($work,
            static function () use ($work, $options, &$result, &$stage) {
                [$route, $asset, $mappings] = plugin_agentbdmosassetsync_field_sync_context($work, $options, $stage);
                $stage = 'SNAPSHOT_INVALID';
                $eligible = plugin_agentbdmosassetsync_field_sync_snapshots($work, $route, $asset, $options, $result);
                return [$route, $asset, $mappings, $eligible];
            });
        $result['b_items_id'] = (int) $asset->getID();
        $stage = 'JOURNAL_UNCERTAIN';
        if (!$record->saveProcessorFields((int) $work['id'], ['b_items_id' => $result['b_items_id'], 'link_state' => 'Active'], true)
            || !plugin_agentbdmosassetsync_field_sync_store($record, $result)) {
            throw new RuntimeException('Verified parent evidence could not be saved');
        }
        if ($eligibleSnapshots !== []) {
            $stage = 'SNAPSHOT_INVALID';
            plugin_agentbdmosassetsync_field_sync_begin_snapshots($work, $options, $eligibleSnapshots);
        }
        $values = json_decode($work['a_values_json'], false, 512, JSON_THROW_ON_ERROR);
        foreach ($options->mapping_ids as $id) {
            $stage = 'JOURNAL_UNCERTAIN';
            $mapping = $mappings[$id];
            if ($mapping->source !== 'B' && !property_exists($values, $id)) {
                plugin_agentbdmosassetsync_field_sync_outcome($result, $id, 'Rejected', 'NotAttempted', 'VALUE_REQUIRED',
                    'A supplied no value for this selected mapping');
                if (!plugin_agentbdmosassetsync_field_sync_store($record, $result)) {
                    throw new RuntimeException('Field rejection journal could not be saved');
                }
                continue;
            }
            try {
                $value = $mapping->source === 'B' ? ($values->$id ?? null)
                    : plugin_agentbdmosassetsync_exact_work_value($work, $id, $values->$id);
            } catch (Throwable $valueError) {
                plugin_agentbdmosassetsync_field_sync_outcome($result, $id, 'Rejected', 'NotAttempted', 'INVALID_VALUE',
                    'Selected A value has no exact supported scalar representation');
                if (!plugin_agentbdmosassetsync_field_sync_store($record, $result)) {
                    throw new RuntimeException('Field rejection journal could not be saved');
                }
                continue;
            }
            if (!plugin_agentbdmosassetsync_field_sync_mapping($record, $work, $options, $mapping, $result, $value)) {
                // Do not overwrite a final journal whose commit response/readback is unavailable.
                $record->saveProcessorFields((int) $work['id'], ['status' => 'Held',
                    'error' => 'Field journal persistence is uncertain; reconcile stored outcomes'], true);
                return;
            }
            if ($result['field_sync']['error_code'] !== null) {
                break;
            }
        }
        $outcomes = array_column($result['field_outcomes'], 'outcome');
        if ($result['field_sync']['error_code'] !== null || in_array('Unknown', $outcomes, true)
            || in_array('Conflict', $outcomes, true)) {
            $status = 'Held';
        }
        if ($result['field_sync']['error_code'] === null && in_array('Conflict', $outcomes, true)) {
            $result['field_sync']['error_code'] = 'EVIDENCE_CONFLICT';
            $result['field_sync']['reason'] = 'Selected Both fields require genuine-edit conflict review';
        }
        if ($result['field_sync']['in_flight'] === null && !in_array('Unknown', $outcomes, true)) {
            $stage = 'SNAPSHOT_INVALID';
            $result['covered_change_ids'] = plugin_agentbdmosassetsync_covered_returns($work, $result, $options->mapping_ids);
            if ($eligibleSnapshots !== []) {
                $context = $work;
                $context['handled_change_ids_json'] = json_encode($eligibleSnapshots, JSON_THROW_ON_ERROR);
                $failures = plugin_agentbdmosassetsync_finish_corrections($record, $result, $context);
                if ($failures !== []) {
                    $status = 'Held';
                    $result['field_sync']['error_code'] = 'INCOMPLETE_SNAPSHOT';
                    $result['field_sync']['reason'] = 'Exact snapshot coverage remains incomplete';
                }
            }
        }
        if ($result['field_sync']['snapshot_outcomes'] !== []) {
            $status = 'Held';
            $result['field_sync']['error_code'] = $result['field_sync']['error_code'] ?? 'INCOMPLETE_SNAPSHOT';
            $result['field_sync']['reason'] = $result['field_sync']['reason'] ?? 'Snapshot contains excluded mappings';
        }
        $result['covered_change_ids'] = array_values(array_diff($result['covered_change_ids'], $result['handled_change_ids_done']));
    } catch (Throwable $e) {
        if ($e->getCode() === 9101) {
            // The connection's transaction state is unknown; preserve the already durable marker and stop the batch.
            throw $e;
        }
        $status = 'Held';
        $result['field_sync']['error_code'] = $stage;
        $result['field_sync']['reason'] = 'Work could not complete under its current authorization, scope or journal evidence';
    }
    $reason = $status === 'Held' ? ($result['field_sync']['reason'] ?? 'Selected Both fields require conflict review') : null;
    plugin_agentbdmosassetsync_field_sync_reconcile_guard($work);
    if (!$record->saveProcessorFields((int) $work['id'], ['status' => $status, 'error' => $reason,
        'result_json' => json_encode($result, JSON_THROW_ON_ERROR),
        'completed_at' => $status === 'Done' ? Session::getCurrentTime() : null], true)) {
        throw new RuntimeException('Final field Work metadata is uncertain; started marker prevents replay');
    }
}
