<?php

namespace App\Modules\Admin\Roles;


use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes.php');

        $this->loadViewsFrom(__DIR__ . '/Views', 'AdminRoles');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}