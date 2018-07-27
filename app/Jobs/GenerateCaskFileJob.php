<?php

namespace Updater\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;

use Updater\Models\Cask;
use Updater\Updater\Directory;
use Updater\Events\CaskFileGenerated;

class GenerateCaskFileJob implements ShouldQueue
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
        // Generate the view file.
        Storage::disk('local')->put(Directory::getCaskPath() . $this->cask->cask_name, View::make('cask', $this->cask));

        // Fire the event.
        event(new CaskFileGenerated($this->cask));
    }
}
