<?php

namespace Updater\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Updater\Models\Cask;

class CaskFileGenerated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $cask;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Cask $cask)
    {
        // Set the cask file.
        $this->cask = $cask;
    }
}
