<?php

namespace Updater\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Updater\Jobs\CrawlAllPageCountJob;
use Updater\Events\UpdaterGenerateAllTriggered;

class CrawlAllPageCount
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
     * @param  UpdaterGenerateAllTriggered  $event
     * @return void
     */
    public function handle(UpdaterGenerateAllTriggered $event)
    {
        // Dispatch the job.
        CrawlAllPageCountJob::dispatch();
    }
}
