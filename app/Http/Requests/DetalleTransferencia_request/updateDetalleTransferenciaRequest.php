<?php

namespace App\Http\Requests\DetalleTransferencia_request;

use App\Http\Responses\Responses;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class updateDetalleTransferenciaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {
        $metodo = $this->method();
        if ($metodo == 'PATCH') {
            return [
                'estado' => 'required|integer',
                'seccion' => 'sometimes|string',
                'serie' => 'sometimes|string',
                'subserie' => 'sometimes|string',
                'cajas' => 'sometimes|integer',
                'carpetas' => 'sometimes|integer',
                'otros' => 'sometimes|integer',
                'folios' => 'sometimes|integer',
            ];
        } elseif ($metodo == 'PUT') {
            return [
                'seccion'       => 'required|string',
                'serie'         => 'required|integer',
                'subserie'      => 'required|integer',
                'cajas'         => 'required|integer',
                'carpetas'      => 'required|integer',
                'otros'         => 'required|integer',
                'folios'        => 'required|integer',
                'estado'        => 'sometimes|integer',
            ];
        }
        return [];
    }

    protected function prepareForValidation()
    {
        $data = [
            'seccion_detalle_transferencia'             => $this->seccion ?? null,
            'id_serie'               => $this->serie ?? null,
            'id_subserie'            => $this->subserie ?? null,
            'cantidad_cajas_detalle_transferencia'      => $this->cajas ?? null,
            'cantidad_carpetas_detalle_transferencia'   => $this->carpetas ?? null,
            'cantidad_otros_detalle_transferencia'      => $this->otros ?? null,
            'cantidad_folios_detalle_transferencia'     => $this->folios ?? null,
            'id_estado'                                 => $this->estado ?? null
        ];

        $this->merge(array_filter($data, function ($value) {
            return !is_null($value);
        }));
    }

     public function messages()
    {
        return [
            'seccion.string'       => 'El atributo seccion solo acepta texto',
            'seccion.required'      => 'El atributo seccion es requerido',

            'serie.string'          => 'El atributo serie solo acepta texto',
            'serie.required'        => 'El atributo serie es requerido',

            'subserie.string'      => 'El atributo subserie solo acepta texto',
            'subserie.required'     => 'El atributo subserie es requerido',

            'cajas.integer'         => 'El atributo cajas acepta solo numeros',
            'cajas.required'        => 'El atributo cajas es requerido',

            'carpetas.integer'      => 'El atributo carpetas acepta solo numeros',
            'carpetas.required'     => 'El atributo carpetas es requerido',

            'otros.integer'         => 'El atributo otros acepta solo numeros',
            'otros.required'        => 'El atributo otros es requerido',

            'folios.integer'        => 'El atributo folios acepta solo numeros',
            'folios.required'       => 'El atributo folios es requerido',
        ];
    }

    //Funcion para tomar los errores y retornarlos de la manera general del back en todo el aplicativo.
    public function failedValidation(Validator $validator) {

        $errores = $validator->errors()->all();
        $erroresTexto = implode(', ', $errores);
        $response = Responses::warning(422, 'Error de validaciones', $erroresTexto,  $validator->errors());

        throw new HttpResponseException($response);
    }
}
