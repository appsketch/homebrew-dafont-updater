<?php

namespace Updater\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Updater\Jobs\CrawlFontInformationJob;
use Updater\Events\HandleCrawlFontInformation;

class CrawlFontInformation
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
     * @param  HandleCrawlFontInformation  $event
     * @return void
     */
    public function handle(HandleCrawlFontInformation $event)
    {
        // Dispatch the job.
        CrawlFontInformationJob::dispatch($event->font);
    }
}
