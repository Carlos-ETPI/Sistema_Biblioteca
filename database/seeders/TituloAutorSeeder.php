<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TituloAutorSeeder extends Seeder
{
    public function run()
    {
        DB::table('tituloautor')->insert([
            ['ID_TITULO' => 1, 'ID_AUTOR' => 1],
            ['ID_TITULO' => 1, 'ID_AUTOR' => 2],
            ['ID_TITULO' => 2, 'ID_AUTOR' => 3],
            ['ID_TITULO' => 3, 'ID_AUTOR' => 4],
        ]);
    }
}
