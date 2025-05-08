<?php
namespace App\Services\Archivo_services;

use App\Http\Responses\Responses;
use App\Models\Archivo\ArchivoModel;
use App\Models\DetalleUnidad\DetalleUnidadModel;

use function PHPUnit\Framework\isNull;

class registroArchivoUnidadServices
{
    public function registroArchivos($dataRegistro) {
        try {
            $this->validarDetalle($dataRegistro['id_detalle']);

            $archivo = ArchivoModel::create($dataRegistro->all());

            return Responses::success(200, 'Registro realizado', 'Se realizo el registro del archivo de la unidad', 'success', $archivo);

        } catch (\Exception $e) {
            return Responses::error(500, 'Error de registro', 'Por favor intente mas tarde', $e->getMessage());
        }
    }

    protected function validarDetalle($idDetalle) {
        $detalle = DetalleUnidadModel::find($idDetalle);

        if (!$detalle) {
            throw new \Exception("No se el detalle del archivo");
        }

        return $detalle->id_detalle;
    }
}

