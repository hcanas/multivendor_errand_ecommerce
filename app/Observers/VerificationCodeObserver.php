<?php

namespace App\Observers;

use App\Models\VerificationCode;
use Illuminate\Support\Facades\Mail;

class VerificationCodeObserver
{
    public function created(VerificationCode $verification_code)
    {
        Mail::to($verification_code->email)
            ->queue(new \App\Mail\VerificationCode($verification_code));
    }
}
