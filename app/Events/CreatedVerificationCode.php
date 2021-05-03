<?php

namespace App\Events;

use App\Models\VerificationCode;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CreatedVerificationCode
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $verification_code;

    /**
     * Create a new event instance.
     *
     * @param VerificationCode $verification_code
     * @return void
     */
    public function __construct(VerificationCode $verification_code)
    {
        $this->verification_code = $verification_code;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
