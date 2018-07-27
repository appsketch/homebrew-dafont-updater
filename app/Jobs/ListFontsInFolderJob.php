<?php

namespace Updater\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Storage;

use Updater\Enumerations\Font;
use Updater\Events\FontsInFolderListed;
use Updater\Models\Cask;

class ListFontsInFolderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * 
     */
    private $cask;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Cask $cask)
    {
        // Set the cask to use.
        $this->cask = $cask;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // List all the files in the font folder.
        $fonts = Storage::allFiles($this->cask->path . $this->cask->slug);

        // Check if there are any fonts.
        if (collect($fonts)->isNotEmpty())
        {
            // The cask.
            $cask = $this->cask;

            // Map each font file.
            $fonts = array_map(function($font) use ($cask) {
                // Remove the path.
                return str_replace($this->cask->path . $this->cask->slug . DIRECTORY_SEPARATOR, null, $font);
            }, $fonts);

            // Filter non font files.
            $fonts = array_filter($fonts, function($file) {
                // Check if the file is a font.
                return Font::isFont($file);
            });

            // Sort the fonts.
            $fonts = array_values(array_sort($fonts));

            // Set the fonts.
            $this->cask->fonts = $fonts;

            // Save the cask.
            $this->cask->save();

            // Call the event.
            event(new FontsInFolderListed($this->cask));
        }
    }
}
