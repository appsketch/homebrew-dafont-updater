<?php

namespace Updater\Console\Commands;

use Illuminate\Console\Command;

use Updater\Events\UpdaterInitializeTriggered;
use Updater\Updater\Directory;

class UpdaterInitialize extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'updater:initialize';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialize the updater';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // All the folders.
        $folders = Directory::alphabet();

        // Loop through each folder.
        foreach($folders as $folder)
        {
            // Fire the event.
            event(new UpdaterInitializeTriggered($folder));
        }
    }
}
