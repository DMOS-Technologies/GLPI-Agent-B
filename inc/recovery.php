<?php

require_once __DIR__ . '/fieldisolation.php';
require_once __DIR__ . '/recoveryassessment.php';

/** This fingerprint excludes only the new sidecar, never any original evidence. */
function plugin_agentbdmosassetsync_recovery_fingerprint(array $row): string
{
    unset($row['recovery_json']);
    return hash('sha256', json_encode(plugin_agentbdmosassetsync_evidence_canonical((object) $row),
        JSON_THROW_ON_ERROR | JSON_PRESERVE_ZERO_FRACTION));
}

function plugin_agentbdmosassetsync_recovery_job(?DBmysql $connection = null): ?array
{
    global $DB;
    $connection ??= $DB;
    $rows = iterator_to_array($connection->request(['FROM' => 'glpi_configs', 'WHERE' => [
        'context' => 'plugin:agentbdmosassetsync', 'name' => 'recovery_assessment']]));
    if ($rows === []) {
        return null;
    }
    if (count($rows) !== 1) {
        throw new RuntimeException('Recovery assessment schedule is ambiguous');
    }
    $job = json_decode(reset($rows)['value'], true, 512, JSON_THROW_ON_ERROR);
    if (!is_array($job) || ($job['version'] ?? null) !== 1
        || !is_string($job['build'] ?? null) || $job['build'] === ''
        || !is_int($job['cursor'] ?? null) || !is_int($job['high_work_id'] ?? null)
        || $job['cursor'] < 0 || $job['cursor'] > $job['high_work_id']
        || !in_array($job['state'] ?? null, ['Pending', 'Complete'], true)
        || ($job['state'] === 'Complete' && $job['cursor'] !== $job['high_work_id'])
        || !array_key_exists('next_build', $job) || !array_key_exists('next_high_work_id', $job)
        || (($job['next_build'] === null) !== ($job['next_high_work_id'] === null))
        || ($job['next_build'] !== null && (!is_string($job['next_build']) || $job['next_build'] === ''
            || !is_int($job['next_high_work_id']) || $job['next_high_work_id'] < 0))) {
        throw new RuntimeException('Recovery assessment schedule is invalid');
    }
    return $job;
}

function plugin_agentbdmosassetsync_recovery_store_job(array $job, DBmysql $observer): void
{
    global $DB;
    plugin_agentbdmosassetsync_recovery_guard();
    $scope = ['context' => 'plugin:agentbdmosassetsync', 'name' => 'recovery_assessment'];
    $json = json_encode($job, JSON_THROW_ON_ERROR);
    if (!$DB->updateOrInsert('glpi_configs', $scope + ['value' => $json], $scope)) {
        throw new RuntimeException('Recovery assessment schedule could not be stored');
    }
    plugin_agentbdmosassetsync_recovery_guard($observer);
    if (plugin_agentbdmosassetsync_recovery_job($observer) !== $job) {
        throw new RuntimeException('Recovery assessment schedule is not independently visible', 9101);
    }
    plugin_agentbdmosassetsync_recovery_guard($observer);
    plugin_agentbdmosassetsync_recovery_guard();
}

/** A metadata transaction is valid only while the original sessions retain all execution locks. */
function plugin_agentbdmosassetsync_recovery_guard(?DBmysql $connection = null): void
{
    global $DB;
    $context = $GLOBALS['plugin_agentbdmosassetsync_recovery_context'] ?? null;
    if (!is_array($context) || ($context['writer'] ?? null) !== $DB
        || !(($context['writer'] ?? null) instanceof DBmysql) || !(($context['observer'] ?? null) instanceof DBmysql)
        || !is_int($context['owner_id'] ?? null) || !is_int($context['writer_id'] ?? null)
        || !is_int($context['observer_id'] ?? null) || !is_bool($context['require_worker'] ?? null)
        || !is_string($context['nonce'] ?? null)) {
        throw new RuntimeException('Recovery assessment execution context is unavailable', 9101);
    }
    $connection ??= $context['writer'];
    if ($connection !== $context['writer'] && $connection !== $context['observer']) {
        throw new RuntimeException('Recovery assessment session is unavailable', 9101);
    }
    try {
        $row = $connection->fetchAssoc($connection->doQuery('SELECT CONNECTION_ID() AS id, IS_USED_LOCK('
            . $connection::quoteValue($context['nonce']) . ') AS nonce_owner, '
            . "IS_USED_LOCK('asb-assessment-job') AS job_owner, "
            . "IS_USED_LOCK('agentbdmosassetsync-worker') AS worker_owner"));
        $expectedId = $connection === $context['writer'] ? $context['writer_id'] : $context['observer_id'];
        if (!$row || (int) ($row['id'] ?? 0) !== $expectedId
            || (int) ($row['nonce_owner'] ?? 0) !== $context['owner_id']
            || (int) ($row['job_owner'] ?? 0) !== $context['writer_id']
            || ($context['require_worker'] && (int) ($row['worker_owner'] ?? 0) !== $context['owner_id'])) {
            throw new RuntimeException('Recovery assessment execution lock ownership changed');
        }
    } catch (Throwable $e) {
        throw new RuntimeException('Recovery assessment execution ownership is uncertain', 9101, $e);
    }
}

