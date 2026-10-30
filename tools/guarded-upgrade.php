<?php

// Only the enforcing host wrapper invokes these administrative roles; this is not an HTTP endpoint.
if (PHP_SAPI !== 'cli') {
    http_response_code(404);
    exit;
}
umask(0077);

function au_write(string $path, string $value): void
{
    if (file_put_contents($path, $value) === false || !chmod($path, 0600)) {
        throw new RuntimeException('Private operation evidence could not be saved');
    }
}

function au_json($value): string
{
    return json_encode($value, JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES
        | JSON_UNESCAPED_UNICODE | JSON_PRESERVE_ZERO_FRACTION);
}

function au_boot(array $request): void
{
    require $request['glpi_root'] . '/vendor/autoload.php';
    $kernel = new \Glpi\Kernel\Kernel();
    $kernel->boot();
    $user = new User();
    if (!$user->getFromDBbyName($request['username'])) {
        throw new RuntimeException('Requested native administrator is unavailable');
    }
    $auth = new Auth();
    $auth->auth_succeded = true;
    $auth->user = $user;
    Session::init($auth);
    Session::changeActiveEntities('all');
    if (!Session::haveRight('config', READ) || !Session::haveRight('config', UPDATE)) {
        throw new RuntimeException('Native configuration READ and UPDATE permissions are required');
    }
    global $DB;
    $DB->doQuery('SET SESSION lock_wait_timeout = 5');
    $DB->doQuery('SET SESSION innodb_lock_wait_timeout = 5');
}

function au_schedulers(array $request): array
{
    $found = [];
    foreach (glob('/proc/[0-9]*/cmdline') as $file) {
        $raw = @file_get_contents($file);
        if ($raw === false || $raw === '') {
            continue;
        }
        $argv = explode("\0", rtrim($raw, "\0"));
        if (!in_array('/opt/glpi/scheduler.sh', $argv, true)
            || !in_array($request['glpi_root'] . '/front/cron.php', $argv, true)
            || end($argv) !== 'processWork') {
            continue;
        }
        $status = @file_get_contents(dirname($file) . '/status');
        if (!is_string($status) || !preg_match('/^Uid:\s+(\d+)/m', $status, $matches)) {
            throw new RuntimeException('Dedicated B scheduler owner could not be established');
        }
        $found[] = ['argv' => $argv, 'uid' => (int) $matches[1]];
    }
    return $found;
}

function au_supervisor(): array
{
    $paths = array_merge(['/etc/supervisor/supervisord.conf'], glob('/etc/supervisor/conf.d/*.conf'));
    foreach ($paths as $path) {
        $text = @file_get_contents($path);
        if (!is_string($text) || !str_contains($text, '[supervisorctl]')) {
            continue;
        }
        $lines = [];
        $code = 0;
        exec('supervisorctl -c ' . escapeshellarg($path) . ' status 2>/dev/null', $lines, $code);
        if (!in_array($code, [0, 3], true)) {
            continue;
        }
        $programs = [];
        foreach ($lines as $line) {
            $parts = preg_split('/\s+/', trim($line));
            if (count($parts) < 2 || !in_array($parts[1], ['RUNNING', 'STOPPED'], true)) {
                throw new RuntimeException('Only stable native supervisor states are supported');
            }
            $programs[$parts[0]] = $parts[1];
        }
        return ['supervisor_control' => $path, 'supervisor_programs' => $programs];
    }
    throw new RuntimeException('A supported native supervisor control configuration is required');
}

function au_task(array $request, bool $restore): array
{
    global $DB;
    $lock = $DB->fetchAssoc($DB->doQuery("SELECT GET_LOCK('agentbdmosassetsync-worker', 0) AS acquired"));
    if ((int) ($lock['acquired'] ?? 0) !== 1) {
        throw new RuntimeException('B worker is active; never reset its task');
    }
    $cronLock = 'glpicron.' . (int) (time() / HOUR_TIMESTAMP - 340000);
    $cronLocked = false;
    try {
        $cronLocked = $DB->getLock($cronLock);
        if (!$cronLocked) {
            throw new RuntimeException('Native cron selection is active');
        }
        $task = new CronTask();
        if (!$task->getFromDBbyName(PluginAgentbdmosassetsyncWork::class, 'processWork')
            || !in_array((int) $task->fields['state'], [CronTask::STATE_WAITING, CronTask::STATE_DISABLE], true)) {
            throw new RuntimeException('Only an idle B automatic action may be changed');
        }
        $before = $task->fields;
        $next = CronTask::STATE_DISABLE;
        if ($restore) {
            $original = $request['task_before'];
            foreach (['id', 'itemtype', 'name', 'frequency', 'param', 'mode', 'allowmode',
                'hourmin', 'hourmax', 'logs_lifetime', 'comment'] as $key) {
                if ($task->fields[$key] !== $original[$key]) {
                    throw new RuntimeException('Original automatic action configuration changed');
                }
            }
            if ((int) $task->fields['state'] !== CronTask::STATE_DISABLE) {
                throw new RuntimeException('Only the paused action may be restored');
            }
            $next = (int) $original['state'];
        }
        if ((int) $before['state'] !== $next
            && !$task->update(['id' => (int) $task->getID(), 'state' => $next])) {
            throw new RuntimeException('Native automatic action update was declined');
        }
        if (!$task->getFromDB((int) $task->getID()) || (int) $task->fields['state'] !== $next) {
            throw new RuntimeException('Native automatic action update could not be verified');
        }
        return ['task_before' => $before, 'task_after' => $task->fields];
    } finally {
        if ($cronLocked) {
            $DB->releaseLock($cronLock);
        }
        $DB->doQuery("SELECT RELEASE_LOCK('agentbdmosassetsync-worker')");
    }
}

