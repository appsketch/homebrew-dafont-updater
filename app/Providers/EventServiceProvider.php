<?php

namespace Updater\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use Updater\Events\FontInformationCrawled;
use Updater\Events\FontsInFolderListed;
use Updater\Events\HandleCrawlFontInformation;
use Updater\Events\HandleCrawlListOfFonts;
use Updater\Events\HandleCrawlPageCount;
use Updater\Events\ReceivedPageCount;
use Updater\Events\UpdaterCronjobTriggered;
use Updater\Events\UpdaterGenerateAllTriggered;
use Updater\Events\UpdaterInitializeTriggered;
use Updater\Events\ZipFileDownloaded;
use Updater\Events\ZipFileExtracted;

use Updater\Listeners\CrawlAllListOfFonts;
use Updater\Listeners\CrawlAllPageCount;
use Updater\Listeners\CrawlEverything;
use Updater\Listeners\CrawlFontInformation;
use Updater\Listeners\CrawlListOfFonts;
use Updater\Listeners\CrawlPageCount;
use Updater\Listeners\CreateAlphabetDirectory;
use Updater\Listeners\CreateCasksDirectory;
use Updater\Listeners\DownloadZipFromDafont;
use Updater\Listeners\ExtractZip;
use Updater\Listeners\GenerateCaskFile;
use Updater\Listeners\GenerateSha256Hash;
use Updater\Listeners\ListFontsInFolder;
use Updater\Events\CaskFileGenerated;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        CaskFileGenerated::class => [

        ],
        FontInformationCrawled::class => [
            DownloadZipFromDafont::class
        ],
        FontsInFolderListed::class => [
            GenerateCaskFile::class
        ],
        HandleCrawlFontInformation::class => [
            CrawlFontInformation::class
        ],
        HandleCrawlListOfFonts::class => [
            CrawlListOfFonts::class
        ],
        HandleCrawlPageCount::class => [
            CrawlPageCount::class
        ],
        ReceivedPageCount::class => [
            CrawlAllListOfFonts::class
        ],
        UpdaterCronjobTriggered::class => [
            CrawlEverything::class
        ],
        UpdaterGenerateAllTriggered::class => [
            CrawlAllPageCount::class
        ],
        UpdaterInitializeTriggered::class => [
            CreateAlphabetDirectory::class,
            CreateCasksDirectory::class
        ],
        ZipFileDownloaded::class => [
            ExtractZip::class,
            GenerateSha256Hash::class
        ],
        ZipFileExtracted::class => [
            ListFontsInFolder::class
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
