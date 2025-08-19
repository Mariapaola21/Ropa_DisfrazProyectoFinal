<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Reserva;
use App\Models\Disfrace;
use App\Models\Disfraz;
use App\Models\Usuario;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

    }
}
        // User::factory(10)->create();

    
        // Crear 10 usuarios
        // Usuario::factory(10)->create();

        // Crear 5 disfraces
        Disfraz::factory(5)->create();

        // Crear 15 reservas
        Reserva::factory(15)->create();