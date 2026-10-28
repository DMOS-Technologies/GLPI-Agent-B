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
            'id', 'status', 'route_id', 'settings_version', 'entities_id', 'itemtype', 'subject',
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
        plugin_agentbdmosassetsync_check_fields($input, array_merge($required, ['subject', 'note_json']));
        $subject = $input['subject'] ?? 'Asset';
        if ($subject === 'Note') {
            $required[] = 'note_json';
        }
        plugin_agentbdmosassetsync_require_fields($input, $required);
        if (array_key_exists('subject', $input) && !in_array($input['subject'], ['Asset', 'Note'], true)) {
            plugin_agentbdmosassetsync_fail('ASB_INVALID_FIELD: field=subject');
        }
        if ($subject === 'Asset' && array_key_exists('note_json', $input) && $input['note_json'] !== null) {
            plugin_agentbdmosassetsync_fail('ASB_INVALID_FIELD: field=note_json');
        }
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
        if (!$fields instanceof stdClass
            || ($subject === 'Asset' && !get_object_vars($fields))
            || ($subject === 'Note' && get_object_vars($fields) !== [])) {
            plugin_agentbdmosassetsync_fail('ASB_INVALID_FIELD: field=changed_fields_json');
        }
        if ($subject === 'Note') {
            $note = plugin_agentbdmosassetsync_json('note_json', $input['note_json']);
            if (!plugin_agentbdmosassetsync_notes_valid_payload($note, true) || $note->reliable !== true
                || !plugin_agentbdmosassetsync_notes_content_supported($note->content)) {
                plugin_agentbdmosassetsync_fail('ASB_INVALID_FIELD: field=note_json');
            }
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
        $input += ['subject' => 'Asset', 'note_json' => null,
            'status' => 'Pending', 'retry_count' => 0, 'error' => null, 'done_at' => null];
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
        $this->validateAcknowledgement($input);
        return $this->finishPending((int) $input['id'], true, $input['status'], $history, $options);
    }

    private function validateAcknowledgement(array $input): void
    {
        $owned = ['route_id', 'settings_version', 'a_entities_id', 'entities_id', 'itemtype',
            'subject', 'note_json', 'identity_json', 'changed_fields_json', 'retry_count', 'error',
            'date_creation', 'date_mod', 'done_at'];
        plugin_agentbdmosassetsync_check_fields($input, ['id', 'status'], $owned);
        plugin_agentbdmosassetsync_require_fields($input, ['id', 'status']);
        if (!plugin_agentbdmosassetsync_is_uint($input['id'], 1)) {
            plugin_agentbdmosassetsync_fail('ASB_INVALID_FIELD: field=id');
        }
        if (!is_string($input['status'])) {
            plugin_agentbdmosassetsync_fail('ASB_INVALID_FIELD: field=status');
        }
    }

    private function checkAcknowledgementScope(): void
    {
        $route = plugin_agentbdmosassetsync_read_setting($this->fields['route_id']);
        if ($route === null
            || (int) $route['entities_id'] !== (int) $this->fields['entities_id']
            || (int) $route['a_entities_id'] !== (int) $this->fields['a_entities_id']) {
            plugin_agentbdmosassetsync_fail('ASB_CHANGE_SCOPE_MISMATCH: reason=route_entity_pair');
        }
        // Finishing an old immutable snapshot does not require the current settings version or enabled state.
        $identity = plugin_agentbdmosassetsync_json('identity_json', $this->fields['identity_json']);
        if (!plugin_agentbdmosassetsync_object_keys($identity, ['a_items_id', 'b_items_id', 'serial'])
            || !plugin_agentbdmosassetsync_is_uint($identity->b_items_id, 1)
            || ($identity->a_items_id !== null && !plugin_agentbdmosassetsync_is_uint($identity->a_items_id, 1))) {
            plugin_agentbdmosassetsync_fail('ASB_CHANGE_IDENTITY_UNAVAILABLE');
        }
        $type = $this->fields['itemtype'];
        if (!is_subclass_of($type, CommonDBTM::class)) {
            plugin_agentbdmosassetsync_fail('ASB_CHANGE_IDENTITY_UNAVAILABLE: reason=itemtype');
        }
        if (($this->fields['subject'] ?? 'Asset') === 'Note') {
            $note = plugin_agentbdmosassetsync_json('note_json', $this->fields['note_json']);
            if (!plugin_agentbdmosassetsync_notes_valid_payload($note, true)) {
                plugin_agentbdmosassetsync_fail('ASB_CHANGE_IDENTITY_UNAVAILABLE: reason=note_snapshot');
            }
            plugin_agentbdmosassetsync_notes_check_acknowledgement($this->fields, $identity, $note);
            return;
        }
        $asset = new $type();
        // Concrete custom types share a table; an ID alone does not prove the snapshot's itemtype.
        $criteria = [$type::getTableField($type::getIndexName()) => $identity->b_items_id]
            + $type::getSystemSQLCriteria($type::getTable());
        if (!$asset->getFromDBByCrit($criteria)) {
            plugin_agentbdmosassetsync_fail('ASB_CHANGE_SCOPE_MISMATCH: reason=asset_identity');
        }
        if (!$asset->isEntityAssign() || (int) $asset->getEntityID() !== (int) $this->fields['entities_id']) {
            plugin_agentbdmosassetsync_fail('ASB_CHANGE_SCOPE_MISMATCH: reason=asset_entity');
        }
        $this->checkAcknowledgementLink($identity);
    }

    private function checkAcknowledgementLink(stdClass $identity): void
    {
        global $DB;

        // Lock retained evidence while deciding whether this relationship is currently Suspended.
        $query = 'SELECT * FROM `' . PluginAgentbdmosassetsyncWork::getTable() . '` WHERE `itemtype` = '
            . $DB::quoteValue($this->fields['itemtype']) . ' AND (`route_id` = '
            . $DB::quoteValue($this->fields['route_id']) . ' OR `b_items_id` = ' . $identity->b_items_id . ')'
            . " AND `subject` = 'Asset' AND `link_state` IN ('Active', 'Suspended') ORDER BY `id` DESC FOR UPDATE";
        $result = $DB->doQuery($query);
        $latest = [];
        while ($work = $DB->fetchAssoc($result)) {
            // An unlinked historical snapshot must not acknowledge another route's retained ownership.
            if ($work['route_id'] !== $this->fields['route_id']) {
                plugin_agentbdmosassetsync_fail('ASB_CHANGE_IDENTITY_AMBIGUOUS: reason=competing_route');
            }
            $aId = (int) $work['a_items_id'];
            if (!isset($latest[$aId])) {
                $latest[$aId] = $work;
            }
        }
        $matching = [];
        foreach ($latest as $aId => $work) {
            if ((int) $work['b_items_id'] !== $identity->b_items_id && $aId !== $identity->a_items_id) {
                continue;
            }
            if ($aId < 1 || (int) $work['b_items_id'] !== $identity->b_items_id
                || (int) $work['entities_id'] !== (int) $this->fields['entities_id']
                || (int) $work['a_entities_id'] !== (int) $this->fields['a_entities_id']) {
                plugin_agentbdmosassetsync_fail('ASB_CHANGE_SCOPE_MISMATCH: reason=verified_link');
            }
            $matching[$aId] = $work['link_state'];
        }
        if (count($matching) > 1 || ($matching && $identity->a_items_id !== null
            && !isset($matching[$identity->a_items_id]))) {
            plugin_agentbdmosassetsync_fail('ASB_CHANGE_IDENTITY_AMBIGUOUS');
        }
        if ($identity->a_items_id !== null && !$matching) {
            plugin_agentbdmosassetsync_fail('ASB_CHANGE_IDENTITY_UNAVAILABLE: reason=verified_link');
        }
        if ($matching && reset($matching) === 'Suspended') {
            plugin_agentbdmosassetsync_fail('ASB_CHANGE_LINK_SUSPENDED');
        }
    }

    public function prepareInputForUpdate($input)
    {
        return $this->internalDone ? $input : false;
    }

    /** Local processing attempt metadata; never available through REST update(). */
    public function recordCorrectionAttempt(int $id): bool
    {
        return $this->saveCorrectionMetadata($id, true, null);
    }

    public function recordCorrectionFailure(int $id, string $reason): bool
    {
        return $this->saveCorrectionMetadata($id, false, $reason);
    }

    private function saveCorrectionMetadata(int $id, bool $increment, ?string $error): bool
    {
        global $DB;
        if (!plugin_agentbdmosassetsync_is_uint($id, 1)) {
            throw new RuntimeException('Invalid local correction snapshot ID');
        }
        $DB->beginTransaction();
        try {
            $DB->doQuery('SELECT `id` FROM `' . static::getTable() . '` WHERE `id` = ' . $id . ' FOR UPDATE');
            if (!$this->getFromDB($id) || $this->fields['status'] !== 'Pending') {
                $DB->rollBack();
                return false;
            }
            $before = $this->fields;
            $count = (int) $before['retry_count'] + ($increment ? 1 : 0);
            if ($count > 4294967295) {
                throw new RuntimeException('Correction attempt counter is exhausted');
            }
            $this->internalDone = true;
            if (!parent::update(['id' => $id, 'retry_count' => $count, 'error' => $error])
                || !$this->getFromDB($id) || (int) $this->fields['retry_count'] !== $count
                || $this->fields['error'] !== $error) {
                throw new RuntimeException('Correction metadata save could not be verified');
            }
            foreach ($before as $field => $value) {
                if (!in_array($field, ['retry_count', 'error', 'date_mod'], true) && $this->fields[$field] !== $value) {
                    throw new RuntimeException('Correction metadata changed an immutable snapshot field');
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

    /** Local correction code proves exact snapshot coverage before calling this method. */
    public function markDoneInternally(int $id): bool
    {
        if (!plugin_agentbdmosassetsync_is_uint($id, 1)) {
            plugin_agentbdmosassetsync_fail('ASB_INVALID_FIELD: field=ids');
        }
        return $this->finishPending($id, false);
    }

    private function finishPending(int $id, bool $acknowledgement, string $status = 'Done', $history = true, array $options = []): bool
    {
        global $DB;

        $DB->beginTransaction();
        try {
            $DB->doQuery('SELECT `id` FROM `' . static::getTable() . '` WHERE `id` = ' . $id . ' FOR UPDATE');
            if (!$this->getFromDB($id)) {
                if ($acknowledgement) {
                    plugin_agentbdmosassetsync_fail('ASB_CHANGE_IDENTITY_UNAVAILABLE: reason=queue_row');
                }
                $DB->rollBack();
                return false;
            }
            if ($acknowledgement && (!$this->can($id, UPDATE)
                || !Session::haveAccessToEntity((int) $this->fields['entities_id']))) {
                plugin_agentbdmosassetsync_fail('ASB_CHANGE_PERMISSION_DENIED');
            }
            if ($this->fields['status'] !== 'Pending' || $status !== 'Done') {
                if ($acknowledgement) {
                    plugin_agentbdmosassetsync_fail('ASB_CHANGE_TRANSITION: from=' . $this->fields['status'] . ' to=' . $status);
                }
                $DB->rollBack();
                return false;
            }
            if ($acknowledgement) {
                $this->checkAcknowledgementScope();
            }
            $before = $this->fields;
            $doneAt = Session::getCurrentTime();
            if ($doneAt === null) {
                plugin_agentbdmosassetsync_fail('ASB_CHANGE_TIME_UNAVAILABLE');
            }
            $this->internalDone = true;
            $saved = parent::update(['id' => $id, 'status' => 'Done', 'done_at' => $doneAt], $history, $options);
            if (!$saved || !$this->getFromDB($id) || $this->fields['status'] !== 'Done'
                || $this->fields['done_at'] !== $doneAt || $this->fields['date_mod'] !== $doneAt) {
                if ($acknowledgement) {
                    plugin_agentbdmosassetsync_fail('ASB_CHANGE_VERIFY_FAILED');
                }
                $DB->rollBack();
                return false;
            }
            foreach ($before as $field => $value) {
                if (!in_array($field, ['status', 'done_at', 'date_mod'], true) && $this->fields[$field] !== $value) {
                    if ($acknowledgement) {
                        plugin_agentbdmosassetsync_fail('ASB_CHANGE_VERIFY_FAILED: field=' . $field);
                    }
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
