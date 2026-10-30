<?php

function plugin_agentbdmosassetsync_participation_enabled(array $work): bool
{
    return ($work['participation_json'] ?? null) !== null;
}

/** Explicit opt-in supplies direction; field authority alone cannot identify A-to-B work. */
function plugin_agentbdmosassetsync_participation_admission(array $input): ?array
{
    if (!plugin_agentbdmosassetsync_participation_enabled($input)) {
        return null;
    }
    // Native REST admission does not load the background processor's shared route checks.
    require_once __DIR__ . '/process.php';
    try {
        $option = plugin_agentbdmosassetsync_json('participation_json', $input['participation_json']);
        if (!plugin_agentbdmosassetsync_object_keys($option, ['version']) || $option->version !== 1
            || ($input['subject'] ?? 'Asset') !== 'Asset' || ($input['operation'] ?? 'Sync') !== 'Sync') {
            throw new RuntimeException('Invalid participation request');
        }
        $route = plugin_agentbdmosassetsync_current_route($input);
        $targets = plugin_agentbdmosassetsync_participation_targets($route, $input['itemtype']);
        if (count($targets) !== 2) {
            throw new RuntimeException('Participation requires current configured targets');
        }
        $progress = ['version' => 1, 'eligible' => false, 'error_code' => null, 'reason' => null, 'targets' => []];
        foreach ($targets as $target) {
            $progress['targets'][] = ['target_id' => $target->target_id, 'outcome' => 'Pending',
                'certainty' => 'NotAttempted', 'error_code' => null, 'reason' => null];
        }
        return ['version' => 1, 'settings_version' => (int) $route['settings_version'],
            'targets' => $targets, 'progress' => $progress, 'in_flight' => null];
    } catch (Throwable $e) {
        plugin_agentbdmosassetsync_fail('ASB_INVALID_FIELD: field=participation_json');
    }
}

function plugin_agentbdmosassetsync_participation_targets(array $route, string $itemtype): array
{
    $groups = json_decode($route['participation_flags_json'] ?? '[]', false, 512, JSON_THROW_ON_ERROR);
    foreach ($groups as $group) {
        if ($group->itemtype === $itemtype) {
            return $group->targets;
        }
    }
    return [];
}

/** Pin actual definitions; names are lookup keys, not permission to rebind a replaced field. */
function plugin_agentbdmosassetsync_participation_descriptor(CommonDBTM $asset, stdClass $target,
    bool $forWrite = true): array
{
    global $DB;
    $field = plugin_agentbdmosassetsync_field_descriptor($asset, $target->b_field, $forWrite, true);
    if ($field['kind'] !== 'boolean') {
        throw new RuntimeException('Participation requires scalar Yes/No storage');
    }
    $expected = [];
    if ($asset instanceof \Glpi\Asset\Asset) {
        $expected['asset_definition_id'] = (int) $asset::getDefinition()->getID();
    }
    if ($field['custom_field_id'] !== null) {
        $expected['custom_field_definition_id'] = $field['custom_field_id'];
    }
    if ($field['container_id'] !== null) {
        $rows = iterator_to_array($DB->request(['FROM' => PluginFieldsField::getTable(), 'WHERE' => [
            'plugin_fields_containers_id' => $field['container_id'], 'name' => $target->b_field->name,
            'is_active' => 1]]));
        if (count($rows) !== 1) {
            throw new RuntimeException('Participation definition is unavailable');
        }
        $definition = reset($rows);
        $container = $DB->request(['FROM' => PluginFieldsContainer::getTable(),
            'WHERE' => ['id' => $field['container_id']]])->current();
        if ($definition['name'] !== $target->b_field->name || !$container
            || $container['name'] !== $target->b_field->container) {
            throw new RuntimeException('Participation selector must use actual stored keys');
        }
        $expected['fields_container_id'] = $field['container_id'];
        $expected['fields_field_id'] = (int) $definition['id'];
    }
    if (!plugin_agentbdmosassetsync_object_keys($target->definition, array_keys($expected))) {
        throw new RuntimeException('Participation definition identity is incomplete');
    }
    foreach ($expected as $key => $value) {
        if ($target->definition->$key !== $value) {
            throw new RuntimeException('Participation definition identity changed');
        }
    }
    return $field;
}

