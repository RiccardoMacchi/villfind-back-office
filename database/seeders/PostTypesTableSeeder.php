<?php

namespace Database\Seeders;

use App\Functions\Helper;
use App\Models\PostType;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class PostTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 15; $i++) {

            $new_post_type = new PostType();

            $new_post_type->name = $faker->sentence(3);
            $new_post_type->slug = Helper::generateSlug($new_post_type->name, PostType::class);
            $new_post_type->description = $faker->paragraph();

            $new_post_type->save();
        }
    }
}
