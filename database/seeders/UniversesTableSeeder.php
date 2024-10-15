<?php

namespace Database\Seeders;

use App\Models\Universe;
use Illuminate\Database\Seeder;

class UniversesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csv_file = fopen(__DIR__ . '/../data/universes.csv', 'r');

        for ($row_count = 0; ($row_data = fgetcsv($csv_file)) != false; $row_count++) {
            if ($row_count) {
                $new_universe = new Universe();
                $new_universe->name = $row_data[0];
                if ($row_data[1]) {
                    $new_universe->description = $row_data[1];
                }

                $new_universe->save();
            }
        }
    }
}
