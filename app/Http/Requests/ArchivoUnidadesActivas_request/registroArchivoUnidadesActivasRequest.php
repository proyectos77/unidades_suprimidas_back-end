<?php

namespace App\Http\Requests\ArchivoUnidadesActivas_request;

use App\Http\Responses\Responses;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class registroArchivoUnidadesActivasRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_unidad'     => 'required|integer',
            'ubicacion'     => 'required|string',
            'direccion'     => 'required|string',
            'edificio'      => 'required|string',
            'piso'          => 'required|string',
            'bodega'        => 'required|string',

        ];
    }

    protected function prepareForValidation()
    {
       $this->merge([
            'id_unidad'                         => $this->id_unidad,
            'ubicacion_archivo_unidad_activa'   => $this->ubicacion,
            'direccion_archivo_unidad_activa'   => $this->direccion,
            'edificio_archivo_unidad_activa'    => $this->edificio,
            'piso_archivo_unidad_activa'        => $this->piso,
            'bodega_archivo_unidad_activa'      => $this->bodega,
        ]);
    }

    public function messages()
    {
        return [
            'id_unidad.required'    => 'El atributo unidad es requerido',
            'ubicacion.required'    => 'El atributo ubicacion es requerido',
            'direccion.required'    => 'El atributo direccion es requerido',
            'edificio.required'     => 'El atributo edificio es requerido',
            'piso.required'         => 'El atributo piso es requerido',
            'bodega.required'       => 'El atributo bodega es requerido',

        ];
    }

    public function failedValidation(Validator $validator)
    {
        $errores = $validator->errors()->all();
        $erroresTexto = implode(', ', $errores);
        $response = Responses::warning(422, 'Error de validaciones', $erroresTexto,  $validator->errors());

        throw new HttpResponseException($response);
    }
}
