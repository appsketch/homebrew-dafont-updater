<?php

namespace Updater\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Symfony\Component\DomCrawler\Crawler;

use Updater\Updater\URL;
use Updater\Models\Cask;
use Updater\Events\FontInformationCrawled;

class CrawlFontInformationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * 
     */
    private $url;

    /**
     * 
     */
    private $font;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $font)
    {
        // Request font information.
        $this->url = new URL();
        
        // Set the font to crawl.
        $this->font = $font;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Set the font url to crawl.
        $this->url->font($this->font);

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
