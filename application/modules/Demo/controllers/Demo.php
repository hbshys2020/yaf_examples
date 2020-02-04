<?php
class DemoController extends \Yaf\Controller_Abstract{
    public function indexAction(){
        echo '<pre>';
        $demo = new \Demo\Demo();
        print_r($demo->detail());
        print_r($demo->db(1));
        print_r($demo->model(1));
        exit;
    }
}

