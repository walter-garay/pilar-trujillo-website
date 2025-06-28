<?php

namespace Database\Seeders;

use App\Models\Media;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ShortsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener la categoría Destacable
        $destacableCategory = Category::where('name', 'Destacable')->first();

        $shorts = [
            [
                'title' => 'PASACALLE',
                'description' => 'EL PASACALLE, es una cadenciosa expresión musical huanuqueña propia del transitar por las calles de la ciudad y de los pueblos enlazando hombres y mujeres.',
                'file_url' => 'https://www.youtube.com/watch?v=eHWeIKqX8rc',
            ],
            [
                'title' => 'EL HUAYNO HUANUQUEÑO',
                'description' => 'EL HUAYNO HUANUQUEÑO, muy señorial, muy mestizo de elegantes movimientos.',
                'file_url' => 'https://www.youtube.com/watch?v=DhSnMlNrs_s',
            ],
            [
                'title' => 'ACUARELAS HUANUQUEÑAS',
                'description' => 'ACUARELAS HUANUQUEÑAS, una bella creación musical del músico tradicionalista Gumersindo Atencia Ramírez que recrea los valores icónicos de Huánuco.',
                'file_url' => 'https://www.youtube.com/watch?v=DK66pnZLLQ4',
            ],
            [
                'title' => 'KOTOSH-ONUKI',
                'description' => 'KOTOSH-ONUKI, una importantísima entrevista a uno de los descubridores de Kotosh, el doctor Yoshio Onuki.',
                'file_url' => 'https://www.youtube.com/watch?v=MYtdTgHIpKU',
            ],
            [
                'title' => 'EL CONDOR PASA',
                'description' => 'EL CONDOR PASA, la melodía universal de Daniel Alomía Robles interpretada por Paul Mauriat.',
                'file_url' => 'https://www.youtube.com/watch?v=BpNxCOMUvww',
            ],
            [
                'title' => 'BIBLIOTECA SEMINARIO SAN TEODORO',
                'description' => 'LA BIBLIOTECA SEMINARIO SAN TEODORO tiene un gran valor de carácter editorial por la antigüedad de las obras que salvaguarda, generalmente de carácter religioso.',
                'file_url' => 'https://www.youtube.com/watch?v=ABVJzmb005k',
            ],
        ];

        foreach ($shorts as $media) {
            Media::create(array_merge($media, [
                'type' => 'short_video',
                'publication_date' => '2025-06-25',
                'category_id' => $destacableCategory->id,
                'user_id' => 1,
                'tags' => json_encode(['reencuentro', 'pilar-trujillo', 'videos-cortos', 'short', 'destacable']),
                'views_count' => 0,
                'likes_count' => 0,
                'cover_image_url' => null,
            ]));
        }
    }
}
