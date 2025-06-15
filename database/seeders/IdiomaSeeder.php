<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IdiomaSeeder extends Seeder
{
    public function run()
    {
        DB::table('IDIOMA')->insert([
            ['ID_IDIOMA' => 1, 'IDIOMA' => 'Español'],
            ['ID_IDIOMA' => 2, 'IDIOMA' => 'Inglés'],
            ['ID_IDIOMA' => 3, 'IDIOMA' => 'Francés'],
        ]);
    }
}
