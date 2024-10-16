<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SkillsTableSeeder::class,
            UniversesTableSeeder::class,
            ServicesTableSeeder::class,
            RatingsTableSeeder::class,
            UsersTableSeeder::class,
            VillainsTableSeeder::class,
            MessagesTableSeeder::class,
            SkillVillainTableSeeder::class,
            ServiceVillainTableSeeder::class,
            RatingVillainTableSeeder::class,
            SponsorshipTableSeeder::class,
            SponsorshipVillainTableSeeder::class,
        ]);
    }
}
