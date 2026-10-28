<?php

/** Notepad owns both new-note and content-update hooks for every supported parent type. */
function plugin_agentbdmosassetsync_register_note_capture(): void
{
    global $PLUGIN_HOOKS;
    try {
        $PLUGIN_HOOKS['pre_item_add']['agentbdmosassetsync'][Notepad::class]
            = 'plugin_agentbdmosassetsync_note_capture_before_add';
        $PLUGIN_HOOKS['pre_item_update']['agentbdmosassetsync'][Notepad::class]
            = 'plugin_agentbdmosassetsync_note_capture_before_update';
        foreach (['item_add', 'item_update'] as $hook) {
            $PLUGIN_HOOKS[$hook]['agentbdmosassetsync'][Notepad::class]
                = 'plugin_agentbdmosassetsync_note_capture_after';
        }
    } catch (Throwable $e) {
        plugin_agentbdmosassetsync_capture_log(new Notepad(), 'note-register', $e);
    }
}

function plugin_agentbdmosassetsync_note_capture_before_add(CommonDBTM $note): void
{
    plugin_agentbdmosassetsync_note_capture_before($note, true);
}

function plugin_agentbdmosassetsync_note_capture_before_update(CommonDBTM $note): void
{
    plugin_agentbdmosassetsync_note_capture_before($note, false);
}

/** These inputs can make Notepad::post_updateItem rewrite content after ITEM_UPDATE. */
function plugin_agentbdmosassetsync_note_capture_has_upload(array $input): bool
{
    foreach (['_filename', '_content', '_tag_filename', '_tag_content', '_prefix_filename',
        '_prefix_content', '_tag', 'documents_id', '_documents_id'] as $name) {
        if (isset($input[$name]) && $input[$name] !== [] && $input[$name] !== ''
            && $input[$name] !== false && $input[$name] !== 0) {
            return true;
        }
    }
    return false;
}

function plugin_agentbdmosassetsync_note_capture_routes(string $type): array
{
    if (!in_array($type, plugin_agentbdmosassetsync_asset_types(), true)
        || !plugin_agentbdmosassetsync_notes_capable($type)) {
        return [];
    }
    return array_values(array_filter(plugin_agentbdmosassetsync_capture_routes($type),
        static function (array $route) use ($type): bool {
            $selected = json_decode($route['notes_itemtypes_json'] ?? '[]', true, 512, JSON_THROW_ON_ERROR);
            return is_array($selected) && in_array($type, $selected, true);
        }));
}

/** Independently reread the concrete parent, including custom types sharing one table. */
function plugin_agentbdmosassetsync_note_capture_parent(string $type, int $id): CommonDBTM
{
    if ($id < 1 || !in_array($type, plugin_agentbdmosassetsync_asset_types(), true)) {
        throw new RuntimeException('ASB_NOTE_CAPTURE_PARENT_UNAVAILABLE');
    }
    $parent = new $type();
    $criteria = [$type::getTableField($type::getIndexName()) => $id]
        + $type::getSystemSQLCriteria($type::getTable());
    if (!$parent->getFromDBByCrit($criteria) || !$parent->isEntityAssign()) {
        throw new RuntimeException('ASB_NOTE_CAPTURE_PARENT_UNAVAILABLE');
    }
    return $parent;
}

/** A Note made while its parent is being added is part of that creation, not a later edit. */
function plugin_agentbdmosassetsync_note_capture_nested(string $type): bool
{
    foreach (debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT | DEBUG_BACKTRACE_IGNORE_ARGS) as $frame) {
        if (($frame['function'] ?? '') === 'add' && ($frame['object'] ?? null) instanceof $type) {
            return true;
        }
    }
    return false;
}

function plugin_agentbdmosassetsync_note_capture_before(CommonDBTM $note, bool $isAdd): void
{
    $key = spl_object_id($note);
    unset($GLOBALS['plugin_agentbdmosassetsync_note_captures'][$key]);
    try {
        if (plugin_agentbdmosassetsync_is_sync_write()) {
            return;
        }
        $previous = null;
        if ($isAdd) {
            $type = $note->input['itemtype'] ?? null;
            $parentId = (int) ($note->input['items_id'] ?? 0);
        } else {
            $before = new Notepad();
            if (!$before->getFromDB((int) $note->getID())) {
                throw new RuntimeException('ASB_NOTE_CAPTURE_PREVIOUS_UNAVAILABLE');
            }
            $type = $before->fields['itemtype'] ?? null;
            $parentId = (int) ($before->fields['items_id'] ?? 0);
            $previous = $before->fields['content'] ?? null;
            if (!is_string($previous)) {
                throw new RuntimeException('ASB_NOTE_CAPTURE_PREVIOUS_CONTENT_UNAVAILABLE');
            }
        }
        if (!is_string($type)) {
            return;
        }
        $routes = plugin_agentbdmosassetsync_note_capture_routes($type);
        if (!$routes || plugin_agentbdmosassetsync_note_capture_nested($type)) {
            return;
        }
        $GLOBALS['plugin_agentbdmosassetsync_note_captures'][$key] = [
            'itemtype' => $type, 'items_id' => $parentId, 'note_id' => $isAdd ? null : (int) $note->getID(),
            'is_add' => $isAdd, 'previous_content' => $previous,
            'time' => plugin_agentbdmosassetsync_capture_time(), 'routes' => $routes,
        ];
        plugin_agentbdmosassetsync_note_capture_parent($type, $parentId);
        if (plugin_agentbdmosassetsync_note_capture_has_upload($note->input)) {
            throw new RuntimeException('ASB_NOTE_CAPTURE_UNSUPPORTED_FILE_INPUT');
        }
    } catch (Throwable $e) {
        if (isset($GLOBALS['plugin_agentbdmosassetsync_note_captures'][$key])) {
            $GLOBALS['plugin_agentbdmosassetsync_note_captures'][$key]['skip'] = true;
        }
        plugin_agentbdmosassetsync_capture_log($note, 'note-before', $e);
    }
}

