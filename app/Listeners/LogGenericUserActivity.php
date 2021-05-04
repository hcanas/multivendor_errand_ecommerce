<?php

namespace App\Listeners;

use App\Events\GenericUserActivity;
use App\Models\UserActivity;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogGenericUserActivity
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  GenericUserActivity  $event
     * @return void
     */
    public function handle(GenericUserActivity $event)
    {
        UserActivity::create([
            'user_id' => $event->user_id,
            'overview' => $event->overview,
            'type' => $event->type,
        ]);
    }
}
