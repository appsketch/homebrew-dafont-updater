<?php

namespace Updater\Models;

use Illuminate\Database\Eloquent\Model;
use Cocur\Slugify\Bridge\Laravel\SlugifyFacade as Slugify;

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
        return strtoupper($this->name[0]);
    }

    /**
     * Generate slug.
     */
    public function getSlugAttribute()
    {
        return Slugify::slugify($this->name);
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
