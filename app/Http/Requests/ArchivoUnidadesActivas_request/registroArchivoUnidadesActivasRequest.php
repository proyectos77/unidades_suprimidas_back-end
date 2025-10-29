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
            '*.seccion'         => 'required|string',
            '*.serie'           => 'required|integer',
            '*.subserie'        => 'required|integer',
            '*.cajas'           => 'required|integer',
            '*.carpetas'        => 'required|integer',
            '*.tomos'           => 'nullable|integer',
            '*.folios'          => 'required|integer',
            '*.anioRegistro'    => 'required|integer',
            '*.tipoOtro'        => 'nullable|string',
            '*.descripcionOtro' => 'nullable|string',
            '*.otros'           => 'nullable|integer',
            '*.idUnidad'        => 'required|integer',
        ];
    }

    protected function prepareForValidation()
    {
        $data = $this->all();

        // 🧠 Si el usuario envía un solo objeto, lo convertimos en un array de uno
        if (isset($data['seccion'])) {
            $data = [$data];
        }

        $this->replace($data);
    }

    public function messages()
    {
        return [
            '*.seccion.required' => 'El atributo sección es requerido',
            '*.serie.required' => 'El atributo serie es requerido',
            '*.subserie.required' => 'El atributo subserie es requerido',
            '*.cajas.required' => 'El atributo cajas es requerido',
            '*.carpetas.required' => 'El atributo carpetas es requerido',
            '*.folios.required' => 'El atributo folios es requerido',
            '*.anioRegistro.required' => 'El atributo año de registro es requerido',
            '*.idUnidad.required' => 'El atributo id de unidad es requerido',
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
