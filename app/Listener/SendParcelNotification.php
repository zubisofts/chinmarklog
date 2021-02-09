<?php

namespace App\Listener;

use App\Event\UpdateParcelStatus;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendParcelNotification
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
     * @param  UpdateParcelStatus  $event
     * @return void
     */
    public function handle(UpdateParcelStatus $event)
    {
        //
    }
}
