<?php

namespace Updater\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;

use Updater\Enumerations\Font;
use Updater\Events\ZipFileExtracted;
use Updater\Events\FontsInFolderListed;

class ListFontsInFolder implements ShouldQueue
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

        // List all the files in the font folder.
        $fonts = Storage::allFiles($cask->path . $cask->slug);

        // Check if there are any fonts.
        if (collect($fonts)->isNotEmpty())
        {
            // Map each font file.
            $fonts = array_map(function($font) use ($cask) {
                // Remove the path.
                return str_replace($cask->path . $cask->slug . DIRECTORY_SEPARATOR, null, $font);
            }, $fonts);

            // Filter non font files.
            $fonts = array_filter($fonts, function($file) {
                // Check if the file is a font.
                return Font::isFont($file);
            });

            // Sort the fonts.
            $fonts = array_values(array_sort($fonts));

            // Set the fonts.
            $cask->fonts = $fonts;

            // Save the cask.
            $cask->save();

            // Call the event.
            event(new FontsInFolderListed($cask));
        }
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            ZipFileExtracted::class,
            'Updater\Listeners\ListFontsInFolder@handle'
        );
    }
}
