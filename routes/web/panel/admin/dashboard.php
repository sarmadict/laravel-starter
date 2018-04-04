<?php


Route::group([
    'namespace' => 'Panel\Admin\Dashboard',
    'prefix' => 'admin',
    'domain' => domain('panel'),
    'as' => 'panel.admin.dashboard.'],
    function () {
        Route::get('/', 'DashboardController@index')
            ->name('show');

        Route::get('/dashboard', 'DashboardController@index');
    }
);