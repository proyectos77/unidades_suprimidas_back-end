<?php

namespace App\Http\Requests\SolicitudTransferencia_request;

use App\Http\Responses\Responses;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class actualizarSolicitudRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'usuarioAprobo'     => 'required|integer',
            'fechaFin'          => 'required|date',
            'Observacion'       => 'required|string',
            'estado'            => 'required|integer'
        ];

    }

    protected function prepareForValidation()
    {
        $this->merge([
            'id_usuario_revisor_solicitud_transferencia'    => $this->usuarioAprobo,
            'fecha_fin_solicitud_transferencia'             => $this->fechaFin,
            'observacion_solicitud_transferencia'           => $this->Observacion,
            'estado_solicitud_transferencia'                => $this->estado,
        ]);
    }

     public function messages()
    {
        return [
            'usuarioAprobo.integer'         => 'El atributo usuario  acepta solo numeros',
            'usuarioAprobo.required'        => 'El atributo usuario es requerido',

            'fechaFin.date'                 => 'El atributo fecha no tiene el formato correcto',
            'fechaFin.required'             => 'El atributo fecha es requerido',

            'estado.number'                 => 'El atributo estado  solo acepta numeros',
            'estado.required'               => 'El atributo estado es requerido',

            'Observacion.string'            => 'El atributo observacion  solo acepta texto',
            'Observacion.required'          => 'El atributo observacion es requerido',
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
