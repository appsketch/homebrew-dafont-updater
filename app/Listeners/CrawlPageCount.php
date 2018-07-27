<?php

namespace Updater\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Updater\Jobs\CrawlPageCountJob;
use Updater\Events\HandleCrawlPageCount;

class CrawlPageCount
{
    /**
     * 
     */
    public function __construct() {}

    /**
     * Handle the event.
     *
     * @param  HandleCrawlPageCount  $event
     * @return void
     */
    public function handle(HandleCrawlPageCount $event)
    {
        // Dispatch the job.
        CrawlPageCountJob::dispatch($event->lettre);
    }
}
