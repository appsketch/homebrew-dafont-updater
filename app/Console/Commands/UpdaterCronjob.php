<?php

namespace Updater\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

use Updater\Events\UpdaterCronjobTriggered;

class UpdaterCronjob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'updater:cronjob';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the daily updater task';

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
        // Log information.
        Log::info('[COMMAND] [UPDATER:CRONJOB] command triggered');

        // Fire the event.
        $value = event(new UpdaterCronjobTriggered());

        dd($value);
    }
}
