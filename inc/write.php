<?php

/** Produce a destination-local scalar; never pass a foreign dropdown ID to GLPI. */
function plugin_agentbdmosassetsync_write_value(CommonDBTM $asset, array $field, stdClass $mapping, $value)
{
    $kind = $field['kind'];
    if ($kind === 'dropdown') {
        if (!in_array($mapping->value_mode, ['text_to_dropdown', 'dropdown_label_to_dropdown'], true)
            || !is_string($value) || $value === '') {
            throw new RuntimeException('Dropdown requires a nonempty readable label and explicit lookup conversion');
        }
        return plugin_agentbdmosassetsync_dropdown_id($asset, $field, $value);
    }
    if (!in_array($mapping->value_mode, ['direct', 'dropdown_label_to_text'], true)
        || ($mapping->value_mode === 'dropdown_label_to_text' && ($kind !== 'text' || !is_string($value)))) {
        throw new RuntimeException('Conversion does not match destination field kind');
    }
    if ($value === null) {
        if ($field['custom_field_id'] !== null || $field['container_id'] !== null || $field['sql']['Null'] !== 'YES') {
            throw new RuntimeException('Destination does not have a verified nullable local writer');
        }
        return null;
    }
    if ($kind === 'text') {
        if (!is_string($value) || in_array($value, ['NULL', 'null'], true)) {
            throw new RuntimeException('Destination text requires a string representable by GLPI local methods');
        }
        $sql = strtolower($field['sql']['Type']);
        if ($field['custom_field_id'] === null) {
            if (preg_match('/\A(?:var)?char\((\d+)\)/', $sql, $length)
                && mb_strlen($value, 'UTF-8') > (int) $length[1]) {
                throw new RuntimeException('Text exceeds destination column length');
            }
            $maximum = str_starts_with($sql, 'mediumtext') ? 16777215
                : (str_starts_with($sql, 'longtext') ? 4294967295 : (str_starts_with($sql, 'text') ? 65535 : null));
            if ($maximum !== null && strlen($value) > $maximum) {
                throw new RuntimeException('Text exceeds destination storage length');
            }
        }
    } elseif ($kind === 'boolean') {
        if (!is_bool($value)) {
            throw new RuntimeException('Destination Yes/No requires a boolean');
        }
        $value = (int) $value;
    } elseif (in_array($kind, ['integer', 'number'], true)) {
        if ((!is_int($value) && !is_float($value)) || !is_finite((float) $value)) {
            throw new RuntimeException('Destination requires a compatible finite number');
        }
        $value = plugin_agentbdmosassetsync_number($value);
        if ($kind === 'integer' && !is_int($value)) {
            throw new RuntimeException('Destination integer requires an exact integral value');
        }
        if ($field['custom_field_id'] === null) {
            plugin_agentbdmosassetsync_numeric_bounds($field['sql']['Type'], $value);
        }
    } elseif (in_array($kind, ['date', 'datetime'], true)) {
        $format = $kind === 'date' ? 'Y-m-d' : 'Y-m-d H:i:s';
        $date = is_string($value) ? DateTimeImmutable::createFromFormat('!' . $format, $value) : false;
        $errors = DateTimeImmutable::getLastErrors();
        if (!$date || ($errors !== false && ($errors['warning_count'] || $errors['error_count']))
            || $date->format($format) !== $value || (int) $date->format('Y') < 1000) {
            throw new RuntimeException('Destination requires a real canonical native date/datetime');
        }
    } else {
        throw new RuntimeException('Unsupported destination scalar writer');
    }
    if ($field['custom_field_id'] !== null) {
        // GLPI's custom field formatter is authoritative; reject any lossy conversion later on reread.
        $field['custom_type']->formatValueForDB($value);
    }
    return $value;
}

