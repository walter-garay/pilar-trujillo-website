<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;

    // Define the attributes that can be mass-assigned
    protected $fillable = [
        'title',
        'content',
        'status',
        'author_id',
        'category_id',
        'tags',
        'references'
    ];

    /**
     * Relationship with User.
     * A publication belongs to a user (the author).
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Relationship with Category.
     * A publication belongs to one category.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relationship with PublicationImage.
     * A publication can have many images associated with it.
     */
    public function images()
    {
        return $this->hasMany(PublicationImage::class);
    }
}
