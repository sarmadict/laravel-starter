<?php

Route::namespace('App\Modules\Admin\Users\Controllers')
    ->middleware(['web', 'admin'])
    ->domain(domain('panel'))
    ->prefix('admin/accounts')
    ->name('admin.')
    ->group(function () {
        Route::resource('users', 'UsersController');

        Route::post('users/get', 'UsersTableController')->name('users.get');
    });