<?php

namespace Database\Seeders;

use App\Models\Rating;
use App\Models\Villain;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RatingVillainTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csv_file = fopen(__DIR__ . '/../data/reviews.csv', 'r');

        for ($row_count = 0; ($row_data = fgetcsv($csv_file)) !== false; $row_count++) {
            if ($row_count) {
                $rating_id = Rating::where('value', '=', $row_data[2])->first()->id;
                $villain = Villain::where('name', '=', $row_data[0])->first();

                $villain->ratings()->attach($rating_id, [
                    'full_name' => $row_data[1],
                    'content' => $row_data[3] ?? '',
                    'created_at' => Carbon::now()->subDays(rand(0, 365)),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
        fclose($csv_file);

        //Dati generati per Frieza per prova statistiche
        $villainFrieza = Villain::find(1);
        $names = [
            "Bob Johnson", "Daniel Wright", "Mary Johnson", "Sarah Thompson", "James White",
            "Linda Lee", "John Carter", "Patricia Evans", "Robert Brown", "Jennifer Clark"
        ];
        $ratingValues = [1, 2, 3, 4, 5];
        $reviewTexts = [
            "Efficient and ruthless. Highly recommended!",
            "Truly a formidable opponent.",
            "Achieved results beyond expectations.",
            "Could improve on communication.",
            "Met expectations, would recommend.",
            "Exceptional service, as promised!",
            ""
        ];

        for ($i = 0; $i < 500; $i++) {
            $ratingValue = $ratingValues[array_rand($ratingValues)];
            $rating = Rating::firstOrCreate(['value' => $ratingValue]);

            $villainFrieza->ratings()->attach($rating->id, [
                'full_name' => $names[array_rand($names)],
                'content' => $reviewTexts[array_rand($reviewTexts)],
                'created_at' => Carbon::now()->subDays(rand(0, 365)),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
