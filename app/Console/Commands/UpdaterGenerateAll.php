<?php

namespace Updater\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

use Updater\Events\UpdaterGenerateAllTriggered;

class UpdaterGenerateAll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'updater:generate-all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate all cask files';

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
        Log::info('[COMMAND] [UPDATER:GENERATE-ALL] command triggered');

        // Fire the event.
        event(new UpdaterGenerateAllTriggered());
    }
}
