<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    // Define the attributes that can be mass-assigned
    protected $fillable = ['name', 'type'];

    /**
     * Relationship with Publication.
     * A category can have many publications.
     */
    public function publications()
    {
        return $this->hasMany(Publication::class);
    }

    /**
     * Relationship with Media.
     * A category can have many media items (videos, audios, etc.).
     */
    public function medias()
    {
        return $this->hasMany(Media::class);
    }
}
