<?php
class EquipmentConfig extends PluginConfig{
    function getOptions(){
        return array();
    }
    function pre_save(&$config,&$errors){
        return true;
    }
}