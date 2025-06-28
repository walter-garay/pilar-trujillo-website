<?php

namespace Database\Seeders;

use App\Models\Media;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TelevisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener la categoría Destacable
        $destacableCategory = Category::where('name', 'Destacable')->first();

        $televisionPrograms = [
            [
                'title' => 'REENCUENTRO 21 DE JUNIO DEL 2025',
                'file_url' => 'https://www.youtube.com/watch?v=_FVXrBelqCo',
                'description' => "1. Gran Complejo Cultural Huánuco.\n2. Huánuco Pampa.\n3. Fiesta de San Juan.\n4. Provincia de Puerto Inca.\n5. Quebrada de Agorragra-Llicua.\n6. Muru Raymi en Kichky.\n7. Vertiente Oriental de la Cordillera del Huayhuash.",
            ],
            [
                'title' => 'REENCUENTRO 14 DE JUNIO DEL 2025',
                'file_url' => 'https://www.youtube.com/watch?v=bUs2j0_BvJU',
                'description' => "1. Museo Allpawasi.\n2. Virgilio López.\n3. Estanco y Aunkinmarka.\n4. Museo de Ciencias.\n5. Prestiños Huanuqueños.\n6. Aparicio Pomares.\n7. Fiesta de San Juan.\n8. Templo San Miguel de Huácar.\n9. Muri Raymi.",
            ],
            [
                'title' => 'REENCUENTRO 07 DE JUNIO DEL 2025',
                'file_url' => 'https://www.youtube.com/watch?v=jWuTixTiZWQ',
                'description' => "1. Templo San Miguel de Huácar.\n2. Libro Chiuchi Mate.\n3. Capilla Huayopampa.\n4. Políticas Públicas para el manejo del Cáncer.\n5. Barrio El Beaterio.\n6. Templo San Cristóbal.",
            ],
            [
                'title' => 'REENCUENTRO 31 DE MAYO DEL 2025',
                'file_url' => 'https://www.youtube.com/watch?v=BZ0pO34fS8c',
                'description' => "1. Lauricocha.\n2. El Ciudadano frente a su patrimonio.\n3. La Nación Guanuco. Un Amanecer Wamaliano.\n4. Amigos de la música.",
            ],
            [
                'title' => 'REENCUENTRO 24 DE MAYO DEL 2025',
                'file_url' => 'https://www.youtube.com/watch?v=CYHxBHmH_Ew',
                'description' => "1. La agonía del barrio El Beaterio.\n2. El Festival de la Papa Amarilla.\n3. Huánuco, semillero de papa nativa.\n4. Proceso de canonización de Monseñor Sardinas.\n5. Cámara de Comercio e Industrias de Huánuco-100 Años de existencia.\n6. Historia de la advocación de Maria Auxiliadora.\n7. Fiesta de María Auxiliadora en Huánuco.",
            ],
            [
                'title' => 'REENCUENTRO 17 DE MAYO DEL 2025',
                'file_url' => 'https://www.youtube.com/watch?v=aPHqmYSHur0',
                'description' => "1. Sinfonía por el Perú-Núcleo Huánuco.\n2. Las MYPEs en el desarrollo de la región Huánuco.\n3. El Gran Complejo Cultural Huánuco y la desatención gubernamental.\n4. Las Fichas de Inventario Turístico como herramienta de gestión en el sector.\n5. Dr. Yoshio Onuki- El descubrimiento de Kotosh.",
            ],
            [
                'title' => 'REENCUENTRO 10 DE MAYO DEL 2025',
                'file_url' => 'https://www.youtube.com/watch?v=MI2P9700BuU',
                'description' => "1. Cannon Cantoria-Amor Eterno.\n2. Teresa Guerra Carhuapoma-Docente universitaria.\n3. El rol protagónico de la madre desde la percepción de la iglesia católica.\n4. Rebeca Fernández Palacios-Cantante y docente nivel primaria.\n5. Sac. Agustino Robert Prevost-Papa León XIV.",
            ],
        ];

        foreach ($televisionPrograms as $program) {
            Media::create(array_merge($program, [
                'type' => 'television',
                'publication_date' => '2025-06-25',
                'category_id' => $destacableCategory->id,
                'user_id' => 1,
                'tags' => json_encode(['reencuentro', 'pilar-trujillo', 'televisión', 'programa', 'destacable']),
                'views_count' => 0,
                'likes_count' => 0,
                'cover_image_url' => null,
            ]));
        }
    }
}
