<?php

Route::namespace('App\Modules\Admin\Categories\Controllers')
    ->middleware(['web', 'admin'])
    ->domain(domain('panel'))
    ->prefix('admin/general')
    ->name('admin.')
    ->group(function () {
        Route::resource('categories', 'CategoriesController');

    });