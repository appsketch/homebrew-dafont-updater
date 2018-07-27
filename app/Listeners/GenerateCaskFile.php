<?php

namespace Updater\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Updater\Jobs\GenerateCaskFileJob;
use Updater\Events\FontsInFolderListed;

class GenerateCaskFile
{
    /**
     * Handle the event.
     *
     * @param  FontsInFolderListed  $event
     * @return void
     */
    public function handle(FontsInFolderListed $event)
    {
        // Dispatch the job.
        GenerateCaskFileJob::dispatch($event->cask);
    }
}
