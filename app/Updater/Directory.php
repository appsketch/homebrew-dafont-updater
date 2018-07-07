<?php

namespace Updater\Updater;

use Illuminate\Support\Facades\Storage;

class Directory
{
    /**
     * Generate an alphabeth array.
     * 
     * @param  bool  $uppercased  If the array needs to be uppercased.
     * @param  bool  $hashtag     If the array needs the hashtag.
     * @return array
     */
    public static function alphabet($uppercased = true, $hashtag = true)
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

    /**
     * Repository Path.
     * 
     * @return string
     */
    public static function repositoryPath()
    {
        // Return the path to the repository.
        return storage_path('app/' . ENV('HOMEBREW_DAFONT_GIT_DIRECTORY'));
    }

    /**
     * Create directory if not exists.
     * 
     * @param  string  $path  Directory to create.
     * @return void
     */
    public static function createDirectory($path)
    {
        // Check if the folder doesn't exists.
        if(!in_array($path, Storage::directories()))
        {
            // Create the folder.
            Storage::makeDirectory($path);
        }
    }
}
