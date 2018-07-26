<?php

namespace Updater\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class GenerateSha256Hash implements ShouldQueue
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

        // Generate the SHA256 hash.
        $cask->sha256 = hash_file('sha256', storage_path('app/' . $cask->path . $cask->zip_name));

        // Save the cask.
        $cask->save();
    }
}
