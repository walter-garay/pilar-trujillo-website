<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            // Categorías de Medios
            ['name' => 'Documentales', 'type' => 'media'],
            ['name' => 'Entrevistas', 'type' => 'media'],
            ['name' => 'Reportajes Especiales', 'type' => 'media'],
            ['name' => 'Noticias', 'type' => 'media'],
            ['name' => 'Programas de Opinión', 'type' => 'media'],
            ['name' => 'Debates', 'type' => 'media'],
            ['name' => 'Cultura', 'type' => 'media'],
            ['name' => 'Tecnología', 'type' => 'media'],
            ['name' => 'Ciencia', 'type' => 'media'],
            ['name' => 'Educación', 'type' => 'media'],
            ['name' => 'Destacable', 'type' => 'media'],
            ['name' => 'Deportes', 'type' => 'media'],
            ['name' => 'Música', 'type' => 'media'],
            ['name' => 'Arte', 'type' => 'media'],
            ['name' => 'Viajes', 'type' => 'media'],
            ['name' => 'Salud', 'type' => 'media'],
            ['name' => 'Gastronomía', 'type' => 'media'],
            ['name' => 'Historia Local', 'type' => 'media'],
            ['name' => 'Medio Ambiente', 'type' => 'media'],
            ['name' => 'Juventud', 'type' => 'media'],
            ['name' => 'Cine', 'type' => 'media'],
            ['name' => 'Teatro', 'type' => 'media'],
            ['name' => 'Literatura', 'type' => 'media'],
            ['name' => 'Fotografía', 'type' => 'media'],
            ['name' => 'Arquitectura', 'type' => 'media'],
            ['name' => 'Moda', 'type' => 'media'],
            ['name' => 'Danza', 'type' => 'media'],
            ['name' => 'Podcast', 'type' => 'media'],
            ['name' => 'Radio', 'type' => 'media'],
            ['name' => 'Televisión', 'type' => 'media'],
            ['name' => 'Cómics', 'type' => 'media'],
            ['name' => 'Animación', 'type' => 'media'],
            ['name' => 'Videojuegos', 'type' => 'media'],
            ['name' => 'Cuentos', 'type' => 'media'],
            ['name' => 'Ensayos', 'type' => 'media'],
            ['name' => 'Biografías', 'type' => 'media'],
            ['name' => 'Crónica Urbana', 'type' => 'media'],
            ['name' => 'Crónica Rural', 'type' => 'media'],
            ['name' => 'Turismo', 'type' => 'media'],
            ['name' => 'Ecología', 'type' => 'media'],
            ['name' => 'Sociedad', 'type' => 'media'],
            ['name' => 'Política', 'type' => 'media'],
            ['name' => 'Economía', 'type' => 'media'],
            ['name' => 'Religión', 'type' => 'media'],
            ['name' => 'Filosofía', 'type' => 'media'],
            ['name' => 'Psicología', 'type' => 'media'],
            ['name' => 'Educación Superior', 'type' => 'media'],
            ['name' => 'Educación Básica', 'type' => 'media'],
            ['name' => 'Innovación', 'type' => 'media'],
            ['name' => 'Emprendimiento', 'type' => 'media'],
            ['name' => 'Actualidad', 'type' => 'media'],

            // Categorías de Publicaciones
            ['name' => 'Destacable', 'type' => 'publication'],
            ['name' => 'Investigación', 'type' => 'publication'],
            ['name' => 'Artículos', 'type' => 'publication'],
            ['name' => 'Crónicas', 'type' => 'publication'],
            ['name' => 'Ensayos', 'type' => 'publication'],
            ['name' => 'Análisis Político', 'type' => 'publication'],
            ['name' => 'Economía', 'type' => 'publication'],
            ['name' => 'Sociedad', 'type' => 'publication'],
            ['name' => 'Internacional', 'type' => 'publication'],
            ['name' => 'Historia', 'type' => 'publication'],
            ['name' => 'Reseñas de Libros', 'type' => 'publication'],
            ['name' => 'Cultura Popular', 'type' => 'publication'],
            ['name' => 'Educación y Pedagogía', 'type' => 'publication'],
            ['name' => 'Salud Pública', 'type' => 'publication'],
            ['name' => 'Tecnología', 'type' => 'publication'],
            ['name' => 'Derechos Humanos', 'type' => 'publication'],
            ['name' => 'Medio Ambiente', 'type' => 'publication'],
            ['name' => 'Género y Diversidad', 'type' => 'publication'],
            ['name' => 'Juventud y Niñez', 'type' => 'publication'],
            ['name' => 'Arte y Literatura', 'type' => 'publication'],
            ['name' => 'Deporte', 'type' => 'publication'],
            ['name' => 'Psicología Social', 'type' => 'publication'],
            ['name' => 'Filosofía', 'type' => 'publication'],
            ['name' => 'Religión', 'type' => 'publication'],
            ['name' => 'Política Internacional', 'type' => 'publication'],
            ['name' => 'Crítica Literaria', 'type' => 'publication'],
            ['name' => 'Biografías', 'type' => 'publication'],
            ['name' => 'Cuentos', 'type' => 'publication'],
            ['name' => 'Novela', 'type' => 'publication'],
            ['name' => 'Poesía', 'type' => 'publication'],
            ['name' => 'Teatro', 'type' => 'publication'],
            ['name' => 'Cine', 'type' => 'publication'],
            ['name' => 'Música y Cultura', 'type' => 'publication'],
            ['name' => 'Gastronomía', 'type' => 'publication'],
            ['name' => 'Viajes y Relatos', 'type' => 'publication'],
            ['name' => 'Crónica Urbana', 'type' => 'publication'],
            ['name' => 'Crónica Rural', 'type' => 'publication'],
            ['name' => 'Innovación', 'type' => 'publication'],
            ['name' => 'Emprendimiento', 'type' => 'publication'],
            ['name' => 'Actualidad', 'type' => 'publication'],
            ['name' => 'Educación Superior', 'type' => 'publication'],
            ['name' => 'Educación Básica', 'type' => 'publication'],
            ['name' => 'Derecho', 'type' => 'publication'],
            ['name' => 'Ciencias Políticas', 'type' => 'publication'],
            ['name' => 'Ciencias Sociales', 'type' => 'publication'],
            ['name' => 'Ciencias Naturales', 'type' => 'publication'],
            ['name' => 'Matemáticas', 'type' => 'publication'],
            ['name' => 'Física', 'type' => 'publication'],
            ['name' => 'Química', 'type' => 'publication'],
            ['name' => 'Biología', 'type' => 'publication'],
            ['name' => 'Ingeniería', 'type' => 'publication'],
            ['name' => 'Arquitectura', 'type' => 'publication'],
            ['name' => 'Medicina', 'type' => 'publication'],
            ['name' => 'Enfermería', 'type' => 'publication'],
            ['name' => 'Agronomía', 'type' => 'publication'],
            ['name' => 'Veterinaria', 'type' => 'publication'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
