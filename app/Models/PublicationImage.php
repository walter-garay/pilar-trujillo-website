<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicationImage extends Model
{
    use HasFactory;

    // Deshabilitar los timestamps automáticos
    public $timestamps = false;

    // Define the attributes that can be mass-assigned
    protected $fillable = [
        'publication_id',
        'file_url',
        'caption'
    ];

    /**
     * Relationship with Publication.
     * A publication image belongs to one publication.
     */
    public function publication()
    {
        return $this->belongsTo(Publication::class);
    }
}
