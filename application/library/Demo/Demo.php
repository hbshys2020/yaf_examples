<?php

namespace Demo;

class Demo{
    public function detail(){
        return file_list_info(APP_PATH);
    }
    public function model($id){
        $data = \UserModel::find($id);
        return $data;
    }
    public function db($id) {
        $data = \DB::connection('db2')->table('user')->where('user_id',$id)->first();
        return $data;
    }
}