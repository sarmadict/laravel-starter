<?php

Route::namespace('App\Modules\Admin\Core\Controllers')
    ->middleware(['web', 'admin'])
    ->domain(domain('panel'))
    ->prefix('admin/core')
    ->name('admin.core.')
    ->group(function () {

        Route::get('search-users', 'SearchUsersController@search')->name('search-users');
    });