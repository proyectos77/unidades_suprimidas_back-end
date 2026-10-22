<?php

namespace Database\Seeders;

use App\Models\TiposDocumentacionSistema\TipoDocumentacionSistemaModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TiposDocumentacionSistema extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoDocumentacionSistemaModel::create([
            'nombre_tipo_documento_sistema' => 'Documento PDF',
            'descripcion_tipo_documento_sistema' => 'Todo documento PDF'
        ]);

        TipoDocumentacionSistemaModel::create([
            'nombre_tipo_documento_sistema' => 'Documento Word',
            'descripcion_tipo_documento_sistema' => 'Todo documento Word'
        ]);

        TipoDocumentacionSistemaModel::create([
            'nombre_tipo_documento_sistema' => 'Presentaciones',
            'descripcion_tipo_documento_sistema' => 'Presentaciones power point'
        ]);

        TipoDocumentacionSistemaModel::create([
            'nombre_tipo_documento_sistema' => 'Videos',
            'descripcion_tipo_documento_sistema' => 'Todo video'
        ]);
    }
}
