<?php

namespace Updater\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use Updater\Console\Commands\UpdaterCronjob;
use Updater\Console\Commands\UpdaterInitialize;
use Updater\Console\Commands\UpdaterGenerateAll;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        UpdaterCronjob::class,
        UpdaterGenerateAll::class,
        UpdaterInitialize::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Run the updater cronjob command every day at 2 am.
        $schedule->command(UpdaterCronjob::class)->dailyAt('2:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
