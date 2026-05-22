<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Zone;

class ZoneSeeder extends Seeder
{
    public function run(): void
    {
        $zones = [
            ['nom' => 'Abidjan', 'code' => 'ABJ'],
            ['nom' => 'Bouaké', 'code' => 'BKE'],
            ['nom' => 'Daloa', 'code' => 'DAL'],
            ['nom' => 'Korhogo', 'code' => 'KOR'],
            ['nom' => 'Yamoussoukro', 'code' => 'YAM'],
            ['nom' => 'San Pedro', 'code' => 'SPD'],
        ];

        foreach ($zones as $z) {
            Zone::create($z);
        }
    }
}