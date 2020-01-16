<?php
class DemoController extends \Yaf\Controller_Abstract{
    public function indexAction(){
        $demo = (new \Demo\Demo)->detail();
        echo '<pre>';
        print_r($demo);
        exit;
    }
}

