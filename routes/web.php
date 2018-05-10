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

Route::get('/test/1', function (\Illuminate\Http\Request $request) {
    dd($request->path());
});


Route::get('test/4', function () {
    $user = Auth::user();

    $permissionNames = [
        'admin.users.index',
        'admin.users.create',
        'admin.users.show',
        'admin.users.edit',
        'admin.users.delete',
    ];

    $permissions = [];

    foreach ($permissionNames as $permissionName) {
        $permissions[] = \App\Models\Accounts\Permission::query()->firstOrCreate([
            'name' => $permissionName
        ], [
            'title' => $permissionName,
            'type' => \App\Services\Acl\Types\Permission::PRIMARY,
            'state' => \App\Types\State::ENABLED,
        ]);
    }

    $user->permissions()->syncWithoutDetaching(array_pluck($permissions, 'id'));

    cache()->clear();

});


Route::get('test/5', function () {
    $user = Auth::user();
    dd(\App\Types\Blog\PostStatus::flipTrans('dsdsd.dsds'));
//    dd($user->can('panelAdminCategoriesIndex', \App\Models\Categories\Category::class));
//
//    $user = \App\Models\Users\User::find(1);

    $items = collect();

    foreach (\App\Models\Accounts\Permission::all() as $permission) {
        $items->put($permission->id, $user->can($permission->name));
//        $items->push($user->hasPermissionTo($permission->name));
    }

    dump($items->toArray());
});

Route::get('test/6', function (\App\Repositories\Users\UserRepository $users) {

    for ($i = 215; $i <= 1000; $i++) {
        $users->registerUser([
            'first_name' => "Saeid_{$i}",
            'last_name' => "Asadi",
            'display_name' => "Saeid_{$i} Asadi nickname",
            'email' => "saeid_{$i}@gmail.com",
            'username' => "saeid_{$i}",
            'gender' => \App\Types\Accounts\Gender::MALE,
            'state' => \App\Types\State::ENABLED,
            'password' => bcrypt("admini")
        ]);
    }

});