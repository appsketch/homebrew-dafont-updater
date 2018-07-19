<?php

namespace Updater\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use Updater\Updater\Directory;

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
        // The cask.
        $cask = $event->cask;

        // Generate the view file.
        Storage::put(Directory::getCaskPath() . $cask->cask_name, View::make('cask', $cask));
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
            'Updater\Listeners\GenerateCaskFile@handle'
        );
    }
}
