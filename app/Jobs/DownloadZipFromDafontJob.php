<?php

namespace Updater\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use Updater\Models\Cask;
use Updater\Events\ZipFileDownloaded;

class DownloadZipFromDafontJob implements ShouldQueue
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
        // Download the zip file.
        Storage::put($this->cask->path . $this->cask->zip_name, File($this->cask->url));

        // Call the event.
        event(new ZipFileDownloaded($this->cask));
    }
}
