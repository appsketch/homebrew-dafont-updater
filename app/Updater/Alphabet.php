<?php

namespace Updater\Updater;

class Alphabet
{
    /**
     * Generate an alphabeth array.
     * 
     * @param  bool  $hashtag  if the array needs the hashtag.
     * @return array
     */
    public static function alphabet($hashtag = true)
    {
        // Generate an alphabet array.
        $alphabet = range('a', 'z');

        // Check if the hashtag is needed.
        if ($hashtag)
        {
            // Add the hashtag to the array.
            array_push($alphabet, '#');
        }

        // Return the array.
        return $alphabet;
    }
}