/** Each genuine supported Note save emits one immutable snapshot per currently eligible route. */
function plugin_agentbdmosassetsync_note_capture_after(CommonDBTM $note): void
{
    $key = spl_object_id($note);
    if (!isset($GLOBALS['plugin_agentbdmosassetsync_note_captures'][$key])) {
        return;
    }
    $capture = $GLOBALS['plugin_agentbdmosassetsync_note_captures'][$key];
    try {
        if (plugin_agentbdmosassetsync_is_sync_write()) {
            return;
        }
        if ($capture['skip'] ?? false) {
            throw new RuntimeException('ASB_NOTE_CAPTURE_PRECHECK_FAILED');
        }
        $saved = plugin_agentbdmosassetsync_note_capture_saved($note, $capture);
        if (!$capture['is_add'] && $saved['content'] === $capture['previous_content']) {
            return;
        }
        $current = [];
        foreach (plugin_agentbdmosassetsync_note_capture_routes($capture['itemtype']) as $route) {
            $current[$route['route_id']] = $route;
        }
        foreach ($capture['routes'] as $beforeRoute) {
            $route = $current[$beforeRoute['route_id']] ?? null;
            if ($route === null || (int) $route['settings_version'] !== (int) $beforeRoute['settings_version']
                || (int) $route['a_entities_id'] !== (int) $beforeRoute['a_entities_id']
                || (int) $route['entities_id'] !== (int) $beforeRoute['entities_id']) {
                plugin_agentbdmosassetsync_note_capture_invalidate($note, $capture, $beforeRoute);
                continue;
            }
            try {
                plugin_agentbdmosassetsync_note_capture_queue($note, $capture, $saved, $route);
            } catch (Throwable $e) {
                plugin_agentbdmosassetsync_capture_log($note, 'note-queue', $e, $route['route_id']);
                plugin_agentbdmosassetsync_note_capture_invalidate($note, $capture, $route);
            }
        }
    } catch (Throwable $e) {
        plugin_agentbdmosassetsync_capture_log($note, 'note-after', $e);
        foreach ($capture['routes'] as $route) {
            plugin_agentbdmosassetsync_note_capture_invalidate($note, $capture, $route);
        }
    } finally {
        unset($GLOBALS['plugin_agentbdmosassetsync_note_captures'][$key]);
    }
}

function plugin_agentbdmosassetsync_note_capture_saved(CommonDBTM $note, array $capture): array
{
    $id = (int) $note->getID();
    if ($id < 1 || ($capture['note_id'] !== null && $capture['note_id'] !== $id)) {
        throw new RuntimeException('ASB_NOTE_CAPTURE_ID_MISMATCH');
    }
    if (plugin_agentbdmosassetsync_note_capture_has_upload($note->input)) {
        throw new RuntimeException('ASB_NOTE_CAPTURE_UNSUPPORTED_FILE_INPUT');
    }
    $stored = new Notepad();
    if (!$stored->getFromDB($id) || ($stored->fields['itemtype'] ?? null) !== $capture['itemtype']
        || (int) ($stored->fields['items_id'] ?? 0) !== $capture['items_id']) {
        throw new RuntimeException('ASB_NOTE_CAPTURE_PARENT_CHANGED');
    }
    $content = $stored->fields['content'] ?? null;
    if (!is_string($content) || !array_key_exists('content', $note->fields)
        || $content !== $note->fields['content']) {
        throw new RuntimeException('ASB_NOTE_CAPTURE_CONTENT_NOT_VERIFIED');
    }
    if (!plugin_agentbdmosassetsync_notes_native_can($stored->fields, READ)) {
        throw new RuntimeException('ASB_NOTE_CAPTURE_READ_DENIED');
    }
    if (!plugin_agentbdmosassetsync_notes_native_supported($stored->fields)) {
        throw new RuntimeException('ASB_NOTE_CAPTURE_UNSUPPORTED_EMBEDDED_FILE_CONTENT');
    }
    return $stored->fields;
}

