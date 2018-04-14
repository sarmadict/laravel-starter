<?php

namespace App\Providers;

use App\Http\ViewComposers\AdminPanelComposer;
use App\Http\ViewComposers\GeneralComposer;
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
        // view()->composer('*', GeneralComposer::class);

        view()->composer('panel.admin.layouts.main', AdminPanelComposer::class);
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
