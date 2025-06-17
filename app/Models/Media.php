<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    // Define the attributes that can be mass-assigned
    protected $fillable = [
        'title',
        'description',
        'file_url',
        'type',
        'cover_image_url',
        'publication_date',
        'category_id',
        'user_id',
        'tags',
    ];

    /**
     * Relationship with Category.
     * Each media item belongs to one category.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relationship with User.
     * Each media item belongs to one user (creator).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship with PublicationImage.
     * Each media item can have many images associated with it.
     */
    public function images()
    {
        return $this->hasMany(PublicationImage::class);
    }
}