/** Keep mutable definition rows stable through the native flag write. */
function plugin_agentbdmosassetsync_participation_lock_definition(CommonDBTM $asset, stdClass $target,
    array $field): array
{
    global $DB;
    $options = [];
    if ($field['container_id'] !== null) {
        $row = $DB->fetchAssoc($DB->doQuery('SELECT * FROM `' . PluginFieldsField::getTable()
            . '` WHERE `id` = ' . (int) $target->definition->fields_field_id . ' FOR UPDATE'));
        if (!$row || !$row['is_active'] || $row['multiple'] || $row['type'] !== 'yesno'
            || $row['name'] !== $target->b_field->name
            || (int) $row['plugin_fields_containers_id'] !== $field['container_id']) {
            throw new RuntimeException('Participation definition changed');
        }
    }
    if ($asset instanceof \Glpi\Asset\Asset) {
        $row = $DB->fetchAssoc($DB->doQuery('SELECT * FROM `' . \Glpi\Asset\AssetDefinition::getTable()
            . '` WHERE `id` = ' . (int) $target->definition->asset_definition_id . ' FOR UPDATE'));
        if (!$row || !$row['is_active']) {
            throw new RuntimeException('Participation asset definition changed');
        }
        foreach (json_decode($row['fields_display'] ?? '[]', true, 512, JSON_THROW_ON_ERROR) as $display) {
            if (($display['key'] ?? null) === $target->b_field->name) {
                $options = $display['field_options'] ?? [];
            }
        }
        if ($field['custom_field_id'] !== null) {
            $row = $DB->fetchAssoc($DB->doQuery('SELECT * FROM `' . \Glpi\Asset\CustomFieldDefinition::getTable()
                . '` WHERE `id` = ' . (int) $field['custom_field_id'] . ' FOR UPDATE'));
            if (!$row || $row['type'] !== \Glpi\Asset\CustomFieldType\BooleanType::class
                || 'custom_' . $row['system_name'] !== $target->b_field->name
                || (int) $row['assets_assetdefinitions_id'] !== (int) $target->definition->asset_definition_id) {
                throw new RuntimeException('Participation custom definition changed');
            }
            $options = json_decode($row['field_options'] ?? '[]', true, 512, JSON_THROW_ON_ERROR);
        }
        plugin_agentbdmosassetsync_custom_options($options, false);
    }
    return $options;
}

function plugin_agentbdmosassetsync_participation_storage(array $field): string
{
    return json_encode([strtolower($field['table']), strtolower($field['value_column']),
        $field['container_id'], $field['custom_field_id']],
        JSON_THROW_ON_ERROR);
}

/** A later linked receipt must not turn an earlier uncertain creation into verified adoption. */
function plugin_agentbdmosassetsync_participation_parent_origin(array $work, CommonDBTM $asset): void
{
    global $DB;
    $origins = iterator_to_array($DB->request(['FROM' => PluginAgentbdmosassetsyncWork::getTable(), 'WHERE' => [
        'subject' => 'Asset', 'operation' => 'Sync', 'route_id' => $work['route_id'], 'itemtype' => $work['itemtype'],
        'a_entities_id' => (int) $work['a_entities_id'], 'entities_id' => (int) $work['entities_id'],
        'a_items_id' => (int) $work['a_items_id'], 'b_items_id' => (int) $asset->getID()], 'ORDER' => 'id ASC']));
    $origin = reset($origins);
    if (!$origin || $origin['status'] !== 'Done' || $origin['link_state'] !== 'Active'
        || $origin['completed_at'] === null) {
        throw new RuntimeException('Original parent association is not confirmed');
    }
    $identity = json_decode($origin['identity_json'], false, 512, JSON_THROW_ON_ERROR);
    $result = json_decode($origin['result_json'] ?? '', false, 512, JSON_THROW_ON_ERROR);
    if (!plugin_agentbdmosassetsync_object_keys($identity, ['a_items_id', 'b_items_id', 'serial'])
        || $identity->a_items_id !== (int) $work['a_items_id'] || $identity->b_items_id !== null
        || !$result instanceof stdClass
        || ($result->b_items_id ?? null) !== (int) $asset->getID()
        || !property_exists($result, 'created_b_items_id')
        || ($result->created_b_items_id !== null && $result->created_b_items_id !== (int) $asset->getID())) {
        throw new RuntimeException('Original creation or adoption receipt is unavailable');
    }
}

