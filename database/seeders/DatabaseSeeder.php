<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('prueba1234'),
        ]);
        $user->assignRole('admin');
        
            $this->call([
            CategoriaSeeder::class,
            CatalogoSeeder::class,
            IdiomaSeeder::class,
            AutorSeeder::class,
            TituloSeeder::class,
            TituloAutorSeeder::class,
            EjemplarSeeder::class,
        ]);

    }
}
