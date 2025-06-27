<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Media;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Make sure at least one user and media categories exist
        $user = User::first() ?? User::factory()->create();
        $mediaCategories = Category::where('type', 'media')->get();

        if ($mediaCategories->isEmpty()) {
            // If no media categories are found, cannot proceed
            $this->command->warn('No media categories found. Please run CategorySeeder first.');
            return;
        }

        $mediaTypes = ['television', 'short_video', 'radio', 'podcast', 'audiobook', 'exclusive'];

        foreach ($mediaTypes as $type) {
            for ($i = 0; $i < 10; $i++) {
                $title = $faker->sentence(4);
                $description = $faker->paragraph(3);

                $fileUrl = match ($type) {
                    'television' => 'https://www.youtube.com/watch?v=fkEURtfT0a8',
                    'short_video' => 'https://www.youtube.com/shorts/' . $faker->randomElement(['k4y2_DO-6tY', 'm_u6m3-Lq_8', 'lq9v5sD-pYI', '8fW5n4n7Q8U', 'a3ICNMQW7Ok']),
                    'radio', 'podcast', 'audiobook' => 'https://freetestdata.com/wp-content/uploads/2021/09/Free_Test_Data_1MB_MP3.mp3',
                    'exclusive' => 'https://www.youtube.com/watch?v=exclusive_' . $i,
                    default => $faker->url,
                };

                Media::create([
                    'title' => $title,
                    'description' => $description,
                    'file_url' => $fileUrl,
                    'type' => $type,
                    'cover_image_url' => 'https://picsum.photos/seed/' . str_replace(' ', '_', $title) . '/400/225',
                    'publication_date' => $faker->dateTimeBetween('-1 year', 'now'),
                    'category_id' => $mediaCategories->random()->id,
                    'user_id' => $user->id,
                    'tags' => json_encode($faker->words(3)),
                    'views_count' => $faker->numberBetween(100, 100000),
                    'likes_count' => $faker->numberBetween(10, 10000),
                ]);
            }
        }
    }
}
