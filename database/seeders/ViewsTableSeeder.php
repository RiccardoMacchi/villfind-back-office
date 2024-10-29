<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Villain;
use App\Models\View;
use Carbon\Carbon;

class ViewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csv_file = fopen(__DIR__ . '/../data/views.csv', 'r');

        for ($row_count = 0; ($row_data = fgetcsv($csv_file)) != false; $row_count++) {
            if ($row_count) {
                $view = new View();
                $view->villain_id = $row_data[0];
                $view->visitor_ip= $row_data[1];
                $view->created_at= Carbon::parse($row_data[2]);
                $view->save();
            }
        }
    }
}
