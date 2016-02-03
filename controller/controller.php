<?php
namespace controller;
class Controller{
    private function render(){
        $loader = new Twig_Loader_Filesystem(EQUIPMENT_PATH.'templates');
        $twig = new Twig_Environment($loader,array(
           'cache' => EQUIPMENT_PATH.'cache',
        ));
        require_once(STAFFINC_DIR.'header.inc.php');

        require_once(STAFFINC_DIR.'footer.inc.php');
    }
}