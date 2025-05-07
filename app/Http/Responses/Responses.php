<?php

    namespace App\Http\Responses;


    class Responses
    {
        static function success($statusCode, $titulo, $mensaje, $icono, $data = []){
            $respuesta = [
                'statusCode'    => $statusCode,
                'titulo'        => $titulo,
                'mensaje'       => $mensaje,
                'icono'         => $icono,
                'data'          => $data
            ];

            return response()->json($respuesta, $statusCode);
        }

        static function error($statusCode, $titulo, $mensaje, $error ){
            $respuesta = [
                'statusCode'    => $statusCode,
                'titulo'        => $titulo,
                'mensaje'       => $mensaje,
                'icono'         => 'error',
                'data'          => $error
            ];

            return response()->json($respuesta, $statusCode);
        }

        static function warning($statusCode, $titulo, $mensaje,  $data = []) {
            $respuesta = [
                'statusCode'    => $statusCode,
                'titulo'        => $titulo,
                'mensaje'       => $mensaje,
                'icono'         => 'warning',
                'data'          => $data
            ];

            return response()->json($respuesta);
        }

        static function successSesion($statusCode, $titulo, $icono, $data, $token){
            $respuesta = [
                'statusCode'    => $statusCode,
                'titulo'        => $titulo,
                'icono'         => $icono,
                'data'          => $data
            ];

            return response()->json($respuesta, $statusCode);
        }

        static function successListado($statusCode, $titulo, $mensaje, $data, $infoPagination){
            $respuesta = [
                'statusCode'        => $statusCode,
                'titulo'            => $titulo,
                'mensaje'           => $mensaje,
                'icono'             => 'success',
                'data'              => $data,
                'infoPagination'   => $infoPagination
            ];

            return response()->json($respuesta, $statusCode);
        }

        static function respuestaListadoUnCampo($statusCode, $data = []){
            $respuesta = [
                'statusCode'    => $statusCode,
                'data'          => $data
            ];

            return response()->json($respuesta, $statusCode);
        }
    }
