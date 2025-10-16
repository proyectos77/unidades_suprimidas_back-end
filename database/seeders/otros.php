<?php

namespace Database\Seeders;

use App\Models\TiposOtros\tipoOtrosModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class otros extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        tipoOtrosModel::create([
            'nombre_tipo_otro' => 'CDS',
            'id_estado' => '1',
        ]);

        tipoOtrosModel::create([
            'nombre_tipo_otro' => 'USB',
            'id_estado' => '1',
        ]);

        tipoOtrosModel::create([
            'nombre_tipo_otro' => 'DISKETTE',
            'id_estado' => '1',
        ]);

        tipoOtrosModel::create([
            'nombre_tipo_otro' => 'DISCO DURO',
            'id_estado' => '1',
        ]);
    }
}
