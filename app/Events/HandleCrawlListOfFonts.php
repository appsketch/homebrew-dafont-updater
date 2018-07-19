<?php

namespace Updater\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class HandleCrawlListOfFonts
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The lettre to crawl.
     */
    public $lettre;

    /**
     * The page to crawl.
     */
    public $page;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($lettre, $page)
    {
        // Set the lettre to crawl.
        $this->lettre = $lettre;

        // Set the page to crawl.
        $this->page = $page;
    }
}
