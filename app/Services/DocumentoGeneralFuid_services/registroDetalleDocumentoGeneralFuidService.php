<?php

namespace App\Services\DocumentoGeneralFuid_services;

use App\Http\Resources\DocumentoGeneralFuid\registroDetalleDocumentoGeneralFuidResource;
use App\Http\Responses\Responses;
use App\Models\DocumentoGeneralFuid\DetalleDocumentoGeneralFuidModel;
use App\Models\DocumentoGeneralFuid\DocumentoGeneralFuidModel;
use App\Models\CarpetaUnidadActiva\CarpetaUnidadActivaModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\HttpException;

class registroDetalleDocumentoGeneralFuidService
{
    public function listarDetalles(){
        try {
            $detalles = DetalleDocumentoGeneralFuidModel::with(['carpetaUnidadActiva', 'estados'])->get();

            return Responses::success(200, 'Listado de detalles', 'Se obtuvo la lista de detalles del documento general FUID', 'success', registroDetalleDocumentoGeneralFuidResource::collection($detalles));
        } catch (\Exception $e) {
            return Responses::error(500, 'Error al obtener detalles', 'Por favor intente más tarde', $e->getMessage());
        }
    }

    public function registroDetalleDocumentoGeneralFuid($request){
        DB::beginTransaction();
        try {
            $this->validarCarpetaPerteneceACaja($request->id_documento_general, $request->id_carpeta_unidad_activa);

            $detalle = DetalleDocumentoGeneralFuidModel::create($request->all());
            $detalle->load('carpetaUnidadActiva');
            DB::commit();
            return Responses::success(200, 'Registro realizado', 'Se realizó el registro del detalle del documento general FUID correctamente', 'success', new registroDetalleDocumentoGeneralFuidResource($detalle));
        } catch (HttpException $e) {
            DB::rollBack();
            return Responses::error($e->getStatusCode(), 'Error de validación', $e->getMessage(), null);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error registrando detalle documento general FUID: ' . $e->getMessage(), [
                'payload' => $request->all(),
                'exception' => $e,
            ]);
            return Responses::error(500, 'Error de registros', 'Por favor intente más tarde', $e->getMessage());
        }
    }

    protected function validarCarpetaPerteneceACaja($idDocumentoGeneral, $idCarpeta){
        $documento = DocumentoGeneralFuidModel::find($idDocumentoGeneral);
        if (!$documento) {
            throw new HttpException(422, "El documento general FUID con id {$idDocumentoGeneral} no existe.");
        }

        $carpeta = CarpetaUnidadActivaModel::find($idCarpeta);
        if (!$carpeta) {
            throw new HttpException(422, "La carpeta con id {$idCarpeta} no existe.");
        }

        if ((int) $carpeta->id_caja_unidad_activa !== (int) $documento->id_caja_unidad_activa) {
            throw new HttpException(422, 'La carpeta seleccionada no pertenece a la caja del documento general FUID.');
        }
    }

    public function obtenerDetalle($id){
        try {
            $detalle = DetalleDocumentoGeneralFuidModel::with(['carpetaUnidadActiva', 'estados'])->findOrFail($id);
            return Responses::success(200, 'Detalle obtenido', 'Se obtuvo el detalle del documento general FUID correctamente', 'success', new registroDetalleDocumentoGeneralFuidResource($detalle));
        } catch (\Exception $e) {
            return Responses::error(500, 'Error al obtener el detalle', 'Por favor intente más tarde', $e->getMessage());
        }
    }

    public function actualizarDetalle($id, $request){
        DB::beginTransaction();
        try {
            $detalle = DetalleDocumentoGeneralFuidModel::findOrFail($id);
            $detalle->update($request->all());
            $detalle->load('carpetaUnidadActiva');
            DB::commit();
            return Responses::success(200, 'Actualización realizada', 'Se actualizó el detalle del documento general FUID correctamente', 'success', new registroDetalleDocumentoGeneralFuidResource($detalle));
        } catch (HttpException $e) {
            DB::rollBack();
            return Responses::error($e->getStatusCode(), 'Error de validación', $e->getMessage(), null);
        } catch (\Exception $e) {
            DB::rollBack();
            return Responses::error(500, 'Error de actualización', 'Por favor intente más tarde', $e->getMessage());
        }
    }

    public function eliminarDetalle($id){
        try {
            $detalle = DetalleDocumentoGeneralFuidModel::findOrFail($id);
            $detalle->delete();
            return Responses::success(200, 'Eliminación realizada', 'Se eliminó el detalle del documento general FUID correctamente', 'success', null);
        } catch (\Exception $e) {
            return Responses::error(500, 'Error al eliminar', 'Por favor intente más tarde', $e->getMessage());
        }
    }

    public function detallesPorDocumento($idDocumentoGeneral){
        try {
            $detalles = DetalleDocumentoGeneralFuidModel::with('carpetaUnidadActiva')
                ->where('id_documento_general', $idDocumentoGeneral)
                ->get();

            return Responses::success(
                200,
                'Listado de detalles',
                'Se obtuvo la lista de detalles del documento general FUID',
                'success',
                registroDetalleDocumentoGeneralFuidResource::collection($detalles)
            );
        } catch (\Exception $e) {
            return Responses::error(500, 'Error al obtener detalles', 'Error al obtener los detalles del documento', $e->getMessage());
        }
    }

    public function detallesPorCarpeta($idCarpeta){
        try {
            $detalles = DetalleDocumentoGeneralFuidModel::with('carpetaUnidadActiva')
                ->where('id_carpeta_unidad_activa', $idCarpeta)
                ->get();

            return Responses::success(
                200,
                'Listado de detalles',
                'Se obtuvo la lista de detalles del documento general FUID de la carpeta',
                'success',
                registroDetalleDocumentoGeneralFuidResource::collection($detalles)
            );
        } catch (\Exception $e) {
            return Responses::error(500, 'Error al obtener detalles', 'Error al obtener los detalles de la carpeta', $e->getMessage());
        }
    }

    public function buscarDetalles($filtros){
        try {
            $query = DetalleDocumentoGeneralFuidModel::with('carpetaUnidadActiva');

            if (!empty($filtros['nombre_serie_subserie_asunto'])) {
                $query->where('nombre_serie_subserie_asunto', 'like', '%' . $filtros['nombre_serie_subserie_asunto'] . '%');
            }

            if (!empty($filtros['numero_orden'])) {
                $query->where('numero_orden', $filtros['numero_orden']);
            }

            if (!empty($filtros['codigo'])) {
                $query->where('codigo', $filtros['codigo']);
            }

            if (!empty($filtros['numero_caja'])) {
                $query->where('numero_caja', 'like', '%' . $filtros['numero_caja'] . '%');
            }

            if (!empty($filtros['numero_carpeta'])) {
                $query->where('numero_carpeta', 'like', '%' . $filtros['numero_carpeta'] . '%');
            }

            if (!empty($filtros['numero_tomo'])) {
                $query->where('numero_tomo', 'like', '%' . $filtros['numero_tomo'] . '%');
            }

            if (!empty($filtros['numero_soporte'])) {
                $query->where('numero_soporte', 'like', '%' . $filtros['numero_soporte'] . '%');
            }

            if (!empty($filtros['notas'])) {
                $query->where('notas', 'like', '%' . $filtros['notas'] . '%');
            }

            if (!empty($filtros['id_documento_general'])) {
                $query->where('id_documento_general', $filtros['id_documento_general']);
            }

            if (!empty($filtros['id_carpeta_unidad_activa'])) {
                $query->where('id_carpeta_unidad_activa', $filtros['id_carpeta_unidad_activa']);
            }

            if (!empty($filtros['fecha_extrema_inicio'])) {
                $query->whereDate('fecha_extrema_inicio', '>=', $filtros['fecha_extrema_inicio']);
            }

            if (!empty($filtros['fecha_extrema_fin'])) {
                $query->whereDate('fecha_extrema_fin', '<=', $filtros['fecha_extrema_fin']);
            }

            $detalles = $query->get();

            return Responses::success(
                200,
                'Resultados de búsqueda',
                'Se obtuvieron los detalles que coinciden con la búsqueda',
                'success',
                registroDetalleDocumentoGeneralFuidResource::collection($detalles)
            );
        } catch (\Exception $e) {
            return Responses::error(500, 'Error en la búsqueda', 'Ocurrió un error al buscar los detalles', $e->getMessage());
        }
    }
}
