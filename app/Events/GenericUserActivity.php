<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class GenericUserActivity
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user_id = null;

    public $overview = '';

    public $type = 'generic';

    /**
     * Create a new event instance.
     *
     * @param String $overview
     * @param int|null $user_id
     * @return void
     */
    public function __construct($overview, int $user_id = null)
    {
        $this->overview = $overview;
        $this->user_id = Auth::check() ? Auth::id() : $user_id;
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
