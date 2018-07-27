<?php

namespace Updater\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Updater\Jobs\GenerateSha256HashJob;
use Updater\Events\ZipFileDownloaded;

class GenerateSha256Hash
{
    /**
     * Handle the event.
     *
     * @param  ZipFileDownloaded  $event
     * @return void
     */
    public function handle(ZipFileDownloaded $event)
    {
        // Dispatch the event.
        GenerateSha256HashJob::dispatch($event->cask);
    }
}
