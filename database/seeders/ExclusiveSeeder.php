<?php

namespace Database\Seeders;

use App\Models\Media;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ExclusiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener la categoría Destacable
        $destacableCategory = Category::where('name', 'Destacable')->first();

        $exclusiveMedias = [
            [
                'title' => 'AUSPICIADORES',
                'description' => 'AUSPICIADORES son las empresas e instituciones que con marcado amor por Huánuco hicieron viable los productos audiovisuales referidos a valores icónicos que se exhiben.',
                'file_url' => 'https://www.youtube.com/watch?v=iCMRKoOiilw',
            ],
            [
                'title' => 'JAVIER PULGAR',
                'description' => 'JAVIER PULGAR VIDAL es el geógrafo más representativo del Perú por sus invaluables tesis referidas a: Las ocho regiones naturales del Perú y a la Regionalización Transversal del Perú.',
                'file_url' => 'https://www.youtube.com/watch?v=zcZTfWl8vaE',
            ],
            [
                'title' => 'KOTOSH COMPARATIVO',
                'description' => 'KOTOSH COMPARATIVO se desenvuelve entre el valor de dos presencias ancestrales del Periodo Formativo en Huánuco, Kotosh y Shillacoto.',
                'file_url' => 'https://www.youtube.com/watch?v=U3waOlZAXVY',
            ],
            [
                'title' => 'DÁMASO BERAÚN',
                'description' => 'DÁMASO BERAÚN uno de los más grandes sabios del Perú por su gran dominio de diversas ciencias como la astronomía, la matemática, la filosofía.',
                'file_url' => 'https://www.youtube.com/watch?v=cjonAHPtpA0',
            ],
            [
                'title' => 'EL CARNAVAL TINKUY',
                'description' => 'EL CARNAVAL TINKUY una celebración andina que introduce parte de la historia de Huánuco referida a la Revolución de 1812.',
                'file_url' => 'https://www.youtube.com/watch?v=5lfbuiLZbpQ',
            ],
            [
                'title' => 'HERMILIO VALDIZÁN',
                'description' => 'HERMILIO VALDIZÁN, Padre de la Psiquiatría Peruana que humanizara el tratamiento a los locos con innovadoras terapias.',
                'file_url' => 'https://www.youtube.com/watch?v=5lOqoyqCNZQ',
            ],
            [
                'title' => 'MONTE POTRERO',
                'description' => 'MONTEPOTRERO bosque montano de neblina, bello microclima que atesora coloridas aves de hermoso trinar.',
                'file_url' => 'https://www.youtube.com/watch?v=PFsJ9477tTw',
            ],
            [
                'title' => 'AUGUSTO CARDICH',
                'description' => 'AUGUSTO CARDICH Padre de la Prehistoria Peruana por descubrir en 1958 el Hombre de Lauricocha.',
                'file_url' => 'https://www.youtube.com/watch?v=1Sth12M0skA',
            ],
        ];

        foreach ($exclusiveMedias as $media) {
            // Extraer el ID del video de YouTube
            preg_match('/v=([\w-]+)/', $media['file_url'], $matches);
            $videoId = $matches[1] ?? '';
            $coverImageUrl = $videoId ? "https://img.youtube.com/vi/{$videoId}/hqdefault.jpg" : null;

            Media::create(array_merge($media, [
                'type' => 'exclusive',
                'publication_date' => '2025-06-25',
                'category_id' => $destacableCategory->id,
                'user_id' => 1,
                'tags' => json_encode(['reencuentro', 'pilar-trujillo', 'exclusivo', 'video', 'destacable']),
                'views_count' => 0,
                'likes_count' => 0,
                'cover_image_url' => $coverImageUrl,
            ]));
        }
    }
}
