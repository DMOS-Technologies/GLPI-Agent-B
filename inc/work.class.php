<?php

class PluginAgentbdmosassetsyncWork extends CommonDBTM
{
    public static $rightname = 'plugin_agentbdmosassetsync_work';
    public static $undisclosedFields = ['field_sync_json'];
    private ?array $clientCreateInput = null;

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
        // Native V1 adds _add and entity defaults after this check, outside its add() catch.
        if ($right === CREATE && $input !== null) {
            $this->clientCreateInput = $input;
        }
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
            'id', 'work_id', 'status', 'route_id', 'settings_version', 'entities_id', 'itemtype', 'subject',
        ]);
    }

    public function add(array $input, $options = [], $history = true)
    {
        global $DB;

        $raw = $this->clientCreateInput ?? $input;
        $this->clientCreateInput = null;
        $identity = $this->validateCreation($raw);
        $fieldSync = $this->validateFieldSync($raw, $identity);
        if (!static::canCreate() || !Session::haveAccessToEntity($raw['entities_id'])) {
            return false;
        }
        $userId = $this->sessionId(Session::getLoginUserID());
        $profileId = $this->sessionId($_SESSION['glpiactiveprofile']['id'] ?? null);
        if ($userId === null || $profileId === null) {
            plugin_agentbdmosassetsync_fail('ASB_WORK_SUBMITTER_UNAVAILABLE');
        }

        $raw += ['operation' => 'Sync', 'handled_change_ids_json' => '[]', 'subject' => 'Asset',
            'note_json' => null, 'field_sync_json' => null];
        if ($fieldSync !== null) {
            $raw['result_json'] = json_encode(plugin_agentbdmosassetsync_field_sync_initial_result(
                $fieldSync['options'], $fieldSync['enabled_mapping_ids']), JSON_THROW_ON_ERROR);
        }
        $raw += [
            'submitted_users_id' => $userId, 'submitted_profiles_id' => $profileId,
            'a_items_id' => $identity->a_items_id, 'b_items_id' => null, 'link_state' => null,
            'processing_started_at' => null, 'status' => 'Accepted', 'result_json' => null,
            'error' => null, 'completed_at' => null,
        ];

        // Serialize retries before GLPI add(); the database unique key remains the final guard.
        $lock = 'asb-work-' . sha1($raw['work_id']);
        $locked = $DB->fetchAssoc($DB->doQuery("SELECT GET_LOCK('$lock', 5) AS acquired"));
        if ((int) $locked['acquired'] !== 1) {
            plugin_agentbdmosassetsync_fail('ASB_WORK_BUSY');
        }
        try {
            if ((new self())->getFromDBByCrit(['work_id' => $raw['work_id']])) {
                plugin_agentbdmosassetsync_fail('ASB_WORK_EXISTS: work_id=' . $raw['work_id']);
            }
            $DB->beginTransaction();
            try {
                $id = parent::add($raw, $options, $history);
                if ($id === false) {
                    $DB->rollBack();
                    return false;
                }
                $this->verifyCreated((int) $id, $raw);
                $DB->commit();
                return $id;
            } catch (Throwable $e) {
                $DB->rollBack();
                throw $e;
            }
        } finally {
            $DB->doQuery("SELECT RELEASE_LOCK('$lock')");
        }
    }

    private function validateCreation(array $input): stdClass
    {
        $required = ['work_id', 'route_id', 'a_entities_id', 'entities_id', 'itemtype',
            'identity_json', 'a_values_json', 'a_change_times_json', 'settings_version'];
        $owned = ['id', 'submitted_users_id', 'submitted_profiles_id', 'a_items_id', 'b_items_id',
            'link_state', 'processing_started_at', 'status', 'result_json', 'error',
            'date_creation', 'date_mod', 'completed_at'];
        plugin_agentbdmosassetsync_check_fields($input,
            array_merge($required, ['operation', 'handled_change_ids_json', 'subject', 'note_json', 'field_sync_json']), $owned);
        $subject = $input['subject'] ?? 'Asset';
        if ($subject === 'Note') {
            $required[] = 'note_json';
        }
        plugin_agentbdmosassetsync_require_fields($input, $required);

        $invalid = [];
        foreach (['work_id', 'route_id'] as $field) {
            if (!plugin_agentbdmosassetsync_is_key($input[$field])) {
                $invalid[] = $field;
            }
        }
        foreach (['a_entities_id', 'entities_id', 'settings_version'] as $field) {
            if (!plugin_agentbdmosassetsync_is_uint($input[$field], $field === 'settings_version' ? 1 : 0)) {
                $invalid[] = $field;
            }
        }
        if (!is_string($input['itemtype']) || $input['itemtype'] === ''
            || mb_strlen($input['itemtype'], 'UTF-8') > 255) {
            $invalid[] = 'itemtype';
        }
        $operation = $input['operation'] ?? 'Sync';
        if (array_key_exists('subject', $input) && !in_array($input['subject'], ['Asset', 'Note'], true)) {
            $invalid[] = 'subject';
        }
        $operations = $subject === 'Note' ? ['Sync', 'Inventory'] : ['Sync', 'Suspend', 'Resume'];
        if (array_key_exists('operation', $input) && !in_array($input['operation'], $operations, true)) {
            $invalid[] = 'operation';
        }
        if ($subject === 'Asset' && array_key_exists('note_json', $input) && $input['note_json'] !== null) {
            $invalid[] = 'note_json';
        }

        $json = [];
        foreach (['a_change_times_json', 'a_values_json', 'handled_change_ids_json', 'identity_json'] as $field) {
            if ($field === 'handled_change_ids_json' && !array_key_exists($field, $input)) {
                $json[$field] = [];
                continue;
            }
            try {
                $json[$field] = plugin_agentbdmosassetsync_json($field, $input[$field]);
            } catch (RuntimeException $e) {
                $invalid[] = $field;
            }
        }
        if (array_key_exists('identity_json', $json) && !$this->validIdentity($json['identity_json'])) {
            $invalid[] = 'identity_json';
        }
        if (array_key_exists('a_values_json', $json) && !$this->validValues($json['a_values_json'])) {
            $invalid[] = 'a_values_json';
        }
        if (array_key_exists('a_change_times_json', $json) && !$this->validTimes($json['a_change_times_json'])) {
            $invalid[] = 'a_change_times_json';
        }
        if (array_key_exists('handled_change_ids_json', $json) && !$this->validHandledIds($json['handled_change_ids_json'])) {
            $invalid[] = 'handled_change_ids_json';
        }
        if ($subject === 'Note') {
            try {
                $note = plugin_agentbdmosassetsync_json('note_json', $input['note_json']);
                $valid = $operation === 'Inventory'
                    ? plugin_agentbdmosassetsync_notes_inventory_payload_valid($note)
                    : plugin_agentbdmosassetsync_notes_valid_payload($note);
                if (!$valid) {
                    $invalid[] = 'note_json';
                }
            } catch (RuntimeException $e) {
                $invalid[] = 'note_json';
            }
        }
        if ($subject === 'Note' || in_array($operation, ['Suspend', 'Resume'], true)) {
            foreach (['a_values_json', 'a_change_times_json'] as $field) {
                if (array_key_exists($field, $json)
                    && (!$json[$field] instanceof stdClass || get_object_vars($json[$field]) !== [])) {
                    $invalid[] = $field;
                }
            }
            if (($subject !== 'Note' || $operation === 'Inventory')
                && ($json['handled_change_ids_json'] ?? []) !== []) {
                $invalid[] = 'handled_change_ids_json';
            }
        }
        if ($invalid) {
            sort($invalid, SORT_STRING);
            plugin_agentbdmosassetsync_fail('ASB_INVALID_FIELD: field=' . $invalid[0]);
        }
        return $json['identity_json'];
    }

    /** Opt-in selection is metadata only; the worker verifies the actual retained Active parent. */
    private function validateFieldSync(array $input, stdClass $identity): ?array
    {
        if (!array_key_exists('field_sync_json', $input) || $input['field_sync_json'] === null) {
            return null;
        }
        $options = plugin_agentbdmosassetsync_json('field_sync_json', $input['field_sync_json']);
        $version = $options instanceof stdClass ? ($options->version ?? null) : null;
        $keys = $version === 2 ? ['version', 'mapping_ids', 'reconcile_work_id'] : ['version', 'mapping_ids'];
        if (($input['subject'] ?? 'Asset') !== 'Asset' || ($input['operation'] ?? 'Sync') !== 'Sync'
            || !plugin_agentbdmosassetsync_object_keys($options, $keys)
            || !in_array($version, [1, 2], true) || !is_array($options->mapping_ids)
            || ($version === 2 && !plugin_agentbdmosassetsync_is_uint($options->reconcile_work_id, 1))) {
            plugin_agentbdmosassetsync_fail('ASB_INVALID_FIELD: field=field_sync_json');
        }
        if (!plugin_agentbdmosassetsync_is_uint($identity->b_items_id, 1)) {
            plugin_agentbdmosassetsync_fail('ASB_INVALID_FIELD: field=identity_json');
        }
        $seen = [];
        foreach ($options->mapping_ids as $id) {
            if (!$this->validMappingId($id) || in_array($id, $seen, true)) {
                plugin_agentbdmosassetsync_fail('ASB_INVALID_FIELD: field=field_sync_json');
            }
            $seen[] = $id;
        }
        $route = plugin_agentbdmosassetsync_read_setting($input['route_id']);
        if ($route === null || !(int) $route['route_enabled']
            || (int) $route['settings_version'] !== $input['settings_version']
            || (int) $route['a_entities_id'] !== $input['a_entities_id']
            || (int) $route['entities_id'] !== $input['entities_id']) {
            plugin_agentbdmosassetsync_fail('ASB_INVALID_FIELD: field=field_sync_json');
        }
        try {
            $types = json_decode($route['enabled_itemtypes_json'], true, 512, JSON_THROW_ON_ERROR);
            $mappings = json_decode($route['field_mappings_json'], false, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            plugin_agentbdmosassetsync_fail('ASB_INVALID_FIELD: field=field_sync_json');
        }
        if (!is_array($types) || !in_array($input['itemtype'], $types, true) || !is_array($mappings)) {
            plugin_agentbdmosassetsync_fail('ASB_INVALID_FIELD: field=field_sync_json');
        }
        $enabled = [];
        foreach ($mappings as $mapping) {
            if ($mapping instanceof stdClass && ($mapping->enabled ?? false) === true
                && ($mapping->itemtype ?? null) === $input['itemtype']
                && $this->validMappingId($mapping->mapping_id ?? null)) {
                $enabled[] = $mapping->mapping_id;
            }
        }
        foreach ($options->mapping_ids as $id) {
            if (!in_array($id, $enabled, true)) {
                plugin_agentbdmosassetsync_fail('ASB_INVALID_FIELD: field=field_sync_json');
            }
        }
        if ($version === 2) {
            try {
                plugin_agentbdmosassetsync_field_sync_reconcile_reference($input, $options);
            } catch (Throwable $e) {
                plugin_agentbdmosassetsync_fail('ASB_INVALID_FIELD: field=field_sync_json');
            }
        }
        foreach (['a_values_json', 'a_change_times_json'] as $name) {
            $values = plugin_agentbdmosassetsync_json($name, $input[$name]);
            foreach (array_keys(get_object_vars($values)) as $id) {
                if (!in_array($id, $options->mapping_ids, true)) {
                    plugin_agentbdmosassetsync_fail('ASB_INVALID_FIELD: field=' . $name);
                }
            }
        }
        return ['options' => $options, 'enabled_mapping_ids' => $enabled];
    }

    private function validIdentity($identity): bool
    {
        return plugin_agentbdmosassetsync_object_keys($identity, ['a_items_id', 'b_items_id', 'serial'])
            && plugin_agentbdmosassetsync_is_uint($identity->a_items_id, 1)
            && ($identity->b_items_id === null || plugin_agentbdmosassetsync_is_uint($identity->b_items_id, 1))
            && ($identity->serial === null || (is_string($identity->serial) && $identity->serial !== ''));
    }

    private function validValues($values): bool
    {
        if (!$values instanceof stdClass) {
            return false;
        }
        foreach (get_object_vars($values) as $mappingId => $value) {
            if (!$this->validMappingId($mappingId)
                || (!is_scalar($value) && $value !== null)
                || (is_float($value) && !is_finite($value))) {
                return false;
            }
        }
        return true;
    }

    private function validTimes($times): bool
    {
        if (!$times instanceof stdClass) {
            return false;
        }
        foreach (get_object_vars($times) as $mappingId => $time) {
            if (!$this->validMappingId($mappingId)
                || !plugin_agentbdmosassetsync_object_keys($time, ['changed_at', 'reliable'])
                || !is_bool($time->reliable)
                || ($time->changed_at !== null && !$this->validFieldTime($time->changed_at))) {
                return false;
            }
        }
        return true;
    }

    private function validMappingId($id): bool
    {
        return is_string($id) && preg_match('/\A[a-z][a-z0-9_]{0,63}\z/D', $id) === 1;
    }

    private function validFieldTime($value): bool
    {
        if (!is_string($value)
            || preg_match('/\A[0-9]{4}-[0-9]{2}-[0-9]{2}T[0-9]{2}:[0-9]{2}:[0-9]{2}\+08:00\z/D', $value) !== 1) {
            return false;
        }
        $date = DateTimeImmutable::createFromFormat('!Y-m-d\TH:i:sP', $value);
        $errors = DateTimeImmutable::getLastErrors();
        return $date !== false && ($errors === false || ($errors['warning_count'] === 0 && $errors['error_count'] === 0))
            && $date->format('Y-m-d\TH:i:sP') === $value;
    }

    private function validHandledIds($ids): bool
    {
        if (!is_array($ids)) {
            return false;
        }
        $seen = [];
        foreach ($ids as $id) {
            if (!plugin_agentbdmosassetsync_is_uint($id, 1) || in_array($id, $seen, true)) {
                return false;
            }
            $seen[] = $id;
        }
        return true;
    }

    private function sessionId($id): ?int
    {
        if (is_string($id) && ctype_digit($id) && strlen($id) <= 10) {
            $id = (int) $id;
        }
        return plugin_agentbdmosassetsync_is_uint($id, 1) ? $id : null;
    }

    private function verifyCreated(int $id, array $expected): void
    {
        if (!$this->getFromDB($id)) {
            plugin_agentbdmosassetsync_fail('ASB_WORK_VERIFY_FAILED');
        }
        foreach ($expected as $field => $value) {
            if (($value === null && $this->fields[$field] !== null)
                || ($value !== null && (string) $this->fields[$field] !== (string) $value)) {
                plugin_agentbdmosassetsync_fail('ASB_WORK_VERIFY_FAILED');
            }
        }
    }

    public function update(array $input, $history = true, $options = [])
    {
        plugin_agentbdmosassetsync_fail('ASB_WORK_IMMUTABLE');
    }

    /** Called by local processing code only; REST still reaches the forbidden update(). */
    public function saveProcessorFields(int $id, array $values, bool $strictTransaction = false): bool
    {
        global $DB;

        plugin_agentbdmosassetsync_check_fields($values, [
            'processing_started_at', 'b_items_id', 'link_state', 'status', 'result_json', 'error', 'completed_at',
        ]);
        try {
            $DB->beginTransaction();
        } catch (Throwable $e) {
            if ($strictTransaction) {
                throw new RuntimeException('Work metadata transaction start is uncertain; stop this worker without replay', 9101, $e);
            }
            throw $e;
        }
        $rollingBack = false;
        try {
            $DB->doQuery('SELECT `id` FROM `' . static::getTable() . '` WHERE `id` = ' . $id . ' FOR UPDATE');
            if (!$this->getFromDB($id) || $this->fields['status'] !== 'Accepted') {
                $rollingBack = true;
                $DB->rollBack();
                return false;
            }
            if (($this->fields['subject'] ?? 'Asset') === 'Note'
                && ((array_key_exists('b_items_id', $values) && $values['b_items_id'] !== null)
                    || (array_key_exists('link_state', $values) && $values['link_state'] !== null))) {
                throw new RuntimeException('Note Work cannot change Asset link evidence');
            }
            if (isset($values['status']) && !in_array($values['status'], ['Accepted', 'Done', 'Held', 'Failed'], true)) {
                throw new RuntimeException('Invalid internal Work status');
            }
            $saved = parent::update(['id' => $id] + $values);
            if (!$saved) {
                $rollingBack = true;
                $DB->rollBack();
                return false;
            }
            $this->verifyCreated($id, $values);
            $DB->commit();
            return true;
        } catch (Throwable $e) {
            if ($strictTransaction && $rollingBack) {
                throw new RuntimeException('Work metadata rollback is uncertain; stop this worker without replay', 9101, $e);
            }
            try {
                $DB->rollBack();
            } catch (Throwable $rollbackError) {
                if ($strictTransaction) {
                    throw new RuntimeException('Work metadata rollback is uncertain; stop this worker without replay', 9101, $rollbackError);
                }
                throw $rollbackError;
            }
            throw $e;
        }
    }

    /** First copy owns the outer transaction so the asset and verified link commit together. */
    public function saveFirstCopyEvidence(int $id, array $values): bool
    {
        global $DB;

        plugin_agentbdmosassetsync_check_fields($values, ['b_items_id', 'link_state', 'result_json']);
        $DB->doQuery('SELECT `id` FROM `' . static::getTable() . '` WHERE `id` = ' . $id . ' FOR UPDATE');
        if (!$this->getFromDB($id) || ($this->fields['subject'] ?? 'Asset') !== 'Asset'
            || $this->fields['status'] !== 'Accepted'
            || $this->fields['processing_started_at'] === null || $this->fields['b_items_id'] !== null) {
            return false;
        }
        if (!parent::update(['id' => $id] + $values)) {
            return false;
        }
        $this->verifyCreated($id, $values);
        return true;
    }

    /** The caller owns the native field transaction; its provisional proof commits with the field. */
    public function saveFieldSyncEvidence(int $id, array $result): bool
    {
        global $DB;

        $DB->doQuery('SELECT `id` FROM `' . static::getTable() . '` WHERE `id` = ' . $id . ' FOR UPDATE');
        if (!$this->getFromDB($id) || $this->fields['status'] !== 'Accepted'
            || $this->fields['processing_started_at'] === null
            || ($this->fields['subject'] ?? 'Asset') !== 'Asset'
            || $this->fields['operation'] !== 'Sync' || $this->fields['field_sync_json'] === null) {
            return false;
        }
        $options = plugin_agentbdmosassetsync_field_sync_options($this->fields);
        if (($result['field_sync']['version'] ?? null) !== $options->version
            || ($result['field_sync']['mapping_ids'] ?? null) !== $options->mapping_ids
            || ($options->version === 2
                && ($result['field_sync']['reconcile_work_id'] ?? null) !== $options->reconcile_work_id)
            || ($options->version === 1 && array_key_exists('reconcile_work_id', $result['field_sync']))) {
            return false;
        }
        $json = json_encode($result, JSON_THROW_ON_ERROR);
        if (!parent::update(['id' => $id, 'result_json' => $json])) {
            return false;
        }
        $this->verifyCreated($id, ['result_json' => $json]);
        return true;
    }

    public static function cronInfo($name)
    {
        return $name === 'processWork'
            ? ['description' => 'Process a bounded batch of Agent B Work records'] : [];
    }

    public static function cronProcessWork(CronTask $task)
    {
        require_once __DIR__ . '/process.php';
        return plugin_agentbdmosassetsync_process_batch($task);
    }
}
