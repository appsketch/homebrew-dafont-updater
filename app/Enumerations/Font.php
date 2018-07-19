<?php

namespace Updater\Enumerations;

use MyCLabs\Enum\Enum;

class Font extends Enum
{
    /**
     * Open Type Font.
     */
    private const OTF = '.otf';
    
    /**
     * True Type Font.
     */
    private const TTF = '.ttf';

    /**
     * Check if the given file is a font file.
     */
    public static function isFont($file)
    {
        // Check if the file ends with.
        return ends_with(strtolower($file), array_flatten(Self::toArray()));
    }
}
