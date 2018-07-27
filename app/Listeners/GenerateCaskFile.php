<?php

namespace Updater\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Updater\Jobs\GenerateCaskFileJob;

class GenerateCaskFile
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
        GenerateCaskFileJob::dispatch($event->cask);
    }
}
