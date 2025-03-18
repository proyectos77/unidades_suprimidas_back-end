<?php

namespace Database\Seeders;

use App\Models\Departamentos\DepartamentosModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartamentosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DepartamentosModel::create([
            'nombre_departamento' => 'Huila',
            'id_estado' => 1,
            'fecha_creacion_departamento' => now(),
            'fecha_actualizacion_departamento' => now()
        ]);
    }
}
