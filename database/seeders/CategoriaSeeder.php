<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    public function run()
    {
        DB::table('categoria')->insert([
            ['ID_CATEGORIA' => 1, 'NOM_CATEGORIA' => 'Ficción', 'DESCRIPCION_CATEGORIA' => 'Narrativa de eventos imaginarios'],
            ['ID_CATEGORIA' => 2, 'NOM_CATEGORIA' => 'Historia', 'DESCRIPCION_CATEGORIA' => 'Eventos del pasado'],
            ['ID_CATEGORIA' => 3, 'NOM_CATEGORIA' => 'Ciencia', 'DESCRIPCION_CATEGORIA' => 'Estudios científicos'],
        ]);
    }
}
