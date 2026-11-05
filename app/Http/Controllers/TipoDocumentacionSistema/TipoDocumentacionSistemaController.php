<?php

namespace App\Http\Controllers\TipoDocumentacionSistema;

use App\Http\Controllers\Controller;
use App\Http\Responses\Responses;
use App\Models\TiposDocumentacionSistema\TipoDocumentacionSistemaModel;

class TipoDocumentacionSistemaController extends Controller
{
    /**
     * Listado de los tipos de documentación activos (para el select del formulario).
     */
    public function index()
    {
        try {
            $tipos = TipoDocumentacionSistemaModel::where('id_estado', 1)
                ->orderBy('id_tipo_documentacion_sistema')
                ->get(['id_tipo_documentacion_sistema', 'nombre_tipo_documento_sistema', 'descripcion_tipo_documento_sistema']);

            return Responses::success(200, 'Consulta realizada', 'La consulta se ha realizado con exito', 'success', $tipos);
        } catch (\Exception $e) {
            return Responses::error(500, 'Error consulta', 'Error al realizar la consulta.', $e->getMessage());
        }
    }
}
