<?php

namespace Database\Seeders;

use App\Models\Publication;
use App\Models\PublicationImage;
use App\Models\Category;
use Illuminate\Database\Seeder;

class PublicationSeeder extends Seeder
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
                'references' => [
                    'url' => 'https://www.elespectador.com',
                    'name' => 'El Espectador',
                ],
            ],
            [
                'title' => 'DR. JOSE VARALLANOS - La fundación española de la ciudad de Huánuco',
                'references' => [
                    'url' => 'https://www.elespectador.com',
                    'name' => 'El Espectador',
                ],
            ],
            [
                'title' => 'La crónica de un estilo literario - DR. VIRGILIO LÓPEZ CALDERÓN',
                'references' => [
                    'url' => 'https://www.elespectador.com',
                    'name' => 'El Espectador',
                ],
            ],
            [
                'title' => 'Milenaria danza agrícola - MAMA RAYHUANA. Escenificación del sembrío de los tubérculos andinos y del maíz',
                'references' => [
                    'url' => 'https://www.elespectador.com',
                    'name' => 'El Espectador',
                ],
            ],
            [
                'title' => "SEMBLANZA SERGIO D'AMBROSIO ROBLES - Cantante y compositor, un músico que vive de su arte",
                'references' => [
                    'url' => 'https://www.elespectador.com',
                    'name' => 'El Espectador',
                ],
            ],
            // Nuevos registros Diario Ahora 2010
            [
                'title' => 'EL BOSQUE DE NEBLINA DE CARPISH - Entre la altivez andina y la exuberancia de la selva',
                'references' => [
                    'url' => 'https://ahora.com.pe',
                    'name' => 'Diario Ahora',
                ],
            ],
            [
                'title' => 'SHILLACOTO - Huella de la mutilación de nuestra historia',
                'references' => [
                    'url' => 'https://ahora.com.pe',
                    'name' => 'Diario Ahora',
                ],
            ],
            [
                'title' => 'RODOLFO HOLZMANN - Compositor, etnomusicólogo y maestro forjador de talentos.',
                'references' => [
                    'url' => 'https://ahora.com.pe',
                    'name' => 'Diario Ahora',
                ],
            ],
            [
                'title' => 'GARU - Arquitectura que reta el paso del tiempo',
                'references' => [
                    'url' => 'https://ahora.com.pe',
                    'name' => 'Diario Ahora',
                ],
            ],
            [
                'title' => 'SAMUEL CARDICH AMPUDIA',
                'references' => [
                    'url' => 'https://ahora.com.pe',
                    'name' => 'Diario Ahora',
                ],
            ],
            [
                'title' => 'HISTORIA DEL GUARDIÁN DE LA MEMORIA NACIONAL',
                'references' => [
                    'url' => 'https://ahora.com.pe',
                    'name' => 'Diario Ahora',
                ],
            ],
            [
                'title' => 'MONTE POTRERO - Fuente hídrica de Umari, pulmón de la humanidad',
                'references' => [
                    'url' => 'https://ahora.com.pe',
                    'name' => 'Diario Ahora',
                ],
            ],
            [
                'title' => 'LAS ORQUÍDEAS, - INMENSAS O DIMINUTAS: SIEMPRE PRECIOSAS',
                'references' => [
                    'url' => 'https://ahora.com.pe',
                    'name' => 'Diario Ahora',
                ],
            ],
            [
                'title' => 'EL SEÑORIAL RIO HUALLAGA',
                'references' => [
                    'url' => 'https://ahora.com.pe',
                    'name' => 'Diario Ahora',
                ],
            ],
            [
                'title' => 'LAS NACIENTES DEL RIO HUALLAGA',
                'references' => [
                    'url' => 'https://ahora.com.pe',
                    'name' => 'Diario Ahora',
                ],
            ],
            [
                'title' => 'NÉSTOR ARMAS Y EL MUSEO DE CIENCIAS',
                'references' => [
                    'url' => 'https://ahora.com.pe',
                    'name' => 'Diario Ahora',
                ],
            ],

            // Nuevos registros ANTORCHA 2010
            [
                'title' => 'JAVIER PULGAR VIDAL - UNA VIDA DESTINADA AL MAGISTERIO DESDE EL PRINCIPIO',
                'references' => [
                    'url' => '',
                    'name' => 'ANTORCHA 2010',
                ],
            ],
            [
                'title' => 'SALVEMOS NUESTROS MONUMENTOS HISTÓRICOS',
                'references' => [
                    'url' => '',
                    'name' => 'ANTORCHA 2010',
                ],
            ],
            // Nuevos registros Diario Ahora
            [
                'title' => 'PADRE AGUSTINO MARCOS DURÁN MARTEL',
                'references' => [
                    'url' => 'https://ahora.com.pe',
                    'name' => 'Diario Ahora',
                ],
            ],
            [
                'title' => 'Daniel Alomía Robles - Gloria de la música autóctona, genuino intérprete del sentido del alma indígena.',
                'references' => [
                    'url' => 'https://ahora.com.pe',
                    'name' => 'Diario Ahora',
                ],
            ],
            [
                'title' => 'Francisco Gumersindo Atencia Ramírez - Maestro, compositor y músico.',
                'references' => [
                    'url' => 'https://ahora.com.pe',
                    'name' => 'Diario Ahora',
                ],
            ],
            [
                'title' => 'GEOLOGÍA DE LA CIUDAD DE HUÁNUCO',
                'references' => [
                    'url' => 'https://ahora.com.pe',
                    'name' => 'Diario Ahora',
                ],
            ],
        ];

        foreach ($publications as $pub) {
            $publication = Publication::create([
                'title' => $pub['title'],
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
