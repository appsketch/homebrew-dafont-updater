<?php

namespace Updater\Models;

use Illuminate\Database\Eloquent\Model;

use Cocur\Slugify\Bridge\Laravel\SlugifyFacade as Slugify;

use Updater\Updater\Directory;

class Cask extends Model
{
    /**
     * The attributes that should be appended.
     * 
     * @var array
     */
    protected $appends = [
        'token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'fonts' => 'array'
    ];

    /**
     * 
     */
    protected $fillable = [
        'homepage',
        'name',
        'url'
    ];

    /**
     * Generate cask file name.
     */
    public function getCaskNameAttribute()
    {
        return $this->token . '.rb';
    }

    /**
     * Generate zip name.
     */
    public function getZipNameAttribute()
    {
        return $this->slug . '.zip';
    }

    /**
     * Generate lettre.
     */
    public function getLettreAttribute()
    {
        // Get the first character uppercased.
        $first = strtoupper($this->name[0]);
        
        // Return the lettre.
        return in_array($first, Directory::alphabet()) ? $first : '#';
    }

    /**
     * Generate slug.
     */
    public function getSlugAttribute()
    {
        // Parse the URL.
        $parsed = parse_url($this->url);

        // Parse the query into an array.
        parse_str($parsed['query'], $query);

        // Return a slug variant.
        return Slugify::slugify($query['f']);
    }

    /**
     * Generate token.
     */
    public function getTokenAttribute()
    {
        return 'dafont-' . $this->slug;
    }

    /**
     * Generate path
     */
    public function getPathAttribute()
    {
        return implode(DIRECTORY_SEPARATOR, [
            env('HOMEBREW_DAFONT_ZIP_DIRECTORY'),
            $this->lettre,
            $this->slug,
            ''
        ]);
    }

    /**
     * 
     */
    public function getCreateBranchNameAttribute()
    {
        return 'create-' . $this->token;
    }

    /**
     * 
     */
    public function getUpdateBranchNameAttribute()
    {
        return 'update-' . $this->token;
    }

    /**
     * Convert the fonts to a json object.
     */
    public function setFontsAttribute($value)
    {
        $this->attributes['fonts'] = json_encode($value);
    }
}
