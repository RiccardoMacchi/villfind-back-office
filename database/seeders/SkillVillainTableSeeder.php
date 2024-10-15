<?php

namespace Database\Seeders;

use App\Models\Skill;
use App\Models\Villain;
use Illuminate\Database\Seeder;

class SkillVillainTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csv_file = fopen(__DIR__ . '/../data/villains.csv', 'r');

        for ($row_count = 0; ($row_data = fgetcsv($csv_file)) != false; $row_count++) {
            if ($row_count) {
                if ($row_data[4]) {
                    $new_skills_names = explode(';', $row_data[4]);

                    foreach ($new_skills_names as $new_skill_name) {
                        $skill_id = Skill::where('name', '=', $new_skill_name)->first()->id;

                        Villain::find($row_count)->skills()->attach($skill_id);
                    }
                }
            }
        }
    }
}
