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
            'email' => 'pilar.tmartel@gmail.com',
            'password' => Hash::make('@yudame//40-mami2'),
            'role' => 'admin',
            'phone' => '+51 993 006 779',
            'social_media_urls' => [
                'facebook' => 'https://www.facebook.com/pilar.trujillomartel',
                'tiktok' => 'https://www.tiktok.com/@pilar.trujillo.ma',
                'instagram' => 'https://www.instagram.com/reencuentro_cultural',
                'youtube' => 'https://www.youtube.com/@reencuentro_cultural',
                'twitter' => 'https://x.com/Reencuentro_Hoy',
            ],
            'photo_url' => '/assets/images/pilar/perfil.png',
            'email_verified_at' => now(),
        ]);
    }
}
