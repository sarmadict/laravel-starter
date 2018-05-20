<?php

namespace App\Providers;


use App\Models\Categories\Category;
use App\Models\Categories\CategoryObserver;
use App\Models\Permissions\Permission;
use App\Models\Permissions\PermissionObserver;
use App\Models\Posts\Post;
use App\Models\Posts\PostObserver;
use App\Models\Roles\Role;
use App\Models\Roles\RoleObserver;
use App\Models\Users\User;
use App\Models\Users\UserObserver;
use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Category::observe(CategoryObserver::class);

        Permission::observe(PermissionObserver::class);

        Post::observe(PostObserver::class);

        Role::observe(RoleObserver::class);

        User::observe(UserObserver::class);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
