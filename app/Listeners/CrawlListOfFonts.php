<?php

namespace Updater\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Symfony\Component\DomCrawler\Crawler;

use Updater\Updater\URL;

class CrawlListOfFonts
{
    /**
     * 
     */
    private $url;

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
        // Check if property lettre exists.
        if (property_exists($event, 'lettre'))
        {
            // Set the lettre to crawl.
            $this->url->alpha($event->lettre);
        }
        
        // If the lettre is not set.
        else
        {
            // Crawl the everythin/updates page.
            $this->url->everything();
        }

        // Set the page to crawl.
        $this->url->page($event->page);

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
            dd($crawler->each(function (Crawler $node) {

                // Echo it for now.
                echo $node->attr('href') . PHP_EOL;
            }));
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
            'Updater\Events\UpdaterCronjobTriggered',
            'Updater\Listeners\CrawlListOfFonts@handle'
        );
    }
}
