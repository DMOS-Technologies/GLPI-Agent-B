<?php

function plugin_agentbdmosassetsync_rights(): array
{
    return [
        'plugin_agentbdmosassetsync_setting',
        'plugin_agentbdmosassetsync_work',
        'plugin_agentbdmosassetsync_change',
    ];
}

function plugin_agentbdmosassetsync_fail(string $message): never
{
    throw new RuntimeException($message);
}

function plugin_agentbdmosassetsync_check_fields(array $input, array $allowed, array $owned = []): void
{
    $keys = array_keys($input);
    sort($keys, SORT_STRING);
    foreach ($keys as $key) {
        if (in_array($key, $owned, true)) {
            plugin_agentbdmosassetsync_fail('ASB_B_OWNED_FIELD: field=' . $key);
        }
    }
    foreach ($keys as $key) {
        if (!in_array($key, $allowed, true)) {
            plugin_agentbdmosassetsync_fail('ASB_UNKNOWN_FIELD: field=' . $key);
        }
    }
}

function plugin_agentbdmosassetsync_require_fields(array $input, array $required): void
{
    sort($required, SORT_STRING);
    foreach ($required as $key) {
        if (!array_key_exists($key, $input)) {
            plugin_agentbdmosassetsync_fail('ASB_REQUIRED_FIELD: field=' . $key);
        }
    }
}

function plugin_agentbdmosassetsync_is_uint($value, int $minimum = 0): bool
{
    return is_int($value) && $value >= $minimum && $value <= 4294967295;
}

function plugin_agentbdmosassetsync_is_key($value): bool
{
    return is_string($value) && preg_match('/\A[A-Za-z0-9][A-Za-z0-9.-]{0,127}\z/D', $value) === 1;
}

function plugin_agentbdmosassetsync_json(string $field, $value)
{
    if (!is_string($value)) {
        plugin_agentbdmosassetsync_fail('ASB_INVALID_FIELD: field=' . $field);
    }
    try {
        return json_decode($value, false, 512, JSON_THROW_ON_ERROR);
    } catch (JsonException $e) {
        plugin_agentbdmosassetsync_fail('ASB_INVALID_FIELD: field=' . $field);
    }
}

function plugin_agentbdmosassetsync_object_keys($value, array $keys): bool
{
    if (!$value instanceof stdClass) {
        return false;
    }
    $actual = array_keys(get_object_vars($value));
    sort($actual);
    sort($keys);
    return $actual === $keys;
}

function plugin_agentbdmosassetsync_evidence_time($value): ?DateTimeImmutable
{
    if (!is_string($value) || !str_ends_with($value, '+08:00')) {
        return null;
    }
    $time = DateTimeImmutable::createFromFormat('!Y-m-d\TH:i:sP', $value);
    return $time && $time->format('Y-m-d\TH:i:sP') === $value ? $time : null;
}

function plugin_agentbdmosassetsync_read_setting(string $routeId): ?array
{
    if (!plugin_agentbdmosassetsync_is_key($routeId)) {
        plugin_agentbdmosassetsync_fail('ASB_INVALID_FIELD: field=route_id');
    }
    $setting = new PluginAgentbdmosassetsyncSetting();
    return $setting->getFromDBByCrit(['route_id' => $routeId]) ? $setting->fields : null;
}

/** Only local code calls this helper, after proving snapshot coverage. */
function markQueueRowsDone(array $ids): array
{
    foreach ($ids as $id) {
        if (!plugin_agentbdmosassetsync_is_uint($id, 1)) {
            plugin_agentbdmosassetsync_fail('ASB_INVALID_FIELD: field=ids');
        }
    }
    $results = [];
    foreach (array_unique($ids) as $id) {
        $change = new PluginAgentbdmosassetsyncChange();
        $results[$id] = $change->markDoneInternally($id);
    }
    return $results;
}

function plugin_agentbdmosassetsync_search_options(string $table, array $fields): array
{
    $options = [];
    foreach ($fields as $number => $field) {
        $options[] = [
            'id' => $number + 1, 'table' => $table, 'field' => $field,
            'name' => $field, 'datatype' => $field === 'id' ? 'integer' : 'string',
            'massiveaction' => false,
        ];
    }
    return $options;
}
