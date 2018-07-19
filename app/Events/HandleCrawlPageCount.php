<?php

namespace Updater\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class HandleCrawlPageCount
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The lettre
     * 
     * @var  string
     */
    public $lettre;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(String $lettre)
    {
        $this->lettre = $lettre;
    }
}
