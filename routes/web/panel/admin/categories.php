<?php


Route::group([
    'namespace' => 'Panel\Admin\Categories',
    'prefix' => 'admin/general',
    'domain' => domain('panel'),
    'as' => 'panel.admin.',
    'middleware' => 'panel.admin'],
    function () {
        Route::resource('categories', 'CategoriesController');

    }
);