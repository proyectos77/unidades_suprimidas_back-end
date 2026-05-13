<?php

namespace App\Services\TipoDocumental_services;

use App\Http\Responses\Responses;
use App\Models\TipoDocumental\TipoDocumentalModel;

class TipoDocumentalService
{
    public function obtenerTodosLosTiposDocumentales()
    {
        try {
            $tiposDocumentales = TipoDocumentalModel::all();

            return Responses::success(
                200,
                'Listado de tipos documentales',
                'Se obtuvo la lista de todos los tipos documentales',
                'success',
                $tiposDocumentales
            );

        } catch (\Exception $e) {
            return Responses::error(
                500,
                'Error al obtener tipos documentales',
                'No se pudo obtener el listado de tipos documentales',
                'error',
                $e->getMessage()
            );
        }
    }

    public function obtenerTipoDocumental($id)
    {
        try {
            $tipoDocumental = TipoDocumentalModel::findOrFail($id);

            return Responses::success(
                200,
                'Tipo documental obtenido',
                'Se obtuvo el tipo documental',
                'success',
                $tipoDocumental
            );

        } catch (\Exception $e) {
            return Responses::error(
                404,
                'Tipo documental no encontrado',
                'El tipo documental no existe',
                'error',
                $e->getMessage()
            );
        }
    }

    public function crearTipoDocumental($datos)
    {
        try {
            $tipoDocumental = TipoDocumentalModel::create([
                'nombre_tipo_documental' => $datos['nombre_tipo_documental'] ?? null,
            ]);

            return Responses::success(
                201,
                'Tipo documental creado',
                'El tipo documental se ha creado exitosamente',
                'success',
                $tipoDocumental
            );

        } catch (\Exception $e) {
            return Responses::error(
                500,
                'Error al crear tipo documental',
                'No se pudo crear el tipo documental',
                'error',
                $e->getMessage()
            );
        }
    }

    public function actualizarTipoDocumental($id, $datos)
    {
        try {
            $tipoDocumental = TipoDocumentalModel::findOrFail($id);

            $tipoDocumental->update([
                'nombre_tipo_documental' => $datos['nombre_tipo_documental'] ?? $tipoDocumental->nombre_tipo_documental,
            ]);

            return Responses::success(
                200,
                'Tipo documental actualizado',
                'El tipo documental se ha actualizado exitosamente',
                'success',
                $tipoDocumental
            );

        } catch (\Exception $e) {
            return Responses::error(
                500,
                'Error al actualizar tipo documental',
                'No se pudo actualizar el tipo documental',
                'error',
                $e->getMessage()
            );
        }
    }

    public function eliminarTipoDocumental($id)
    {
        try {
            $tipoDocumental = TipoDocumentalModel::findOrFail($id);
            $tipoDocumental->delete();

            return Responses::success(
                200,
                'Tipo documental eliminado',
                'El tipo documental se ha eliminado exitosamente',
                'success',
                null
            );

        } catch (\Exception $e) {
            return Responses::error(
                500,
                'Error al eliminar tipo documental',
                'No se pudo eliminar el tipo documental',
                'error',
                $e->getMessage()
            );
        }
    }
}
