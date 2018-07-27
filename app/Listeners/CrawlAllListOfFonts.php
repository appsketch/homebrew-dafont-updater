<?php

namespace Updater\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Updater\Jobs\CrawlAllListOfFontsJob;
use Updater\Events\ReceivedPageCount;

class CrawlAllListOfFonts
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
     * @param  ReceivedPageCount  $event
     * @return void
     */
    public function handle(ReceivedPageCount $event)
    {
        // Dispatch the job.
        CrawlAllListOfFontsJob::dispatch($event->amountOfPages, $event->lettre);
    }
}
