<?php

namespace Updater\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Updater\Events\HandleCrawlPageCount;

class CrawlAllPageCountJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * 
     */
    private $alphabet;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        // All the lettres to crawl.
        // $this->alphabet = alphabet(false);
        $this->alphabet = ['x'];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Loop through each lettre.
        foreach($this->alphabet as $lettre)
        {
            // Trigger the handle crawl page count event.
            event(new HandleCrawlPageCount($lettre));
        }
    }
}
