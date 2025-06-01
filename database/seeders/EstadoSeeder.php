<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Estados\EstadosModell;

class EstadoSeeder extends Seeder
{
    public function run(): void
    {
        EstadosModell::create([
            'nombre_estado' => 'Activo',
            'descripcion_estado' => 'Elemento activo',
            'estado' => '1',
        ]);

        EstadosModell::create([
            'nombre_estado' => 'Inactivo',
            'descripcion_estado' => 'Elemento inactivo',
            'estado' => '0',
        ]);

        EstadosModell::create([
            'nombre_estado' => 'Solicitud en revisión',
            'descripcion_estado' => 'Solicitud en revisión por parte del revisor',
            'estado' => '0',
        ]);

        EstadosModell::create([
            'nombre_estado' => 'Solicitud aprobada',
            'descripcion_estado' => 'Solicitud aprobada por el revisor',
            'estado' => '0',
        ]);

        EstadosModell::create([
            'nombre_estado' => 'Solicitud rechazada',
            'descripcion_estado' => 'Solicitud rechazada por el revisor',
            'estado' => '0',
        ]);
    }
}
