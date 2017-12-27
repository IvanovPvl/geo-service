<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationsTableSeeder extends Seeder
{
    public function run()
    {
        $this->command->info('Start import locations');

        $filePath = base_path(implode(DIRECTORY_SEPARATOR, ['data', 'GeoLite2-City-Locations-en.csv']));
        $file = fopen($filePath, 'r');
        $rows = [];
        while (($data = fgetcsv($file)) !== false) {
            $rows[] = [
                'id'      => $data[0],
                'city'    => $data[10],
                'country' => $data[5],
            ];

            if (count($rows) == 1000) {
                DB::table('locations')->insert($rows);
                $rows = [];
            }
        }

        if (count($rows) > 0) {
            DB::table('locations')->insert($rows);
        }

        $this->command->info('Finish import locations');
    }
}