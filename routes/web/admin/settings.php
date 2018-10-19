<?php

Route::namespace('App\Modules\Admin\Settings\Controllers')
    ->middleware(['web', 'admin'])
    ->domain(domain('panel'))
    ->prefix('admin/general')
    ->name('admin.')
    ->group(function () {
        Route::get('settings/{type?}', 'SettingsController@edit')->name('settings.edit');

        Route::put('settings/{type?}', 'SettingsController@update')->name('settings.update');

    });