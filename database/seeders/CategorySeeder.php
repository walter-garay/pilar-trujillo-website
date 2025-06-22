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
            // Media Categories
            ['name' => 'Documentaries', 'type' => 'media'],
            ['name' => 'Interviews', 'type' => 'media'],
            ['name' => 'Special Reports', 'type' => 'media'],
            ['name' => 'News', 'type' => 'media'],
            ['name' => 'Opinion Programs', 'type' => 'media'],
            ['name' => 'Debates', 'type' => 'media'],
            ['name' => 'Culture', 'type' => 'media'],
            ['name' => 'Technology', 'type' => 'media'],
            ['name' => 'Science', 'type' => 'media'],
            ['name' => 'Education', 'type' => 'media'],

            // Publication Categories
            ['name' => 'Journalistic Research', 'type' => 'publication'],
            ['name' => 'Opinion Articles', 'type' => 'publication'],
            ['name' => 'Chronicles', 'type' => 'publication'],
            ['name' => 'Photo Essays', 'type' => 'publication'],
            ['name' => 'Political Analysis', 'type' => 'publication'],
            ['name' => 'Economy', 'type' => 'publication'],
            ['name' => 'Society', 'type' => 'publication'],
            ['name' => 'International', 'type' => 'publication'],
            ['name' => 'History', 'type' => 'publication'],
            ['name' => 'Book Reviews', 'type' => 'publication'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
