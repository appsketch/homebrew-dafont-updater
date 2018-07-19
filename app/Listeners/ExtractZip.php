<?php

namespace Updater\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;

use Chumper\Zipper\Facades\Zipper;

use Updater\Events\ZipFileDownloaded;
use Updater\Events\ZipFileExtracted;

class ExtractZip implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        // The cask.
        $cask = $event->cask;

        // Delete the directory if exists.
        Storage::deleteDirectory($cask->path . $cask->slug);

        // Zipper object.
        $zipper = Zipper::make(storage_path('app/' . $cask->path . $cask->zip_name))->extractTo(storage_path('app/' . $cask->path . $cask->slug));

        // Call the event.
        event(new ZipFileExtracted($cask));
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            ZipFileDownloaded::class,
            'Updater\Listeners\ExtractZip@handle'
        );
    }
}
