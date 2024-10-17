<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csv_file = fopen(__DIR__ . '/../data/villains.csv', 'r');

        for ($row_count = 0; ($row_data = fgetcsv($csv_file)) != false; $row_count++) {
            if ($row_count) {
                $new_user = new User();
                $new_user->email = 'test' . $row_count . '@test';
                $new_user->password = Hash::make('test' . $row_count);

                $new_user->save();
            }
        }
    }
}
