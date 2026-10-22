<?php

    namespace App\Services\DocumentacionSistema;

use App\Helpers\generalHelper;
use App\Http\Resources\DocumentacionSistema\DocumentacionSistemaResource;
use App\Http\Responses\Responses;
use App\Models\DocumentosSistema\DocumentosSistemasModel;

    class consultaDocumentacionSistema{

        public function consultaDocumentacionSistema(){

            try {
                $documentacion = DocumentosSistemasModel::with('estados', 'tipoDocumentacionSistema')->paginate(10);
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
    }

