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
        Signal::connect('apps.scp',array('EquipmentPlugin','callbackDispatch'));
    }
    private function table($name){
        return TABLE_PREFIX.'equipment'.$name;
    }
    private function firstRun(){
        return (db_num_rows(db_query('SHOW TABLES LIKE "'.$this->table('inventory'))) == 0);
    }
}