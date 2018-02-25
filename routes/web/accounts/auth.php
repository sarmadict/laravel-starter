<?php

Route::group([
    'namespace' => 'Accounts\Auth',
    'prefix' => 'auth',
    'domain' => domain('accounts'),
    'as' => 'accounts.auth.'],
    function () {
        Route::get('/login', 'LoginController@showLoginForm')
            ->name('login.show');

        Route::post('/login', 'LoginController@login')
            ->name('login.login');

        Route::get('/register', 'RegisterController@showRegistrationForm')
            ->name('register.show');

        Route::post('/register', 'RegisterController@register')
            ->name('register.register');

        Route::any('/logout', 'RegisterController@logout')
            ->name('login.logout');
    }
);