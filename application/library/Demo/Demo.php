<?php

namespace Demo;

class Demo{
    public function detail(){
        return file_list_info(APP_PATH);
    }
}