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
        // Mapear carpetas a palabras clave de publicaciones
        $folderMap = [
            '1. LUIS GUZMAN' => 'LUIS GUZMÁN',
            '2. JOSE VARALLANOS' => 'JOSE VARALLANOS',
            '3. VIRGILIO LOPEZ VALIDO' => 'VIRGILIO',
            '4. MAMA RAYHUANA Y DR. ANDRADE' => 'MAMA RAYHUANA',
            '5. PELO D AMBROSIO' => 'AMBROSIO',
        ];

        $basePath = '/assets/images/publications/EL ESPECTADOR 2009/';

        foreach ($folderMap as $folder => $keyword) {
            // Buscar la publicación por palabra clave en el título
            $publication = Publication::where('title', 'like', "%$keyword%")
                ->orderBy('id')
                ->first();
            if (!$publication) continue;

            // Obtener archivos de la carpeta (simulación, ya que no se puede leer el FS en runtime)
            // Aquí deberías listar los archivos reales en el entorno de producción
            $folderPath = public_path($basePath . $folder);
            if (!is_dir($folderPath)) continue;
            $files = array_filter(scandir($folderPath), function($file) use ($folderPath) {
                return is_file($folderPath . DIRECTORY_SEPARATOR . $file) && !str_starts_with($file, '.');
            });

            foreach ($files as $file) {
                PublicationImage::create([
                    'publication_id' => $publication->id,
                    'file_url' => $basePath . $folder . '/' . $file,
                    'caption' => '',
                ]);
            }
        }
    }
}
