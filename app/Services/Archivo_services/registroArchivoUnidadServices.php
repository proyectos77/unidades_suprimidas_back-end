<?php
namespace App\Services\Archivo_services;

use App\Http\Responses\Responses;
use App\Models\DetalleUnidad\DetalleUnidadModel;

use function PHPUnit\Framework\isNull;

class registroArchivoUnidadServices
{
    public function registroArchivos($dataRegistro) {
        try {
            $validarDetalle = $this->validarDetalle($dataRegistro['id_detalle']);
            $validarDetalle->fill($dataRegistro->all());
            $validarDetalle->save();

            return Responses::success(200, 'Registro realizado', 'Se realizo el registro del detalle de la unidad', 'success', $validarDetalle);

        } catch (\Exception $e) {
            return Responses::error(500, 'Error de registro', 'Por favor intente mas tarde', $e->getMessage());
        }
    }

    protected function validarDetalle($idDetalle) {
        return DetalleUnidadModel::findOrFail($idDetalle);
    }
}

