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

require route_path('web/accounts/auth.php');

Route::get('/test/1', function (\Illuminate\Http\Request $request){
     dd($request->path());
});


Route::get('test/5', function () {
    $user = Auth::user();

//    dd($user->can('panelAdminCategoriesIndex', \App\Models\Categories\Category::class));
//
//    $user = \App\Models\Accounts\User::find(1);

    $items = collect();

    foreach (\App\Models\Accounts\Permission::all() as $permission){
        $items->put($permission->id,$user->can($permission->name));
//        $items->push($user->hasPermissionTo($permission->name));
    }

    dump($items->toArray());
});