function plugin_agentbdmosassetsync_numeric_bounds(string $sql, $value): void
{
    if (preg_match('/\A(tinyint|smallint|mediumint|int|bigint)\b/i', $sql, $match)) {
        $bits = ['tinyint' => 8, 'smallint' => 16, 'mediumint' => 24, 'int' => 32, 'bigint' => 64][strtolower($match[1])];
        $unsigned = stripos($sql, 'unsigned') !== false;
        $minimum = $unsigned ? 0 : -pow(2, $bits - 1);
        $maximum = $bits === 64 ? PHP_INT_MAX : pow(2, $bits - ($unsigned ? 0 : 1)) - 1;
        if (!is_int($value) || $value < $minimum || $value > $maximum) {
            throw new RuntimeException('Number exceeds destination integer range');
        }
    } elseif (preg_match('/\Adecimal\((\d+),(\d+)\)/i', $sql, $match)) {
        if (abs($value) >= pow(10, (int) $match[1] - (int) $match[2])
            || round($value, (int) $match[2]) != $value) {
            throw new RuntimeException('Number exceeds destination decimal range or precision');
        }
    }
    if (stripos($sql, 'unsigned') !== false && $value < 0) {
        throw new RuntimeException('Negative number is invalid for unsigned destination');
    }
}

function plugin_agentbdmosassetsync_dropdown_id(CommonDBTM $asset, array $field, string $label): int
{
    global $DB;
    $type = $field['dropdown_class'];
    $option = new $type();
    $column = $option instanceof CommonTreeDropdown ? 'completename' : 'name';
    if (!$type::canView() || !$DB->fieldExists($type::getTable(), $column)) {
        throw new RuntimeException('Destination dropdown options are not readable');
    }
    $matches = [];
    foreach ($DB->request(['FROM' => $type::getTable(), 'WHERE' => [$column => $label]]) as $row) {
        if ($row[$column] !== $label || !empty($row['is_deleted']) || !empty($row['is_template'])) {
            continue;
        }
        if ($option->isEntityAssign()) {
            $entity = (int) $row['entities_id'];
            $applies = $entity === (int) $asset->getEntityID()
                || (!empty($row['is_recursive']) && in_array((int) $asset->getEntityID(),
                    array_map('intval', getSonsOf('glpi_entities', $entity)), true));
            if (!$applies) {
                continue;
            }
        }
        if (!$option->getFromDB($row['id']) || !$option->can($row['id'], READ)) {
            throw new RuntimeException('Matching destination dropdown option is not permitted');
        }
        $matches[] = (int) $row['id'];
    }
    if (count($matches) !== 1) {
        throw new RuntimeException(count($matches) === 0 ? 'Destination dropdown label has no permitted exact match'
            : 'Destination dropdown label is ambiguous');
    }
    return $matches[0];
}

