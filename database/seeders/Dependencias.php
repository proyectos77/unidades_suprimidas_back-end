<?php

namespace Database\Seeders;

use App\Models\Denpendencias\Dependencias as DenpendenciasDependencias;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Dependencias extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'COEJC',
            'sigla_dependencia' => "COEJC",
            'padre_dependencia' => null
        ]);

        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'SECEJ',
            'sigla_dependencia' => "SECEJ",
            'padre_dependencia' => null
        ]);

        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'JEMOP',
            'sigla_dependencia' => "JEMOP",
            'padre_dependencia' => 2
        ]);

        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'JEMPP',
            'sigla_dependencia' => "JEMPP",
            'padre_dependencia' => 2
        ]);

        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'CHP1',
            'sigla_dependencia' => "CHP1",
            'padre_dependencia' => 4
        ]);

        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'DIV01',
            'sigla_dependencia' => "DIV01",
            'padre_dependencia' => 3
        ]);

        DenpendenciasDependencias::create([
            'nombre_dependencia' => 'DIV2',
            'sigla_dependencia' => "DIV2",
            'padre_dependencia' => 3
        ]);
    }
}
