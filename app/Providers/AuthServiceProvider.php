<?php

namespace App\Providers;

use App\Models\Users\User;
use App\Models\Categories\Category;
use App\Models\Posts\Post;
use App\Policies\Categories\CategoryPolicy;
use App\Policies\Posts\PostPolicy;
use App\Policies\Users\UserPolicy;
use App\Services\Auth\FlexibleUserProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Category::class => CategoryPolicy::class,
        Post::class => PostPolicy::class,
        User::class => UserPolicy::class,
    ];


    /**
     * {@inheritdoc}
     */
    public function register()
    {
        Passport::ignoreMigrations();
    }

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Auth::provider('flexible_eloquent', function ($app, array $config) {
            return new FlexibleUserProvider($app['hash'], $config['model']);
        });

        // Passport::routes();
    }
}
