<?php

use Illuminate\Database\Seeder;

class BlocksTableSeeder extends Seeder
{
    public function run()
    {
        $this->command->info('Start import blocks');

        $filePath = base_path(implode(DIRECTORY_SEPARATOR, ['data', 'GeoLite2-City-Blocks-IPv4.csv']));
        $file = fopen($filePath, 'r');
        $rows = [];
        while (($data = fgetcsv($file)) !== false) {
            $network   = $data[0];
            $geonameId = $data[1];

            if (!$network || !$geonameId) {
                continue;
            }

            $rows[] = [
                'network'    => $network,
                'latitude'   => $data[7],
                'longitude'  => $data[8],
                'geoname_id' => $geonameId,
            ];

            if (count($rows) == 1000) {
                DB::table('blocks')->insert($rows);
                $rows = [];
            }
        }

        if (count($rows) > 0) {
            DB::table('blocks')->insert($rows);
        }

        $this->command->info('Finish import blocks');
    }
}