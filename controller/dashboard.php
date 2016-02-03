<?php
namespace controller;
require_once 'controller.php';
class Dashboard extends Controller{
    public $title = 'Equipment Dashboard';
    public function dashboardAction(){
        $this->render('dashboard.twig.html',array());
    }
}