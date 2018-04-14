<?php


Route::group([
    'namespace' => 'Panel\Admin\Dashboard',
    'prefix' => 'admin/',
    'domain' => domain('panel'),
    'as' => 'panel.admin.dashboard.',
    'middleware' => 'panel.admin'],
    function () {
        Route::get('/', 'DashboardController@index')->name('index');

        Route::get('/dashboard', 'DashboardController@index');
    }
);