function plugin_agentbdmosassetsync_write_mapping(array $work, stdClass $mapping, int $assetId, $value): array
{
    global $DB;
    $lock = 'asb-setting-' . sha1($work['route_id']);
    $row = $DB->fetchAssoc($DB->doQuery("SELECT GET_LOCK('$lock', 5) AS acquired"));
    if ((int) $row['acquired'] !== 1) {
        throw new RuntimeException('Hold: route is busy');
    }
    $barrier = null;
    try {
        return plugin_agentbdmosassetsync_as_submitter($work, static function () use ($work, $mapping, $assetId, $value, &$barrier, $DB) {
            try {
                $route = plugin_agentbdmosassetsync_current_route($work);
                $asset = plugin_agentbdmosassetsync_find_existing($work);
                plugin_agentbdmosassetsync_validate_corrections($work, $route, $asset);
                if ((int) $asset->getID() !== $assetId
                    || !in_array($mapping, json_decode($route['field_mappings_json'], false, 512, JSON_THROW_ON_ERROR))) {
                    throw new RuntimeException('Current link or mapping no longer matches');
                }
                plugin_agentbdmosassetsync_check_asset($asset, $work, $mapping->source === 'Both' ? READ : UPDATE);
            } catch (RuntimeException $e) {
                throw new RuntimeException('Hold: ' . $e->getMessage());
            }
            $writeAttempted = false;
            $completionAttempted = false;
            $descriptor = plugin_agentbdmosassetsync_field_descriptor($asset, $mapping->b_field, false);
            $barrier = plugin_agentbdmosassetsync_provenance_begin($work, $asset, $mapping, $descriptor);
            try {
                $DB->beginTransaction();
            } catch (Throwable $e) {
                throw new RuntimeException('Hold: asset transaction could not be started', 0, $e);
            }
            try {
                try {
                    plugin_agentbdmosassetsync_lock_current_asset($work, $asset, $mapping->source === 'Both' ? READ : UPDATE);
                } catch (RuntimeException $e) {
                    throw new RuntimeException('Hold: ' . $e->getMessage(), 0, $e);
                }
                $field = plugin_agentbdmosassetsync_field_descriptor($asset, $mapping->b_field, $mapping->source !== 'Both');
                $current = plugin_agentbdmosassetsync_locked_value($work, $asset, $field, $mapping->source !== 'Both');
                if ($mapping->source === 'Both') {
                    $decision = plugin_agentbdmosassetsync_both_decision($work, $asset, $mapping, $field, $value, $current);
                    if ($decision['outcome'] !== 'AppliedToB') {
                        $completionAttempted = true;
                        $DB->commit();
                        plugin_agentbdmosassetsync_provenance_restore($barrier);
                        return $decision;
                    }
                    try {
                        plugin_agentbdmosassetsync_check_asset($asset, $work, UPDATE);
                        $field = plugin_agentbdmosassetsync_field_descriptor($asset, $mapping->b_field);
                    } catch (RuntimeException $e) {
                        throw new RuntimeException('Hold: A won Both but the current B write is not permitted: ' . $e->getMessage(), 0, $e);
                    }
                }
                if ($mapping->source === 'A'
                    && plugin_agentbdmosassetsync_blank_text_equal($field, $value, $current)
                    && ($field['container_id'] === null
                        || plugin_agentbdmosassetsync_locked_fields_row($asset, $field) !== null)) {
                    plugin_agentbdmosassetsync_comparison_value($field, $mapping, $value);
                    $completionAttempted = true;
                    $DB->commit();
                    plugin_agentbdmosassetsync_provenance_restore($barrier);
                    return ['outcome' => 'AlreadyEqual', 'reason' => null, 'return' => null];
                }
                $local = plugin_agentbdmosassetsync_write_value($asset, $field, $mapping, $value);
                $expected = plugin_agentbdmosassetsync_field_value($field, $local);
                if ($current === $expected) {
                    $completionAttempted = true;
                    $DB->commit();
                    plugin_agentbdmosassetsync_provenance_restore($barrier);
                    return ['outcome' => 'AlreadyEqual', 'reason' => null, 'return' => null];
                }
                try {
                    $saved = plugin_agentbdmosassetsync_sync_guard(static function () use ($asset, $field, $local, &$writeAttempted) {
                        if ($field['container_id'] !== null) {
                            return plugin_agentbdmosassetsync_write_fields($asset, $field, $local, $writeAttempted);
                        }
                        $writeAttempted = true;
                        return $asset->update(['id' => $asset->getID(), $field['value_column'] => $local]);
                    });
                    if (!$saved || !$asset->getFromDB($assetId)
                        || plugin_agentbdmosassetsync_field_read($asset, $field) !== $expected) {
                        throw new RuntimeException('Save failed: local write or reread did not confirm the intended value');
                    }
                } catch (Throwable $e) {
                    if (!$writeAttempted || ($e instanceof RuntimeException && str_starts_with($e->getMessage(), 'Save failed:'))) {
                        throw $e;
                    }
                    throw new RuntimeException('Hold: local asset write outcome is uncertain; reconcile before new Work', 0, $e);
                }
                plugin_agentbdmosassetsync_provenance_copied($work, $asset, $mapping, $field, $expected, $barrier);
                $completionAttempted = true;
                $DB->commit();
                return ['outcome' => 'AppliedToB', 'reason' => null, 'return' => null];
            } catch (Throwable $e) {
                try {
                    $DB->rollBack();
                } catch (Throwable $rollbackError) {
                    throw new RuntimeException('Hold: asset transaction rollback is uncertain; reconcile before new Work',
                        0, $rollbackError);
                }
                if ($completionAttempted) {
                    throw new RuntimeException('Hold: asset transaction completion is uncertain; reconcile before new Work', 0, $e);
                }
                if (!$writeAttempted) {
                    plugin_agentbdmosassetsync_provenance_restore($barrier);
                }
                if ($writeAttempted && !($e instanceof RuntimeException
                    && (str_starts_with($e->getMessage(), 'Save failed:') || str_starts_with($e->getMessage(), 'Hold:')))) {
                    throw new RuntimeException('Hold: attempted asset write outcome is uncertain; reconcile before new Work', 0, $e);
                }
                throw $e;
            }
        });
    } finally {
        plugin_agentbdmosassetsync_provenance_end($barrier);
        try {
            $DB->doQuery("SELECT RELEASE_LOCK('$lock')");
        } catch (Throwable $e) {
            throw new RuntimeException('Hold: route lock release failed after asset action; reconcile saved values before new Work', 0, $e);
        }
    }
}

