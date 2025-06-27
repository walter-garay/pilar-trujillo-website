<?php

namespace Database\Seeders;

use App\Models\Publication;
use App\Models\PublicationImage;
use Illuminate\Database\Seeder;

class PublicationImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener todas las publicaciones existentes
        $publications = Publication::all();

        // Array de URLs de imágenes de ejemplo (puedes reemplazar con URLs reales)
        $sampleImages = [
            'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=800&h=600&fit=crop',
            'https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=800&h=600&fit=crop',
            'https://images.unsplash.com/photo-1455390582262-044cdead277a?w=800&h=600&fit=crop',
            'https://images.unsplash.com/photo-1513475382585-d06e58bcb0e0?w=800&h=600&fit=crop',
            'https://images.unsplash.com/photo-1495020689067-958852a6c2c8?w=800&h=600&fit=crop',
            'https://images.unsplash.com/photo-1504711434969-e33886168f5c?w=800&h=600&fit=crop',
            'https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=800&h=600&fit=crop',
            'https://images.unsplash.com/photo-1455390582262-044cdead277a?w=800&h=600&fit=crop',
        ];

        // Array de captions de ejemplo
        $sampleCaptions = [
            'Imagen representativa de la publicación',
            'Ilustración del contenido principal',
            'Fotografía relacionada con el tema',
            'Gráfico explicativo del artículo',
            'Imagen de portada de la publicación',
            'Elemento visual complementario',
            'Diagrama ilustrativo del contenido',
            'Fotografía de contexto cultural',
        ];

        foreach ($publications as $publication) {
            // Crear 1-3 imágenes por publicación
            $numImages = rand(1, 3);

            for ($i = 0; $i < $numImages; $i++) {
                PublicationImage::create([
                    'publication_id' => $publication->id,
                    'file_url' => $sampleImages[array_rand($sampleImages)],
                    'caption' => $sampleCaptions[array_rand($sampleCaptions)],
                ]);
            }
        }
    }
}
