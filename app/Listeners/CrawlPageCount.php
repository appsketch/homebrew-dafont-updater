<?php

namespace Updater\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Symfony\Component\DomCrawler\Crawler;

use Updater\Updater\URL;
use Updater\Events\HandleCrawlPageCount;
use Illuminate\Support\Facades\Log;

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

            // Log it for now.
            Log::info('[' . $event->lettre . '] ' . $pageCount);
        }
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            HandleCrawlPageCount::class,
            'Updater\Listeners\CrawlPageCount@handle'
        );
    }
}
