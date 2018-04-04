<?php

namespace App\Providers;

use App\ViewComposers\AdminPanelComposer;
use App\ViewComposers\GeneralComposer;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', GeneralComposer::class);

        view()->composer('panel.admin.*', AdminPanelComposer::class);
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
