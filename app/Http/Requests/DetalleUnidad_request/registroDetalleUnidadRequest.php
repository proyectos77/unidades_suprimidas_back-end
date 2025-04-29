<?php

namespace App\Http\Requests\DetalleUnidad_request;

use App\Http\Responses\Responses;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class registroDetalleUnidadRequest extends FormRequest
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
            'actoAdministrativoCreacion'        =>  'required|string',
            'actoAdministrativoDesactivacion'   =>  'required|string',
            'fechaCreacionUnidad'               =>  'required|date',
            'fechaDesactivacionUnidad'          =>  'required|date',
            'puestoMandoAdelantado'             =>  'required|string',
            'puestoMandoAtrasado'               =>  'required|string',
            'observacion'                       =>  'required|string',
            'idUnidad'                          =>  'required|numeric|unique:detalle_unidad,id_unidad',
            'numero_cajas'                      => 'required|integer',
            'numero_carpetas'                   => 'required|integer',
            'numero_folio'                      => 'required|integer'
        ];
    }

    protected function prepareForValidation(){
        $this->merge([
            'acto_administrativo_creacion_detalle'      => $this->actoAdministrativoCreacion,
            'acto_administrativo_desactivacion_detalle' =>  $this->actoAdministrativoDesactivacion,
            'fecha_creacion_unidad_detalle'             =>  $this->fechaCreacionUnidad,
            'fecha_desactivacion_unidad_detalle'        =>  $this->fechaDesactivacionUnidad,
            'puesto_mando_adelantado_detalle'           =>  $this->puestoMandoAdelantado,
            'puesto_mando_atrasado_detalle'             =>  $this->puestoMandoAtrasado,
            'observacion_detalle'                       =>  $this->observacion,
            'id_unidad'                                 =>  $this->idUnidad,
            'numero_cajas_archivos'                     => $this->numero_cajas,
            'numero_carpetas_archivo'                   => $this->numero_carpetas,
            'numero_folios_archivo'                     => $this->numero_folio,
        ]);
    }

    public function messages(){
        return [
            'actoAdministrativoCreacion.required'       => 'El atributo acto administrativo creacion es requerido',
            'actoAdministrativoDesactivacion.required'  =>  'El atributo acto administrativo desactivacion es requerido',
            'fechaCreacionUnidad.required'              =>  'El atributo fecha creacion unidad es requerido',
            'fechaCreacionUnidad.date'                  =>  'El atributo fecha creacion unidad espera una fecha',
            'fechaDesactivacionUnidad.required'         =>  'El atributo fecha desactivacion unidad es requerido',
            'fechaDesactivacionUnidad.date'             =>  'El atributo fecha desactivacion unidad espera una fecha',
            'puestoMandoAdelantado.required'            =>  'El atributo puesto de mando adelantado es requerido',
            'puestoMandoAtrasado.required'              =>  'El atributo puesto de mando atrasado es requerido',
            'observacion.required'                      =>  'El atributo observacion es requerido',
            'idUnidad.required'                         =>  'El atributo id unidad es requerido',
            'idUnidad.unique'                           =>  'Ya existe detalle para esta unidad',
            'numero_cajas.integer'                      => 'El atributo numero de cajas  acepta solo numeros',
            'numero_cajas.required'                     => 'El atributo numero de cajas es requerido',

            'numero_carpetas.integer'                   => 'El atributo numero de carpetas solo acepta numeros',
            'numero_carpetas.required'                  => 'El atributo numero de carpetas es requerido',

            'numero_folio.integer'                      => 'El atributo numero de folios  solo acepta numeros',
            'numero_folio.required'                     => 'El atributo numero de folios es requerido',
        ];
    }

    public function failedValidation(Validator $validator){
        $errores = $validator->errors()->all();
        $erroresTexto = implode(', ', $errores);
        $responses = Responses::warning(422, 'Error de validaciones', $erroresTexto, $validator->errors());

        throw new HttpResponseException($responses);
    }
}