function au_backend(DBmysql $db): array
{
    $row = $db->fetchAssoc($db->doQuery('SELECT DATABASE() AS database_name, @@server_uuid AS server_uuid,'
        . ' VERSION() AS server_version, CONNECTION_ID() AS owner_id'));
    if (!str_starts_with($row['server_version'] ?? '', '8.4.')) {
        throw new RuntimeException('Only the reviewed MySQL 8.4 preserving backend is supported');
    }
    return $row;
}

function au_preflight(array $request): array
{
    global $DB;
    if (GLPI_VERSION !== '11.0.7') {
        throw new RuntimeException('This preserving procedure is reviewed only for GLPI 11.0.7');
    }
    $plugin = new Plugin();
    if (!$plugin->getFromDBbyDir('agentbdmosassetsync') || (int) $plugin->fields['state'] !== Plugin::ACTIVATED
        || !in_array($plugin->fields['version'], ['0.4.1', '0.5.0', '0.5.1', '0.5.2'], true)
        || plugin_version_agentbdmosassetsync()['version'] !== $plugin->fields['version']
        || $plugin->isPluginsExecutionSuspended()) {
        throw new RuntimeException('The existing active capture-compatible package is not established');
    }
    $marker = $DB->request(['FROM' => 'glpi_configs', 'WHERE' => [
        'context' => 'plugin:agentbdmosassetsync', 'name' => 'evidence_upgrade']])->current();
    if ($marker && ($marker['value'] ?? null) !== '{"version":1,"state":"ready"}') {
        throw new RuntimeException('An earlier upgrade/reset needs conservative recovery');
    }
    $task = new CronTask();
    if (!$task->getFromDBbyName(PluginAgentbdmosassetsyncWork::class, 'processWork')
        || !in_array((int) $task->fields['state'], [CronTask::STATE_WAITING, CronTask::STATE_DISABLE], true)) {
        throw new RuntimeException('The B action is not idle');
    }
    $backend = au_backend($DB);
    return ['plugin_id' => (int) $plugin->getID(), 'source_version' => $plugin->fields['version'],
        'active_path' => Plugin::getPhpDir('agentbdmosassetsync'), 'database' => $backend['database_name'],
        'server_uuid' => $backend['server_uuid'], 'database_host' => $DB->dbhost,
        'task' => $task->fields, 'schedulers' => au_schedulers($request)] + au_supervisor();
}

