<?php

namespace Updater\Console\Commands;

use Illuminate\Console\Command;

use Updater\Updater\Alphabet;

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

    }
}
