<?php

Route::group(['middleware' => ['web', 'auth']], function () {
    
    /*route of permissions*/
    Route::get('/panel/permissions','Ilbeygi\UserPermission\Controller\PermissionController@index')->name('permissions.group.index');
    Route::post('/panel/permissions','Ilbeygi\UserPermission\Controller\PermissionController@store')->name('permissions.group.store');
    Route::get('/panel/permissions/access/{id}','Ilbeygi\UserPermission\Controller\PermissionController@accessIndex')->name('permissions.access.index');
    Route::post('/panel/permissions/access/','Ilbeygi\UserPermission\Controller\PermissionController@accessStore')->name('permissions.access.store');
    Route::post('/panel/permissions/access/delete/{id}','Ilbeygi\UserPermission\Controller\PermissionController@accessDelete')->name('permissions.access.delete');
    Route::post('/panel/permissions/route/store','Ilbeygi\UserPermission\Controller\PermissionController@routeStore')->name('permissions.route.store');

});

Route::group(['middleware' => ['web', 'auth']], function(){
    
    Route::get('/saveAllRouteNameInDatabase', function (){
    
        $rr = array();
        $rotue = resolve('Illuminate\Routing\Router')->getRoutes();
        foreach ($rotue as $r){
            $rr[] = $r;
        }

        $allRoute = array();
        foreach ($rr as $r){
            if (isset($r->action['as']))
                $allRoute[] = $r->action['as'];
        }
        
        $bool = false;
        foreach ($allRoute as $route){
            $rowr = Ilbeygi\UserPermission\Models\Route::where('route',$route)->first();
            if ($rowr != NULL){
                continue;
            }else {
                $ro = new Ilbeygi\UserPermission\Models\Route();
                $ro->route = $route;
                $ro->route_name = $route;
                $ro->save();
                $bool = TRUE;
            }
        }
        
        if ($bool){
            
            $allroutesdb = Ilbeygi\UserPermission\Models\Route::all();
            $deleted = \DB::delete('delete from roles');
            
            if ($allroutesdb != NULL){
                $rolename = Ilbeygi\UserPermission\Models\RoleName::where('role_name','superadmin')->first();
                if ($rolename == NULL){
                    $newrolename = new Ilbeygi\UserPermission\Models\RoleName();
                    $newrolename->role_name = 'superadmin';
                    $newrolename->save();
                    $rolenameID = $newrolename->id;
                } else {
                    $rolenameID = $rolename->id;
                }

                foreach ($allroutesdb as $allrdb){
                    $roles = new Ilbeygi\UserPermission\Models\Role();
                    $roles->role_names_id = $rolenameID;
                    $roles->routes_id = $allrdb->id;
                    $roles->save();
                }
                
                $checkuserrole = Ilbeygi\UserPermission\Models\UserRole::where('users_id',auth()->user()->id)->first();
                if ($checkuserrole == NULL){
                    $user_role = new Ilbeygi\UserPermission\Models\UserRole();
                    $user_role->users_id = auth()->user()->id;
                    $user_role->role_names_id = $rolenameID;
                    $user_role->save();
                }
                

            }
        }
        
        if ($bool)
            return 'routes inserted to database';
        else
            return 'routes cant inserted to database';
    });
});


