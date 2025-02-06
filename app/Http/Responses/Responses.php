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

        static function error($statusCode, $titulo, $mensaje, $icono, $error ){
            $respuesta = [
                'statusCode'    => $statusCode,
                'titulo'        => $titulo,
                'mensaje'       => $mensaje,
                'icono'         => $icono,
                'data'          => $error
            ];

            return response()->json($respuesta, $statusCode);
        }

        static function warning($statusCode, $titulo, $mensaje, $icono, $data = null) {
            $respuesta = [
                'statusCode'    => $statusCode,
                'titulo'        => $titulo,
                'mensaje'       => $mensaje,
                'icono'         => $icono,
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
    }
