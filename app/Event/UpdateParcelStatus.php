<?php

namespace App\Event;

use App\Models\User;
use App\Models\parcel;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UpdateParcelStatus implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $parcel;
    public $user;
    public $details;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    
    public function __construct(parcel $parcel, User $user, array $details)
    {
        $this->parcel = $parcel;
        $this->user = $user;
        $this->details = $details;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('parcel-update');
    }

    public function broadcastAs()
    {
        return 'parcel-changes';
    }
}
