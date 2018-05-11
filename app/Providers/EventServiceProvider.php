<?php

namespace App\Providers;

use App\Events\Users\UserCreated;
use App\Events\Users\UserUpdated;
use App\Listeners\Users\ClearUserPermissionsCache;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        UserUpdated::class => [
            ClearUserPermissionsCache::class,
        ],
        UserCreated::class => [
            //
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
