<?php

namespace Database\Seeders;

use App\Functions\Helper;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 15; $i++) {

            $new_post_type = new Tag();

            $new_post_type->name = $faker->word();
            $new_post_type->slug = Helper::generateSlug($new_post_type->name, Tag::class);

            $new_post_type->save();
        }
    }
}
