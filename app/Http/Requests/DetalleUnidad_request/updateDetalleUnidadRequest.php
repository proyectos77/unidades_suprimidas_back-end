<?php

namespace App\Http\Requests\DetalleUnidad_request;

use App\Http\Responses\Responses;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class updateDetalleUnidadRequest extends FormRequest
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


        $id = request()->route('usuario'); // Capturar el ID de la ruta
        /* dd($id); */

        $method = $this->method();

        if ($method === 'PUT') {
            return [
                'actoAdministrativoCreacion'        => 'required|string',
                'actoAdministrativoDesactivacion'   => 'required|string',
                'fechaCreacionUnidad'               => 'required|date',
                'fechaDesactivacionUnidad'          => 'required|date',
                'puestoMandoAdelantado'             => 'required|string',
                'puestoMandoAtrasado'               => 'required|string',
                'observacion'                       => 'required|string',
            ];
        }elseif ($method === 'PATCH') {
            return [
                'actoAdministrativoCreacion'         => 'sometimes|string',
                'actoAdministrativoDesactivacion'    => 'sometimes|string',
                'fechaCreacionUnidad'                => 'sometimes|date',
                'fechaDesactivacionUnidad'           => 'sometimes|date',
                'puestoMandoAdelantado'              => 'sometimes|string',
                'puestoMandoAtrasado'                => 'sometimes|string',
                'observacion'                        => 'sometimes|string',
            ];
        }
    }

    protected function prepareForValidation()
    {
        $data = [
            'acto_administrativo_creacion_detalle' => $this->actoAdministrativoCreacion ?? null,
            'acto_administrativo_desactivacion_detalle' => $this->actoAdministrativoDesactivacion ?? null,
            'fecha_creacion_unidad_detalle' => $this->fechaCreacionUnidad ?? null,
            'fecha_desactivacion_unidad_detalle' => $this->fechaDesactivacionUnidad ?? null,
            'puesto_mando_adelantado_detalle' => $this->puestoMandoAdelantado ?? null,
            'puesto_mando_atrasado_detalle' => $this->puestoMandoAtrasado ?? null,
            'observacion_detalle' => $this->observacion ?? null
        ];

        $this->merge(array_filter($data, function ($value) {
            return !is_null($value);
        }));
    }

    public function messages()
    {
        return [
            'actoAdministrativoCreacion.string'                 => 'El atributo acto administrativo creacion solo acepta letras',
            'actoAdministrativoCreacion.required'               => 'El atributo acto administrativo creacion es requerido',

            'actoAdministrativoDesactivacion.numeric'           => 'El atributo acto administrativo desactivacion solo acepta números',
            'actoAdministrativoDesactivacion.required'          => 'El atributo acto administrativo desactivacion es requerido',

            'fechaCreacionUnidad.required'                      => 'El atributo fecha creacion unidad es requerido',
            'fechaCreacionUnidad.date'                          => 'El atributo fehca creacion no tiene un formato de fecha valido',

            'fechaDesactivacionUnidad.required'                 => 'El atributo fecha desactivacion unidad es requerido',
            'fechaDesactivacionUnidad.date'                     => 'El atributo fehca desactivacion no tiene un formato de fecha valido',

            'puestoMandoAdelantado.string'                      => 'El atributo puesto de m ando adelantado solo acepta letras',
            'puestoMandoAdelantado.required'                    => 'El atributo puesto de m ando adelantado es requerido',

            'puestoMandoAtrasado.string'                        => 'El atributo puesto de m ando atrasado solo acepta letras',
            'puestoMandoAtrasado.required'                      => 'El atributo puesto de m ando atrasado es requerido',

            'observacion.string'                                => 'El atributo observacion solo acepta letras',
            'observacion.required'                              => 'El atributo observacion es requerido',
        ];
    }

    public function failedValidation(Validator $validator) {

        $errores = $validator->errors()->all();
        $erroresTexto = implode(', ', $errores);
        $response = Responses::warning(422, 'Error de validaciones', $erroresTexto,  $validator->errors());

        throw new HttpResponseException($response);
    }
}
