<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Pilar Trujillo Martel',
            'email' => 'pilar@trujillo.com',
            'password' => Hash::make('pilar@admin.2025'),
            'role' => 'admin',
            'phone' => '+51 993 006 779',
            'social_media_urls' => [
                'facebook' => 'https://www.facebook.com/pilar.trujillomartel',
                'tiktok' => 'https://linkedin.com/in/pilartrujillo',
                'instagram' => 'https://instagram.com/pilartrujillo',
                'youtube' => 'https://www.youtube.com/@reencuentro-pilartrujillom7251'
            ],
            'photo_url' => '/assets/woman.png',
            'email_verified_at' => now(),
        ]);
    }
}
