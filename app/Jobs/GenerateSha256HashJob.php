<?php

namespace Updater\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Updater\Models\Cask;

class GenerateSha256HashJob implements ShouldQueue
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
        // Generate the SHA256 hash.
        $this->cask->sha256 = hash_file('sha256', storage_path('app/' . $this->cask->path . $this->cask->zip_name));

        // Save the cask.
        $this->cask->save();
    }
}
