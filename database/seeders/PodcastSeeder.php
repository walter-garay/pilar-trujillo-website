<?php

namespace Database\Seeders;

use App\Models\Media;
use App\Models\Category;
use Illuminate\Database\Seeder;

class PodcastSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener la categoría Destacable
        $destacableCategory = Category::where('name', 'Destacable')->first();

        $podcasts = [
            [
                'title' => 'VIRGEN DE LA ASUNCION',
                'description' => 'VIRGEN DE LA ASUNCION, Se refiere a la primera patrona de Huánuco, bajo cuya advocación se funda la ciudad en la gélida planicie de Huánuco Pampa el 15 de agosto de 1539.',
                'cover' => '/assets/images/covers/podcast/3.png',
                'file' => '/assets/videos/podcast/1-VIRGEN-DE-LA-ASUNCION.mp4',
            ],
            [
                'title' => 'MAZAMORRA DE TOCOSH',
                'description' => 'MAZAMORRA DE TOCOSH de gran valor medicinal por su alto registro de penicilina, elaborada a base de papa remojada en corrientes de agua altoandinas.',
                'cover' => '/assets/images/covers/podcast/1.png',
                'file' => '/assets/videos/podcast/2-MAZAMORRA-DE-TOCOSH.mp4',
            ],
            [
                'title' => 'TAZA DE CAFÉ',
                'description' => 'TAZA DE CAFÉ Delicioso potaje gastronómico de grano tostado de café que llega humeante y oloroso a la mesa del comensal.',
                'cover' => '/assets/images/covers/podcast/2.png',
                'file' => '/assets/videos/podcast/3-TAZA-DE-CAFE.mp4',
            ],
            [
                'title' => 'EL COLLPO HUANUQUEÑO',
                'description' => 'EL COLLPO HUANUQUEÑO En esencia es una mazamorra de calabaza cocinada en horno de pan. Todo un deleite para el paladar.',
                'cover' => '/assets/images/covers/podcast/4.png',
                'file' => '/assets/videos/podcast/4-EL-COLLPO-HUANUQUEO.mp4',
            ],
            [
                'title' => 'CUNYAG Y NUÑASH',
                'description' => 'CUNYAG Y NUÑASH Es la leyenda de un amor entretejido por Cunyag y Nunash, que sufren la maldición del padre de Cunyag, convertida en una durmiente mujer cubierta de vegetación y Nunash en un guerrero de piedra en posición recostada.',
                'cover' => '/assets/images/covers/podcast/5.png',
                'file' => '/assets/videos/podcast/5-CUNYAG-Y-NUASH.mp4',
            ],
            [
                'title' => 'DANIEL ALOMÍA ROBLES',
                'description' => 'DANIEL ALOMÍA ROBLES, el universal compositor huanuqueño y su legado musical estudiado y catalogado por el etnomusicólogo Rodolfo Holzmann.',
                'cover' => '/assets/images/covers/podcast/6.png',
                'file' => '/assets/videos/podcast/6-DANIEL-ALOMA-ROBLES.mp4',
            ],
        ];

        foreach ($podcasts as $podcast) {
            Media::create([
                'title' => $podcast['title'],
                'description' => $podcast['description'],
                'file_url' => $podcast['file'],
                'type' => 'podcast',
                'publication_date' => '2025-06-25',
                'category_id' => $destacableCategory->id,
                'user_id' => 1,
                'tags' => json_encode(['reencuentro', 'pilar-trujillo', 'podcast', 'audio', 'destacable']),
                'views_count' => 0,
                'likes_count' => 0,
                'cover_image_url' => $podcast['cover'],
            ]);
        }
    }
}
