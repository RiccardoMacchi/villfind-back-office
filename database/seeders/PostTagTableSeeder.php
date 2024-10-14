<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::chunk(100, function ($posts) {
            foreach ($posts as $post) {
                while (rand(0, 1)) {
                    $tag_id = Tag::inRandomOrder()->first()->id;

                    $post->tags()->attach($tag_id);
                }
            }
        });
    }
}
