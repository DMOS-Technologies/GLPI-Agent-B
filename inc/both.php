<?php

/** Compare transport values before asking whether A's losing value can be saved in B. */
function plugin_agentbdmosassetsync_comparison_value(array $field, stdClass $mapping, $value)
{
    if ($field['kind'] === 'dropdown') {
        if (!in_array($mapping->value_mode, ['text_to_dropdown', 'dropdown_label_to_dropdown'], true)
            || ($value !== null && !is_string($value))) {
            throw new RuntimeException('Dropdown comparison requires a readable label');
        }
        return $value;
    }
    if (!in_array($mapping->value_mode, ['direct', 'dropdown_label_to_text'], true)
        || ($mapping->value_mode === 'dropdown_label_to_text' && $field['kind'] !== 'text')) {
        throw new RuntimeException('Comparison conversion does not match destination field kind');
    }
    if ($value === null) {
        return null;
    }
    if (in_array($field['kind'], ['text', 'date', 'datetime'], true) && is_string($value)) {
        return $value;
    }
    if ($field['kind'] === 'boolean' && is_bool($value)) {
        return $value;
    }
    if (in_array($field['kind'], ['integer', 'number'], true) && (is_int($value) || is_float($value))) {
        return plugin_agentbdmosassetsync_number($value);
    }
    throw new RuntimeException('A value has no compatible scalar comparison type');
}

/** The caller holds the asset and actual field-storage locks for this fresh decision. */
function plugin_agentbdmosassetsync_both_decision(array $work, CommonDBTM $asset, stdClass $mapping,
    array $field, $aValue, $bValue): array
{
    $aValue = plugin_agentbdmosassetsync_comparison_value($field, $mapping, $aValue);
    if (plugin_agentbdmosassetsync_scalar_equal($aValue, $bValue)) {
        return ['outcome' => 'AlreadyEqual', 'reason' => null, 'return' => null];
    }
    $aTimes = json_decode($work['a_change_times_json'], false, 512, JSON_THROW_ON_ERROR);
    $aEvidence = $aTimes->{$mapping->mapping_id} ?? null;
    $bEvidence = plugin_agentbdmosassetsync_genuine_time($work, $asset, $mapping->mapping_id, $bValue, true);
    $aTime = $aEvidence instanceof stdClass && $aEvidence->reliable === true
        ? plugin_agentbdmosassetsync_evidence_time($aEvidence->changed_at) : null;
    $bTime = $bEvidence['reliable'] === true
        ? plugin_agentbdmosassetsync_evidence_time($bEvidence['changed_at']) : null;
    if ($aTime === null || $bTime === null) {
        return ['outcome' => 'Conflict', 'reason' => 'Unequal Both values lack two reliable genuine field times', 'return' => null];
    }
    if ($aTime == $bTime) {
        return ['outcome' => 'Conflict', 'reason' => 'Unequal Both values have equal genuine field times', 'return' => null];
    }
    if ($bTime > $aTime) {
        return ['outcome' => 'ReturnToA', 'reason' => null, 'return' => ['value' => $bValue] + $bEvidence];
    }
    return ['outcome' => 'AppliedToB', 'reason' => null, 'return' => null];
}
