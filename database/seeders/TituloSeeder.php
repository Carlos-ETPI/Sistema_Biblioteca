<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TituloSeeder extends Seeder
{
    public function run()
    {
        DB::table('TITULO')->insert([
            ['ID_TITULO' => 1, 'ID_CATALOGO' => 1, 'ID_CATEGORIA' => 1, 'ID_IDIOMA' => 1, 'NOMBRE_TITULO' => 'El Principito', 'ISBN_TITULO' => '978-1234567890'],
            ['ID_TITULO' => 2, 'ID_CATALOGO' => 1, 'ID_CATEGORIA' => 2, 'ID_IDIOMA' => 2, 'NOMBRE_TITULO' => 'Historia del Mundo', 'ISBN_TITULO' => '978-9876543210'],
            ['ID_TITULO' => 3, 'ID_CATALOGO' => 1, 'ID_CATEGORIA' => 3, 'ID_IDIOMA' => 3, 'NOMBRE_TITULO' => 'Fundamentos de Ciencia', 'ISBN_TITULO' => '978-4567891230'],
        ]);
    }
}
