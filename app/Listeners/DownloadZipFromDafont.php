<?php

namespace Updater\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Updater\Jobs\DownloadZipFromDafontJob;

class DownloadZipFromDafont
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct() {}

    /**
     * Handle download zip from Dafont.
     * 
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        // Dispatch the job.
        DownloadZipFromDafontJob::dispatch($event->cask);
    }
}
