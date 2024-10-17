<?php

namespace Database\Seeders;

use App\Models\Message;
use App\Models\Villain;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

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

                $new_message->save();
            }
        }
    }
}
