<?php

namespace Updater\Listeners;

use Updater\Events\UpdaterInitializeTriggered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;

use Updater\Updater\Directory;

class CreateCasksDirectory
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UpdaterInitializeTriggered  $event
     * @return void
     */
    public function handle(UpdaterInitializeTriggered $event)
    {
        // Create the Casks directory if it doens't exists.
        Storage::makeDirectory(ENV('HOMEBREW_DAFONT_GIT_DIRECTORY') . DIRECTORY_SEPARATOR . 'Casks');
    }
}
