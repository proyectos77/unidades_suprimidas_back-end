<?php

 namespace App\Services\Archivo_services;

use App\Http\Responses\Responses;
use App\Models\Archivo\ArchivoModel;

 class updateArchivoUnidadServices
 {
    public function actualizarArchivo($request, $id) {
        try {
            $archivo = $this->validarArchivo($id);
            $archivo->fill($request->all());
            $archivo->save();

            return Responses::success(200, 'Actualizado', 'Archivo actualizado correctamente', 'success', $archivo);

        } catch (\Exception $e) {
            return Responses::error(500, 'Error', 'Error al actualizar el archivo', $e->getMessage());
        }
    }

    private function validarArchivo($idArchivo) {
        return ArchivoModel::findOrFail($idArchivo);
    }
 }