function au_guard(array $request): void
{
    global $DB;
    $old = $DB;
    $mustUnsanitize = $old->request(['FROM' => 'glpi_configs', 'WHERE' => [
        'context' => 'core', 'name' => 'must_unsanitize_db_data']])->current()['value'] ?? true;
    $DB = new DB();
    $DB->setMustUnsanitizeData((bool) $mustUnsanitize);
    if (!$old->close()) {
        throw new RuntimeException('Preflight database context did not close');
    }
    $DB->doQuery('SET SESSION lock_wait_timeout = 5');
    $DB->doQuery('SET SESSION innodb_lock_wait_timeout = 5');
    $backend = au_backend($DB);
    $before = $request['preflight'];
    if ($backend['database_name'] !== $before['database'] || $backend['server_uuid'] !== $before['server_uuid']) {
        throw new RuntimeException('The fenced backend does not match preflight');
    }
    $plugin = $DB->request(['FROM' => 'glpi_plugins', 'WHERE' => ['directory' => 'agentbdmosassetsync']])->current();
    if (!$plugin || (int) $plugin['state'] !== Plugin::ACTIVATED || $plugin['version'] !== $before['source_version']) {
        throw new RuntimeException('The original package is no longer active');
    }
    $worker = $DB->fetchAssoc($DB->doQuery("SELECT GET_LOCK('agentbdmosassetsync-worker', 5) AS acquired"));
    if ((int) ($worker['acquired'] ?? 0) !== 1) {
        throw new RuntimeException('B worker guard could not be acquired');
    }
    $routes = array_values(iterator_to_array($DB->request(['FROM' => 'glpi_plugin_agentbdmosassetsync_settings', 'ORDER' => 'id'])));
    foreach ($routes as $route) {
        $lock = 'asb-setting-' . sha1($route['route_id']);
        $row = $DB->fetchAssoc($DB->doQuery("SELECT GET_LOCK('$lock', 5) AS acquired"));
        if ((int) ($row['acquired'] ?? 0) !== 1) {
            throw new RuntimeException('A route guard could not be acquired');
        }
    }
    $writable = ['glpi_plugins', 'glpi_configs', 'glpi_events', 'glpi_logs', 'glpi_profilerights',
        'glpi_profiles', 'glpi_users', 'glpi_crontasks', 'glpi_crontasklogs'];
    foreach (['settings', 'works', 'changes', 'notelinks', 'scalarstates'] as $suffix) {
        $writable[] = 'glpi_plugin_agentbdmosassetsync_' . $suffix;
    }
    $tables = [];
    $result = $DB->doQuery("SHOW FULL TABLES WHERE Table_type = 'BASE TABLE'");
    while ($table = $DB->fetchAssoc($result)) {
        $name = reset($table);
        if (!preg_match('/\A[a-zA-Z0-9_]+\z/D', $name)) {
            throw new RuntimeException('An unsupported table identifier prevents a complete guard');
        }
        if (!in_array($name, $writable, true)) {
            $tables[] = $name;
        }
    }
    sort($tables, SORT_STRING);
    if ($tables === []) {
        throw new RuntimeException('No native storage can be guarded');
    }
    $snapshot = ['version' => 1, 'plugin' => ['state' => (int) $plugin['state'], 'version' => $plugin['version']],
        'database' => $backend['database_name'], 'server_uuid' => $backend['server_uuid'],
        'routes' => $routes, 'tables' => $tables, 'must_unsanitize' => (bool) $mustUnsanitize, 'protected' => []];
    foreach (['works', 'changes', 'notelinks', 'scalarstates'] as $suffix) {
        $table = 'glpi_plugin_agentbdmosassetsync_' . $suffix;
        $rows = iterator_to_array($DB->request(['FROM' => $table, 'ORDER' => 'id']));
        $hashes = [];
        $columns = array_keys($DB->listFields($table, false));
        foreach ($rows as $row) {
            $hashes[(string) $row['id']] = hash('sha256', json_encode(
                plugin_agentbdmosassetsync_evidence_canonical((object) $row),
                JSON_THROW_ON_ERROR | JSON_PRESERVE_ZERO_FRACTION));
            if ($suffix === 'scalarstates') {
                $proof = json_decode($row['state_json'], true);
                foreach ([$proof['parent']['table'] ?? null, $proof['current']['storage']['table'] ?? null] as $storage) {
                    if ($storage !== null && !in_array($storage, $tables, true)) {
                        throw new RuntimeException('Tracked native proof storage is not guarded');
                    }
                }
            }
        }
        $snapshot['protected'][$table] = ['columns' => $columns, 'rows' => (object) $hashes];
    }
    $snapshotJson = au_json($snapshot);
    au_write($request['operation_dir'] . '/snapshot.json', $snapshotJson);
    $token = bin2hex(random_bytes(32));
    $guardLock = 'asb-upgrade-' . substr(hash('sha256', $token), 0, 48);
    $pending = au_json(['version' => 1, 'state' => 'pending', 'token_hash' => hash('sha256', $token),
        'snapshot_hash' => hash('sha256', $snapshotJson), 'source_version' => $plugin['version'],
        'target_version' => $request['target_version']]);
    $where = ['context' => 'plugin:agentbdmosassetsync', 'name' => 'evidence_upgrade'];
    $DB->updateOrInsert('glpi_configs', $where + ['value' => $pending], $where);
    if (($DB->request(['FROM' => 'glpi_configs', 'WHERE' => $where])->current()['value'] ?? null) !== $pending) {
        throw new RuntimeException('Durable pending marker could not be established');
    }
    // Everything after LOCK TABLES is raw SQL without table reads, transactions or reconnects.
    $DB->doQuery('LOCK TABLES ' . implode(', ', array_map(static fn($table) => '`' . $table . '` READ', $tables)));
    $acquired = $DB->fetchAssoc($DB->doQuery("SELECT GET_LOCK('$guardLock', 0) AS acquired"));
    if ((int) ($acquired['acquired'] ?? 0) !== 1) {
        throw new RuntimeException('The locked guard identity could not be published');
    }
    $context = ['version' => 1, 'token' => $token, 'guard_owner_id' => (int) $backend['owner_id'],
        'guard_lock' => $guardLock, 'backend_identity' => ['database' => $backend['database_name'],
            'server_uuid' => $backend['server_uuid']], 'source_version' => $plugin['version'],
        'target_version' => $request['target_version'], 'snapshot_json' => $snapshotJson];
    au_write($request['operation_dir'] . '/guard-ready.json', au_json($context));
    $deadline = microtime(true) + (int) $request['timeout'];
    while (!is_file($request['operation_dir'] . '/release')) {
        if (microtime(true) > $deadline) {
            throw new RuntimeException('The guarded operation exceeded its bounded window');
        }
        $identity = $DB->fetchAssoc($DB->doQuery("SELECT CONNECTION_ID() AS id, IS_USED_LOCK('$guardLock') AS owner"));
        if ((int) $identity['id'] !== (int) $backend['owner_id'] || (int) $identity['owner'] !== (int) $backend['owner_id']) {
            throw new RuntimeException('Database guard continuity was lost');
        }
        usleep(100000);
    }
    $DB->doQuery('UNLOCK TABLES');
    $DB->doQuery('SELECT RELEASE_ALL_LOCKS()');
    if (!$DB->close()) {
        throw new RuntimeException('Database guard close was not confirmed');
    }
}

