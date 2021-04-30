<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerificationCode extends Mailable
{
    use Queueable, SerializesModels;

    public $verification_code;

    public function __construct(\App\Models\VerificationCode $verification_code)
    {
        $this->verification_code = $verification_code;
    }

    public function build()
    {
        return $this->view('mails/verification_code')
            ->subject('Verification Code')
            ->with('verification_code', $this->verification_code);
    }
}
