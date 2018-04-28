<?php

Route::namespace('App\Modules\Admin\Posts\Controllers')
    ->middleware(['web', 'admin'])
    ->domain(domain('panel'))
    ->prefix('admin/blog')
    ->name('admin.')
    ->group(function () {
        Route::resource('posts', 'PostsController');

    });