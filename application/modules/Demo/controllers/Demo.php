<?php
use Yaf\Registry;
class DemoController extends \Yaf\Controller_Abstract{
    public function indexAction(){
        $demo = new \Demo\Demo();
        print_r($demo->detail());
        // $data = \TableModel::find(1);
        // print_r($data);
        // $data = \DB::connection('default')->table('table')->where('id',1)->first();
        return false;
    }
}

