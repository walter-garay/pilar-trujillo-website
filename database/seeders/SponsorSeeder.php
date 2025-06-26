<?php

namespace Database\Seeders;

use App\Models\Sponsor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $sponsors = [
            [
                'name' => 'Canal Nacional',
                'logo_url' => 'https://picsum.photos/seed/canal/400/200',
                'description' => 'Televisora líder en contenido periodístico y cultural, comprometida con la verdad.',
                'media_url' => 'https://www.example.com',
                'website_url' => $faker->url,
            ],
            [
                'name' => 'Fundación Libertad de Prensa',
                'logo_url' => 'https://picsum.photos/seed/prensa/400/200',
                'description' => 'Organización dedicada a defender el periodismo independiente y la libertad de expresión.',
                'media_url' => 'https://www.example.com',
                'website_url' => $faker->url,
            ],
            [
                'name' => 'Universidad de Comunicaciones',
                'logo_url' => 'https://picsum.photos/seed/universidad/400/200',
                'description' => 'Centro de formación de excelencia para la nueva generación de periodistas.',
                'media_url' => 'https://www.example.com',
                'website_url' => $faker->url,
            ],
            [
                'name' => 'Radio Horizonte',
                'logo_url' => 'https://picsum.photos/seed/radio/400/200',
                'description' => 'Emisora de radio con un fuerte enfoque en noticias locales y análisis profundo.',
                'media_url' => 'https://www.example.com',
                'website_url' => $faker->url,
            ],
            [
                'name' => 'Tech for Good',
                'logo_url' => 'https://picsum.photos/seed/tech/400/200',
                'description' => 'ONG que promueve el uso de la tecnología para el impacto social y la transparencia.',
                'media_url' => 'https://www.example.com',
                'website_url' => $faker->url,
            ],
            [
                'name' => 'Editorial El Saber',
                'logo_url' => 'https://picsum.photos/seed/editorial/400/200',
                'description' => 'Casa editorial reconocida por su publicación de libros de investigación y ensayos.',
                'media_url' => 'https://www.example.com',
                'website_url' => $faker->url,
            ],
        ];

        foreach ($sponsors as $sponsor) {
            Sponsor::create(array_merge($sponsor, [
                'email' => $faker->companyEmail,
                'phone' => $faker->phoneNumber,
                'social_media_urls' => json_encode(['twitter' => 'https://twitter.com/' . $faker->userName]),
                'promotion_start' => $faker->dateTimeBetween('-1 month', 'now'),
                'promotion_end' => $faker->dateTimeBetween('now', '+2 months'),
            ]));
        }
    }
}
