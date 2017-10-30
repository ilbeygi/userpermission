<?php

namespace Ilbeygi\UserPermission\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserRole extends Model
{
    protected $table = "user_roles";
    use SoftDeletes;

    public function users()
    {
    	return $this->belongsTo('Ilbeygi\UserPermission\Models\User');
    }


    public function rolenames()
    {
    	return $this->belongsTo('Ilbeygi\UserPermission\Models\RoleName','role_names_id');
    }
    protected $dates = ['deleted_at'];
}



 