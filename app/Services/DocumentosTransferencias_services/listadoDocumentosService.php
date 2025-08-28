<?php

namespace App\Services\DocumentosTransferencias_services;

use App\Http\Resources\DocumentosTransferencias\DocumentosTransferenciasResource;
use App\Http\Responses\Responses;
use App\Models\DocumentoTransferencia\DocumentoTransferenciaModel;

class listadoDocumentosService
{
    public function listarDocumentos($idTransferencia)
    {
        try {
            $documentos = DocumentoTransferenciaModel::where(['id_transferencia' => $idTransferencia, 'id_estado' => 1])->with('documento')->get();

            if ($documentos->isEmpty()) {
                return Responses::success('200', 'Consulta realizada', 'No se encontraron documentos para la transferencia especificada', 'success');
            }

            $data = new DocumentosTransferenciasResource($documentos);

            return Responses::success('200', 'Consulta realizada', 'Consulta realizada con exito', 'success', $data);

        } catch (\Exception $e) {
            return Responses::error('500', 'Error en la consulta', 'Error al realizar la consulta', $e->getMessage());
        }


        return response()->json($documentos);
    }
}

