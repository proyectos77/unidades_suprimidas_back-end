<?php

namespace App\Services\Unidades_services;

use App\Http\Responses\Responses;
use App\Models\Unidades\UnidadesModel;

class getRutaUnidadActivaService
{
    public function getRuta($idUnidad)
    {
        try {
            $unidad = UnidadesModel::find($idUnidad);

            if (!$unidad) {
                return Responses::warning(404,'No encontrada','La unidad especificada no existe',[]);
            }

            $ruta = [];

            while ($unidad) {
                $ruta[] = ['id_unidad' => $unidad->id_unidad,'nombre_unidad' => $unidad->nombre_unidad,'sigla_unidad' => $unidad->sigla_unidad,];

                $unidad = $unidad->padre;
            }

            $ruta = array_reverse($ruta);

            $rutaTexto = implode(' / ', array_column($ruta, 'nombre_unidad'));

            return Responses::success(200,'Consulta realizada con éxito','Ruta generada correctamente','success',$rutaTexto
            );

        } catch (\Exception $e) {
            return Responses::error(
                500,
                'Error al generar ruta',
                'No se pudo construir la ruta jerárquica',
                $e->getMessage()
            );
        }
    }
}
