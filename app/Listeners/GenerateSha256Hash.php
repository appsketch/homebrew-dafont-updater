<?php

namespace Updater\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class GenerateSha256Hash
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

        // Log information.
        Log::info('Generating sha256 hash.', [
            'name' => $cask->name
        ]);

        // Generate the SHA256 hash.
        $cask->sha256 = hash_file('sha256', storage_path('app/' . $cask->path . $cask->zip_name));

        // Save the cask.
        $cask->save();
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
            'Updater\Listeners\GenerateSha256Hash@handle'
        );
    }
}
