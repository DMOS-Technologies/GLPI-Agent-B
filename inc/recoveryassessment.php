<?php

/** Original receipts are observations here, never instructions to repeat an old write. */
function plugin_agentbdmosassetsync_recovery_original_fields(array $work): array
{
    $prior = [];
    $ids = [];
    $values = null;
    try {
        $values = json_decode($work['a_values_json'], false, 512, JSON_THROW_ON_ERROR);
        if (!$values instanceof stdClass) {
            $values = null;
        }
    } catch (Throwable $e) {
        // A damaged payload cannot be used for a current comparison.
    }
    if (plugin_agentbdmosassetsync_field_sync_enabled($work)) {
        try {
            $options = plugin_agentbdmosassetsync_field_sync_options($work);
            foreach ($options->mapping_ids as $id) {
                if (preg_match('/\A[a-z][a-z0-9_]{0,63}\z/D', $id) !== 1) {
                    throw new RuntimeException('Unrecognized original mapping reference');
                }
            }
        } catch (Throwable $e) {
            return ['Unsupported', [], [], $values, false];
        }
        $journal = plugin_agentbdmosassetsync_field_sync_journal($work);
        if ($journal !== null) {
            $prior = array_column($journal['field_outcomes'], null, 'mapping_id');
        }
        $complete = $journal !== null && $journal['field_sync']['in_flight'] === null
            && $values !== null
            && plugin_agentbdmosassetsync_is_uint($journal['b_items_id'], 1)
            && (int) $work['b_items_id'] === $journal['b_items_id'];
        foreach ($options->mapping_ids as $id) {
            $complete = $complete && in_array($prior[$id]['outcome'] ?? null,
                ['AppliedToB', 'AlreadyEqual', 'ReturnToA'], true);
            if (($prior[$id]['outcome'] ?? null) === 'ReturnToA') {
                $complete = $complete && property_exists($journal['b_values_for_a'], $id);
                $tuple = (array) ($journal['b_values_for_a']->$id ?? []);
                $complete = $complete && (($tuple['reliable'] ?? false) !== true
                    || plugin_agentbdmosassetsync_evidence_time($tuple['changed_at'] ?? null) !== null);
            }
        }
        return [$journal === null ? 'Damaged' : 'Valid', $options->mapping_ids, $prior, $values, $complete];
    }
    $state = 'Legacy';
    if ($work['result_json'] !== null) {
        try {
            $result = json_decode($work['result_json'], false, 512, JSON_THROW_ON_ERROR);
            $keys = ['b_items_id', 'created_b_items_id', 'b_values_for_a', 'covered_change_ids',
                'handled_change_ids_done', 'field_outcomes'];
            if (plugin_agentbdmosassetsync_participation_enabled($work)) {
                $keys[] = 'participation';
            }
            if (!plugin_agentbdmosassetsync_object_keys($result, $keys)
                || ($result->b_items_id !== null && !plugin_agentbdmosassetsync_is_uint($result->b_items_id, 1))
                || ($result->b_items_id !== null && (int) $work['b_items_id'] !== $result->b_items_id)
                || ($result->b_items_id === null && $work['b_items_id'] !== null)
                || ($result->created_b_items_id !== null
                    && (!plugin_agentbdmosassetsync_is_uint($result->created_b_items_id, 1)
                        || $result->created_b_items_id !== $result->b_items_id))
                || !$result->b_values_for_a instanceof stdClass
                || !is_array($result->field_outcomes) || !array_is_list($result->field_outcomes)) {
                throw new RuntimeException('Unrecognized legacy receipt');
            }
            foreach ([$result->covered_change_ids, $result->handled_change_ids_done] as $covered) {
                if (!is_array($covered) || !array_is_list($covered)) {
                    throw new RuntimeException('Unrecognized legacy snapshot coverage');
                }
                foreach ($covered as $changeId) {
                    if (!plugin_agentbdmosassetsync_is_uint($changeId, 1)) {
                        throw new RuntimeException('Unrecognized legacy snapshot reference');
                    }
                }
            }
            foreach ($result->field_outcomes as $field) {
                if (!plugin_agentbdmosassetsync_object_keys($field, ['mapping_id', 'outcome', 'reason'])
                    || !is_string($field->mapping_id)
                    || preg_match('/\A[a-z][a-z0-9_]{0,63}\z/D', $field->mapping_id) !== 1
                    || isset($prior[$field->mapping_id])
                    || ($field->reason !== null && !is_string($field->reason))
                    || !in_array($field->outcome, ['AppliedToB', 'AlreadyEqual', 'ReturnToA', 'Conflict', 'Skipped', 'Failed'], true)) {
                    throw new RuntimeException('Unrecognized legacy field receipt');
                }
                $ids[] = $field->mapping_id;
                $prior[$field->mapping_id] = ['outcome' => $field->outcome];
            }
            foreach (get_object_vars($result->b_values_for_a) as $id => $tuple) {
                if (($prior[$id]['outcome'] ?? null) !== 'ReturnToA'
                    || !plugin_agentbdmosassetsync_object_keys($tuple, ['value', 'changed_at', 'reliable'])
                    || (!is_scalar($tuple->value) && $tuple->value !== null) || !is_bool($tuple->reliable)
                    || ($tuple->reliable && plugin_agentbdmosassetsync_evidence_time($tuple->changed_at) === null)
                    || ($tuple->changed_at !== null && plugin_agentbdmosassetsync_evidence_time($tuple->changed_at) === null)) {
                    throw new RuntimeException('Unrecognized legacy return tuple');
                }
            }
            foreach ($prior as $id => $receipt) {
                if ($receipt['outcome'] === 'ReturnToA' && !property_exists($result->b_values_for_a, $id)) {
                    throw new RuntimeException('Missing legacy return tuple');
                }
            }
        } catch (Throwable $e) {
            $state = 'Damaged';
            $prior = [];
            $ids = [];
        }
    }
    foreach ($values instanceof stdClass ? array_keys(get_object_vars($values)) : [] as $id) {
        if (preg_match('/\A[a-z][a-z0-9_]{0,63}\z/D', $id) === 1 && !in_array($id, $ids, true)) {
            $ids[] = $id;
        }
    }
    $complete = $state === 'Legacy' && $work['result_json'] !== null && $ids !== [] && $values !== null
        && plugin_agentbdmosassetsync_is_uint($result->b_items_id, 1)
        && (int) $work['b_items_id'] === $result->b_items_id;
    foreach ($ids as $id) {
        $complete = $complete && in_array($prior[$id]['outcome'] ?? null,
            ['AppliedToB', 'AlreadyEqual', 'ReturnToA'], true);
    }
    return [$state, $ids, $prior, $values, $complete];
}

