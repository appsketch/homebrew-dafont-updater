<?php

namespace Updater\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Chumper\Zipper\Facades\Zipper;
use Updater\Enumerations\Font;

class ExtractZip
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

        // Zipper object.
        $zipper = Zipper::make(storage_path('app/' . $cask->path . $cask->zip_name));

        // Remove files that aren't fonts.
        $zipper->remove(array_filter($zipper->listFiles(), function($file) {
            return !Font::isFont($file);
        }));
        
        // Unzip the downloaded zip file.
        $zipper->extractTo(storage_path('app/' . $cask->path . $cask->slug));
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
            'Updater\Listeners\ExtractZip@handle'
        );
    }
}
