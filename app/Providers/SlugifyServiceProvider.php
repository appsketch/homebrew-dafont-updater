<?php

namespace Updater\Providers;

use Illuminate\Support\ServiceProvider;

use Cocur\Slugify\Slugify;

class SlugifyServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('slugify', function () {
            $slugify = new Slugify();

            // Expand the + symbol into a separated English word: -plus-.
            $slugify->addRule('+', '-plus-');

            // Expand the @ symbol into a separated English word: -at-.
            $slugify->addRule('@', '-at-');

            return $slugify;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return ['slugify'];
    }
}
