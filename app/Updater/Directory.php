<?php

namespace Updater\Updater;

class Directory
{
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
     * Get the cask path.
     */
    public static function getCaskPath()
    {
        return implode(DIRECTORY_SEPARATOR, [
            env('HOMEBREW_DAFONT_GIT_DIRECTORY'),
            'Casks',
            ''
        ]);
    }

    /**
     * Generate path
     */
    public function getZipPath($lettre, $slug)
    {
        return implode(DIRECTORY_SEPARATOR, [
            env('HOMEBREW_DAFONT_ZIP_DIRECTORY'),
            $lettre,
            $slug,
            ''
        ]);
    }
}
