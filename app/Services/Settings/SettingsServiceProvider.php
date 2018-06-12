<?php

namespace App\Services\Settings;

use Illuminate\Support\ServiceProvider;
use anlutro\LaravelSettings\Facade as Settings;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Settings::extend('intelligent_database', function ($app) {
            $connectionName = $this->getConfig('connection');
            $connection = $this->app['db']->connection($connectionName);
            $table = $this->getConfig('table');
            $keyColumn = $this->getConfig('keyColumn');
            $valueColumn = $this->getConfig('valueColumn');

            return new IntelligentDatabaseStore($connection, $table, $keyColumn, $valueColumn, $app['cache.store']);
        });
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

    protected function getConfig($key)
    {
        return $this->app['config']->get('settings.' . $key);
    }
}
