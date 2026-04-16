<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BaldaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $baldas = [];

        // Sabemos que hay 700 estantes en total (100 cuerpos x 7 estantes)
        for ($estanteId = 1; $estanteId <= 700; $estanteId++) {

            // Creamos 7 baldas para cada estante
            for ($numeroBalda = 1; $numeroBalda <= 7; $numeroBalda++) {
                $baldas[] = [
                    'id_estante'   => $estanteId,
                    'nombre_balda' => 'Balda ' . $numeroBalda,
                ];
            }
        }

        // Dividimos el arreglo de 4900 registros en bloques de 1000
        // Esto optimiza el consumo de memoria y hace la inserción más segura
        $chunks = array_chunk($baldas, 1000);

        foreach ($chunks as $chunk) {
            DB::table('baldas')->insert($chunk);
        }
    }
}
