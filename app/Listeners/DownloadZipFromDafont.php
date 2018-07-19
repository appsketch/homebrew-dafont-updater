<?php

namespace Updater\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class DownloadZipFromDafont
{
    /**
     * Handle download zip from Dafont.
     * 
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        // The cask.
        $cask = $event->cask;

        // Download the zip file.
        Storage::put($cask->path . $cask->zip_name, File($cask->url));
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            '',
            'Updater\Listeners\DownloadZipFromDafont@handle'
        );
    }
}
