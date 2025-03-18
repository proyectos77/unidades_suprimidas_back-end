<?php

namespace Database\Seeders;

use App\Models\Municipios\MunicipiosModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MunicipiosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MunicipiosModel::create([
            'nombre_municipio' => 'Neiva',
            'id_departamento' => 1
        ]);
    }
}
