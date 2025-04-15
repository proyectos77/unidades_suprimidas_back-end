<?php

    namespace App\Services\TiposUsuarios_services;

use App\Http\Resources\TipoUsuarios\listadoTipoUsuariosResource;
use App\Http\Responses\Responses;
use App\Models\TipoUsuario\TipoUsuarioModell;
use GuzzleHttp\Psr7\Response;

    class listaTiposUsuarios
    {
        public function listadoTipoUsuarios() {

            try {
                $tipoUsuarios = TipoUsuarioModell::all();

                if ($tipoUsuarios->isEmpty()) {
                    return Responses::success('200', 'Sin resultados', 'No se encontraron resultados', 'success');
                }

                $data = new listadoTipoUsuariosResource($tipoUsuarios);
                return Responses::success(200, 'Consulta realizada', 'La consulta se ha realizado con exito', 'success', $data);

            } catch (\Exception $e) {
                return Responses::error(500, 'Error de consulta', 'Error al realizar la consulta', $e->getMessage());
            }
        }
    }
