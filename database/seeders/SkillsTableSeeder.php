<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;

class SkillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csv_file = fopen(__DIR__ . '/../data/skills.csv', 'r');

        for ($row_count = 0; ($row_data = fgetcsv($csv_file)) != false; $row_count++) {
            if ($row_count) {
                $new_service = new Skill();
                $new_service->name = $row_data[0];

                $new_service->save();
            }
        }
    }
}
