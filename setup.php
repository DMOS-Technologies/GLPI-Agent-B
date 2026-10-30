<?php

use Glpi\Plugin\Hooks;

function plugin_init_agentbdmosassetsync()
{
    global $PLUGIN_HOOKS;

    $PLUGIN_HOOKS[Hooks::CSRF_COMPLIANT]['agentbdmosassetsync'] = true;
    require_once __DIR__ . '/inc/functions.php';
    require_once __DIR__ . '/inc/fields.php';
    require_once __DIR__ . '/inc/evidence.php';
    require_once __DIR__ . '/inc/provenance.php';
    require_once __DIR__ . '/inc/fieldisolation.php';
    require_once __DIR__ . '/inc/participation.php';
    require_once __DIR__ . '/inc/notes.php';
    require_once __DIR__ . '/inc/capture.php';
    require_once __DIR__ . '/inc/notecapture.php';
    $PLUGIN_HOOKS[Hooks::POST_INIT]['agentbdmosassetsync'] = 'plugin_agentbdmosassetsync_register_capture';
    $PLUGIN_HOOKS[Hooks::POST_PLUGIN_ENABLE]['agentbdmosassetsync'] = 'plugin_agentbdmosassetsync_evidence_plugin_lifecycle';
    $PLUGIN_HOOKS[Hooks::POST_PLUGIN_DISABLE]['agentbdmosassetsync'] = 'plugin_agentbdmosassetsync_evidence_plugin_lifecycle';
    foreach (['PluginFieldsField', 'PluginFieldsContainer', \Glpi\Asset\AssetDefinition::class,
        \Glpi\Asset\CustomFieldDefinition::class] as $definitionType) {
        $PLUGIN_HOOKS[Hooks::PRE_ITEM_UPDATE]['agentbdmosassetsync'][$definitionType] = 'plugin_agentbdmosassetsync_evidence_definition_before';
        $PLUGIN_HOOKS[Hooks::ITEM_UPDATE]['agentbdmosassetsync'][$definitionType] = 'plugin_agentbdmosassetsync_evidence_definition_update';
        foreach ([Hooks::PRE_ITEM_ADD, Hooks::ITEM_ADD, Hooks::PRE_ITEM_DELETE, Hooks::ITEM_DELETE,
            Hooks::PRE_ITEM_PURGE, Hooks::ITEM_PURGE, Hooks::PRE_ITEM_RESTORE, Hooks::ITEM_RESTORE] as $hook) {
            $PLUGIN_HOOKS[$hook]['agentbdmosassetsync'][$definitionType] = 'plugin_agentbdmosassetsync_evidence_definition_lifecycle';
        }
    }
    Plugin::registerClass(PluginAgentbdmosassetsyncSetting::class);
    Plugin::registerClass(PluginAgentbdmosassetsyncWork::class);
    Plugin::registerClass(PluginAgentbdmosassetsyncChange::class);
    Plugin::registerClass(PluginAgentbdmosassetsyncProfile::class, ['addtabon' => Profile::class]);
}

function plugin_version_agentbdmosassetsync()
{
    return [
        'name' => 'Agent-B-DMOS-AssetSync',
        'version' => '0.6.0',
        'author' => 'DMOS',
        'license' => 'GPLv3+',
        'requirements' => ['glpi' => ['min' => '11.0.7', 'max' => '11.0.99']],
    ];
}

function plugin_agentbdmosassetsync_check_prerequisites()
{
    return version_compare(GLPI_VERSION, '11.0.7', '>=')
        && version_compare(GLPI_VERSION, '11.1.0', '<');
}

function plugin_agentbdmosassetsync_check_config($verbose = false)
{
    return true;
}
