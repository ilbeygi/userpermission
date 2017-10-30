# userpermissions
This is a package about permissions of users in laravel

-------

## How to install userPermission package on laravel

**Installation**

STEP 1 :

```
composer require "ilbeygi/userpermission":"dev-master"
```

STEP 2 : Add `provider` in config/app.php

```
'providers' => [
  ...
  Ilbeygi\UserPermission\userPermissionServiceProvider::class, // <-- add this line at the end of provider array
],
```

STEP 3 :
```
  php artisan vendor:publish --tag=userPermissionPackage_ilbeygi_ir
```
STEP 4 : 
```
  php artisan migrate
```

STEP 5 : add `middleware` in `app/Http/Kernel.php` 
```
protected $routeMiddleware = [
        ....
        'checkRoles' => \Ilbeygi\UserPermission\Middlewares\CheckRole::class,  // <-- add this line at the end of $routeMiddleware
    ];
```

STEP 6 : run laravel
```
  php artisan serve
```

STEP 7 : Go to this way (just for once) 
```
  http://{your_laravel_address}/saveAllRouteNameInDatabase
```

STEP8 : 
  Go to `vendor/ilbeygi/userpermission/src/route.php` and delete `/saveAllRouteNameInDatabase` route :
```
Route::get('/saveAllRouteNameInDatabase', function (){
    
        ......
    });
```