function au_upgrade(array $request): array
{
    global $DB;
    // Kernel boot already detects the new version and unloads the not-yet-upgraded plugin.
    Plugin::load('agentbdmosassetsync', true);
    if (!function_exists('plugin_agentbdmosassetsync_evidence_upgrade_begin')
        || !class_exists(PluginAgentbdmosassetsyncSetting::class)) {
        throw new RuntimeException('The reviewed candidate could not be loaded for native maintenance');
    }
    $context = json_decode(file_get_contents($request['operation_dir'] . '/context.json'), true, 512, JSON_THROW_ON_ERROR);
    if (plugin_version_agentbdmosassetsync()['version'] !== $request['target_version']) {
        throw new RuntimeException('The installed candidate does not match the reviewed target');
    }
    plugin_agentbdmosassetsync_evidence_upgrade_begin($context);
    $plugin = new Plugin();
    $plugin->checkPluginState('agentbdmosassetsync');
    if (!$plugin->getFromDBbyDir('agentbdmosassetsync') || (int) $plugin->fields['state'] !== Plugin::NOTUPDATED) {
        throw new RuntimeException('Native version detection did not require the expected upgrade');
    }
    $plugin->install($plugin->getID());
    if (!$plugin->getFromDBbyDir('agentbdmosassetsync') || (int) $plugin->fields['state'] !== Plugin::NOTACTIVATED) {
        throw new RuntimeException('Native additive installation did not complete');
    }
    if (!$plugin->activate($plugin->getID())) {
        throw new RuntimeException('Native activation did not complete');
    }
    $observer = new DB();
    $observer->setMustUnsanitizeData((bool) json_decode($context['snapshot_json'], true)['must_unsanitize']);
    $bindings = plugin_agentbdmosassetsync_evidence_upgrade_finish($observer);
    if (!$observer->close()) {
        throw new RuntimeException('The independent completion observer did not close');
    }
    return ['state' => 'ready', 'version' => $request['target_version'], 'bindings' => $bindings];
}

$role = $argv[1] ?? '';
$request = json_decode(file_get_contents($argv[2] ?? ''), true, 512, JSON_THROW_ON_ERROR);
ob_start();
try {
    if ($role === 'hashes') {
        $path = $request['preflight']['active_path'];
        $hashes = [];
        foreach (array_merge([$path . '/setup.php', $path . '/hook.php'], glob($path . '/inc/*.php')) as $file) {
            $hashes[substr($file, strlen($path) + 1)] = hash_file('sha256', $file);
        }
        $result = $hashes;
    } elseif ($role === 'processes') {
        $result = au_schedulers($request);
    } else {
        au_boot($request);
        $result = match ($role) {
            'preflight' => au_preflight($request),
            'pause' => au_task($request, false),
            'restore-task' => au_task($request, true),
            'guard' => au_guard($request),
            'upgrade' => au_upgrade($request),
            default => throw new RuntimeException('Unknown administrative role'),
        };
    }
    $noise = ob_get_clean();
    if ($noise !== '') {
        au_write($request['operation_dir'] . '/native-output.log', $noise);
    }
    echo au_json($result), "\n";
} catch (Throwable $error) {
    $noise = ob_get_clean();
    fwrite(STDERR, $noise . $error->getMessage() . "\n");
    exit(1);
}
