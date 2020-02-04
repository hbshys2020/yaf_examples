<?php

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model{
    const CREATED_AT = 'add_time';
    const UPDATED_AT = 'update_time';

    protected $connection = 'db1';
    protected $table      = 'user';
    protected $primaryKey = 'user_id';
    protected $fillable   = ['user_id','name','add_time','update_time'];
}