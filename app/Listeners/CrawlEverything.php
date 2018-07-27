<?php

namespace Updater\Listeners;

use Updater\Events\UpdaterCronjobTriggered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Updater\Jobs\CrawlEverythingJob;
use Updater\Events\ReceivedPageCount;

class CrawlEverything
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
     * @param  UpdaterCronjobTriggered  $event
     * @return void
     */
    public function handle(UpdaterCronjobTriggered $event)
    {
        // Trigger the event.
        event(new ReceivedPageCount(10));
    }
}
