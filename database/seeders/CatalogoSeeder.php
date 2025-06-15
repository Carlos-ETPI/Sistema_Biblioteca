<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatalogoSeeder extends Seeder
{
    public function run()
    {
        DB::table('catalogo')->insert([
            ['ID_CATALOGO' => 1, 'BIBLIOTECA_CATALOGO' => 'Biblioteca Central'],
        ]);
    }
}
