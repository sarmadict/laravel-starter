<?php

Route::namespace('App\Modules\Admin\Roles\Controllers')
    ->middleware(['web', 'admin'])
    ->domain(domain('panel'))
    ->prefix('admin/accounts')
    ->name('admin.')
    ->group(function () {
        Route::resource('roles', 'RolesController');

        Route::post('get', 'RolesTableController')->name('roles.get');
    });