<?php

namespace Updater\Updater;

class URL
{
    // Dafont base URL.
    public static $DAFONT_URL = 'https://www.dafont.com/';

    /**
     * Array filled with queries.
     * 
     * @var  array
     */
    private $query;

    /**
     * The URL without the query string.
     * 
     * @var  array
     */
    private $url;

    /**
     * Set nup query
     */
    private function nup($nup = 1)
    {
        // Set the new.php url.
        $this->url = Self::$DAFONT_URL . 'new.php';

        // Add nup to the query array.
        $this->query = array_set($this->query, 'nup', $nup);

        // Forget the lettre key.
        array_forget($this->query, 'lettre');
    }

    /**
     * Set new query.
     *
     * @return object
     */
    public function new()
    {
        // Set nup to 1.
        $this->nup(1);

        // Return this object.
        return $this;
    }
    
    /**
     * Set latest query.
     *
     * @return object
     */
    public function latest()
    {
        // Set nup to 2.
        $this->nup(2);

        // Return this object.
        return $this;
    }
    
    /**
     * Set everything query.
     *
     * @return object
     */
    public function everything()
    {
        // Set nup to 3.
        $this->nup(3);

        // Return this object.
        return $this;
    }

    /**
     * Set page query.
     *
     * @return object
     */
    public function page($page = 1)
    {
        // Add the page query.
        $this->query = array_set($this->query, 'page', $page);

        // Return this object.
        return $this;
    }

    /**
     * Generate the alpha url.
     * 
     * @return object
     */
    public function alpha($lettre = 'a')
    {
        // Set the new.php url.
        $this->url = Self::$DAFONT_URL . 'alpha.php';
        
        // Add lettre to the query array.
        $this->query = array_set($this->query, 'lettre', urlencode($lettre));

        // Forget the nup key.
        array_forget($this->query, 'nup');

        // Return this object.
        return $this;
    }

    /**
     * Generate the URL.
     * 
     * @return string  The URL as a string.
     */
    public function generate()
    {
        // Generate the URL and return it.
        return $this->url . '?' . http_build_query($this->query);
    }
}
