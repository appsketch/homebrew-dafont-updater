<?php

namespace Updater\Listeners;

use Updater\Events\UpdaterInitializeTriggered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Updater\Updater\Directory;

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
        // All the folders.
        $folders = Directory::alphabet();

        // Loop through each folder.
        foreach($folders as $folder)
        {
            // Create the directory if it doens't exists.
            Directory::createDirectory(ENV('HOMEBREW_DAFONT_ZIP_DIRECTORY') . DIRECTORY_SEPARATOR . $folder);
        }
    }
}
