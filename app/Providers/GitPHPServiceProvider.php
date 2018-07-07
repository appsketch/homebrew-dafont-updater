<?php

namespace Updater\Providers;

use Illuminate\Support\ServiceProvider;

use Updater\Repositories\GitPHPRepository;
use Updater\Updater\Directory;

class GitPHPServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(GitPHPRepository::class, function ($app) {

            // Git folder in local storage.
            $path = Directory::repositoryPath();

            // Return Git PHP object.
            return is_dir($path) ? new GitPHPRepository($path) : GitPHPRepository::cloneRepository(env('HOMEBREW_DAFONT_GITHUB_REPOSITORY'), $path);
        });
    }
}
