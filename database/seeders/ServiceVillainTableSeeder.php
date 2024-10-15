<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\Villain;
use Illuminate\Database\Seeder;

class ServiceVillainTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csv_file = fopen(__DIR__ . '/../data/villains.csv', 'r');

        for ($row_count = 0; ($row_data = fgetcsv($csv_file)) != false; $row_count++) {
            if ($row_count) {
                if ($row_data[5]) {
                    $services_names = explode(';', $row_data[5]);

                    foreach ($services_names as $service_name) {
                        $service_id = Service::where('name', '=', $service_name)->first()->id;

                        Villain::where('name', '=', $row_data[0])->first()->services()->attach($service_id);
                    }
                }
            }
        }
    }
}
