<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Admin Panel
require 'web/admin/core.php';
require 'web/admin/dashboard.php';
require 'web/admin/settings.php';
require 'web/admin/categories.php';
require 'web/admin/posts.php';
require 'web/admin/roles.php';
require 'web/admin/users.php';


//Accounts
require 'web/accounts/auth.php';
