<?php

namespace Database\Seeders;

use App\Models\Publication;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PublicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear categorías necesarias
        $categories = [
            ['id' => 1, 'name' => 'Periodismo', 'type' => 'publication'],
            ['id' => 2, 'name' => 'Comunicación', 'type' => 'publication'],
            ['id' => 3, 'name' => 'Audio', 'type' => 'publication'],
        ];
        foreach ($categories as $cat) {
            Category::updateOrCreate(['id' => $cat['id']], $cat);
        }

        $publications = [
            [
                'title' => 'El futuro del periodismo',
                'content' => 'Un análisis sobre el impacto de la tecnología en el periodismo actual.',
                'status' => 'active',
                'author_id' => 1,
                'category_id' => 1,
                'tags' => json_encode(['periodismo', 'tecnología']),
                'references' => json_encode(['https://ejemplo.com/futuro']),
                'views_count' => 120,
            ],
            [
                'title' => 'La ética en los medios',
                'content' => 'Reflexión sobre la importancia de la ética en la comunicación.',
                'status' => 'active',
                'author_id' => 1,
                'category_id' => 2,
                'tags' => json_encode(['ética', 'medios']),
                'references' => json_encode(['https://ejemplo.com/etica']),
                'views_count' => 85,
            ],
            [
                'title' => 'Cobertura de conflictos internacionales',
                'content' => 'Cómo los medios abordan la cobertura de guerras y conflictos.',
                'status' => 'archived',
                'author_id' => 1,
                'category_id' => 1,
                'tags' => json_encode(['conflictos', 'internacional']),
                'references' => json_encode(['https://ejemplo.com/conflictos']),
                'views_count' => 200,
            ],
            [
                'title' => 'El auge de los podcasts',
                'content' => 'Por qué los podcasts se han vuelto tan populares en la última década.',
                'status' => 'active',
                'author_id' => 1,
                'category_id' => 3,
                'tags' => json_encode(['podcast', 'audio']),
                'references' => json_encode(['https://ejemplo.com/podcasts']),
                'views_count' => 60,
            ],
            [
                'title' => 'Fake news y desinformación',
                'content' => 'Estrategias para combatir la desinformación en la era digital.',
                'status' => 'active',
                'author_id' => 1,
                'category_id' => 2,
                'tags' => json_encode(['fake news', 'desinformación']),
                'references' => json_encode(['https://ejemplo.com/fakenews']),
                'views_count' => 300,
            ],
            [
                'title' => 'Periodismo de investigación',
                'content' => 'El valor del periodismo de investigación en la sociedad.',
                'status' => 'archived',
                'author_id' => 1,
                'category_id' => 1,
                'tags' => json_encode(['investigación', 'sociedad']),
                'references' => json_encode(['https://ejemplo.com/investigacion']),
                'views_count' => 150,
            ],
            [
                'title' => 'Redes sociales y opinión pública',
                'content' => 'El papel de las redes sociales en la formación de la opinión pública.',
                'status' => 'active',
                'author_id' => 1,
                'category_id' => 2,
                'tags' => json_encode(['redes sociales', 'opinión']),
                'references' => json_encode(['https://ejemplo.com/redes']),
                'views_count' => 90,
            ],
            [
                'title' => 'La evolución de la radio',
                'content' => 'De la radio tradicional a la radio digital.',
                'status' => 'archived',
                'author_id' => 1,
                'category_id' => 3,
                'tags' => json_encode(['radio', 'digital']),
                'references' => json_encode(['https://ejemplo.com/radio']),
                'views_count' => 45,
            ],
            [
                'title' => 'Narrativas visuales',
                'content' => 'El poder de la imagen en la comunicación moderna.',
                'status' => 'active',
                'author_id' => 1,
                'category_id' => 1,
                'tags' => json_encode(['visual', 'imagen']),
                'references' => json_encode(['https://ejemplo.com/visual']),
                'views_count' => 110,
            ],
            [
                'title' => 'Tendencias en medios digitales',
                'content' => 'Principales tendencias que están transformando los medios digitales.',
                'status' => 'active',
                'author_id' => 1,
                'category_id' => 2,
                'tags' => json_encode(['tendencias', 'digital']),
                'references' => json_encode(['https://ejemplo.com/tendencias']),
                'views_count' => 75,
            ],
        ];

        foreach ($publications as $pub) {
            Publication::create($pub);
        }
    }
}
