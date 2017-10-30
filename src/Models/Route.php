<?php

namespace Ilbeygi\UserPermission\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Route extends Model
{
    use SoftDeletes;

    public function roles()
    {
    	return $this->hasMany('Ilbeygi\UserPermission\Models\Role');
    }
    protected $dates = ['deleted_at'];
}




