<?php

namespace App\Services\Alert;

use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;
use Illuminate\Session\Store as SessionStore;

class AlertServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(SessionStore $session)
    {
        view()->composer('*', function (View $view) use ($session) {
            $view->with('alerts', $session->get('alerts') ?: new ViewAlertBag);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('alert.response', function ($app) {
            return new AlertResponse($app['session.store']);
        });
    }
}
