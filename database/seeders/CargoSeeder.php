<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cargos\CargosModel;

class CargoSeeder extends Seeder
{
    public function run(): void
    {
        CargosModel::create([
            'nombre_cargo' => 'Soldado profesional',
            'id_estado' => 1 // O el ID del estado correcto en la base de datos
        ]);
    }
}
