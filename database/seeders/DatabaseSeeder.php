<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            EstadoSeeder::class,
            TipoUsuarioSeeder::class,
            CargoSeeder::class,
            Usuarios::class,
            departamentosMunicipios::class
        ]);
    }
}
