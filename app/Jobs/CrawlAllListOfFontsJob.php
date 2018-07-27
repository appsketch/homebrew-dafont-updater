<?php

namespace Updater\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Updater\Events\HandleCrawlListOfFonts;

class CrawlAllListOfFontsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * 
     */
    public $amountOfPages;

    /**
     * 
     */
    public $lettre;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $amountOfPages, string $lettre = null)
    {
        // Set the amount of pages to crawl.
        $this->amountOfPages = $amountOfPages;

        // Set the lettre to crawl.
        $this->lettre = $lettre;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Loop through each page.
        foreach(range(1, $this->amountOfPages) as $page)
        {
            // Call the event.
            event(new HandleCrawlListOfFonts($this->lettre, $page));
        }
    }
}
