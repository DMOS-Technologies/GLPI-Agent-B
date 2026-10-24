<?php

function plugin_agentbdmosassetsync_install()
{
    global $DB;

    $tables = [
        'settings' => "
            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `route_id` VARCHAR(128) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
            `a_entities_id` INT UNSIGNED NOT NULL,
            `entities_id` INT UNSIGNED NOT NULL,
            `route_enabled` TINYINT UNSIGNED NOT NULL,
            `settings_version` INT UNSIGNED NOT NULL,
            `enabled_itemtypes_json` LONGTEXT NOT NULL,
            `field_mappings_json` LONGTEXT NOT NULL,
            PRIMARY KEY (`id`), UNIQUE KEY `route_id` (`route_id`),
            KEY `entities_id` (`entities_id`)",
        'works' => "
            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `work_id` VARCHAR(128) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
            `route_id` VARCHAR(128) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
            `a_entities_id` INT UNSIGNED NOT NULL,
            `entities_id` INT UNSIGNED NOT NULL,
            `itemtype` VARCHAR(255) NOT NULL,
            `identity_json` LONGTEXT NOT NULL,
            `a_values_json` LONGTEXT NOT NULL,
            `a_change_times_json` LONGTEXT NOT NULL,
            `settings_version` INT UNSIGNED NOT NULL,
            `handled_change_ids_json` LONGTEXT NOT NULL,
            `operation` VARCHAR(16) NOT NULL DEFAULT 'Sync',
            `submitted_users_id` INT UNSIGNED NOT NULL DEFAULT 0,
            `submitted_profiles_id` INT UNSIGNED NOT NULL DEFAULT 0,
            `a_items_id` INT UNSIGNED NOT NULL DEFAULT 0,
            `b_items_id` INT UNSIGNED NULL DEFAULT NULL,
            `link_state` VARCHAR(16) NULL DEFAULT NULL,
            `processing_started_at` DATETIME NULL DEFAULT NULL,
            `status` VARCHAR(16) NOT NULL DEFAULT 'Accepted',
            `result_json` LONGTEXT NULL DEFAULT NULL,
            `error` TEXT NULL DEFAULT NULL,
            `date_creation` DATETIME NOT NULL,
            `date_mod` DATETIME NOT NULL,
            `completed_at` DATETIME NULL DEFAULT NULL,
            PRIMARY KEY (`id`), UNIQUE KEY `work_id` (`work_id`),
            KEY `entities_id` (`entities_id`), KEY `status` (`status`),
            KEY `route_id` (`route_id`), KEY `asset_link` (`route_id`, `itemtype`, `a_items_id`)",
        'changes' => "
            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `route_id` VARCHAR(128) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
            `settings_version` INT UNSIGNED NOT NULL,
            `a_entities_id` INT UNSIGNED NOT NULL,
            `entities_id` INT UNSIGNED NOT NULL,
            `itemtype` VARCHAR(255) NOT NULL,
            `identity_json` LONGTEXT NOT NULL,
            `changed_fields_json` LONGTEXT NOT NULL,
            `status` VARCHAR(16) NOT NULL DEFAULT 'Pending',
            `retry_count` INT UNSIGNED NOT NULL DEFAULT 0,
            `error` TEXT NULL DEFAULT NULL,
            `date_creation` DATETIME NOT NULL,
            `date_mod` DATETIME NOT NULL,
            `done_at` DATETIME NULL DEFAULT NULL,
            PRIMARY KEY (`id`), KEY `entities_id` (`entities_id`),
            KEY `status` (`status`), KEY `route_id` (`route_id`)",
    ];
    foreach ($tables as $suffix => $columns) {
        $table = 'glpi_plugin_agentbdmosassetsync_' . $suffix;
        if (!$DB->tableExists($table)) {
            $DB->doQuery("CREATE TABLE `$table` ($columns) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
        }
    }

    require_once __DIR__ . '/inc/functions.php';
    foreach (plugin_agentbdmosassetsync_rights() as $name) {
        foreach ($DB->request(['FROM' => 'glpi_profiles']) as $profile) {
            $DB->updateOrInsert('glpi_profilerights', [
                'profiles_id' => $profile['id'], 'name' => $name,
            ], ['profiles_id' => $profile['id'], 'name' => $name]);
        }
    }
    ProfileRight::cleanAllPossibleRights();
    $cron = new CronTask();
    if (!$cron->getFromDBbyName(PluginAgentbdmosassetsyncWork::class, 'processWork')) {
        return (bool) CronTask::register(PluginAgentbdmosassetsyncWork::class, 'processWork', 60, [
            'mode' => CronTask::MODE_EXTERNAL,
            'allowmode' => CronTask::MODE_EXTERNAL,
            'state' => CronTask::STATE_WAITING,
            'comment' => 'Foundation task; no work processor is installed yet.',
        ]);
    }
    return true;
}

function plugin_agentbdmosassetsync_uninstall()
{
    global $DB;

    require_once __DIR__ . '/inc/functions.php';
    if (!CronTask::unregister('agentbdmosassetsync')) {
        return false;
    }
    if (!ProfileRight::deleteProfileRights(plugin_agentbdmosassetsync_rights())) {
        return false;
    }
    // An administrator's explicit uninstall removes this plugin's records only.
    foreach (['settings', 'works', 'changes'] as $suffix) {
        $DB->doQuery('DROP TABLE IF EXISTS `glpi_plugin_agentbdmosassetsync_' . $suffix . '`');
    }
    return true;
}
