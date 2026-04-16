<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $estantes = [];

        // Bucle exterior: Recorre los 100 cuerpos existentes
        for ($cuerpoId = 1; $cuerpoId <= 100; $cuerpoId++) {

            // Bucle interior: Crea 7 estantes para el cuerpo actual
            for ($numeroEstante = 1; $numeroEstante <= 7; $numeroEstante++) {
                $estantes[] = [
                    'id_cuerpo'      => $cuerpoId,
                    'nombre_estante' => 'Estante ' . $numeroEstante,
                ];
            }
        }

        // Insertamos los 700 registros (100 x 7) en una sola operación
        // Esto es mucho más rápido que hacer 700 consultas separadas
        DB::table('estantes')->insert($estantes);
    }
}
