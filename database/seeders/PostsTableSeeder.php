<?php

namespace Database\Seeders;

use App\Functions\Helper;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\PostType;
use Faker\Generator as Faker;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 200; $i++) {

            $new_post = new Post();

            $new_post->title = $faker->sentence();
            $new_post->slug = Helper::generateSlug($new_post->title, Post::class);
            $new_post->body = $faker->paragraph(8);
            $new_post->reading_time = Helper::getReadingTime($new_post->body);
            $new_post->is_archived = boolval(rand(0, 1));

            $new_post->post_type_id = rand(0, 20) ? PostType::inRandomOrder()->first()->id : null;

            $new_post->save();
        }
    }
}
