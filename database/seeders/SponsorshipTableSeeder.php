<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sponsorship;

class SponsorshipTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csv_file = fopen(__DIR__ . '/../data/sponsorship.csv', 'r');
        for ($row_count = 0; ($row_data = fgetcsv($csv_file)) != false; $row_count++) {
            if ($row_count) {
                $new_villain = new Sponsorship();
                $new_villain->name = $row_data[0];
                $new_villain->price = $row_data[1];
                $new_villain->hours = $row_data[2];;
                $new_villain->save();
            }
        }
    }
}
