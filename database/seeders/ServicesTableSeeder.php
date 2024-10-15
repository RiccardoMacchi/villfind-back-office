<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csv_file = fopen(__DIR__ . '/../data/services.csv', 'r');

        for ($row_count = 0; ($row_data = fgetcsv($csv_file)) != false; $row_count++) {
            if ($row_count) {
                $new_service = new Service();
                $new_service->name = $row_data[0];
                if ($row_data[1]) {
                    $new_service->description = $row_data[1];
                }

                $new_service->save();
            }
        }
    }
}
