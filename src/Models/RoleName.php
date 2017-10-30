<?php

namespace Ilbeygi\UserPermission\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoleName extends Model
{
    use SoftDeletes;
    protected $table = "role_names";

    /**/

    public function roles()
    {
        return $this->hasMany('Ilbeygi\UserPermission\Models\Role');
    }

    public function userrole()
    {
    	return $this->hasOne('Ilbeygi\UserPermission\Models\UserRole');
    }
    protected $dates = ['deleted_at'];
}


