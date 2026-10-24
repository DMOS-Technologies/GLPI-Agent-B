<?php

class PluginAgentbdmosassetsyncProfile extends CommonGLPI
{
    public function getTabNameForItem(CommonGLPI $item, $withtemplate = 0)
    {
        return $item instanceof Profile && $item->fields['interface'] === 'central'
            ? 'Agent-B-DMOS-AssetSync' : '';
    }

    public static function displayTabContentForItem(CommonGLPI $item, $tabnum = 1, $withtemplate = 0)
    {
        if (!$item instanceof Profile || !$item->can($item->getID(), READ)) {
            return false;
        }
        $canEdit = $item->can($item->getID(), UPDATE);
        $item->showFormHeader(['target' => Profile::getFormURL()]);
        $rights = [];
        foreach ([PluginAgentbdmosassetsyncSetting::class, PluginAgentbdmosassetsyncWork::class,
            PluginAgentbdmosassetsyncChange::class] as $type) {
            $rights[] = ['itemtype' => $type, 'label' => $type::getTypeName(), 'field' => $type::$rightname];
        }
        $item->displayRightsChoiceMatrix($rights, [
            'title' => 'Agent-B-DMOS-AssetSync', 'canedit' => $canEdit,
        ]);
        $item->showFormButtons(['canedit' => $canEdit, 'candel' => false]);
        return true;
    }
}
