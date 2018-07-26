<?php

namespace Updater\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

use Symfony\Component\DomCrawler\Crawler;

use Updater\Updater\URL;
use Updater\Models\Cask;
use Updater\Events\FontInformationCrawled;

class CrawlFontInformation implements ShouldQueue
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
        // Font URL.
        $font = $event->font;

        // Set the font url to crawl.
        $this->url->font($font);

        // Request it.
        $response = $this->url->request();

        // Check if succeed.
        if ($response->getStatusCode() === 200)
        {
            // Page content.
            $content = $response->getBody()->getContents();
    
            // Crawler object.
            $crawler = new Crawler($content);
    
            // The crawled name.
            $crawled_name = $crawler->filter('meta')->first()->attr('content');
            
            // The cask name.
            $crawled_name = str_replace(" Font | dafont.com", "", $crawled_name);
            $cask_name = str_replace(" | dafont.com", "", $crawled_name);
    
            // The cask download url.
            $cask_url = str_replace("//", "https://", $crawler->filter('.dl')->first()->attr('href'));
    
            // Cask homepage.
            $cask_homepage = $this->url->url;
    
            // Get the cask or create a new one based on the homepage url.
            $cask = Cask::firstOrNew([
                'homepage' => $cask_homepage,
            ]);
            
            // Set the cask name.
            $cask->name = $cask_name;
    
            // Set the cask url.
            $cask->url = $cask_url;
    
            // Save the cask file.
            $cask->save();

            // Fire the event.
            event(new FontInformationCrawled($cask));
        }
    }
}