function plugin_agentbdmosassetsync_current_value(CommonDBTM $asset, array $field)
{
    $type = $field['storage_class'];
    $stored = new $type();
    $found = $field['container_id'] === null ? $stored->getFromDB($asset->getID())
        : $stored->getFromDBByCrit(['items_id' => $asset->getID()]);
    if (!$found) {
        if ($field['container_id'] !== null) {
            return null;
        }
        throw new RuntimeException('Current field storage could not be read');
    }
    $value = $stored->fields[$field['value_column']];
    if ($field['kind'] === 'dropdown' && ($value === null || (int) $value === 0)) {
        return null;
    }
    return plugin_agentbdmosassetsync_field_value($field, $value);
}

/** Fields 1.24.4 validates values and uses generated local add/update plus asset History. */
function plugin_agentbdmosassetsync_write_fields(CommonDBTM $asset, array $field, $value, bool &$writeAttempted): bool
{
    return plugin_agentbdmosassetsync_write_fields_values($asset, $field, [$field['value_column'] => $value], $writeAttempted);
}

/** A first-copy container receives all mapped mandatory fields in one validated local save. */
function plugin_agentbdmosassetsync_write_fields_values(CommonDBTM $asset, array $field, array $values,
    ?bool &$writeAttempted = null): bool
{
    global $DB;
    $data = plugin_agentbdmosassetsync_locked_fields_row($asset, $field) ?? [];
    $status = PluginFieldsStatusOverride::getStatusFieldName($asset::class);
    $statusValue = $asset->fields[$status] ?? null;
    $overrides = $statusValue !== null
        ? PluginFieldsStatusOverride::getOverridesForItemtypeAndStatus($field['container_id'], $asset::class, $statusValue) : [];
    // Preserve unrelated multiple values when the Fields local writer normalizes the whole container.
    foreach ($DB->request(['FROM' => PluginFieldsField::getTable(),
        'WHERE' => ['plugin_fields_containers_id' => $field['container_id'], 'is_active' => 1]]) as $definition) {
        $column = $definition['type'] === 'dropdown'
            ? 'plugin_fields_' . $definition['name'] . 'dropdowns_id' : $definition['name'];
        if (array_key_exists($column, $values)) {
            foreach ($overrides as $override) {
                if ((int) $override['plugin_fields_fields_id'] === (int) $definition['id'] && $override['is_readonly']) {
                    throw new RuntimeException('Fields value is read-only for the asset current status');
                }
            }
        }
        if ($definition['multiple'] && array_key_exists($column, $data)) {
            $data[$column] = json_decode($data[$column] ?: '[]', true, 512, JSON_THROW_ON_ERROR);
        }
    }
    $data['plugin_fields_containers_id'] = $field['container_id'];
    $data['items_id'] = $asset->getID();
    $data['itemtype'] = $asset::class;
    $data['entities_id'] = $asset->getEntityID();
    $data = array_replace($data, $values);
    $data[$status] = $statusValue;
    // Everything above is pre-save validation; only the local writer can make the outcome uncertain.
    $writeAttempted = true;
    return (new PluginFieldsContainer())->updateFieldsValues($data, $asset::class);
}

