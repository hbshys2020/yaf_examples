<?php

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model{

    protected static function boot(){
      parent::boot();
    }
}