<?php

    namespace App\Services\Utilidades_services;

use App\Helpers\generalHelper;
use App\Http\Responses\Responses;

    class listAniosServices
    {
        public function getListAnios() {

            return Responses::respuestaListadoUnCampo(200, generalHelper::listAnios());
        }
    }
