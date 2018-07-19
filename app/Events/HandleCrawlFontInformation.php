<?php

namespace Updater\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class HandleCrawlFontInformation
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The font to crawl.
     */
    public $font;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($font)
    {
        // Set the font to crawl.
        $this->font = $font;
    }
}
