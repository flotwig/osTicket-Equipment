<?php
require_once(INCLUDE_DIR.'class.plugin.php');
require_once(INCLUDE_DIR.'class.signal.php');
require_once(INCLUDE_DIR.'class.app.php');
require_once(INCLUDE_DIR.'class.dispatcher.php');
require_once(INCLUDE_DIR.'class.dynamic_forms.php');
require_once(INCLUDE_DIR.'class.osticket.php');
require_once('config.php');
class EquipmentPlugin extends Plugin{
    public function bootstrap(){
        if($this->firstRun())
            $this->install();
        Signal::connect('apps.scp',array('EquipmentPlugin','callbackDispatch'));
    }
    public static function callbackDispatch($object,$data){

    }
    private function table($name=''){
        return TABLE_PREFIX.'_equipment_'.$name;
    }
    private function firstRun(){
        return (db_num_rows(db_query('SHOW TABLES LIKE "'.$this->table('inventory'))) == 0);
    }
    private function install(){
        multiquery(str_replace('{prefix}',$this->table(),file_get_contents('sql/createTables.sql')));
    }
    private function pre_uninstall(){
        multiquery(str_replace('{prefix}',$this->table(),file_get_contents('sql/dropTables.sql')));
    }
    private function multiquery($queries){
        $queries = explode(';',$queries);
        foreach($queries as $query)
            db_query($query);
    }
}