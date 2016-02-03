<?php
define('EQUIPMENT_PATH',dirname(__DIR__).'/osTicket-Equipment/');
require_once(INCLUDE_DIR.'class.plugin.php');
require_once(INCLUDE_DIR.'class.signal.php');
require_once(INCLUDE_DIR.'class.app.php');
require_once(INCLUDE_DIR.'class.dispatcher.php');
require_once(INCLUDE_DIR.'class.dynamic_forms.php');
require_once(INCLUDE_DIR.'class.osticket.php');
require_once(EQUIPMENT_PATH.'vendor/autoload.php');
require_once(EQUIPMENT_PATH.'controller/dashboard.php');
require_once(EQUIPMENT_PATH.'controller/devices.php');
require_once(EQUIPMENT_PATH.'controller/checkouts.php');
require_once('config.php');
class EquipmentPlugin extends Plugin{
    public function bootstrap(){
        if($this->firstRun())
            $this->install();
        Signal::connect('apps.scp',array('EquipmentPlugin','callbackDispatch'));
        $this->createStaffMenu();
    }
    public static function callbackDispatch($object,$data){
        // dashboard routing
        $object->append(url('^/equipment/$',
            patterns('controller\Dashboard',
                url_get('^$','defaultAction')
            )
        ));
        // device management routing
        $object->append(url('^/equipment/devices/',
            patterns('controller\Devices',
                url_get('^$','defaultAction'),
                url_get('^new','newFormAction'),
                url_post('^new','newSaveAction'),
                url_get('^delete(?P<id>\d+)$','deleteAction'),
                url_get('^categories$','categoriesListAction'),
                url_post('^categories$','categoriesNewAction'),
                url_get('^types$','typesListAction'),
                url_post('^types$','typesNewAction')
            )
        ));
        // checkouts routing
        $object->append(url('^/equipment/checkouts/',
            patterns('controller\Checkouts',
                url_get('^$','defaultAction'),
                url_get('^checkout','checkoutFormAction'),
                url_post('^checkout','checkoutSaveAction'),
                url_post('^checkin$','checkinAction'),
                url_get('^(?P<id>\d+)','showCheckoutAction')
            )
        ));
    }
    private function createStaffMenu(){
        return Application::registerStaffApp('Equipment','dispatcher.php/equipment/',array('iconclass'=>'faq-categories'));
    }
    public static function table($name=''){
        return TABLE_PREFIX.'_equipment_'.$name;
    }
    private function firstRun(){
        return (db_num_rows(db_query('SHOW TABLES LIKE "'.$this->table('devices'))) == 0);
    }
    private function install(){
        multiquery(str_replace('{prefix}',$this->table(),file_get_contents($this->EQUIPMENT_PATH.'sql/createTables.sql')));
    }
    public function pre_uninstall(){
        multiquery(str_replace('{prefix}',$this->table(),file_get_contents($this->EQUIPMENT_PATH.'sql/dropTables.sql')));
    }
    private function multiquery($queries){
        $queries = explode(';',$queries);
        foreach($queries as $query)
            db_query($query);
    }
}