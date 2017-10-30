<?php

namespace Ilbeygi\UserPermission;

use Illuminate\Support\ServiceProvider;
use Ilbeygi\UserPermission\Middleware\CheckRole;

class userPermissionServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // routes
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        
        // views
        $this->loadViewsFrom(__DIR__.'/Views', 'RoleView');
        $this->publishes([
            __DIR__.'/Views' => resource_path('views/userPermission'),
            __DIR__.'/migrations' => 'database/migrations'
        ],'userPermissionPackage_ilbeygi_ir');
        
        $this->loadMigrationsFrom(__DIR__.'/migrations');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/Config/config.php', 'RoleConfig'
        );
        
        
    }
}