/** Fresh metadata sessions never commit or roll back the normal worker's connection. */
function plugin_agentbdmosassetsync_recovery_session(callable $action, bool $requireWorker)
{
    global $DB;
    $owner = $DB;
    $writer = null;
    $observer = null;
    $nonce = 'asb-assessment-' . bin2hex(random_bytes(12));
    $barrierAcquired = false;
    $jobLocked = false;
    $failure = null;
    $result = null;
    try {
        $identity = $owner->fetchAssoc($owner->doQuery('SELECT CONNECTION_ID() AS id, '
            . "IS_USED_LOCK('agentbdmosassetsync-worker') AS worker"));
        $ownerId = (int) ($identity['id'] ?? 0);
        if ($ownerId < 1 || ($requireWorker && (int) ($identity['worker'] ?? 0) !== $ownerId)) {
            throw new RuntimeException('Recovery assessment worker ownership is unavailable', 9101);
        }
        $acquired = $owner->fetchAssoc($owner->doQuery("SELECT GET_LOCK('$nonce', 0) AS acquired"));
        if ((int) ($acquired['acquired'] ?? 0) !== 1) {
            throw new RuntimeException('Recovery assessment session guard is unavailable', 9101);
        }
        $barrierAcquired = true;
        $writer = new DB();
        plugin_agentbdmosassetsync_field_sync_reconcile_initialize($writer, $nonce, $ownerId);
        $observer = new DB();
        plugin_agentbdmosassetsync_field_sync_reconcile_initialize($observer, $nonce, $ownerId);
        $writerId = (int) $writer->fetchAssoc($writer->doQuery('SELECT CONNECTION_ID() AS id'))['id'];
        $observerId = (int) $observer->fetchAssoc($observer->doQuery('SELECT CONNECTION_ID() AS id'))['id'];
        if ($writerId < 1 || $observerId < 1 || count(array_unique([$ownerId, $writerId, $observerId])) !== 3) {
            throw new RuntimeException('Recovery assessment requires distinct owned metadata sessions', 9101);
        }
        $lock = $writer->fetchAssoc($writer->doQuery("SELECT GET_LOCK('asb-assessment-job', 5) AS acquired"));
        if ((int) ($lock['acquired'] ?? 0) === 1) {
            $jobLocked = true;
            $DB = $writer;
            $GLOBALS['plugin_agentbdmosassetsync_recovery_context'] = ['writer' => $writer, 'observer' => $observer,
                'owner_id' => $ownerId, 'writer_id' => $writerId, 'observer_id' => $observerId,
                'nonce' => $nonce, 'require_worker' => $requireWorker];
            plugin_agentbdmosassetsync_recovery_guard();
            $result = $action($observer);
            plugin_agentbdmosassetsync_recovery_guard();
        }
    } catch (Throwable $e) {
        $failure = $e;
    } finally {
        $DB = $owner;
        unset($GLOBALS['plugin_agentbdmosassetsync_recovery_context']);
        if ($jobLocked) {
            try {
                $released = $writer->fetchAssoc($writer->doQuery("SELECT RELEASE_LOCK('asb-assessment-job') AS released"));
                if ((int) ($released['released'] ?? 0) !== 1) {
                    throw new RuntimeException('Recovery assessment schedule lock release was not confirmed');
                }
            } catch (Throwable $e) {
                $failure = new RuntimeException('Recovery assessment cleanup is uncertain', 9101, $e);
            }
        }
        foreach ([$writer, $observer] as $connection) {
            if (!$connection instanceof DBmysql || !$connection->connected) {
                continue;
            }
            try {
                if (!$connection->close()) {
                    throw new RuntimeException('Owned recovery assessment session did not close');
                }
            } catch (Throwable $e) {
                $failure = new RuntimeException('Recovery assessment cleanup is uncertain', 9101, $e);
            }
        }
        if ($barrierAcquired) {
            try {
                $released = $owner->fetchAssoc($owner->doQuery("SELECT RELEASE_LOCK('$nonce') AS released"));
                if ((int) ($released['released'] ?? 0) !== 1) {
                    throw new RuntimeException('Recovery assessment session guard release was not confirmed');
                }
            } catch (Throwable $e) {
                $failure = new RuntimeException('Recovery assessment cleanup is uncertain', 9101, $e);
            }
        }
    }
    if ($failure !== null) {
        throw $failure;
    }
    return $result;
}

