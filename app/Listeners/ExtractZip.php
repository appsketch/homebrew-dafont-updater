<?php

namespace Updater\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Updater\Jobs\ExtractZipJob;
use Updater\Events\ZipFileDownloaded;

class ExtractZip
{
    /**
     * Handle the event.
     *
     * @param  ZipFileDownloaded  $event
     * @return void
     */
    public function handle(ZipFileDownloaded $event)
    {
        // Dispatch the job.
        ExtractZipJob::dispatch($event->cask);
    }
}
