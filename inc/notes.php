<?php

function plugin_agentbdmosassetsync_notes_table(): string
{
    return 'glpi_plugin_agentbdmosassetsync_notelinks';
}

/** Native and custom assets expose Notes capacity through their actual declared rights. */
function plugin_agentbdmosassetsync_notes_capable(string $itemtype): bool
{
    if (!in_array($itemtype, plugin_agentbdmosassetsync_asset_types(), true)
        || !is_subclass_of($itemtype, CommonDBTM::class)) {
        return false;
    }
    $parent = new $itemtype();
    $rights = $parent->getRights('central');
    return array_key_exists(READNOTE, $rights) && array_key_exists(UPDATENOTE, $rights);
}

function plugin_agentbdmosassetsync_notes_check_parent(CommonDBTM $parent, array $scope, int $right): void
{
    if ($parent::class !== $scope['itemtype']
        || !plugin_agentbdmosassetsync_notes_capable($scope['itemtype'])
        || !$parent->isEntityAssign()
        || !Session::haveAccessToEntity((int) $scope['entities_id'])
        || !Session::haveRight($parent::$rightname, READ)
        || !Session::haveRight($parent::$rightname, READNOTE)
        || ($right !== READ && !Session::haveRight($parent::$rightname, UPDATENOTE))) {
        throw new RuntimeException('Hold: native Notes capability or parent Notes permission unavailable');
    }
    if ($parent->getID() > 0) {
        require_once __DIR__ . '/process.php';
        plugin_agentbdmosassetsync_check_asset($parent, $scope, READ);
    } elseif ((int) $parent->getEntityID() !== (int) $scope['entities_id']) {
        throw new RuntimeException('Hold: Notes parent entity scope mismatch');
    }
}

function plugin_agentbdmosassetsync_notes_valid_payload($note, bool $snapshot = false): bool
{
    if (!plugin_agentbdmosassetsync_object_keys($note,
        ['a_notes_id', 'b_notes_id', 'content', 'changed_at', 'reliable'])
        || ($snapshot ? ($note->a_notes_id !== null && !plugin_agentbdmosassetsync_is_uint($note->a_notes_id, 1))
            : !plugin_agentbdmosassetsync_is_uint($note->a_notes_id, 1))
        || ($snapshot ? !plugin_agentbdmosassetsync_is_uint($note->b_notes_id, 1)
            : ($note->b_notes_id !== null && !plugin_agentbdmosassetsync_is_uint($note->b_notes_id, 1)))
        || !is_string($note->content) || !mb_check_encoding($note->content, 'UTF-8')
        || !is_bool($note->reliable)) {
        return false;
    }
    $time = plugin_agentbdmosassetsync_evidence_time($note->changed_at);
    return ($note->changed_at === null || $time !== null) && (!$note->reliable || $time !== null);
}

function plugin_agentbdmosassetsync_notes_inventory_payload_valid($note): bool
{
    return plugin_agentbdmosassetsync_object_keys($note, ['after_id', 'limit'])
        && plugin_agentbdmosassetsync_is_uint($note->after_id)
        && is_int($note->limit) && $note->limit >= 1 && $note->limit <= 50;
}

/** Reject file-bearing markup without modifying the submitted text or its formatting. */
function plugin_agentbdmosassetsync_notes_content_supported(string $content): bool
{
    if (!mb_check_encoding($content, 'UTF-8')
        || preg_match('/##(?:doc|document)[^#]*##/i', $content)) {
        return false;
    }
    preg_match_all('/<[^>]*>/s', $content, $tags);
    $markup = implode("\n", $tags[0]);
    if (preg_match('/<\s*(?:img|audio|video|source|picture|iframe|embed|object|svg|canvas|style|link)\b/i', $markup)
        || preg_match('/(?:url\s*\(|@import\b|data-(?:document|glpi-document))/i', $markup)) {
        return false;
    }
    // Attribute entities can conceal a native document URL, but escaped visible text is kept intact.
    if (preg_match_all('/\b(?:href|src|poster|data)\s*=\s*(?:"([^"]*)"|\'([^\']*)\'|([^\s>]+))/i', $markup, $attributes, PREG_SET_ORDER)) {
        foreach ($attributes as $attribute) {
            $url = html_entity_decode($attribute[1] !== '' ? $attribute[1]
                : (($attribute[2] ?? '') !== '' ? $attribute[2] : ($attribute[3] ?? '')), ENT_QUOTES | ENT_HTML5, 'UTF-8');
            if (preg_match('~(?:document\.(?:send|form)\.php|/(?:apirest\.php|api\.php/[^/]+)/(?:Document|Document_Item)(?:/|\?)|^(?:data|blob):)~i', $url)) {
                return false;
            }
        }
    }
    return true;
}

function plugin_agentbdmosassetsync_notes_native_supported(array $native): bool
{
    global $DB;
    return isset($native['content']) && is_string($native['content'])
        && plugin_agentbdmosassetsync_notes_content_supported($native['content'])
        && count($DB->request(['FROM' => Document_Item::getTable(), 'WHERE' => [
            'itemtype' => Notepad::class, 'items_id' => (int) $native['id']]])) === 0;
}