/** A missing/damaged journal never reconstructs intent or implies that no writer ran. */
function plugin_agentbdmosassetsync_participation_state(array $work): ?array
{
    try {
        $state = json_decode($work['participation_state_json'] ?? '', false, 512, JSON_THROW_ON_ERROR);
        if (!plugin_agentbdmosassetsync_object_keys($state, ['version', 'settings_version', 'targets', 'progress', 'in_flight'])
            || $state->version !== 1 || $state->settings_version !== (int) $work['settings_version']
            || !is_array($state->targets) || count($state->targets) !== 2
            || !plugin_agentbdmosassetsync_object_keys($state->progress, ['version', 'eligible', 'error_code', 'reason', 'targets'])
            || $state->progress->version !== 1 || !is_bool($state->progress->eligible)
            || !is_array($state->progress->targets) || count($state->progress->targets) !== 2
            || ($state->progress->error_code !== null && !is_string($state->progress->error_code))
            || ($state->progress->reason !== null && !is_string($state->progress->reason))) {
            return null;
        }
        $pairs = ['Pending' => 'NotAttempted', 'Rejected' => 'NotAttempted', 'AlreadyYes' => 'VerifiedEqual',
            'SetToYes' => 'VerifiedApplied', 'Unknown' => 'Unknown'];
        foreach ($state->progress->targets as $index => $outcome) {
            $target = $state->targets[$index];
            if (!plugin_agentbdmosassetsync_object_keys($target, ['target_id', 'b_field', 'definition'])
                || !$target->b_field instanceof stdClass || !$target->definition instanceof stdClass
                || !is_string($target->target_id) || preg_match('/\A[a-z][a-z0-9_]{0,63}\z/D', $target->target_id) !== 1
                || !plugin_agentbdmosassetsync_object_keys($outcome, ['target_id', 'outcome', 'certainty', 'error_code', 'reason'])
                || ($pairs[$outcome->outcome] ?? null) !== $outcome->certainty
                || $outcome->target_id !== $state->targets[$index]->target_id
                || ($outcome->error_code !== null && !is_string($outcome->error_code))
                || ($outcome->reason !== null && !is_string($outcome->reason))) {
                return null;
            }
        }
        if ($state->in_flight !== null
            && (!plugin_agentbdmosassetsync_object_keys($state->in_flight, ['target_id', 'verified'])
                || !is_string($state->in_flight->target_id) || !is_bool($state->in_flight->verified))) {
            return null;
        }
        return ['version' => 1, 'settings_version' => $state->settings_version, 'targets' => $state->targets,
            'progress' => json_decode(json_encode($state->progress, JSON_THROW_ON_ERROR), true, 512, JSON_THROW_ON_ERROR),
            'in_flight' => $state->in_flight === null ? null : (array) $state->in_flight];
    } catch (Throwable $e) {
        return null;
    }
}

function plugin_agentbdmosassetsync_participation_attach(array &$result, array $work): void
{
    if (!plugin_agentbdmosassetsync_participation_enabled($work)) {
        return;
    }
    $state = plugin_agentbdmosassetsync_participation_state($work);
    if ($state === null) {
        throw new RuntimeException('Participation journal is unavailable', 9101);
    }
    $result['participation'] = $state['progress'];
}

function plugin_agentbdmosassetsync_participation_outcome(array &$state, int $index, string $outcome,
    string $certainty, ?string $code = null): void
{
    $state['progress']['targets'][$index] = ['target_id' => $state['targets'][$index]->target_id,
        'outcome' => $outcome, 'certainty' => $certainty, 'error_code' => $code,
        'reason' => $code === null ? null : 'Participation target could not be confirmed under ' . $code];
}

