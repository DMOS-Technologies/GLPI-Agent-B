<?php

class PluginAgentbdmosassetsyncWork extends CommonDBTM
{
    public static $rightname = 'plugin_agentbdmosassetsync_work';
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
            'id', 'work_id', 'status', 'route_id', 'settings_version', 'entities_id', 'itemtype',
        ]);
    }

    public function add(array $input, $options = [], $history = true)
    {
        global $DB;

        $raw = $this->clientCreateInput ?? $input;
        $this->clientCreateInput = null;
        $identity = $this->validateCreation($raw);
        if (!static::canCreate() || !Session::haveAccessToEntity($raw['entities_id'])) {
            return false;
        }
        $userId = $this->sessionId(Session::getLoginUserID());
        $profileId = $this->sessionId($_SESSION['glpiactiveprofile']['id'] ?? null);
        if ($userId === null || $profileId === null) {
            plugin_agentbdmosassetsync_fail('ASB_WORK_SUBMITTER_UNAVAILABLE');
        }

        $raw += ['operation' => 'Sync', 'handled_change_ids_json' => '[]'];
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
            array_merge($required, ['operation', 'handled_change_ids_json']), $owned);
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
        if (array_key_exists('operation', $input) && !in_array($input['operation'], ['Sync', 'Suspend', 'Resume'], true)) {
            $invalid[] = 'operation';
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
        if (in_array($operation, ['Suspend', 'Resume'], true)) {
            foreach (['a_values_json', 'a_change_times_json'] as $field) {
                if (array_key_exists($field, $json)
                    && (!$json[$field] instanceof stdClass || get_object_vars($json[$field]) !== [])) {
                    $invalid[] = $field;
                }
            }
            if (($json['handled_change_ids_json'] ?? []) !== []) {
                $invalid[] = 'handled_change_ids_json';
            }
        }
        if ($invalid) {
            sort($invalid, SORT_STRING);
            plugin_agentbdmosassetsync_fail('ASB_INVALID_FIELD: field=' . $invalid[0]);
        }
        return $json['identity_json'];
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
