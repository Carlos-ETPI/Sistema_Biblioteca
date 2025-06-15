<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AutorSeeder extends Seeder
{
    public function run()
    {
        DB::table('autor')->insert([
            ['ID_AUTOR' => 1, 'NOM_AUTOR' => 'Stephanie', 'APE_AUTOR' => 'Hogan', 'DESC_AUTOR' => 'A hand view four bring. More others reflect far seat.'],
            ['ID_AUTOR' => 2, 'NOM_AUTOR' => 'Emily', 'APE_AUTOR' => 'Lee', 'DESC_AUTOR' => 'Rule reflect argue on. Outside somebody send necessary create blood.'],
            ['ID_AUTOR' => 3, 'NOM_AUTOR' => 'Christine', 'APE_AUTOR' => 'Clark', 'DESC_AUTOR' => 'One agency month card. Vote stay heart common concern near before born.'],
            ['ID_AUTOR' => 4, 'NOM_AUTOR' => 'Jeffrey', 'APE_AUTOR' => 'Hughes', 'DESC_AUTOR' => 'Commercial speak whether must wide success.'],
            ['ID_AUTOR' => 5, 'NOM_AUTOR' => 'Mary', 'APE_AUTOR' => 'Snyder', 'DESC_AUTOR' => 'Act Mrs approach cup suffer evidence rather occur.'],
        ]);
    }
}
