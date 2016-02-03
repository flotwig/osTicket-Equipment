<?php
namespace controller;
class Controller{
    public function render($template,$variables){
        $loader = new Twig_Loader_Filesystem(EQUIPMENT_PATH.'templates');
        $twig = new Twig_Environment($loader,array(
           'cache' => EQUIPMENT_PATH.'cache',
        ));
        $template = $twig->loadTemplate($template);
        require_once(STAFFINC_DIR.'header.inc.php');
        echo $template->render($variables);
        require_once(STAFFINC_DIR.'footer.inc.php');
    }
    private function getList($table){
        \EquipmentPlugin::table($table);
    }
}