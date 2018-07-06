<?php

namespace Updater\Listeners;

use Updater\Events\UpdaterInitializeTriggered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;

class CreateAlphabetDirectory
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
        // Check if the folder doesn't exists.
        if(!in_array($event->folder, Storage::directories()))
        {
            // Create the folder.
            Storage::makeDirectory($event->folder);
        }
    }
}
