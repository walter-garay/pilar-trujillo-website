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
                'name' => 'T-Construye',
                'logo_url' => '/assets/images/sponsors/LOGO T CONSTRUYE.jpeg',
                'description' => 'Empresa fundada con la premisa de ofrecer un nuevo concepto de dinamismo en el sector constructivo e inmobiliario.',
                'media_url' => '',
                'website_url' => 'https://www.facebook.com/share/1Bs11Mujef/',
            ],
            [
                'name' => 'Colegio María Auxiliadora',
                'logo_url' => '/assets/images/sponsors/LOGO COLEGIO MARIA AUXILIADORA HCO.jpg',
                'description' => 'Promoción Corina Arrigotti 1982',
                'media_url' => '',
                'website_url' => 'https://www.facebook.com/share/1Bs11Mujef/',
            ],
            [
                'name' => 'Grupo Mopal',
                'logo_url' => '/assets/images/sponsors/LOGO GRUPO MOPAL.png',
                'description' => 'Concesionario de Toyota, venta de vehículos Toyota en la zona centro-oriental de Perú.',
                'media_url' => '',
                'website_url' => 'https://grupomopal.com.pe/',
            ],
            [
                'name' => 'Wayra Restaurant',
                'logo_url' => '/assets/images/sponsors/LOGO WAYRA.jpeg',
                'description' => 'Ofrecemos una experiencia unica con ingredientes frescos, tecnicas de autor y un ambiente sofisticado para disfrutar cada momento.',
                'media_url' => '',
                'website_url' => 'https://web.facebook.com/profile.php?id=61575318442431',
            ],
            [
                'name' => 'Diario Página3',
                'logo_url' => '/assets/images/sponsors/LOGO DIARIO PAGINA3.jpg',
                'description' => 'El Diario más leído en el departamento de Huánuco.',
                'media_url' => '',
                'website_url' => 'https://pagina3.pe',
            ],
            [
                'name' => 'Dolce Caffe',
                'logo_url' => '/assets/images/sponsors/LOGO DOLCE CAFFE.jpeg',
                'description' => 'Jr.28 de Julio 982 l 📍 Real Plaza - 2do piso Lunes a Domingo l 8:00 AM - 10:30 pm l',
                'media_url' => '',
                'website_url' => 'https://www.instagram.com/dolcecaffe.pe?igsh=MWFqaHBzNWM3dTl0cQ',
            ],
            [
                'name' => 'Visión Magistral',
                'logo_url' => '/assets/images/sponsors/LOGO VISION MAGISTRAL.jpg',
                'description' => 'El correcto cuidado de tus ojos será nuestra prioridad.Jr. Hermilio Valdizan 856 - Huanuco',
                'media_url' => '',
                'website_url' => 'https://web.facebook.com/visionmagistralhuanuco',
            ],
            [
                'name' => 'Pastelería San Carlos',
                'logo_url' => '/assets/images/sponsors/LOGO SAN CARLOS.jpg',
                'description' => 'La mejor cadena de pastelerías del centro oriente del Perú ¡Listos para sorprenderte con dulzura! 🎂',
                'media_url' => '',
                'website_url' => 'https://web.facebook.com/SanCarlosHco',
            ],
            [
                'name' => 'Cooltural Bar Rompecabezas',
                'logo_url' => '/assets/images/sponsors/LOGO COOLTURAL BAR ROMPECABEZAS.jpg',
                'description' => 'Lounge Bar que combina una experiencia inigualable en la calidad del servicio, una variada carta en cocteles, piqueos y platos a la plancha',
                'media_url' => '',
                'website_url' => 'https://www.facebook.com/rompecabezascoolturalbar',
            ],
        ];

        foreach ($sponsors as $sponsor) {
            Sponsor::create(array_merge($sponsor, [
                'email' => '',
                'phone' => '',
                'social_media_urls' => json_encode([]),
                'promotion_start' => '2024-01-01 00:00:00',
                'promotion_end' => '2027-12-31 23:59:59',
            ]));
        }
    }
}
