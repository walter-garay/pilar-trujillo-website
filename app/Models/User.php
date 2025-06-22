<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'social_media_urls',
        'photo_url',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'social_media_urls' => 'array', // Cast the social_media_urls as an array
        ];
    }

        /**
     * Relationship with Publications.
     * A user can have many publications.
     */
    public function publications()
    {
        return $this->hasMany(Publication::class, 'author_id');
    }

    /**
     * Relationship with Media.
     * A user can create many media items (videos, audios, etc.).
     */
    public function medias()
    {
        return $this->hasMany(Media::class);
    }

    /**
     * Relationship with Programs.
     * A user can manage many programs.
     */
    public function programs()
    {
        return $this->hasMany(Program::class);
    }
}
