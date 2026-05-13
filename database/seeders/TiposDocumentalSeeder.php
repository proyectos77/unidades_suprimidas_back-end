<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiposDocumentalSeeder extends Seeder
{
    public function run(): void
    {
        $tiposDocumentales = [
            ['nombre_tipo_documental' => 'Oficio'],
            ['nombre_tipo_documental' => 'Memorando'],
            ['nombre_tipo_documental' => 'Radiograma'],
            ['nombre_tipo_documental' => 'Actas'],
            ['nombre_tipo_documental' => 'Planes'],
            ['nombre_tipo_documental' => 'Directivas'],
            ['nombre_tipo_documental' => 'Disposiciones'],
            ['nombre_tipo_documental' => 'Reglamentos'],
            ['nombre_tipo_documental' => 'Manuales'],
            ['nombre_tipo_documental' => 'Circulares'],
            ['nombre_tipo_documental' => 'Resoluciones'],
            ['nombre_tipo_documental' => 'Convenios'],
            ['nombre_tipo_documental' => 'Orden general'],
            ['nombre_tipo_documental' => 'Orden semanal'],
            ['nombre_tipo_documental' => 'Orden del dia'],
            ['nombre_tipo_documental' => 'Ordenes administrativas de personal'],
            ['nombre_tipo_documental' => 'Ordenes de operaciones'],
            ['nombre_tipo_documental' => 'Ordenes de suministro'],
            ['nombre_tipo_documental' => 'Planillas entrega comunicaciones oficiales'],
            ['nombre_tipo_documental' => 'Planillas de tiro'],
            ['nombre_tipo_documental' => 'Planillas de abastecimiento'],
        ];

        DB::table('tipos_documentales')->insert($tiposDocumentales);
    }
}
