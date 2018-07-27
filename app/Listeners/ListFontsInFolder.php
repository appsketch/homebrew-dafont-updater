<?php

namespace Updater\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Updater\Jobs\ListFontsInFolderJob;
use Updater\Events\ZipFileExtracted;

class ListFontsInFolder
{
    /**
     * Handle the event.
     *
     * @param  ZipFileExtracted  $event
     * @return void
     */
    public function handle(ZipFileExtracted $event)
    {
        // Dispatch the job.
        ListFontsInFolderJob::dispatch($event->cask);
    }
}
