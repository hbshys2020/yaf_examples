<?php

use Illuminate\Database\Eloquent\Model;

class AbilityModel extends Model{
    const CREATED_AT = 'add_time';
    const UPDATED_AT = 'update_time';

    protected $connection = 'gc_case';
    protected $table      = 'abilities_1210';
    protected $primaryKey = 'ability_id';
    protected $fillable   = ['ability_id','ability_category_id','min_age','max_age','title','sort','is_norm','score','status','add_time','update_time'];
}