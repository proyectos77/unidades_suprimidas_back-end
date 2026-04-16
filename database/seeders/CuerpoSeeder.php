<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CuerpoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cuerpos = [];
        $now = Carbon::now();

        // Generamos los 100 registros en memoria
        for ($i = 1; $i <= 100; $i++) {
            $cuerpos[] = [
                'nombre_cuerpo' => 'Cuerpo ' . $i,
            ];
        }

        // Insertamos los 100 registros en una sola consulta
        DB::table('cuerpos')->insert($cuerpos);
    }
}
