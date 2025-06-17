<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    use HasFactory;

    // Fields that can be mass-assigned
    protected $fillable = [
        'file_url',
        'caption',
        'user_id'
    ];

    /**
     * Relationship with User.
     * A gallery image belongs to one user (the uploader).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
