<?php

namespace Updater\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Facades\Log;

class ReceivedPageCount
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The amount of pages to crawl.
     */
    public $amountOfPages;

    /**
     * The lettre to crawl.
     */
    public $lettre;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($amountOfPages, $lettre = null)
    {
        // Set the amount of pages to crawl.
        $this->amountOfPages = $amountOfPages;

        // Set the lettre to crawl.
        $this->lettre = $lettre;
    }
}
