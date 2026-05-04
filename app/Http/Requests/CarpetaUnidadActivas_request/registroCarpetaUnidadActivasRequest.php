<?php

namespace App\Http\Requests\CarpetaUnidadActivas_request;

use App\Http\Responses\Responses;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class registroCarpetaUnidadActivasRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'carpetas'                                     => 'required|array|min:1',
            'carpetas.*.cajaUnidadActiva'                  => 'required|integer',
            'carpetas.*.serie'                             => 'required|integer',
            'carpetas.*.subserie'                          => 'nullable|integer',
            'carpetas.*.numeroCarpeta'                     => 'required|string',
            'carpetas.*.fechaExtremaInicio'                => 'required|date',
            'carpetas.*.fechaExtremaFin'                   => 'required|date',
            'carpetas.*.cantidadFolios'                    => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'carpetas.required'                                            => 'El atributo carpetas es requerido',
            'carpetas.array'                                               => 'El atributo carpetas debe ser un arreglo',
            'carpetas.min'                                                 => 'Debe enviar al menos una carpeta',
            'carpetas.*.cajaUnidadActiva.required'                          => 'El atributo caja unidad activa es requerido en cada carpeta',
            'carpetas.*.serie.required'                                    => 'El atributo serie es requerido en cada carpeta',
            'carpetas.*.subserie.integer'                                  => 'El atributo subserie debe ser un número entero',
            'carpetas.*.numeroCarpeta.required'                            => 'El atributo número de carpeta es requerido en cada carpeta',
            'carpetas.*.fechaExtremaInicio.required'                       => 'El atributo fecha extrema inicio es requerido en cada carpeta',
            'carpetas.*.fechaExtremaInicio.date'                           => 'El atributo fecha extrema inicio debe ser una fecha válida',
            'carpetas.*.fechaExtremaFin.required'                          => 'El atributo fecha extrema fin es requerido en cada carpeta',
            'carpetas.*.fechaExtremaFin.date'                              => 'El atributo fecha extrema fin debe ser una fecha válida',
            'carpetas.*.cantidadFolios.required'                           => 'El atributo cantidad de folios es requerido en cada carpeta',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $errores = $validator->errors()->all();
        $erroresTexto = implode(', ', $errores);
        $response = Responses::warning(422, 'Error de validaciones', $erroresTexto, $validator->errors());

        throw new HttpResponseException($response);
    }
}
