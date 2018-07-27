<?php

namespace Updater\Listeners;

use Updater\Events\UpdaterInitializeTriggered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Updater\Jobs\CreateAlphabetDirectoryJob;

class CreateAlphabetDirectory
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
     * @param  UpdaterInitializeTriggered  $event
     * @return void
     */
    public function handle(UpdaterInitializeTriggered $event)
    {
        // Dispatch the job.
        CreateAlphabetDirectoryJob::dispatch();
    }
}
