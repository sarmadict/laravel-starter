<?php

namespace App\Providers;

use App\Services\Acl\PermissionRegistrar;
use Illuminate\Support\ServiceProvider;

class AclServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @param @permissionRegistrar
     * @return void
     */
    public function boot(PermissionRegistrar $permissionRegistrar)
    {
        $permissionRegistrar->registerPermissions();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
