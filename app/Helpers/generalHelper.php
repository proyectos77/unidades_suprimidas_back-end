<?php

    namespace App\Helpers;

    class generalHelper
    {
        public static function infoPagination($totalRegistros, $totalRegistrosPorPagina, $pagina, $totalPaginas) {

            /* $totalPaginas = ceil($totalRegistros / $totalRegistrosPorPagina); */

            return [
                "pagina" => $pagina,
                "totalRegistro" => $totalRegistros,
                "totalRegistrosPorPagina" => $totalRegistrosPorPagina,
                "totalPaginas" => $totalPaginas
            ];
        }
    }
