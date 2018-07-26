<?php

namespace Updater\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

use Symfony\Component\DomCrawler\Crawler;

use Updater\Updater\URL;
use Updater\Events\ReceivedPageCount;

class CrawlPageCount implements ShouldQueue
{
    /**
     * 
     */
    private $url;

    /**
     * 
     */
    public function __construct()
    {
        // Request font information.
        $this->url = new URL();
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        // Set the lettre to crawl.
        $this->url->alpha($event->lettre);

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
            event(new ReceivedPageCount($pageCount, $event->lettre));
        }
    }
}
