<?php

    namespace App\Services\DocumentosTransferencias_services;

    use App\Http\Responses\Responses;
    use App\Models\DocumentoTransferencia\DocumentoTransferenciaModel;

    class updateDocumentoTransferencia
    {
        public function eliminarDocumentoTransferencia($idDocumento){
            try {
                $documento = DocumentoTransferenciaModel::find($idDocumento);
                if (!$documento) {
                    return Responses::error(404, 'No encontrado', 'Documento no encontrado', 'error');
                }
                $documento->update(['id_estado' => 2]);
                return Responses::success(200, 'Eliminado', 'Documento eliminado con éxito', 'success');
            } catch (\Exception $e) {
                return Responses::error(500, 'Error', 'Error al eliminar documento', 'error', $e->getMessage());
            }
        }
    }
