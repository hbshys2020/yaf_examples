<?php

class TableModel extends \EloquentModel{
    const CREATED_AT = 'add_time';
    const UPDATED_AT = 'update_time';

    protected $connection = 'default';
    protected $table      = 'table';
    protected $primaryKey = 'id';
    protected $fillable   = ['id','name','add_time','update_time'];
}