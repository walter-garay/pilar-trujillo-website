<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    // Define the attributes that can be mass-assigned
    protected $fillable = [
        'title',
        'description',
        'schedule',
        'user_id',
    ];

    /**
     * Relationship with User.
     * A program belongs to a user (the user manages it).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship with Media.
     * A program can have many media items (videos, audios, etc.).
     */
    public function media()
    {
        return $this->hasMany(Media::class);
    }
}
