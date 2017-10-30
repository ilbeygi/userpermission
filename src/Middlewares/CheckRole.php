<?php

namespace Ilbeygi\UserPermission\Middlewares;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();
        if ($user){
            $myurl = request()->route()->getName();
            $userrole = \Ilbeygi\UserPermission\Models\UserRole::where('users_id',$user->id)->first();
            $rolenames = \Ilbeygi\UserPermission\Models\RoleName::findOrFail($userrole->role_names_id);
            $roles = \Ilbeygi\UserPermission\Models\Role::where('role_names_id',$userrole->role_names_id)->get();
            $routidarr = array();
            foreach ($roles as $role) {
                $routidarr[] = $role->routes_id;
            }
            $routes = \Ilbeygi\UserPermission\Models\Route::whereIn('id',$routidarr)->get();
            foreach ($routes as $route) {
                if ($user and $myurl == $route->route and $user->user_type == $rolenames->role_name ) {
                        return $next($request);
                }
            }
            session()->flash('status','Sorry, you do not have permission to access this page.');
            return view('userPermission.errorAuth');
        } else {
            return redirect('/home');
        }
    }
}
