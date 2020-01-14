<?php
class DemoController extends \Yaf\Controller_Abstract{
    public function indexAction(){
        $demo = (new \Demo\Demo)->detail();
        print_r($demo);
        exit;
    }
}

