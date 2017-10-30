<?php

namespace Ilbeygi\UserPermission\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Ilbeygi\UserPermission\Models\RoleName;
use Ilbeygi\UserPermission\Models\Route;
use Ilbeygi\UserPermission\Models\Role;


class PermissionController extends Controller
{
    /**
     * index of permissions.
     *
     * @return view() function
     */
    public function index()
    {
    	$rolenames = RoleName::orderBy('id','desc')->paginate(12);
    	return view('userPermission.userRoleGroup',compact('rolenames'));
    }

    /**
     * insert role names in database.
     *
     * @return back() function
     */
    public function store(Request $request)
    {
    	$this->validate($request,[
    		'role_name' => 'required|min:3'
    	]);
    	$rolename = new RoleName;
    	$rolename->role_name = $request->role_name;
    	if($rolename->save())
    		session()->flash('status','The user group has been added successfully   .');
    	else
    		session()->flash('status','The user group was not created successfully. Please try again.');
    	return back();
    }


    /**
     * show index access.
     *
     * @return void
     */
    public function accessIndex($id)
    {
    	$routes = Route::all();
    	$roles = Role::where('role_names_id',$id)->paginate(40);
    	return view('userPermission.addPermissions',compact('roles','routes','id'));
    }

    /**
     * store access.
     *
     * @return void
     */
    public function accessStore(Request $request)
    {
        $this->validate($request,[
                'role_names_id' => 'required',
                'access' => 'required'
            ]);

        if (!empty($request->access)) {
            foreach ($request->access as $access) {
                if (Role::where('routes_id',$access)->where('role_names_id',$request->role_names_id)->first()) {
                    continue;
                }else{
                    $role = new Role;
                    $role->routes_id = $access;
                    $role->role_names_id = $request->role_names_id;
                    $role->save();
                }
            }
        }

        session()->flash('status','Permissions have been added successfully.');
        return back();

    }


    /**
     * delete access.
     *
     * @return void
     */
    public function accessDelete($id)
    {
        Role::destroy($id);
        return back();
    }

    /**
     * store Route.
     *
     * @return void
     */
    public function routeStore(Request $request)
    {
        $this->validate($request,[
            'route_name' => 'required',
            'route' => 'required'
        ]);

        $route = new Route;
        $route->route = $request->route;
        $route->route_name = $request->route_name;
        if ($route->save()) {
            session()->flash('status','new route have been added successfully.');
        }else{
            session()->flash('status','Sorry, there was a problem registering the new route , Please try again.');
        }
        return back();
    }

}