function plugin_agentbdmosassetsync_participation_store(PluginAgentbdmosassetsyncWork $record, array $state,
    bool $insideTransaction = false): void
{
    if (!$record->saveParticipationFields($state, $insideTransaction)) {
        throw new RuntimeException('Participation journal could not be saved', 9101);
    }
    if (!$insideTransaction) {
        plugin_agentbdmosassetsync_field_sync_reconcile_visible($record->fields,
            ['participation_state_json' => $record->fields['participation_state_json'],
                'result_json' => $record->fields['result_json']]);
    }
}

/** Ordinary completion stays immutable; only this invocation can advance marker receipts. */
function plugin_agentbdmosassetsync_participation_process(PluginAgentbdmosassetsyncWork $record): void
{
    if (!plugin_agentbdmosassetsync_participation_enabled($record->fields)) {
        return;
    }
    if (!$record->beginParticipationPhase()) {
        return;
    }
    $work = $record->fields;
    $state = plugin_agentbdmosassetsync_participation_state($work);
    if ($state === null) {
        throw new RuntimeException('Participation journal is unavailable', 9101);
    }
    plugin_agentbdmosassetsync_field_sync_reconcile_visible($work,
        array_intersect_key($work, array_flip(['status', 'result_json', 'b_items_id', 'link_state', 'completed_at'])));
    $ordinary = json_decode($work['result_json'], true, 512, JSON_THROW_ON_ERROR);
    $eligible = $work['status'] === 'Done';
    if (plugin_agentbdmosassetsync_field_sync_enabled($work)) {
        $journal = plugin_agentbdmosassetsync_field_sync_journal($work);
        $eligible = $journal !== null && $journal['field_sync']['in_flight'] === null
            && !in_array('Unknown', array_column($journal['field_outcomes'], 'outcome'), true)
            && !in_array('Pending', array_column($journal['field_outcomes'], 'outcome'), true)
            && in_array($journal['field_sync']['error_code'], [null, 'EVIDENCE_CONFLICT', 'INCOMPLETE_SNAPSHOT'], true);
    }
    if (!$eligible || (int) ($ordinary['b_items_id'] ?? 0) < 1 || $work['link_state'] !== 'Active') {
        $state['progress']['error_code'] = 'NOT_ELIGIBLE';
        $state['progress']['reason'] = 'Ordinary completion does not establish safe participation eligibility';
        plugin_agentbdmosassetsync_participation_store($record, $state);
        return;
    }
    $code = 'ACCOUNT_DENIED';
    try {
        plugin_agentbdmosassetsync_field_sync_route_action($work, static function () use ($work, $state, &$code) {
            $code = 'SETTING_SCOPE';
            $route = plugin_agentbdmosassetsync_current_route($work);
            if (plugin_agentbdmosassetsync_participation_targets($route, $work['itemtype']) != $state['targets']) {
                throw new RuntimeException('Participation selection changed');
            }
            $code = 'PARENT_SCOPE';
            $asset = plugin_agentbdmosassetsync_find_existing($work, false, false, true);
            if ((int) $asset->getID() !== (int) $work['b_items_id']) {
                throw new RuntimeException('Participation parent changed');
            }
            plugin_agentbdmosassetsync_participation_parent_origin($work, $asset);
        });
    } catch (Throwable $e) {
        if ($e->getCode() === 9101) {
            throw $e;
        }
        if ($e->getCode() === 9104) {
            $code = 'ROUTE_BUSY';
        }
        $state['progress']['error_code'] = $code;
        $state['progress']['reason'] = 'Participation is unavailable under current authorization or scope';
        plugin_agentbdmosassetsync_participation_store($record, $state);
        return;
    }
    $state['progress']['eligible'] = true;
    plugin_agentbdmosassetsync_participation_store($record, $state);
    foreach ($state['targets'] as $index => $target) {
        if (!plugin_agentbdmosassetsync_participation_target($record, $state, $index)) {
            return;
        }
    }
}

