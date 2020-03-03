<?php

use Illuminate\Database\Eloquent\Model;

class EloquentModel extends Model{

    protected static function boot(){
        parent::boot();
        foreach(getconf('database') as $connection=>$val){
            //监听并打印 sql 语句，TODO 监听不到DB 的 sql 记录
            \DB::connection($connection)->listen(function ($query) {
                $i = 0;
                $bindings = $query->bindings;
                $sql = preg_replace_callback("|(\?)|",
                    function ($matches) use ($bindings,&$i){
                        return $bindings[$i++];
                    },$query->sql);
                error_log("sql:[$sql]");
            });
        }
    }
}