/** Installation schedules metadata only; native assets and historical Work outcomes are not touched. */
function plugin_agentbdmosassetsync_recovery_schedule(): bool
{
    try {
        return plugin_agentbdmosassetsync_recovery_session(static function (DBmysql $observer) {
            global $DB;
            $build = plugin_version_agentbdmosassetsync()['version'];
            $table = PluginAgentbdmosassetsyncWork::getTable();
            $high = (int) $DB->fetchAssoc($DB->doQuery("SELECT COALESCE(MAX(`id`), 0) AS high_id FROM `$table`"))['high_id'];
            $job = plugin_agentbdmosassetsync_recovery_job();
            if ($job !== null && $job['build'] === $build) {
                return true;
            }
            if ($job !== null && $job['state'] === 'Pending') {
                $job['next_build'] = $build;
                $job['next_high_work_id'] = max($high, $job['next_high_work_id'] ?? 0);
            } else {
                $job = ['version' => 1, 'build' => $build, 'cursor' => 0, 'high_work_id' => $high,
                    'state' => $high === 0 ? 'Complete' : 'Pending', 'next_build' => null, 'next_high_work_id' => null];
            }
            plugin_agentbdmosassetsync_recovery_store_job($job, $observer);
            return true;
        }, false) === true;
    } catch (Throwable $e) {
        if ($e->getCode() === 9101) {
            throw $e;
        }
        return false;
    }
}

/** Only assessment metadata advances: neither terminal replay nor an implicit fresh A request. */
function plugin_agentbdmosassetsync_recovery_batch(CronTask $task): int
{
    try {
        $job = plugin_agentbdmosassetsync_recovery_job();
        if ($job === null || $job['state'] === 'Complete') {
            return 0;
        }
        $count = plugin_agentbdmosassetsync_recovery_session(static function (DBmysql $observer) {
            global $DB;
            $job = plugin_agentbdmosassetsync_recovery_job();
            if ($job === null || $job['state'] === 'Complete') {
                return 0;
            }
            $table = PluginAgentbdmosassetsyncWork::getTable();
            $rows = iterator_to_array($DB->request(['FROM' => $table, 'WHERE' => ['AND' => [
                ['id' => ['>', $job['cursor']]], ['id' => ['<=', $job['high_work_id']]],
            ]], 'ORDER' => 'id ASC', 'LIMIT' => 20]));
            $count = 0;
            foreach ($rows as $row) {
                plugin_agentbdmosassetsync_recovery_guard();
                $body = plugin_agentbdmosassetsync_recovery_assess($row);
                $time = (new DateTimeImmutable('now', new DateTimeZone('Asia/Brunei')))->format(DATE_ATOM);
                $assessment = ['version' => 1, 'build' => plugin_version_agentbdmosassetsync()['version'],
                    'assessed_at' => $time, 'original_status' => $row['status'],
                    'original_fingerprint' => plugin_agentbdmosassetsync_recovery_fingerprint($row)] + $body;
                if (!(new PluginAgentbdmosassetsyncWork())->saveRecoveryAssessment($row, $assessment, $observer)) {
                    throw new RuntimeException('Recovery assessment metadata was not stored');
                }
                $job['cursor'] = (int) $row['id'];
                plugin_agentbdmosassetsync_recovery_store_job($job, $observer);
                ++$count;
            }
            if (count($rows) < 20 || $job['cursor'] === $job['high_work_id']) {
                $job['cursor'] = $job['high_work_id'];
                $job['state'] = 'Complete';
                if ($job['next_build'] !== null) {
                    $job = ['version' => 1, 'build' => $job['next_build'], 'cursor' => 0,
                        'high_work_id' => $job['next_high_work_id'], 'state' => $job['next_high_work_id'] === 0 ? 'Complete' : 'Pending',
                        'next_build' => null, 'next_high_work_id' => null];
                }
                plugin_agentbdmosassetsync_recovery_store_job($job, $observer);
            }
            return $count;
        }, true) ?? 0;
        if ($count > 0) {
            $task->log('Recovery assessment metadata rows stored: ' . $count . '; no recovery asset writes.');
        }
        return $count;
    } catch (Throwable $e) {
        if ($e->getCode() === 9101) {
            throw $e;
        }
        $task->log('Recovery assessment remains pending because metadata is unavailable; ordinary Work processing is unchanged.');
        return 0;
    }
}
