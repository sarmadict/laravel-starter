<?php

Route::namespace('App\Modules\Accounts\Auth\Controllers')
    ->middleware(['web'])
    ->prefix('auth')
    ->name('auth.')
    ->group(function () {
        Route::get('/login', 'LoginController@showLoginForm')
            ->name('login.show');

        Route::post('/login', 'LoginController@login')
            ->name('login.login');

        Route::get('/register', 'RegisterController@showRegistrationForm')
            ->name('register.show');

        Route::post('/register', 'RegisterController@register')
            ->name('register.register');

        Route::any('/logout', 'LoginController@logout')
            ->name('logout.logout');

        Route::get('password/forget', 'ForgotPasswordController@showLinkRequestForm')
            ->name('password.forget');

        Route::post('password/request', 'ForgotPasswordController@sendResetLinkEmail')
            ->name('password.request');

        Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')
            ->name('password.recover');

        Route::post('password/reset', 'ResetPasswordController@reset')
            ->name('password.reset');
    });