/** Fields' public validator accepts partial massive-action input; never merge stored siblings. */
function plugin_agentbdmosassetsync_field_sync_fields_input(CommonDBTM $asset, array $field, $value,
    string &$code, bool $participation = false): array
{
    global $DB;
    $code = 'STORAGE_UNSUPPORTED';
    $row = plugin_agentbdmosassetsync_locked_fields_row($asset, $field);
    if ($row === null || !is_callable([PluginFieldsContainer::class, 'validateValues'])
        || !is_callable([PluginFieldsContainer::class, 'constructHistory'])) {
        throw new RuntimeException('Existing partial native Fields storage is required');
    }
    $class = $field['storage_class'];
    $stored = new $class();
    $stored->getFromResultSet($row);
    $code = 'FIELD_PERMISSION';
    if (!$stored->can((int) $row['id'], UPDATE)) {
        throw new RuntimeException('Current generated storage write permission is denied');
    }
    $statusName = PluginFieldsStatusOverride::getStatusFieldName($asset::class);
    $status = $asset->fields[$statusName] ?? null;
    $overrides = $status !== null
        ? PluginFieldsStatusOverride::getOverridesForItemtypeAndStatus($field['container_id'], $asset::class, $status) : [];
    $selected = null;
    foreach ($DB->request(['FROM' => PluginFieldsField::getTable(), 'WHERE' => [
        'plugin_fields_containers_id' => $field['container_id'], 'is_active' => 1]]) as $definition) {
        $column = $definition['type'] === 'dropdown'
            ? 'plugin_fields_' . $definition['name'] . 'dropdowns_id' : $definition['name'];
        if ($column === $field['value_column']) {
            $selected = $definition;
            break;
        }
    }
    if ($selected === null) {
        throw new RuntimeException('Selected Fields definition is unavailable');
    }
    foreach ($overrides as $override) {
        if ((int) $override['plugin_fields_fields_id'] === (int) $selected['id']) {
            $selected['is_readonly'] = $override['is_readonly'];
            $selected['mandatory'] = $override['mandatory'];
        }
    }
    // Fields' Yes/No readonly option is form metadata, not generated-row authorization.
    if ($selected['is_readonly'] && !($participation && $field['kind'] === 'boolean')) {
        throw new RuntimeException('Selected Fields value is currently read-only');
    }
    $code = 'INVALID_VALUE';
    if ($selected['mandatory'] && ($value === null || $value === ''
        || ($field['kind'] === 'dropdown' && (int) $value === 0))) {
        throw new RuntimeException('Selected Fields value is mandatory');
    }
    $data = ['id' => (int) $row['id'], 'plugin_fields_containers_id' => $field['container_id'],
        'items_id' => (int) $asset->getID(), 'itemtype' => $asset::class, $field['value_column'] => $value];
    if ($statusName === $field['value_column']) {
        $code = 'STORAGE_UNSUPPORTED';
        throw new RuntimeException('Fields validation metadata collides with the selected storage column');
    }
    $validation = $data;
    $validation[$statusName] = $status;
    if (!PluginFieldsContainer::validateValues($validation, $asset::class, true)) {
        throw new RuntimeException('Native Fields validation rejected the selected partial input');
    }
    return [$stored, $data];
}

/** These are the same public native update/history operations used by Fields 1.24.4. */
function plugin_agentbdmosassetsync_field_sync_fields_save(CommonDBTM $asset, array $field, array $prepared): bool
{
    [$stored, $data] = $prepared;
    if (!$stored->update($data)) {
        return false;
    }
    PluginFieldsContainer::constructHistory($field['container_id'], (int) $asset->getID(), $asset::class,
        $stored->input, $stored);
    return true;
}