/** Missing storage uses native add and SQL defaults, never a merge or fabricated form defaults. */
function plugin_agentbdmosassetsync_participation_fields_create_input(CommonDBTM $asset, array $field,
    string &$code): array
{
    global $DB;
    $code = 'STORAGE_UNSUPPORTED';
    plugin_agentbdmosassetsync_first_copy_isolation();
    $indexes = [];
    $rows = $DB->doQuery('SHOW INDEX FROM `' . $field['table'] . '` WHERE `Non_unique` = 0');
    while ($index = $DB->fetchAssoc($rows)) {
        $indexes[$index['Key_name']][(int) $index['Seq_in_index']] = $index['Column_name'];
    }
    $unique = false;
    foreach ($indexes as $columns) {
        sort($columns, SORT_STRING);
        $unique = $unique || $columns === ['items_id', 'itemtype', 'plugin_fields_containers_id'];
    }
    if (!$unique) {
        throw new RuntimeException('Fields storage identity does not have its supported unique key');
    }
    $query = new DBmysqlIterator($DB);
    $query->buildQuery(['FROM' => $field['table'], 'WHERE' => ['itemtype' => $asset::class,
        'items_id' => (int) $asset->getID(), 'plugin_fields_containers_id' => $field['container_id']]]);
    if ($DB->numrows($DB->doQuery($query->getSql() . ' FOR UPDATE')) !== 0) {
        throw new RuntimeException('Missing Fields storage changed before creation');
    }
    $statusName = PluginFieldsStatusOverride::getStatusFieldName($asset::class);
    if ($statusName === $field['value_column']) {
        throw new RuntimeException('Fields status metadata collides with participation input');
    }
    $status = $asset->fields[$statusName] ?? null;
    $query->buildQuery(['FROM' => PluginFieldsField::getTable(), 'WHERE' => [
        'plugin_fields_containers_id' => $field['container_id'], 'is_active' => 1], 'ORDER' => 'id ASC']);
    $definitions = $DB->doQuery($query->getSql() . ' FOR UPDATE');
    while ($definition = $DB->fetchAssoc($definitions)) {
        $mandatory = (bool) $definition['mandatory'];
        $overrides = $DB->doQuery('SELECT * FROM `' . PluginFieldsStatusOverride::getTable()
            . '` WHERE `plugin_fields_fields_id` = ' . (int) $definition['id'] . ' FOR UPDATE');
        while ($override = $DB->fetchAssoc($overrides)) {
            $states = json_decode($override['states'] ?: '[]', true, 512, JSON_THROW_ON_ERROR);
            if ($override['itemtype'] === $asset::class && $status !== null
                && in_array((int) $status, array_map('intval', $states), true)) {
                $mandatory = (bool) $override['mandatory'];
            }
        }
        if ($mandatory && !in_array($definition['type'], ['yesno', 'header'], true)) {
            throw new RuntimeException('Missing mandatory Fields siblings prevent marker-only creation');
        }
    }
    $data = ['plugin_fields_containers_id' => $field['container_id'], 'items_id' => (int) $asset->getID(),
        'itemtype' => $asset::class, 'entities_id' => (int) $asset->getEntityID(), $field['value_column'] => 1];
    $validation = $data;
    $validation[$statusName] = $status;
    if (!PluginFieldsContainer::validateValues($validation, $asset::class, false)) {
        throw new RuntimeException('Native full-container validation rejected marker-only creation');
    }
    $code = 'TARGET_PERMISSION';
    $class = $field['storage_class'];
    $stored = new $class();
    $permissionInput = $data;
    if (!$stored->can(-1, CREATE, $permissionInput)) {
        throw new RuntimeException('Native generated storage creation is not permitted');
    }
    return [$stored, $data];
}

