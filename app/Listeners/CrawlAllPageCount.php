<?php

namespace Updater\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Updater\Events\HandleCrawlPageCount;

class CrawlAllPageCount implements ShouldQueue
{
    /**
     * 
     */
    private $alphabet;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        // All the lettres to crawl.
        $this->alphabet = alphabet(false);
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        // Loop through each lettre.
        foreach($this->alphabet as $lettre)
        {
            // Trigger the handle crawl page count event.
            event(new HandleCrawlPageCount($lettre));
        }
    }
}
