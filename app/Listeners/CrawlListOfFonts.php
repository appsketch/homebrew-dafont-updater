<?php

namespace Updater\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Updater\Jobs\CrawlListOfFontsJob;
use Updater\Events\HandleCrawlListOfFonts;

class CrawlListOfFonts
{
    public function __construct() {}

    /**
     * Handle the event.
     *
     * @param  HandleCrawlListOfFonts  $event
     * @return void
     */
    public function handle(HandleCrawlListOfFonts $event)
    {
        // Dispatch the job.
        CrawlListOfFontsJob::dispatch($event->lettre, $event->page);
    }
}
