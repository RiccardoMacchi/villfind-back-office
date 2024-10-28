<?php

namespace Database\Seeders;

use App\Models\Message;
use App\Models\Villain;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Carbon\Carbon;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $last_villain_id = Villain::orderBy('id', 'DESC')->first()->id;

        for ($villain_id = 1; $villain_id <= $last_villain_id; $villain_id++) {
            while (rand(0, 2)) {
                $new_message = new Message();
                $new_message->villain_id = $villain_id;
                $new_message->full_name = $faker->firstName() . ' ' . $faker->lastName();
                $new_message->email = $faker->email();
                $new_message->phone = $faker->phoneNumber();
                $new_message->content = $faker->text();
                $new_message->created_at = Carbon::now()->subDays(rand(0, 365));
                $new_message->updated_at = Carbon::now();
                $new_message->save();
            }
        }

        for ($i = 0; $i < 300; $i++) {
            $new_message = new Message();
            $new_message->villain_id = 1;
            $new_message->full_name = $faker->firstName() . ' ' . $faker->lastName();
            $new_message->email = $faker->email();
            $new_message->phone = $faker->phoneNumber();
            $new_message->content = $faker->text();

            // Imposta una data casuale per created_at
            $new_message->created_at = Carbon::now()->subDays(rand(0, 365));
            $new_message->updated_at = Carbon::now();

            $new_message->save();
        }
    }
}
