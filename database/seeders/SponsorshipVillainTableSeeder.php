<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Villain;
use App\Models\Sponsorship;
use Carbon\Carbon;

class SponsorshipVillainTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $villains = Villain::all();
        $sponsorships = Sponsorship::all();

        foreach ($villains as $villain) {
            if (rand(0, 100) <= 30) {
                $number_sponsorships = rand(1, 3);
                $associated_sponsorship = $sponsorships->random($number_sponsorships);

                foreach ($associated_sponsorship as $sponsorship) {
                    switch ($sponsorship->id) {
                        case 1:
                            // Scadenza massima a 24 ore
                            $expiration_date = Carbon::now()->addHours(rand(1, 24));
                            break;
                        case 2:
                            // Scadenza massima a 72 ore
                            $expiration_date = Carbon::now()->addHours(rand(1, 72));
                            break;
                        case 3:
                            // Scadenza massima a 144 ore
                            $expiration_date = Carbon::now()->addHours(rand(1, 144));
                            break;
                    }

                    // scadenza nel passato
                    if (rand(0, 100) <= 60) {
                        $expiration_date = Carbon::now()->subDays(rand(1, 1000 ));
                    }

                    \DB::table('sponsorship_villain')->insert([
                        'villain_id' => $villain->id,
                        'sponsorship_id' => $sponsorship->id,
                        'purchase_price' => $sponsorship->price,
                        'expiration_date' => $expiration_date,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}