/** These compare current permitted storage with an old payload, not with fresh A state. */
function plugin_agentbdmosassetsync_recovery_field_observation(array $work, array $route,
    CommonDBTM $asset, stdClass $mapping, ?stdClass $values, array $observation): array
{
    $id = $mapping->mapping_id;
    if ($values === null) {
        $observation['reason_code'] = 'ORIGINAL_PAYLOAD_UNAVAILABLE';
        return $observation;
    }
    if (!property_exists($values, $id)) {
        $observation['state'] = 'NotSupplied';
        $observation['reason_code'] = 'ORIGINAL_VALUE_NOT_SUPPLIED';
        return $observation;
    }
    $stage = 'FIELD_UNAVAILABLE';
    try {
        $descriptor = plugin_agentbdmosassetsync_work_field($work, $asset, $mapping->b_field, false);
        // Check current physical meaning without reviving the old upgrade-marker decision gate.
        $stage = 'MAPPING_UNAVAILABLE';
        $manifest = plugin_agentbdmosassetsync_evidence_manifest($route);
        $entry = $manifest?->bindings->$id ?? null;
        if (!plugin_agentbdmosassetsync_evidence_entry($entry, (int) $route['settings_version'])
            || $entry->binding_hash !== plugin_agentbdmosassetsync_evidence_fingerprint($route, $mapping, $descriptor)) {
            $observation['reason_code'] = 'MAPPING_UNAVAILABLE';
            return $observation;
        }
        $stage = 'FIELD_UNAVAILABLE';
        $current = plugin_agentbdmosassetsync_locked_value($work, $asset, $descriptor);
        $stage = 'ORIGINAL_PAYLOAD_UNAVAILABLE';
        $original = plugin_agentbdmosassetsync_comparison_value($descriptor, $mapping,
            plugin_agentbdmosassetsync_exact_work_value($work, $id, $values->$id));
        $equal = plugin_agentbdmosassetsync_scalar_equal($original, $current)
            || plugin_agentbdmosassetsync_blank_text_equal($descriptor, $original, $current);
        if (!$equal && in_array($mapping->source, ['B', 'Both'], true)) {
            $stage = 'HISTORY_UNAVAILABLE';
            plugin_agentbdmosassetsync_history_time($asset, $descriptor);
        }
        $observation['state'] = $equal ? 'CurrentEqualToOriginal' : 'CurrentDifferentFromOriginal';
        $observation['reason_code'] = 'CURRENT_PAYLOAD_COMPARISON_ONLY';
    } catch (Throwable $e) {
        if ($e->getCode() === 9101) {
            throw $e;
        }
        $observation['reason_code'] = $stage;
    }
    return $observation;
}

