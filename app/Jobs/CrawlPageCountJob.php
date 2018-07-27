<?php

namespace Updater\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Symfony\Component\DomCrawler\Crawler;

use Updater\Updater\URL;
use Updater\Events\ReceivedPageCount;

class CrawlPageCountJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * 
     */
    private $url;

    /**
     * 
     */
    private $lettre;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $lettre)
    {
        // Request font information.
        $this->url = new URL();

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
        // Set the lettre to crawl.
        $this->url->alpha($this->lettre);

        // Request it.
        $response = $this->url->request();

        // Check if succeed.
        if ($response->getStatusCode() === 200)
        {
            // Page content.
            $content = $response->getBody()->getContents();

            // Crawler object.
            $crawler = new Crawler($content);

            // Filter the dom.
            $crawler = $crawler->filter('.noindex')->children()->last()->previousAll();

            // Get the page count.
            $pageCount = intval($crawler->text());

            // Trigger the event.
            event(new ReceivedPageCount($pageCount, $this->lettre));
        }
    }
}
