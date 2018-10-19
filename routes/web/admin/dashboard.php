<?php

Route::namespace('App\Modules\Admin\Dashboard\Controllers')
    ->middleware(['web', 'admin'])
    ->domain(domain('panel'))
    ->prefix('admin/')
    ->name('admin.')
    ->group(function () {
        Route::get('/', 'DashboardController@index')->name('dashboard.index');

        Route::get('/dashboard', 'DashboardController@index');
    });
