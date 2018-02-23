<?php

Route::group([
    'namespace' => 'Accounts\Auth',
    'prefix' => 'auth',
    'domain' => domain('accounts')],
    function () {
        Route::get('/login', 'LoginController@showLoginForm')
            ->name('accounts.auth.login.show');

        Route::post('/login', 'LoginController@login')
            ->name('accounts.auth.login.login');

        Route::get('/register', 'RegisterController@showRegistrationForm')
            ->name('accounts.auth.register.show');

        Route::post('/register', 'RegisterController@register')
            ->name('accounts.auth.register.register');
    }
);