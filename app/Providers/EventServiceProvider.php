<?php

namespace App\Providers;

use App\Events\CreatedVerificationCode;
use App\Events\GenericUserActivity;
use App\Listeners\LogGenericUserActivity;
use App\Listeners\SendVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        CreatedVerificationCode::class => [
            SendVerificationNotification::class,
        ],
        GenericUserActivity::class => [
            LogGenericUserActivity::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
