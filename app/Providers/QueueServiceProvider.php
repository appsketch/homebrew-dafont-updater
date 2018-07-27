<?php

namespace Updater\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Queue;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Support\Facades\Log;

class QueueServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Queue::after(function(JobProcessed $event) {
            
            // Check if the job was a throttled job.
            if ($event->job->getQueue() === 'throttle') {

                // Sleep for 0.25 second so we don't make too much call to dafont.com
                usleep(250000);
            }
        });
    }
}
