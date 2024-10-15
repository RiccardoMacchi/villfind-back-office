<?php

namespace Database\Seeders;

use App\Models\Rating;
use App\Models\Villain;
use Illuminate\Database\Seeder;

class RatingVillainTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csv_file = fopen(__DIR__ . '/../data/reviews.csv', 'r');

        for ($row_count = 0; ($row_data = fgetcsv($csv_file)) != false; $row_count++) {
            if ($row_count) {
                $rating_id = Rating::where('value', '=', $row_data[2])->first()->id;

                $villain = Villain::where('name', '=', $row_data[0])->first();
                $villain->ratings()->attach($rating_id, ['full_name' => $row_data[1]]);
                if ($row_data[3]) {
                    $villain->ratings()->updateExistingPivot($rating_id, ['content' => $row_data[3]]);
                }
            }
        }
    }
}
