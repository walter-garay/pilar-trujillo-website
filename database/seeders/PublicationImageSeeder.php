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
            // EL ESPECTADOR 2009
            '1. LUIS GUZMAN' => 'LUIS GUZMÁN',
            '2. JOSE VARALLANOS' => 'JOSE VARALLANOS',
            '3. VIRGILIO LOPEZ VALIDO' => 'VIRGILIO',
            '4. MAMA RAYHUANA Y DR. ANDRADE' => 'MAMA RAYHUANA',
            '5. PELO D AMBROSIO' => 'AMBROSIO',

            // DIARIO AHORA 2010
            '1. EL BOSQUE DE NEBLINA DE CARPISH' => 'BOSQUE DE NEBLINA DE CARPISH',
            '2. SHILLACOTO HUELLA DE LA MUTILACIÓN DE NUESTRA HISTORIA' => 'SHILLACOTO',
            '3. RODOLFO HOLZMANN' => 'RODOLFO HOLZMANN',
            '4. GARU ARQUITECTURA QUE RETA EL PASO DEL TIEMPO' => 'GARU',
            '5. SAMUEL CARDICH' => 'SAMUEL CARDICH',
            '6. ARCHIVO GENERAL DE LA NACIÓN' => 'GUARDIÁN DE LA MEMORIA NACIONAL',
            '7. MONTE POTRERO FUENTE HÍDRICA' => 'MONTE POTRERO',
            '8. LAS NACIENTES DEL RIO HUALLAGA' => 'LAS NACIENTES DEL RIO HUALLAGA',
            '9. EL SEÑORIAL RÍO HUALLAGA' => 'EL SEÑORIAL RIO HUALLAGA',
            '10. LAS ORQUIDEAS INMENSAS O DIMINUTAS' => 'LAS ORQUÍDEAS',
            '11. NESTOR ARMAS Y EL MUSEO DE CIENCIAS' => 'NÉSTOR ARMAS',

            // DIARIO ANTORCHA 2010
            '1. JAVIER PULGAR VIDAL' => 'JAVIER PULGAR VIDAL',
            '2. SALVEMOS NUESTROS MONUMENTOS HISTÓRICOS' => 'SALVEMOS NUESTROS MONUMENTOS HISTÓRICOS',

            // DIARIO AHORA 2011
            '1. PADRE AGUSTINO MARCOS DURAND MARTEL' => 'PADRE AGUSTINO MARCOS DURÁN MARTEL',
            '2. DANIEL ALOMIA ROBLES' => 'Daniel Alomía Robles',
            '3. FRANCISCO GUMERSINDO ATENCIA RAMÍREZ' => 'Francisco Gumersindo Atencia Ramírez',
            '4. GEOLOGIA DE LA CIUDAD DE HUANUCO' => 'GEOLOGÍA DE LA CIUDAD DE HUÁNUCO',
        ];

        $basePath = '/assets/images/publications/EL ESPECTADOR 2009/';
        $ahoraBasePath = '/assets/images/publications/AHORA 2010/';
        $antorchaBasePath = '/assets/images/publications/ANTORCHA 2010/';
        $ahora2011BasePath = '/assets/images/publications/AHORA 2011/';

        foreach ($folderMap as $folder => $keyword) {
            // Buscar la publicación por palabra clave en el título
            $publication = Publication::where('title', 'like', "%$keyword%")
                ->orderBy('id')
                ->first();
            if (!$publication) continue;

            // Determinar la ruta base según el tipo de publicación
            $currentBasePath = $basePath; // Default
            if (str_contains($folder, 'EL BOSQUE') || str_contains($folder, 'SHILLACOTO') ||
                str_contains($folder, 'RODOLFO') || str_contains($folder, 'GARU') ||
                str_contains($folder, 'SAMUEL') || str_contains($folder, 'ARCHIVO') ||
                str_contains($folder, 'MONTE POTRERO') || str_contains($folder, 'LAS NACIENTES') ||
                str_contains($folder, 'EL SEÑORIAL') || str_contains($folder, 'LAS ORQUIDEAS') ||
                str_contains($folder, 'NESTOR')) {
                $currentBasePath = $ahoraBasePath;
            } elseif (str_contains($folder, 'JAVIER PULGAR') || str_contains($folder, 'SALVEMOS NUESTROS')) {
                $currentBasePath = $antorchaBasePath;
            } elseif (str_contains($folder, 'PADRE AGUSTINO') || str_contains($folder, 'DANIEL ALOMIA') ||
                       str_contains($folder, 'FRANCISCO GUMERSINDO') || str_contains($folder, 'GEOLOGIA')) {
                $currentBasePath = $ahora2011BasePath;
            }

            // Obtener archivos de la carpeta
            $folderPath = public_path($currentBasePath . $folder);
            if (!is_dir($folderPath)) continue;
            $files = array_filter(scandir($folderPath), function($file) use ($folderPath) {
                return is_file($folderPath . DIRECTORY_SEPARATOR . $file) && !str_starts_with($file, '.');
            });

            foreach ($files as $file) {
                PublicationImage::create([
                    'publication_id' => $publication->id,
                    'file_url' => $currentBasePath . $folder . '/' . $file,
                    'caption' => '',
                ]);
            }
        }
    }
}
