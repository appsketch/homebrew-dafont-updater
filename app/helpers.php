<?php

/**
 * alphabet()
 */
if (! function_exists('alphabet'))
{
    /**
     * Generate an alphabet array.
     * 
     * @param  bool  $uppercased  If the array needs to be uppercased.
     * @param  bool  $hashtag     If the array needs the hashtag.
     * @return array
     */
    function alphabet($uppercased = true, $hashtag = true)
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
        return $uppercased ? array_map('strtoupper', $alphabet) : $alphabet;
    }
}
