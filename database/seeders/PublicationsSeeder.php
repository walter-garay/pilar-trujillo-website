<?php

namespace Database\Seeders;

use App\Models\Publication;
use App\Models\PublicationImage;
use App\Models\Category;
use Illuminate\Database\Seeder;

class PublicationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buscar la categoría 'Destacable' de tipo 'publication'
        $category = Category::where('name', 'Destacable')->where('type', 'publication')->first();

        $publications = [
            [
                'title' => 'ENTREVISTA: ING. LUIS GUZMÁN BARRÓN SOBREVIILLA',
                'description' => '',
                'references' => [
                    'url' => 'https://www.elespectador.com',
                    'name' => 'El Espectador',
                ],
            ],
            [
                'title' => 'DR. JOSE VARALLANOS',
                'description' => 'La fundación española de la ciudad de Huánuco',
                'references' => [
                    'url' => 'https://www.elespectador.com',
                    'name' => 'El Espectador',
                ],
            ],
            [
                'title' => 'La crónica de un estilo literario',
                'description' => 'DR. VIRGILIO LÓPEZ CALDERÓN',
                'references' => [
                    'url' => 'https://www.elespectador.com',
                    'name' => 'El Espectador',
                ],
            ],
            [
                'title' => 'Milenaria danza agrícola',
                'description' => 'MAMA RAYHUANA\nEscenificación del sembrío de los tubérculos andinos y del maíz',
                'references' => [
                    'url' => 'https://www.elespectador.com',
                    'name' => 'El Espectador',
                ],
            ],
            [
                'title' => "SEMBLANZA SERGIO D'AMBROSIO ROBLES",
                'description' => 'Cantante y compositor, un músico que vive de su arte',
                'references' => [
                    'url' => 'https://www.elespectador.com',
                    'name' => 'El Espectador',
                ],
            ],
        ];

        foreach ($publications as $pub) {
            $publication = Publication::create([
                'title' => $pub['title'],
                'description' => $pub['description'],
                'status' => 'active',
                'author_id' => 1,
                'category_id' => $category->id,
                'views_count' => 0,
                'tags' => json_encode(["periodismo", "reencuntro", "pilar-trujillo", "medios"]),
                'content' => '',
                'references' => json_encode($pub['references']),
            ]);

            // Aquí puedes agregar la(s) imagen(es) asociada(s) a la publicación
            // PublicationImage::create([
            //     'publication_id' => $publication->id,
            //     'file_url' => 'URL_DE_LA_IMAGEN',
            //     'caption' => 'Descripción de la imagen',
            // ]);
        }
    }
}
