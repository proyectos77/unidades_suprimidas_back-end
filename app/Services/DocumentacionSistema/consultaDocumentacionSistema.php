<?php

    namespace App\Services\DocumentacionSistema;

use App\Helpers\generalHelper;
use App\Http\Resources\DocumentacionSistema\DocumentacionSistemaResource;
use App\Http\Responses\Responses;
use App\Models\DocumentosSistema\DocumentosSistemasModel;

    class consultaDocumentacionSistema{

        /**
         * Listado paginado de toda la documentación (activa e inactiva) para la administración.
         */
        public function consultaDocumentacionSistema(){

            try {
                $documentacion = DocumentosSistemasModel::with('estados', 'tipoDocumentacionSistema')
                    ->orderBy('id_documento_sistema', 'desc')
                    ->paginate(10);
                $dataPaginacion = generalHelper::infoPagination(
                    $documentacion->total(),
                    $documentacion->perPage(),
                    $documentacion->currentPage(),
                    $documentacion->lastPage(),
                );

                $data = new DocumentacionSistemaResource($documentacion);
                return Responses::successListado(200, 'Consulta realizada', 'La consulta se ha realizado con exito', $data, $dataPaginacion);

            } catch (\Exception $e) {
                return Responses::error(500, 'Error consulta', 'Error al realizar la consulta.', $e->getMessage());
            }

        }

        /**
         * Listado completo de la documentación activa, usado por la biblioteca de manuales.
         */
        public function consultaDocumentacionActiva(){

            try {
                $documentacion = DocumentosSistemasModel::with('estados', 'tipoDocumentacionSistema')
                    ->where('id_estado', 1)
                    ->orderBy('nombre_documento_sistema')
                    ->get();

                $data = new DocumentacionSistemaResource($documentacion);
                return Responses::success(200, 'Consulta realizada', 'La consulta se ha realizado con exito', 'success', $data);

            } catch (\Exception $e) {
                return Responses::error(500, 'Error consulta', 'Error al realizar la consulta.', $e->getMessage());
            }

        }
    }

