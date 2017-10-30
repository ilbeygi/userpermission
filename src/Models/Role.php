<?php

namespace Ilbeygi\UserPermission\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    public function rolenames()
    {
    	return $this->belongsTo('Ilbeygi\UserPermission\Models\RoleName','role_names_id');
    }

    public function routes()
    {
    	return $this->belongsTo('Ilbeygi\UserPermission\Models\Route');
    }
    protected $dates = ['deleted_at'];
}




 