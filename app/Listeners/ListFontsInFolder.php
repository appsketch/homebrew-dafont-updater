<?php

namespace Updater\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Updater\Jobs\ListFontsInFolderJob;

class ListFontsInFolder
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        // Dispatch the job.
        ListFontsInFolderJob::dispatch($event->cask);
    }
}
