<?php

namespace Updater\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CreateAlphabetDirectoryJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct() {}

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // All the folders.
        $folders = alphabet();

        // Loop through each folder.
        foreach($folders as $folder)
        {
            // Create the directory if it doens't exists.
            Storage::makeDirectory(ENV('HOMEBREW_DAFONT_ZIP_DIRECTORY') . DIRECTORY_SEPARATOR . $folder);
        }
    }
}
