<?php

namespace Updater\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Updater\Events\UpdaterInitializeTriggered;
use Updater\Listeners\CreateAlphabetDirectory;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        UpdaterInitializeTriggered::class => [
            CreateAlphabetDirectory::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
