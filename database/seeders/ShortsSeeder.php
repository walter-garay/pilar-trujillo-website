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
            [
                'title' => 'EL CARNAVAL DE HUANUQUEÑO DE ANTAÑO - NICOLÁS VIZCAYA',
                'description' => 'EL CARNAVAL HUANUQUEÑO DE ANTAÑO es descrito por el tradicionalista Nicolás Vizcaya como una actividad socioeconómica trascendente al vincular directamente a los hombres del campo en atención directa a la demanda del área citadina.',
                'file_url' => 'https://www.youtube.com/watch?v=3fYKdDJC2mA',
            ],
            // [
            //     'title' => 'EL SR DE BURGOS Historia',
            //     'description' => 'EL SR. DE BURGOS se registra históricamente desde sus orígenes en la ciudad de Burgos, su presencia en Lima y la representatividad que asume para el pueblo huanuqueño.',
            //     'file_url' => 'https://www.youtube.com/watch?v=0SvGigMQqhE',
            // ],
            [
                'title' => 'HUANUCO PAMPA',
                'description' => 'HUANUCO PAMPA, es la presencia inca en territorio huanuqueño con elementos arquitectónicos muy representativos de aquella época, sobre todo el ushnu.',
                'file_url' => 'https://www.youtube.com/watch?v=D9lW-thCALE',
            ],
            [
                'title' => 'RODOLFO HOLZMANN',
                'description' => 'RODOLFO HOLZMANN, es toda una biografía del maestro Rodolfo Holzman recreada visualmente.',
                'file_url' => 'https://www.youtube.com/watch?v=0f--apwCuFE',
            ],
            [
                'title' => 'CASA HACIENDA ANDABAMBA',
                'description' => 'CASA HACIENDA ANDABAMBA, su historia asociada al origen de la danza de Los Negritos.',
                'file_url' => 'https://www.youtube.com/watch?v=Akai4j6s3yo',
            ],
        ];

        foreach ($shorts as $media) {
            // Extraer el ID del video de YouTube
            preg_match('/v=([\w-]+)/', $media['file_url'], $matches);
            $videoId = $matches[1] ?? '';
            $coverImageUrl = $videoId ? "https://img.youtube.com/vi/{$videoId}/hqdefault.jpg" : null;

            Media::create(array_merge($media, [
                'type' => 'short_video',
                'publication_date' => '2025-06-25',
                'category_id' => $destacableCategory->id,
                'user_id' => 1,
                'tags' => json_encode(['reencuentro', 'pilar-trujillo', 'videos-cortos', 'short', 'destacable']),
                'views_count' => 0,
                'likes_count' => 0,
                'cover_image_url' => $coverImageUrl,
            ]));
        }
    }
}