function plugin_agentbdmosassetsync_notes_rows(array $criteria, bool $lock = false): array
{
    global $DB;
    if (!$lock) {
        return iterator_to_array($DB->request($criteria));
    }
    $query = new DBmysqlIterator($DB);
    $query->buildQuery($criteria);
    $result = $DB->doQuery($query->getSql() . ' FOR UPDATE');
    $rows = [];
    while ($row = $DB->fetchAssoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function plugin_agentbdmosassetsync_notes_link_by_b(array $scope, int $bItemsId, int $bNoteId, bool $lock = false): ?array
{
    $rows = plugin_agentbdmosassetsync_notes_rows(['FROM' => plugin_agentbdmosassetsync_notes_table(), 'WHERE' => [
        'route_id' => $scope['route_id'], 'itemtype' => $scope['itemtype'],
        'b_items_id' => $bItemsId, 'b_notes_id' => $bNoteId]], $lock);
    if (count($rows) > 1) {
        throw new RuntimeException('Hold: competing B Note associations');
    }
    $row = $rows ? reset($rows) : null;
    if ($row !== null && ((int) $row['entities_id'] !== (int) $scope['entities_id']
        || (int) $row['a_entities_id'] !== (int) $scope['a_entities_id'])) {
        throw new RuntimeException('Hold: B Note association entity pair changed');
    }
    return $row;
}

function plugin_agentbdmosassetsync_notes_link_by_a(array $work, bool $lock = false): ?array
{
    $note = json_decode($work['note_json'], false, 512, JSON_THROW_ON_ERROR);
    $rows = plugin_agentbdmosassetsync_notes_rows(['FROM' => plugin_agentbdmosassetsync_notes_table(), 'WHERE' => [
        'route_id' => $work['route_id'], 'itemtype' => $work['itemtype'],
        'a_items_id' => (int) $work['a_items_id'], 'a_notes_id' => $note->a_notes_id]], $lock);
    if (count($rows) > 1) {
        throw new RuntimeException('Hold: competing A Note associations');
    }
    return $rows ? reset($rows) : null;
}

/** Internal B-owned persistence; callers own the transaction and any route/row locks. */
function plugin_agentbdmosassetsync_notes_save_link(array $values, ?int $id = null): array
{
    global $DB;
    $table = plugin_agentbdmosassetsync_notes_table();
    $fields = ['route_id', 'itemtype', 'a_entities_id', 'entities_id', 'a_items_id', 'a_notes_id',
        'b_items_id', 'b_notes_id', 'state', 'reservation_works_id', 'content_hash',
        'value_changed_at', 'value_reliable', 'last_local_changed_at'];
    foreach (array_keys($values) as $key) {
        if (!in_array($key, $fields, true)) {
            throw new RuntimeException('Hold: unsupported internal Note association field');
        }
    }
    if ($id === null) {
        $values += ['a_items_id' => null, 'a_notes_id' => null, 'b_notes_id' => null,
            'state' => 'Linked', 'reservation_works_id' => null, 'content_hash' => null,
            'value_changed_at' => null, 'value_reliable' => 0, 'last_local_changed_at' => null];
        if (!$DB->insert($table, $values)) {
            throw new RuntimeException('Hold: Note association insert failed');
        }
        $id = (int) $DB->insertId();
    } else {
        $before = plugin_agentbdmosassetsync_notes_rows(['FROM' => $table, 'WHERE' => ['id' => $id]], true);
        if (count($before) !== 1) {
            throw new RuntimeException('Hold: Note association disappeared');
        }
        $before = reset($before);
        foreach (['route_id', 'itemtype', 'a_entities_id', 'entities_id', 'a_items_id', 'a_notes_id', 'b_items_id', 'b_notes_id'] as $field) {
            if (array_key_exists($field, $values) && $before[$field] !== null
                && (string) $before[$field] !== (string) $values[$field]) {
                throw new RuntimeException('Hold: Note association cannot be rebound');
            }
        }
        if (!$DB->update($table, $values, ['id' => $id])) {
            throw new RuntimeException('Hold: Note association update failed');
        }
    }
    $saved = plugin_agentbdmosassetsync_notes_rows(['FROM' => $table, 'WHERE' => ['id' => $id]], true);
    if (count($saved) !== 1) {
        throw new RuntimeException('Hold: Note association could not be reread');
    }
    $saved = reset($saved);
    foreach ($values as $field => $value) {
        if (($value === null && $saved[$field] !== null)
            || ($value !== null && (string) $saved[$field] !== (string) $value)) {
            throw new RuntimeException('Hold: Note association persistence was not verified');
        }
    }
    return $saved;
}

function plugin_agentbdmosassetsync_notes_evidence(?array $link, string $content): array
{
    if ($link !== null && $link['state'] === 'Linked'
        && $link['content_hash'] === hash('sha256', $content) && (int) $link['value_reliable'] === 1
        && plugin_agentbdmosassetsync_evidence_time($link['value_changed_at']) !== null) {
        return ['changed_at' => $link['value_changed_at'], 'reliable' => true];
    }
    return ['changed_at' => null, 'reliable' => false];
}

function plugin_agentbdmosassetsync_notes_snapshot(array $native, ?array $link): array
{
    return ['a_notes_id' => $link !== null && $link['a_notes_id'] !== null ? (int) $link['a_notes_id'] : null,
        'b_notes_id' => (int) $native['id'], 'content' => $native['content']]
        + plugin_agentbdmosassetsync_notes_evidence($link, $native['content']);
}

function plugin_agentbdmosassetsync_notes_parent(array $work, bool $lock = false, bool $write = false): array
{
    $route = plugin_agentbdmosassetsync_current_route($work);
    if (!in_array($work['itemtype'], json_decode($route['notes_itemtypes_json'], true, 512, JSON_THROW_ON_ERROR), true)) {
        throw new RuntimeException('Hold: Notes are disabled for this parent itemtype');
    }
    $parent = plugin_agentbdmosassetsync_find_existing($work, false, false, true);
    if ($lock) {
        plugin_agentbdmosassetsync_lock_current_asset($work, $parent, READ);
    }
    plugin_agentbdmosassetsync_notes_check_parent($parent, $work, $write ? UPDATENOTE : READ);
    return [$route, $parent];
}

function plugin_agentbdmosassetsync_notes_native_can(array $native, int $right): bool
{
    $note = new Notepad();
    $note->getFromResultSet($native);
    return $note->can((int) $native['id'], $right);
}

function plugin_agentbdmosassetsync_notes_read_native(CommonDBTM $parent, int $id, bool $lock = false): array
{
    $rows = plugin_agentbdmosassetsync_notes_rows(['FROM' => Notepad::getTable(), 'WHERE' => ['id' => $id]], $lock);
    if (count($rows) !== 1) {
        throw new RuntimeException('Hold: associated native Note is missing');
    }
    $native = reset($rows);
    if ($native['itemtype'] !== $parent::class || (int) $native['items_id'] !== (int) $parent->getID()) {
        throw new RuntimeException('Hold: native Note parent does not match the verified parent');
    }
    if (!plugin_agentbdmosassetsync_notes_native_can($native, READ)) {
        throw new RuntimeException('Hold: native Note read permission denied');
    }
    if (!plugin_agentbdmosassetsync_notes_native_supported($native)) {
        throw new RuntimeException('Hold: Unsupported embedded file content');
    }
    return $native;
}

function plugin_agentbdmosassetsync_notes_check_link(array $work, CommonDBTM $parent, array $link, stdClass $incoming): void
{
    if ($link['state'] !== 'Linked' || $link['b_notes_id'] === null
        || (int) $link['b_items_id'] !== (int) $parent->getID()
        || (int) $link['entities_id'] !== (int) $work['entities_id']
        || (int) $link['a_entities_id'] !== (int) $work['a_entities_id']
        || ($link['a_items_id'] !== null && (int) $link['a_items_id'] !== (int) $work['a_items_id'])
        || ($link['a_notes_id'] !== null && (int) $link['a_notes_id'] !== $incoming->a_notes_id)
        || ($incoming->b_notes_id !== null && (int) $link['b_notes_id'] !== $incoming->b_notes_id)) {
        throw new RuntimeException('Hold: reserved, uncertain, or mismatched Note association requires review');
    }
}

/** A complete exact-content lookup is used only while establishing the first ID pair. */
function plugin_agentbdmosassetsync_notes_match(array $work, CommonDBTM $parent, string $content): ?array
{
    $matches = [];
    $rows = plugin_agentbdmosassetsync_notes_rows(['FROM' => Notepad::getTable(), 'WHERE' => [
        'itemtype' => $work['itemtype'], 'items_id' => (int) $parent->getID()]], true);
    foreach ($rows as $row) {
        if ($row['content'] !== $content) {
            continue;
        }
        if (!plugin_agentbdmosassetsync_notes_native_can($row, READ)) {
            throw new RuntimeException('Hold: matching native Note is not permitted');
        }
        if (!plugin_agentbdmosassetsync_notes_native_supported($row)) {
            throw new RuntimeException('Hold: matching Note has unsupported embedded file content');
        }
        $link = plugin_agentbdmosassetsync_notes_link_by_b($work, (int) $parent->getID(), (int) $row['id'], true);
        if ($link !== null && ($link['state'] !== 'Linked' || $link['a_notes_id'] !== null
            || ($link['a_items_id'] !== null && (int) $link['a_items_id'] !== (int) $work['a_items_id']))) {
            throw new RuntimeException('Hold: exact-content candidate is already paired or uncertain');
        }
        $matches[] = ['native' => $row, 'link' => $link];
    }
    if (count($matches) > 1) {
        throw new RuntimeException('Hold: exact-content Note match is ambiguous');
    }
    return $matches ? reset($matches) : null;
}

function plugin_agentbdmosassetsync_notes_pair(array $work, CommonDBTM $parent, stdClass $incoming,
    array $native, ?array $link): array
{
    if ($link !== null) {
        plugin_agentbdmosassetsync_notes_check_link($work, $parent, $link, $incoming);
    }
    $values = ['route_id' => $work['route_id'], 'itemtype' => $work['itemtype'],
        'a_entities_id' => (int) $work['a_entities_id'], 'entities_id' => (int) $work['entities_id'],
        'a_items_id' => (int) $work['a_items_id'], 'a_notes_id' => $incoming->a_notes_id,
        'b_items_id' => (int) $parent->getID(), 'b_notes_id' => (int) $native['id'], 'state' => 'Linked'];
    return plugin_agentbdmosassetsync_notes_save_link($values, $link === null ? null : (int) $link['id']);
}

function plugin_agentbdmosassetsync_notes_snapshot_scope(array $work, array $route, CommonDBTM $parent,
    array $row, stdClass $incoming, array $link): stdClass
{
    if (($row['subject'] ?? 'Asset') !== 'Note' || $row['route_id'] !== $work['route_id']
        || $row['itemtype'] !== $work['itemtype']
        || (int) $row['settings_version'] !== (int) $route['settings_version']
        || (int) $row['entities_id'] !== (int) $work['entities_id']
        || (int) $row['a_entities_id'] !== (int) $work['a_entities_id']) {
        throw new RuntimeException('Hold: Note correction snapshot scope mismatch: ' . $row['id']);
    }
    $identity = json_decode($row['identity_json'], false, 512, JSON_THROW_ON_ERROR);
    $note = json_decode($row['note_json'], false, 512, JSON_THROW_ON_ERROR);
    $fields = json_decode($row['changed_fields_json'], false, 512, JSON_THROW_ON_ERROR);
    if (!plugin_agentbdmosassetsync_object_keys($identity, ['a_items_id', 'b_items_id', 'serial'])
        || $identity->b_items_id !== (int) $parent->getID()
        || ($identity->a_items_id !== null && $identity->a_items_id !== (int) $work['a_items_id'])
        || !$fields instanceof stdClass || get_object_vars($fields) !== []
        || !plugin_agentbdmosassetsync_notes_valid_payload($note, true)
        || !plugin_agentbdmosassetsync_notes_content_supported($note->content)
        || $note->reliable !== true || $note->b_notes_id !== (int) $link['b_notes_id']
        || ($note->a_notes_id !== null && $note->a_notes_id !== $incoming->a_notes_id)) {
        throw new RuntimeException('Hold: Note correction snapshot identity or evidence mismatch: ' . $row['id']);
    }
    plugin_agentbdmosassetsync_notes_check_link($work, $parent, $link, $incoming);
    return $note;
}

function plugin_agentbdmosassetsync_notes_corrections(array $work, array $route, CommonDBTM $parent,
    stdClass $incoming, ?array $link): array
{
    $rows = [];
    foreach (json_decode($work['handled_change_ids_json'], true, 512, JSON_THROW_ON_ERROR) as $id) {
        $change = new PluginAgentbdmosassetsyncChange();
        if ($link === null || !$change->getFromDB($id) || !$change->can($id, READ) || !$change->can($id, UPDATE)
            || !in_array($change->fields['status'], ['Pending', 'Done'], true)) {
            throw new RuntimeException('Hold: Note correction snapshot missing, unassociated, or denied: ' . $id);
        }
        plugin_agentbdmosassetsync_notes_snapshot_scope($work, $route, $parent, $change->fields, $incoming, $link);
        $rows[$id] = $change->fields;
    }
    return $rows;
}

function plugin_agentbdmosassetsync_notes_begin_corrections(array $rows): void
{
    foreach ($rows as $id => $row) {
        if ($row['status'] === 'Pending' && !(new PluginAgentbdmosassetsyncChange())->recordCorrectionAttempt((int) $id)) {
            $fresh = new PluginAgentbdmosassetsyncChange();
            if (!$fresh->getFromDB($id) || $fresh->fields['status'] !== 'Done') {
                throw new RuntimeException('Hold: Note correction attempt could not be recorded: ' . $id);
            }
        }
    }
}

function plugin_agentbdmosassetsync_notes_revision_covered(array $current, stdClass $snapshot): bool
{
    if ($current['content'] === $snapshot->content) {
        return true;
    }
    $currentTime = $current['reliable'] ? plugin_agentbdmosassetsync_evidence_time($current['changed_at']) : null;
    $snapshotTime = $snapshot->reliable ? plugin_agentbdmosassetsync_evidence_time($snapshot->changed_at) : null;
    return $currentTime !== null && $snapshotTime !== null && $currentTime > $snapshotTime;
}

function plugin_agentbdmosassetsync_notes_decision(stdClass $incoming, array $current): string
{
    if ($incoming->content === $current['content']) {
        return 'AlreadyEqual';
    }
    $aTime = $incoming->reliable ? plugin_agentbdmosassetsync_evidence_time($incoming->changed_at) : null;
    $bTime = $current['reliable'] ? plugin_agentbdmosassetsync_evidence_time($current['changed_at']) : null;
    if ($aTime === null || $bTime === null || $aTime == $bTime) {
        return 'Held';
    }
    return $aTime > $bTime ? 'AppliedToB' : 'ReturnToA';
}

/** Commit the A reservation before any native add can run, including its nested GLPI hooks. */
function plugin_agentbdmosassetsync_notes_prepare_sync(array $work, stdClass $incoming): array
{
    global $DB;
    $DB->beginTransaction();
    try {
        [$route, $parent] = plugin_agentbdmosassetsync_notes_parent($work, true);
        $link = plugin_agentbdmosassetsync_notes_link_by_a($work, true);
        $native = null;
        if ($link !== null) {
            plugin_agentbdmosassetsync_notes_check_link($work, $parent, $link, $incoming);
            $native = plugin_agentbdmosassetsync_notes_read_native($parent, (int) $link['b_notes_id'], true);
        } elseif ($incoming->b_notes_id !== null) {
            $native = plugin_agentbdmosassetsync_notes_read_native($parent, $incoming->b_notes_id, true);
            $link = plugin_agentbdmosassetsync_notes_link_by_b($work, (int) $parent->getID(), $incoming->b_notes_id, true);
            if ($link !== null) {
                plugin_agentbdmosassetsync_notes_check_link($work, $parent, $link, $incoming);
            }
        } else {
            $match = plugin_agentbdmosassetsync_notes_match($work, $parent, $incoming->content);
            if ($match !== null) {
                $native = $match['native'];
                $link = $match['link'];
            }
        }
        // Every supplied reference is checked before association writes or attempt metadata.
        $corrections = plugin_agentbdmosassetsync_notes_corrections($work, $route, $parent, $incoming, $link);
        if ($native !== null) {
            $link = plugin_agentbdmosassetsync_notes_pair($work, $parent, $incoming, $native, $link);
        } else {
            plugin_agentbdmosassetsync_notes_check_parent($parent, $work, UPDATENOTE);
            $link = plugin_agentbdmosassetsync_notes_save_link(['route_id' => $work['route_id'],
                'itemtype' => $work['itemtype'], 'a_entities_id' => (int) $work['a_entities_id'],
                'entities_id' => (int) $work['entities_id'], 'a_items_id' => (int) $work['a_items_id'],
                'a_notes_id' => $incoming->a_notes_id, 'b_items_id' => (int) $parent->getID(),
                'state' => 'Reserved', 'reservation_works_id' => (int) $work['id']]);
        }
        $DB->commit();
        return ['link' => $link, 'parent_id' => (int) $parent->getID(), 'corrections' => $corrections,
            'create' => $native === null];
    } catch (Throwable $e) {
        try {
            $DB->rollBack();
        } catch (Throwable $rollbackError) {
            throw new RuntimeException('Hold: Note association transaction rollback is uncertain', 0, $rollbackError);
        }
        throw $e;
    }
}

function plugin_agentbdmosassetsync_notes_save_native(array $work, stdClass $incoming, array $prepared): array
{
    global $DB;
    $attempted = false;
    $completionAttempted = false;
    $DB->beginTransaction();
    try {
        [$route, $parent] = plugin_agentbdmosassetsync_notes_parent($work, true);
        if ((int) $parent->getID() !== $prepared['parent_id']) {
            throw new RuntimeException('Hold: verified Notes parent changed');
        }
        $link = plugin_agentbdmosassetsync_notes_link_by_a($work, true);
        if ($link === null || (int) $link['id'] !== (int) $prepared['link']['id']) {
            throw new RuntimeException('Hold: Note association changed');
        }
        if ($prepared['create']) {
            if ($link['state'] !== 'Reserved' || $link['b_notes_id'] !== null
                || (int) $link['reservation_works_id'] !== (int) $work['id']) {
                throw new RuntimeException('Hold: A Note reservation is not available for this attempt');
            }
            if (plugin_agentbdmosassetsync_notes_match($work, $parent, $incoming->content) !== null) {
                throw new RuntimeException('Hold: Note appeared after reservation; review before creation');
            }
            $outcome = 'Created';
            $native = null;
        } else {
            plugin_agentbdmosassetsync_notes_check_link($work, $parent, $link, $incoming);
            $native = plugin_agentbdmosassetsync_notes_read_native($parent, (int) $link['b_notes_id'], true);
            plugin_agentbdmosassetsync_notes_corrections($work, $route, $parent, $incoming, $link);
            $outcome = plugin_agentbdmosassetsync_notes_decision($incoming,
                plugin_agentbdmosassetsync_notes_snapshot($native, $link));
        }
        if (in_array($outcome, ['Created', 'AppliedToB'], true)) {
            plugin_agentbdmosassetsync_notes_check_parent($parent, $work, UPDATENOTE);
            $note = new Notepad();
            $input = $native === null
                ? ['itemtype' => $parent::class, 'items_id' => (int) $parent->getID(),
                    'content' => $incoming->content, 'visible_from_ticket' => 0]
                : ['id' => (int) $native['id'], 'content' => $incoming->content,
                    'visible_from_ticket' => (int) $native['visible_from_ticket']];
            if ($native === null) {
                $permitted = $note->can(-1, CREATE, $input);
            } else {
                $note->getFromResultSet($native);
                $permitted = $note->can((int) $native['id'], UPDATE);
            }
            if (!$permitted) {
                throw new RuntimeException('Hold: native Note create/update permission denied');
            }
            $saved = plugin_agentbdmosassetsync_sync_guard(static function () use ($native, $note, $input, &$attempted) {
                $attempted = true;
                if ($native === null) {
                    return $note->add($input);
                }
                return $note->update($input);
            });
            $id = $native === null ? (int) $saved : (int) $native['id'];
            if (!$saved || $id < 1) {
                throw new RuntimeException('Hold: native Note save did not confirm success');
            }
            $fresh = plugin_agentbdmosassetsync_notes_read_native($parent, $id, true);
            $actor = (int) Session::getLoginUserID();
            if ($fresh['content'] !== $incoming->content
                || (int) $fresh['users_id_lastupdater'] !== $actor
                || ($native === null && ((int) $fresh['users_id'] !== $actor || (int) $fresh['visible_from_ticket'] !== 0))
                || ($native !== null && ((int) $fresh['users_id'] !== (int) $native['users_id']
                    || (int) $fresh['visible_from_ticket'] !== (int) $native['visible_from_ticket']))) {
                throw new RuntimeException('Hold: native Note save reread did not preserve the required content/metadata');
            }
            $link = plugin_agentbdmosassetsync_notes_save_link(['b_notes_id' => $id, 'state' => 'Linked',
                'content_hash' => hash('sha256', $fresh['content']), 'value_changed_at' => $incoming->changed_at,
                'value_reliable' => $incoming->reliable ? 1 : 0], (int) $link['id']);
            $native = $fresh;
        }
        $snapshot = plugin_agentbdmosassetsync_notes_snapshot($native, $link);
        $completionAttempted = true;
        $DB->commit();
        return ['outcome' => $outcome, 'note' => $snapshot, 'b_items_id' => (int) $parent->getID(),
            'reason' => $outcome === 'Held' ? 'Differing Notes lack two distinct reliable genuine revision times' : null];
    } catch (Throwable $e) {
        try {
            $DB->rollBack();
        } catch (Throwable $rollbackError) {
            $e = new RuntimeException('Hold: native Note transaction rollback is uncertain', 0, $rollbackError);
            $attempted = true;
        }
        if ($attempted || $completionAttempted) {
            $uncertainTransactionStarted = false;
            try {
                $DB->beginTransaction();
                $uncertainTransactionStarted = true;
                plugin_agentbdmosassetsync_notes_save_link(['state' => 'Uncertain'], (int) $prepared['link']['id']);
                $DB->commit();
                $uncertainTransactionStarted = false;
            } catch (Throwable $ledgerError) {
                if ($uncertainTransactionStarted) {
                    $DB->rollBack();
                }
                throw new RuntimeException('Hold: native Note and association outcomes are uncertain; reconcile before new Work', 0, $ledgerError);
            }
            throw new RuntimeException('Hold: native Note outcome is uncertain; durable association blocks replay', 0, $e);
        }
        throw $e;
    }
}

function plugin_agentbdmosassetsync_notes_inventory(array $work): array
{
    [$route, $parent] = plugin_agentbdmosassetsync_notes_parent($work);
    $input = json_decode($work['note_json'], false, 512, JSON_THROW_ON_ERROR);
    $rows = plugin_agentbdmosassetsync_notes_rows(['FROM' => Notepad::getTable(), 'WHERE' => [
        'itemtype' => $work['itemtype'], 'items_id' => (int) $parent->getID(), 'id' => ['>', $input->after_id]],
        'ORDER' => 'id ASC', 'LIMIT' => $input->limit + 1]);
    $result = ['b_items_id' => (int) $parent->getID(), 'notes' => [], 'skipped_notes' => [],
        'has_more' => count($rows) > $input->limit, 'next_after_id' => $input->after_id];
    foreach (array_slice($rows, 0, $input->limit) as $native) {
        $result['next_after_id'] = (int) $native['id'];
        if (!plugin_agentbdmosassetsync_notes_native_can($native, READ)) {
            throw new RuntimeException('Hold: Inventory native Note read permission denied');
        }
        if (!plugin_agentbdmosassetsync_notes_native_supported($native)) {
            $result['skipped_notes'][] = ['b_notes_id' => (int) $native['id'], 'reason' => 'Unsupported embedded file content'];
            continue;
        }
        $link = plugin_agentbdmosassetsync_notes_link_by_b($work, (int) $parent->getID(), (int) $native['id']);
        $result['notes'][] = plugin_agentbdmosassetsync_notes_snapshot($native, $link);
    }
    return $result;
}

/** Coverage never mutates an unrelated snapshot or completes a ReturnToA revision. */
function plugin_agentbdmosassetsync_notes_finish_corrections(PluginAgentbdmosassetsyncWork $record,
    array $work, stdClass $incoming, array &$result): array
{
    global $DB;
    [$route, $parent] = plugin_agentbdmosassetsync_notes_parent($work);
    $link = plugin_agentbdmosassetsync_notes_link_by_a($work);
    $failures = [];
    $rows = plugin_agentbdmosassetsync_notes_corrections($work, $route, $parent, $incoming, $link);
    $known = [];
    foreach ($DB->request(['FROM' => PluginAgentbdmosassetsyncChange::getTable(), 'WHERE' => [
        'subject' => 'Note', 'route_id' => $work['route_id'], 'itemtype' => $work['itemtype'], 'status' => 'Pending'],
        'ORDER' => 'id ASC']) as $row) {
        $known[(int) $row['id']] = $row;
    }
    foreach ($rows as $id => $row) {
        $known[(int) $id] = $row;
    }
    foreach ($known as $id => $row) {
        try {
            $change = new PluginAgentbdmosassetsyncChange();
            if (!$change->getFromDB($id) || !$change->can($id, READ)) {
                continue;
            }
            $snapshot = plugin_agentbdmosassetsync_notes_snapshot_scope($work, $route, $parent, $change->fields, $incoming, $link);
            $covered = $change->fields['status'] === 'Done'
                || ($result['note_outcome'] !== 'Held'
                    && plugin_agentbdmosassetsync_notes_revision_covered($result['note'], $snapshot));
            if ($covered) {
                $result['covered_change_ids'][] = $id;
            }
            if (!isset($rows[$id])) {
                continue;
            }
            if ($change->fields['status'] === 'Done') {
                $result['handled_change_ids_done'][] = $id;
                continue;
            }
            if ($result['note_outcome'] === 'ReturnToA') {
                if (!$covered && !$change->recordCorrectionFailure($id,
                    'Returned Note does not cover this newer or uncertain snapshot; it remains Pending')) {
                    throw new RuntimeException('Uncovered Note snapshot reason could not be verified');
                }
                continue;
            }
            if (!$covered || !in_array($result['note_outcome'], ['AlreadyEqual', 'Created', 'AppliedToB'], true)) {
                throw new RuntimeException('Snapshot revision is not demonstrably covered by the incoming Note');
            }
            $DB->beginTransaction();
            try {
                [$freshRoute, $freshParent] = plugin_agentbdmosassetsync_notes_parent($work, true);
                $freshLink = plugin_agentbdmosassetsync_notes_link_by_a($work, true);
                $current = plugin_agentbdmosassetsync_notes_read_native($freshParent, (int) $freshLink['b_notes_id'], true);
                $locked = plugin_agentbdmosassetsync_notes_rows(['FROM' => PluginAgentbdmosassetsyncChange::getTable(),
                    'WHERE' => ['id' => $id]], true);
                if (count($locked) !== 1) {
                    throw new RuntimeException('Exact Note snapshot completion is no longer permitted');
                }
                $change->getFromResultSet(reset($locked));
                if (!$change->can($id, READ) || !$change->can($id, UPDATE)) {
                    throw new RuntimeException('Exact Note snapshot completion is no longer permitted');
                }
                $snapshot = plugin_agentbdmosassetsync_notes_snapshot_scope($work, $freshRoute, $freshParent,
                    $change->fields, $incoming, $freshLink);
                $current = plugin_agentbdmosassetsync_notes_snapshot($current, $freshLink);
                if ($current['content'] !== $incoming->content
                    || !plugin_agentbdmosassetsync_notes_revision_covered($current, $snapshot)
                    || ($change->fields['status'] !== 'Done' && !$change->markDoneInternally($id))) {
                    throw new RuntimeException('Exact Note snapshot completion was not verified');
                }
                $result['handled_change_ids_done'][] = $id;
                if (!$record->saveProcessorFields((int) $work['id'], ['result_json' => json_encode($result, JSON_THROW_ON_ERROR)])) {
                    throw new RuntimeException('Note correction progress could not be saved');
                }
                $DB->commit();
            } catch (Throwable $e) {
                $result['handled_change_ids_done'] = array_values(array_diff($result['handled_change_ids_done'], [$id]));
                $DB->rollBack();
                throw $e;
            }
        } catch (Throwable $e) {
            if (!isset($rows[$id])) {
                continue;
            }
            $reason = 'Note snapshot ' . $id . ': ' . ($e instanceof RuntimeException ? $e->getMessage() : 'uncertain correction outcome');
            $failures[] = $reason;
            if (!(new PluginAgentbdmosassetsyncChange())->recordCorrectionFailure($id, $reason)) {
                $fresh = new PluginAgentbdmosassetsyncChange();
                if (!$fresh->getFromDB($id) || $fresh->fields['status'] !== 'Done') {
                    $failures[] = 'Correction failure metadata could not be verified: ' . $id;
                }
            }
        }
    }
    $result['covered_change_ids'] = array_values(array_unique($result['covered_change_ids']));
    $result['handled_change_ids_done'] = array_values(array_unique($result['handled_change_ids_done']));
    return $failures;
}

function plugin_agentbdmosassetsync_process_note_work(PluginAgentbdmosassetsyncWork $record): void
{
    $work = $record->fields;
    $inventory = $work['operation'] === 'Inventory';
    $result = $inventory
        ? ['b_items_id' => null, 'notes' => [], 'skipped_notes' => [], 'has_more' => false, 'next_after_id' => 0]
        : ['b_items_id' => null, 'note_outcome' => 'Held', 'note' => null,
            'covered_change_ids' => [], 'handled_change_ids_done' => []];
    $status = 'Held';
    $reason = null;
    try {
        plugin_agentbdmosassetsync_route_action($work, static function () use ($record, $work, $inventory, &$result, &$status, &$reason) {
            if ($inventory) {
                $result = plugin_agentbdmosassetsync_notes_inventory($work);
                $status = 'Done';
                return;
            }
            $incoming = json_decode($work['note_json'], false, 512, JSON_THROW_ON_ERROR);
            if (!plugin_agentbdmosassetsync_notes_valid_payload($incoming)
                || !plugin_agentbdmosassetsync_notes_content_supported($incoming->content)) {
                throw new RuntimeException('Hold: Unsupported embedded file content or invalid Note revision');
            }
            [, $parent] = plugin_agentbdmosassetsync_notes_parent($work);
            $result['b_items_id'] = (int) $parent->getID();
            $prepared = plugin_agentbdmosassetsync_notes_prepare_sync($work, $incoming);
            $result['b_items_id'] = $prepared['parent_id'];
            plugin_agentbdmosassetsync_notes_begin_corrections($prepared['corrections']);
            try {
                $saved = plugin_agentbdmosassetsync_notes_save_native($work, $incoming, $prepared);
                $result['note_outcome'] = $saved['outcome'];
                $result['note'] = $saved['note'];
                $reason = $saved['reason'];
                $status = $saved['outcome'] === 'Held' ? 'Held' : 'Done';
                $failures = plugin_agentbdmosassetsync_notes_finish_corrections($record, $work, $incoming, $result);
                if ($failures !== []) {
                    $reason = implode('; ', $failures);
                    $status = 'Held';
                }
            } catch (Throwable $e) {
                foreach ($prepared['corrections'] as $id => $row) {
                    try {
                        $change = new PluginAgentbdmosassetsyncChange();
                        if ($change->getFromDB($id) && $change->fields['status'] === 'Pending'
                            && $change->can($id, READ) && $change->can($id, UPDATE)) {
                            $change->recordCorrectionFailure($id, 'Note correction outcome is uncertain; review its Work result');
                        }
                    } catch (Throwable $metadataError) {
                        // The Work remains Held even when its validated snapshot metadata cannot be saved.
                    }
                }
                throw $e;
            }
        });
    } catch (Throwable $e) {
        $status = 'Held';
        $reason = $e instanceof RuntimeException ? $e->getMessage() : 'Hold: Notes processing outcome is uncertain';
        if (!$inventory) {
            $result['note_outcome'] = 'Held';
        }
    }
    if (!$record->saveProcessorFields((int) $work['id'], ['b_items_id' => null, 'link_state' => null,
        'status' => $status, 'error' => $reason, 'result_json' => json_encode($result, JSON_THROW_ON_ERROR),
        'completed_at' => $status === 'Done' ? Session::getCurrentTime() : null])) {
        throw new RuntimeException('Hold: Note Work finalization was not verified; started marker prevents replay');
    }
}

/** Acknowledging an immutable old snapshot tolerates setting changes, never changed ownership. */
function plugin_agentbdmosassetsync_notes_check_acknowledgement(array $change, stdClass $identity, stdClass $note): void
{
    global $DB;
    require_once __DIR__ . '/process.php';
    if (!plugin_agentbdmosassetsync_notes_valid_payload($note, true)) {
        plugin_agentbdmosassetsync_fail('ASB_CHANGE_IDENTITY_UNAVAILABLE: reason=note');
    }
    $owners = plugin_agentbdmosassetsync_notes_rows(['FROM' => PluginAgentbdmosassetsyncWork::getTable(), 'WHERE' => [
        'subject' => 'Asset', 'route_id' => $change['route_id'], 'itemtype' => $change['itemtype'],
        'b_items_id' => $identity->b_items_id, 'link_state' => ['Active', 'Suspended']], 'ORDER' => 'id DESC'], true);
    $aIds = array_values(array_unique(array_map('intval', array_column($owners, 'a_items_id'))));
    if (count($aIds) !== 1 || $aIds[0] < 1
        || ($identity->a_items_id !== null && $identity->a_items_id !== $aIds[0])) {
        plugin_agentbdmosassetsync_fail('ASB_CHANGE_IDENTITY_UNAVAILABLE: reason=verified_note_parent');
    }
    $scope = $change;
    $scope['a_items_id'] = $aIds[0];
    $scope['identity_json'] = json_encode(['a_items_id' => $aIds[0],
        'b_items_id' => $identity->b_items_id, 'serial' => $identity->serial], JSON_THROW_ON_ERROR);
    try {
        $parent = plugin_agentbdmosassetsync_find_existing($scope, false, false, true);
        plugin_agentbdmosassetsync_notes_check_parent($parent, $scope, READ);
        $nativeRows = plugin_agentbdmosassetsync_notes_rows(['FROM' => Notepad::getTable(),
            'WHERE' => ['id' => $note->b_notes_id]], true);
        if (count($nativeRows) !== 1) {
            throw new RuntimeException('Acknowledged Note is missing');
        }
        $native = reset($nativeRows);
        if ($native['itemtype'] !== $parent::class || (int) $native['items_id'] !== (int) $parent->getID()
            || !plugin_agentbdmosassetsync_notes_native_can($native, READ)) {
            throw new RuntimeException('Acknowledged Note parent or read permission changed');
        }
        $link = plugin_agentbdmosassetsync_notes_link_by_b($scope, (int) $parent->getID(), $note->b_notes_id, true);
        if ($link === null || $link['state'] !== 'Linked'
            || ($link['a_items_id'] !== null && (int) $link['a_items_id'] !== $aIds[0])
            || ($note->a_notes_id !== null && (int) $link['a_notes_id'] !== $note->a_notes_id)) {
            throw new RuntimeException('Note association changed or is unavailable');
        }
    } catch (Throwable $e) {
        plugin_agentbdmosassetsync_fail('ASB_CHANGE_SCOPE_MISMATCH: reason=note_identity_or_permission');
    }
}
