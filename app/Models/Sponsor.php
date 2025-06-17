<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    use HasFactory;

    // Fields that can be mass-assigned
    protected $fillable = [
        'name',
        'logo_url',
        'description',
        'email',
        'phone',
        'social_media_urls',
        'media_url',
    ];

    /**
     * Relationship with Publications.
     * A sponsor can sponsor many publications.
     */
    public function publications()
    {
        return $this->hasMany(Publication::class);
    }

    /**
     * Relationship with Media.
     * A sponsor can support many media items.
     */
    public function media()
    {
        return $this->hasMany(Media::class);
    }
}