/** Each native target and its provisional receipt share the checked transaction. */
function plugin_agentbdmosassetsync_participation_target(PluginAgentbdmosassetsyncWork $record,
    array &$state, int $index): bool
{
    global $DB;
    $work = $record->fields;
    $target = $state['targets'][$index];
    $state['in_flight'] = ['target_id' => $target->target_id, 'verified' => false];
    plugin_agentbdmosassetsync_participation_outcome($state, $index, 'Unknown', 'Unknown', 'WRITE_UNCERTAIN');
    plugin_agentbdmosassetsync_participation_store($record, $state);
    $code = 'ACCOUNT_DENIED';
    $attempted = false;
    $transaction = false;
    $commitAttempted = false;
    $finalOutcome = null;
    try {
        plugin_agentbdmosassetsync_field_sync_route_action($work, static function () use ($record, $work, $target,
            $index, &$state, &$code, &$attempted, &$transaction, &$commitAttempted, &$finalOutcome, $DB) {
            $code = 'SETTING_SCOPE';
            $route = plugin_agentbdmosassetsync_current_route($work);
            if (plugin_agentbdmosassetsync_participation_targets($route, $work['itemtype']) != $state['targets']) {
                throw new RuntimeException('Participation selection changed');
            }
            $code = 'PARENT_SCOPE';
            $asset = plugin_agentbdmosassetsync_find_existing($work, false, false, true);
            if ((int) $asset->getID() !== (int) $work['b_items_id'] || $work['link_state'] !== 'Active') {
                throw new RuntimeException('Participation parent changed');
            }
            plugin_agentbdmosassetsync_participation_parent_origin($work, $asset);
            $code = 'TARGET_UNAVAILABLE';
            $field = plugin_agentbdmosassetsync_participation_descriptor($asset, $target, false);
            foreach (plugin_agentbdmosassetsync_mapping_map($route, $work['itemtype']) as $mapping) {
                $selector = $mapping->b_field;
                $sameSelector = $selector->kind === $target->b_field->kind
                    && strcasecmp($selector->name, $target->b_field->name) === 0
                    && ($selector->kind !== 'fields'
                        || strcasecmp($selector->container, $target->b_field->container) === 0);
                // Setting admission checks physical collisions; excluded scalar descriptors remain untouched.
                if ($sameSelector) {
                    throw new RuntimeException('Participation target overlaps an ordinary mapping');
                }
            }
            $code = 'STORAGE_UNSUPPORTED';
            plugin_agentbdmosassetsync_field_sync_transactional($asset, $field);
            try {
                $DB->beginTransaction();
            } catch (Throwable $e) {
                throw new RuntimeException('Participation transaction start is uncertain', 9101, $e);
            }
            $transaction = true;
            $code = 'PARENT_SCOPE';
            plugin_agentbdmosassetsync_lock_current_asset($work, $asset, READ);
            $code = 'TARGET_UNAVAILABLE';
            $options = plugin_agentbdmosassetsync_participation_lock_definition($asset, $target, $field);
            $code = 'STORAGE_UNSUPPORTED';
            $missing = $field['container_id'] !== null
                && plugin_agentbdmosassetsync_locked_fields_row($asset, $field) === null;
            $current = $missing ? null : plugin_agentbdmosassetsync_locked_value($work, $asset, $field);
            if ($current === true) {
                $finalOutcome = 'AlreadyYes';
            } else {
                $code = 'TARGET_PERMISSION';
                plugin_agentbdmosassetsync_check_asset($asset, $work, UPDATE);
                $field = plugin_agentbdmosassetsync_participation_descriptor($asset, $target, true);
                plugin_agentbdmosassetsync_custom_options($options);
                $prepared = null;
                if ($field['container_id'] !== null) {
                    $fieldCode = 'STORAGE_UNSUPPORTED';
                    try {
                        $prepared = $missing
                            ? plugin_agentbdmosassetsync_participation_fields_create_input($asset, $field, $fieldCode)
                            : plugin_agentbdmosassetsync_field_sync_fields_input($asset, $field, 1, $fieldCode, true);
                    } catch (Throwable $e) {
                        $code = in_array($fieldCode, ['FIELD_PERMISSION', 'TARGET_PERMISSION'], true)
                            ? 'TARGET_PERMISSION' : 'STORAGE_UNSUPPORTED';
                        throw $e;
                    }
                }
                $code = 'WRITE_UNCERTAIN';
                $saved = plugin_agentbdmosassetsync_sync_guard(static function () use ($asset, $field, $prepared,
                    $work, $missing, &$attempted, &$code) {
                    plugin_agentbdmosassetsync_field_sync_reconcile_guard($work);
                    $attempted = true;
                    if ($prepared === null) {
                        return $asset->update(['id' => $asset->getID(), $field['value_column'] => 1]);
                    }
                    if (!$missing) {
                        return plugin_agentbdmosassetsync_field_sync_fields_save($asset, $field, $prepared);
                    }
                    [$stored, $data] = $prepared;
                    $id = $stored->add($data);
                    if ($id === false || (int) $id < 1) {
                        return false;
                    }
                    $code = 'VERIFY_UNCERTAIN';
                    if (!$stored->getFromDB((int) $id) || !$stored->can((int) $id, READ)
                        || (int) $stored->getID() !== (int) $id || $stored->fields['itemtype'] !== $asset::class
                        || (int) $stored->fields['items_id'] !== (int) $asset->getID()
                        || (int) $stored->fields['plugin_fields_containers_id'] !== $field['container_id']
                        || !array_key_exists('entities_id', $stored->fields)
                        || (int) $stored->fields['entities_id'] !== (int) $asset->getEntityID()
                        || plugin_agentbdmosassetsync_field_value($field, $stored->fields[$field['value_column']]) !== true) {
                        return false;
                    }
                    PluginFieldsContainer::constructHistory($field['container_id'], (int) $asset->getID(),
                        $asset::class, $stored->input, $stored);
                    return true;
                });
                if (!$saved) {
                    throw new RuntimeException('Native participation save was not confirmed');
                }
                $code = 'VERIFY_UNCERTAIN';
                if (!$asset->getFromDB((int) $work['b_items_id'])
                    || plugin_agentbdmosassetsync_locked_value($work, $asset, $field) !== true) {
                    throw new RuntimeException('Participation reread did not confirm Yes');
                }
                $finalOutcome = 'SetToYes';
            }
            $state['in_flight']['verified'] = true;
            $code = 'JOURNAL_UNCERTAIN';
            plugin_agentbdmosassetsync_participation_store($record, $state, true);
            $code = 'COMMIT_UNCERTAIN';
            $commitAttempted = true;
            $DB->commit();
            $transaction = false;
            plugin_agentbdmosassetsync_field_sync_reconcile_visible($record->fields,
                ['participation_state_json' => $record->fields['participation_state_json'],
                    'result_json' => $record->fields['result_json']]);
        });
    } catch (Throwable $e) {
        if ($e->getCode() === 9101 || $commitAttempted) {
            // Never overwrite a possibly committed verified receipt using the uncertain session.
            throw new RuntimeException('Participation completion is uncertain; stop the worker', 9101, $e);
        }
        if ($transaction) {
            try {
                $DB->rollBack();
            } catch (Throwable $rollbackError) {
                throw new RuntimeException('Participation rollback is uncertain; stop the worker', 9101, $rollbackError);
            }
        }
        if ($e->getCode() === 9104) {
            $code = 'ROUTE_BUSY';
        }
        // A possible mutation retains its durable intention; only known prewrite failures become Rejected.
        plugin_agentbdmosassetsync_participation_outcome($state, $index,
            $attempted ? 'Unknown' : 'Rejected', $attempted ? 'Unknown' : 'NotAttempted', $code);
        if (!$attempted) {
            $state['in_flight'] = null;
        }
        plugin_agentbdmosassetsync_participation_store($record, $state);
        return !$attempted;
    }
    $state['in_flight'] = null;
    plugin_agentbdmosassetsync_participation_outcome($state, $index, $finalOutcome,
        $finalOutcome === 'AlreadyYes' ? 'VerifiedEqual' : 'VerifiedApplied');
    plugin_agentbdmosassetsync_participation_store($record, $state);
    return true;
}
