<?php

namespace Updater\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use Updater\Events\FontInformationCrawled;
use Updater\Events\ZipFileDownloaded;

class DownloadZipFromDafont implements ShouldQueue
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

        // Call the event.
        event(new ZipFileDownloaded($cask));
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            FontInformationCrawled::class,
            'Updater\Listeners\DownloadZipFromDafont@handle'
        );
    }
}
