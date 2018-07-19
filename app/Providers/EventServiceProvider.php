<?php

namespace Updater\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use Updater\Events\UpdaterCronjobTriggered;
use Updater\Events\UpdaterInitializeTriggered;

use Updater\Listeners\CreateAlphabetDirectory;
use Updater\Listeners\CreateCasksDirectory;

use Updater\Listeners\DownloadZipFromDafont;
use Updater\Listeners\ExtractZip;
use Updater\Listeners\GenerateSha256Hash;
use Updater\Listeners\GenerateCaskFile;
use Updater\Listeners\ListFontsInFolder;
use Updater\Listeners\CrawlFontInformation;
use Updater\Listeners\CrawlListOfFonts;
use Updater\Listeners\CrawlPageCount;
use Updater\Listeners\CrawlAllPageCount;
use Updater\Events\HandleCrawlPageCount;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        UpdaterInitializeTriggered::class => [
            CreateAlphabetDirectory::class,
            CreateCasksDirectory::class
        ]
    ];

    /**
     * The subscriber classes to register.
     *
     * @var array
     */
    protected $subscribe = [
        CrawlAllPageCount::class,
        CrawlFontInformation::class,
        CrawlListOfFonts::class,
        CrawlPageCount::class,
        DownloadZipFromDafont::class,
        ExtractZip::class,
        GenerateCaskFile::class,
        GenerateSha256Hash::class,
        ListFontsInFolder::class
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
