<?php

namespace Updater\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Storage;

use Chumper\Zipper\Facades\Zipper;

use Updater\Events\ZipFileExtracted;
use Updater\Models\Cask;

class ExtractZipJob implements ShouldQueue
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
        // Delete the directory if exists.
        Storage::deleteDirectory($this->cask->path . $this->cask->slug);

        // Zipper object.
        $zipper = Zipper::make(storage_path('app/' . $this->cask->path . $this->cask->zip_name))->extractTo(storage_path('app/' . $this->cask->path . $this->cask->slug));

        // Call the event.
        event(new ZipFileExtracted($this->cask));
    }
}
