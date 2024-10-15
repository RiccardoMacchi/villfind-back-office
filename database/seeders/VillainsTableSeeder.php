<?php

namespace Database\Seeders;

use App\Functions\Helper;
use App\Models\Universe;
use App\Models\Villain;
use Illuminate\Database\Seeder;

class VillainsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csv_file = fopen(__DIR__ . '/../data/villains.csv', 'r');

        for ($row_count = 0; ($row_data = fgetcsv($csv_file)) != false; $row_count++) {
            if ($row_count) {
                $new_villain = new Villain();
                $new_villain->name = $row_data[0];
                $new_villain->slug = Helper::generateSlug($row_data[0], Villain::class);
                if ($row_data[1]) {
                    $new_villain->image = $row_data[1];
                }
                if ($row_data[2]) {
                    $new_villain->phone = $row_data[2];
                }

                $new_villain->universe_id = Universe::where('name', '=', $row_data[3])->first()->id;
                $new_villain->user_id = $row_count;

                $new_villain->save();
            }
        }
    }
}
