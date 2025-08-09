<?php

    namespace App\Services\Dependencia_services;

    use App\Http\Resources\Dependencias\DependenciasHijasResource;
    use App\Http\Responses\Responses;
    use App\Models\Denpendencias\Dependencias;

    class listadoDependenciasHijasServices
    {
        public function getListadoDependenciasHijas($idPadre){
            try {
                $dependenciasHijas = Dependencias::where('padre_dependencia', $idPadre)->get();

                if ($dependenciasHijas->isEmpty()) {
                    return Responses::success(200, 'Listado de dependencias hijas', 'No se encontraron dependencias hijas para la dependencia especificada.', 'success', []);
                }

                $data = new DependenciasHijasResource($dependenciasHijas);

                return Responses::success(200, 'Listado de dependencias hijas', 'Dependencias obtenidas correctamente', 'success', $data);

            } catch (\Exception $e) {
                return Responses::error(500, 'Error al obtener el listado de dependencias hijas', 'Error interno del servidor', 'error', $e->getMessage());
            }
        }
    }
