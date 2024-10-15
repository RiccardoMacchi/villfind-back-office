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
        $csv_file = fopen(__DIR__ . '/../data/villains.csv', 'r');

        for ($row_count = 0; ($row_data = fgetcsv($csv_file)) != false; $row_count++) {
            if ($row_count) {
                if ($row_data[4]) {
                    $new_skills_names = explode(';', $row_data[4]);

                    foreach ($new_skills_names as $new_skill_name) {
                        if (!Skill::where('name', '=', $new_skill_name)->count()) {
                            $new_skill = new Skill();

                            $new_skill->name = $new_skill_name;

                            $new_skill->save();
                        }
                    }
                }
            }
        }
    }
}
