<?php

namespace App\Listeners;

use App\Events\CreatedVerificationCode;
use App\Mail\VerificationCode;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendVerificationNotification
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
     * @param  CreatedVerificationCode  $event
     * @return void
     */
    public function handle(CreatedVerificationCode $event)
    {
        Mail::to($event->verification_code->email)
            ->queue(new VerificationCode($event->verification_code));
    }
}