/** A failed capture must not leave an older instant asserted for a newly saved value. */
function plugin_agentbdmosassetsync_note_capture_invalidate(CommonDBTM $note, array $capture, array $route): void
{
    global $DB;
    try {
        $id = $capture['note_id'] ?? (int) $note->getID();
        if ($id < 1) {
            return;
        }
        $criteria = ['route_id' => $route['route_id'], 'itemtype' => $capture['itemtype'],
            'a_entities_id' => (int) $route['a_entities_id'], 'entities_id' => (int) $route['entities_id'],
            'b_items_id' => $capture['items_id'], 'b_notes_id' => $id];
        $table = plugin_agentbdmosassetsync_notes_table();
        if (!$DB->update($table, ['value_reliable' => 0, 'value_changed_at' => null], $criteria)) {
            throw new RuntimeException('ASB_NOTE_CAPTURE_MANUAL_RECONCILIATION_REQUIRED');
        }
        foreach ($DB->request(['FROM' => $table, 'WHERE' => $criteria]) as $row) {
            if ((int) $row['value_reliable'] !== 0 || $row['value_changed_at'] !== null) {
                throw new RuntimeException('ASB_NOTE_CAPTURE_MANUAL_RECONCILIATION_REQUIRED');
            }
        }
    } catch (Throwable $e) {
        plugin_agentbdmosassetsync_capture_log($note, 'note-evidence',
            new RuntimeException('ASB_NOTE_CAPTURE_MANUAL_RECONCILIATION_REQUIRED'), $route['route_id']);
    }
}

/** The ledger and Change share a savepoint; failure leaves the human's already-saved Note alone. */
function plugin_agentbdmosassetsync_note_capture_queue(CommonDBTM $note, array $capture,
    array $saved, array $route): void
{
    global $DB;
    $transaction = false;
    try {
        $DB->beginTransaction();
        $transaction = true;
        $verified = plugin_agentbdmosassetsync_note_capture_saved($note, $capture);
        if ($verified['content'] !== $saved['content']) {
            throw new RuntimeException('ASB_NOTE_CAPTURE_CONTENT_CHANGED');
        }
        $parent = plugin_agentbdmosassetsync_note_capture_parent($capture['itemtype'], $capture['items_id']);
        if ((int) $parent->getEntityID() !== (int) $route['entities_id']) {
            $DB->rollBack();
            plugin_agentbdmosassetsync_note_capture_invalidate($note, $capture, $route);
            return;
        }
        $identity = plugin_agentbdmosassetsync_capture_identity($parent, $route);
        if ($identity === null) {
            $DB->rollBack();
            plugin_agentbdmosassetsync_note_capture_invalidate($note, $capture, $route);
            return;
        }
        $scope = ['route_id' => $route['route_id'], 'itemtype' => $capture['itemtype'],
            'a_entities_id' => (int) $route['a_entities_id'], 'entities_id' => (int) $route['entities_id'],
            'a_items_id' => $identity['a_items_id']];
        plugin_agentbdmosassetsync_notes_check_parent($parent, $scope, READ);
        $link = plugin_agentbdmosassetsync_notes_link_by_b($scope, $capture['items_id'], (int) $saved['id'], true);
        if ($link !== null && ($link['state'] !== 'Linked'
            || ($link['a_items_id'] !== null && $identity['a_items_id'] !== null
                && (int) $link['a_items_id'] !== $identity['a_items_id']))) {
            throw new RuntimeException('ASB_NOTE_CAPTURE_ASSOCIATION_UNCERTAIN');
        }
        $values = $scope + ['b_items_id' => $capture['items_id'], 'b_notes_id' => (int) $saved['id'],
            'state' => 'Linked', 'content_hash' => hash('sha256', $saved['content']),
            'value_changed_at' => $capture['time'], 'value_reliable' => 1,
            'last_local_changed_at' => $capture['time']];
        if ($link === null) {
            $values['a_notes_id'] = null;
            $values['reservation_works_id'] = null;
        } elseif ($identity['a_items_id'] === null) {
            unset($values['a_items_id']);
        }
        $link = plugin_agentbdmosassetsync_notes_save_link($values, $link === null ? null : (int) $link['id']);
        $snapshot = ['a_notes_id' => $link['a_notes_id'] === null ? null : (int) $link['a_notes_id'],
            'b_notes_id' => (int) $saved['id'], 'content' => $saved['content'],
            'changed_at' => $capture['time'], 'reliable' => true];
        $change = new PluginAgentbdmosassetsyncChange();
        $change->createCapturedChange(['route_id' => $route['route_id'],
            'settings_version' => (int) $route['settings_version'],
            'a_entities_id' => (int) $route['a_entities_id'], 'entities_id' => (int) $route['entities_id'],
            'itemtype' => $capture['itemtype'], 'identity_json' => json_encode($identity, JSON_THROW_ON_ERROR),
            'subject' => 'Note', 'changed_fields_json' => '{}',
            'note_json' => json_encode($snapshot, JSON_THROW_ON_ERROR)]);
        $DB->commit();
    } catch (Throwable $e) {
        if ($transaction) {
            try {
                $DB->rollBack();
            } catch (Throwable $rollbackError) {
                plugin_agentbdmosassetsync_capture_log($note, 'note-rollback', $rollbackError, $route['route_id']);
            }
        }
        throw $e;
    }
}