/** Caller supplies a fresh clean native DB session and holds the global worker lock. */
function plugin_agentbdmosassetsync_recovery_assess(array $work): array
{
    global $DB;
    $terminal = in_array($work['status'], ['Done', 'Held', 'Failed'], true);
    $processing = $terminal ? 'Terminal' : ($work['status'] === 'Accepted'
        ? ($work['processing_started_at'] === null ? 'Unstarted' : 'Started') : 'Unsupported');
    $assessment = ['state' => 'Unresolved', 'reason_code' => 'ORIGINAL_STARTED',
        'b_items_id' => null, 'current_settings_version' => null, 'a_action' => 'AccountOriginal',
        'original_processing' => $processing, 'journal_state' => 'Unsupported', 'settings_relation' => 'Unavailable',
        'fields' => [], 'fields_truncated' => false, 'a_freshness' => 'Unknown'];
    if (($work['subject'] ?? 'Asset') !== 'Asset' || $work['operation'] !== 'Sync' || $processing === 'Unsupported') {
        $assessment['state'] = 'NoAction';
        $assessment['reason_code'] = 'OUT_OF_SCOPE';
        $assessment['a_action'] = 'None';
        return $assessment;
    }
    [$journalState, $ids, $prior, $values, $complete] = plugin_agentbdmosassetsync_recovery_original_fields($work);
    $assessment['journal_state'] = $journalState;
    $assessment['fields_truncated'] = count($ids) > 50;
    foreach (array_slice($ids, 0, 50) as $id) {
        $assessment['fields'][] = ['mapping_id' => $id, 'prior_outcome' => $prior[$id]['outcome'] ?? null,
            'prior_certainty' => $prior[$id]['certainty'] ?? null, 'state' => 'Unavailable',
            'reason_code' => 'SCOPE_UNAVAILABLE'];
    }
    $stage = 'ACCOUNT_UNAVAILABLE';
    try {
        return plugin_agentbdmosassetsync_field_sync_route_action($work,
            static function () use ($work, $terminal, &$assessment, $values, $complete, &$stage, $DB) {
                $record = new PluginAgentbdmosassetsyncWork();
                if (!$record->getFromDB((int) $work['id']) || !$record->can((int) $work['id'], READ)) {
                    throw new RuntimeException('Original Work is not readable');
                }
                if ($assessment['journal_state'] === 'Unsupported') {
                    $assessment['reason_code'] = 'UNSUPPORTED_ORIGINAL_CONTRACT';
                    return $assessment;
                }
                if ($assessment['original_processing'] === 'Unstarted'
                    || ($work['status'] === 'Done' && $complete)) {
                    $assessment['state'] = 'NoAction';
                    $assessment['reason_code'] = $work['status'] === 'Done'
                        ? 'ORIGINAL_COMPLETED' : 'NORMAL_QUEUE_PROCESSING';
                    $assessment['a_action'] = 'None';
                    foreach ($assessment['fields'] as &$field) {
                        $field['reason_code'] = $assessment['reason_code'];
                    }
                    unset($field);
                    return $assessment;
                }
                $stage = 'SCOPE_UNAVAILABLE';
                $setting = new PluginAgentbdmosassetsyncSetting();
                if (!$setting->getFromDBByCrit(['route_id' => $work['route_id']])
                    || !$setting->can((int) $setting->getID(), READ)) {
                    throw new RuntimeException('Current Setting is not readable');
                }
                $route = $setting->fields;
                $assessment['current_settings_version'] = (int) $route['settings_version'];
                if ((int) $route['settings_version'] < (int) $work['settings_version']) {
                    throw new RuntimeException('Original Setting is newer than the current publication');
                }
                $sameSettings = (int) $route['settings_version'] === (int) $work['settings_version'];
                $assessment['settings_relation'] = $sameSettings ? 'Same' : 'Advanced';
                $scope = $work;
                $scope['settings_version'] = (int) $route['settings_version'];
                $route = plugin_agentbdmosassetsync_current_route($scope);
                $stage = 'PARENT_UNAVAILABLE';
                $identity = json_decode($work['identity_json'], false, 512, JSON_THROW_ON_ERROR);
                if (!plugin_agentbdmosassetsync_object_keys($identity, ['a_items_id', 'b_items_id', 'serial'])
                    || $identity->a_items_id !== (int) $work['a_items_id']) {
                    throw new RuntimeException('Original identity is unavailable');
                }
                $linkedIdentity = plugin_agentbdmosassetsync_is_uint($identity->b_items_id, 1);
                if (!$linkedIdentity && $identity->b_items_id !== null) {
                    throw new RuntimeException('Original B identity is unavailable');
                }
                if (!$linkedIdentity) {
                    $assessment['a_action'] = 'ResolveIdentity';
                    $assessment['reason_code'] = 'FIRST_COPY_IDENTITY_UNRESOLVED';
                    foreach ($assessment['fields'] as &$field) {
                        $field['reason_code'] = 'FIRST_COPY_IDENTITY_UNRESOLVED';
                    }
                    unset($field);
                    return $assessment;
                }
                $stage = 'PARENT_UNAVAILABLE';
                $asset = plugin_agentbdmosassetsync_field_sync_parent($scope);
                try {
                    $DB->beginTransaction();
                } catch (Throwable $e) {
                    throw new RuntimeException('Recovery assessment transaction start is uncertain', 9101, $e);
                }
                try {
                    plugin_agentbdmosassetsync_lock_current_asset($scope, $asset, READ);
                    $assessment['b_items_id'] = (int) $asset->getID();
                    $stage = 'SCOPE_UNAVAILABLE';
                    $overlap = count($DB->request(['SELECT' => ['id'],
                        'FROM' => PluginAgentbdmosassetsyncWork::getTable(), 'WHERE' => [
                            'subject' => 'Asset', 'status' => 'Accepted', 'route_id' => $work['route_id'],
                            'itemtype' => $work['itemtype'], 'a_items_id' => (int) $work['a_items_id'],
                            'id' => ['<>', (int) $work['id']]], 'LIMIT' => 1])) > 0;
                    if ($terminal && !$overlap) {
                        $assessment['state'] = 'FreshARequired';
                        $assessment['a_action'] = 'FreshV2';
                        $assessment['reason_code'] = 'FRESH_CURRENT_STATE_REQUIRED';
                    } else {
                        $assessment['reason_code'] = $overlap ? 'OVERLAPPING_ACCEPTED_WORK' : 'ORIGINAL_STARTED';
                    }
                    $mappings = plugin_agentbdmosassetsync_mapping_map($route, $work['itemtype']);
                    foreach ($assessment['fields'] as &$field) {
                        $id = $field['mapping_id'];
                        if (!$sameSettings || !isset($mappings[$id])) {
                            $field['reason_code'] = 'MAPPING_UNAVAILABLE';
                        } else {
                            $field = plugin_agentbdmosassetsync_recovery_field_observation($work, $route,
                                $asset, $mappings[$id], $values, $field);
                        }
                    }
                    unset($field);
                    try {
                        $DB->commit();
                    } catch (Throwable $e) {
                        throw new RuntimeException('Recovery assessment transaction completion is uncertain', 9101, $e);
                    }
                } catch (Throwable $e) {
                    try {
                        $DB->rollBack();
                    } catch (Throwable $rollbackError) {
                        throw new RuntimeException('Recovery assessment rollback is uncertain', 9101, $rollbackError);
                    }
                    throw $e;
                }
                return $assessment;
            });
    } catch (Throwable $e) {
        if ($e->getCode() === 9101) {
            throw $e;
        }
        $assessment['state'] = 'Unresolved';
        $assessment['reason_code'] = $e->getCode() === 9104 ? 'ROUTE_BUSY' : $stage;
        if ($assessment['a_action'] === 'FreshV2') {
            $assessment['a_action'] = 'AccountOriginal';
        }
        return $assessment;
    }
}
