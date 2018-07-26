<?php

namespace Updater\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

use Updater\Events\HandleCrawlListOfFonts;

class CrawlAllListOfFonts implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct() {}

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        // Loop through each page.
        foreach(range(1, $event->amountOfPages) as $page)
        {
            // Call the event.
            event(new HandleCrawlListOfFonts($event->lettre, $page));
        }
    }
}
