<?php

namespace App\Http\Requests\CajaUnidadActivas_request;

use App\Http\Responses\Responses;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class registroCajaUnidadActivasRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cajas'                                     => 'required|array|min:1',
            'cajas.*.archivoUnidadActiva'               => 'required|integer',
            'cajas.*.baldas'                            => 'required|integer',
            'cajas.*.codigoCaja'                        => 'required|string',
            'cajas.*.numeroConsecutivoBodega'           => 'required|string',
            'cajas.*.numeroCorrelativoDependencia'      => 'required|string',
            'cajas.*.anio'                              => 'required|string',
            'cajas.*.libros'                            => 'required|string',
            'cajas.*.carpetas'                          => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'cajas.required'                                            => 'El atributo cajas es requerido',
            'cajas.array'                                               => 'El atributo cajas debe ser un arreglo',
            'cajas.min'                                                 => 'Debe enviar al menos una caja',
            'cajas.*.archivoUnidadActiva.required'                      => 'El atributo archivo de unidad activa es requerido en cada caja',
            'cajas.*.baldas.required'                                   => 'El atributo balda es requerido en cada caja',
            'cajas.*.codigoCaja.required'                               => 'El atributo código de caja es requerido en cada caja',
            'cajas.*.numeroConsecutivoBodega.required'                  => 'El atributo número consecutivo bodega es requerido en cada caja',
            'cajas.*.numeroCorrelativoDependencia.required'             => 'El atributo número correlativo dependencia es requerido en cada caja',
            'cajas.*.anio.required'                                     => 'El atributo año es requerido en cada caja',
            'cajas.*.libros.required'                                   => 'El atributo cantidad de libros es requerido en cada caja',
            'cajas.*.carpetas.required'                                 => 'El atributo cantidad de carpetas es requerido en cada caja',
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
