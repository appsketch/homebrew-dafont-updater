<?php

namespace Updater\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Symfony\Component\DomCrawler\Crawler;

use Updater\Updater\URL;
use Updater\Events\HandleCrawlFontInformation;

class CrawlListOfFontsJob implements ShouldQueue
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
     * 
     */
    private $page;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $lettre = null, int $page)
    {
        // Request font information.
        $this->url = new URL();

        // Set the lettre to crawl.
        $this->lettre = $lettre;

        // Set the page to crawl.
        $this->page = $page;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Check if property lettre exists.
        if (isset($this->lettre))
        {
            // Set the lettre to crawl.
            $this->url->alpha($this->lettre);
        }
        
        // If the lettre is not set.
        else
        {
            // Crawl the everythin/updates page.
            $this->url->everything();
        }

        // Set the page to crawl.
        $this->url->page($this->page);

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
            $crawler = $crawler->filter('.preview > a');

            // Loop through each node.
            $crawler->each(function (Crawler $node) {
                
                // Call the event.
                event(new HandleCrawlFontInformation($node->attr('href')));
            });
        }
    }
}
