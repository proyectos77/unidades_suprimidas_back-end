<?php

namespace App\Http\Requests\DocumentoGeneralFuid_request;

use App\Http\Responses\Responses;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class registroDetalleDocumentoGeneralFuidRequest extends FormRequest
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
            'id_documento_general'               => 'required|integer|exists:documento_general_fuid,id_documento_general',
            'id_carpeta_unidad_activa'            => 'required|integer|exists:carpetas_unidad_activas,id_carpeta_unidad_activa',
            'numero_orden'                        => 'required|numeric',
            'codigo'                               => 'required|numeric',
            'nombre_serie_subserie_asunto'        => 'required|string',
            'fecha_extrema_inicio'                => 'required|date',
            'fecha_extrema_fin'                   => 'required|date|after_or_equal:fecha_extrema_inicio',
            'numero_caja'                          => 'required|string',
            'numero_carpeta'                       => 'required|string',
            'numero_tomo'                          => 'required|string',
            'numero_otro'                          => 'nullable|string',
            'numero_folios'                        => 'required|string',
            'numero_soporte'                       => 'required|string',
            'numero_frecuencia_consulta'           => 'required|string',
            'notas'                                => 'nullable|string',
            'id_estado'                            => 'sometimes|numeric',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'id_documento_general'          => $this->id_documento_general,
            'id_carpeta_unidad_activa'      => $this->id_carpeta_unidad_activa,
            'numero_orden'                  => $this->numero_orden,
            'codigo'                        => $this->codigo,
            'nombre_serie_subserie_asunto'  => $this->nombre_serie_subserie_asunto,
            'fecha_extrema_inicio'          => $this->fecha_extrema_inicio,
            'fecha_extrema_fin'             => $this->fecha_extrema_fin,
            'numero_caja'                   => $this->numero_caja,
            'numero_carpeta'                => $this->numero_carpeta,
            'numero_tomo'                   => $this->numero_tomo,
            'numero_otro'                   => $this->numero_otro,
            'numero_folios'                 => $this->numero_folios,
            'numero_soporte'                => $this->numero_soporte,
            'numero_frecuencia_consulta'    => $this->numero_frecuencia_consulta,
            'notas'                         => $this->notas,
            'id_estado'                     => $this->id_estado ?? 1,
        ]);
    }

    public function messages()
    {
        return [
            'id_documento_general.required'             => 'El documento general al que pertenece el detalle es requerido',
            'id_documento_general.integer'               => 'El identificador del documento general debe ser numérico',
            'id_documento_general.exists'                => 'El documento general seleccionado no existe',

            'id_carpeta_unidad_activa.required'          => 'La carpeta a la que pertenece el detalle es requerida',
            'id_carpeta_unidad_activa.integer'           => 'El identificador de la carpeta debe ser numérico',
            'id_carpeta_unidad_activa.exists'            => 'La carpeta seleccionada no existe',

            'numero_orden.required'                      => 'El atributo número de orden es requerido',
            'numero_orden.numeric'                       => 'El atributo número de orden solo acepta números',

            'codigo.required'                            => 'El atributo código es requerido',
            'codigo.numeric'                             => 'El atributo código solo acepta números',

            'nombre_serie_subserie_asunto.required'      => 'El atributo nombre de serie/subserie/asunto es requerido',
            'nombre_serie_subserie_asunto.string'        => 'El atributo nombre de serie/subserie/asunto debe ser texto',

            'fecha_extrema_inicio.required'              => 'La fecha extrema de inicio es requerida',
            'fecha_extrema_inicio.date'                  => 'La fecha extrema de inicio debe ser una fecha válida',

            'fecha_extrema_fin.required'                 => 'La fecha extrema de fin es requerida',
            'fecha_extrema_fin.date'                     => 'La fecha extrema de fin debe ser una fecha válida',
            'fecha_extrema_fin.after_or_equal'           => 'La fecha extrema de fin debe ser igual o posterior a la de inicio',

            'numero_caja.required'                       => 'El atributo número de caja es requerido',
            'numero_caja.string'                         => 'El atributo número de caja debe ser texto',

            'numero_carpeta.required'                    => 'El atributo número de carpeta es requerido',
            'numero_carpeta.string'                      => 'El atributo número de carpeta debe ser texto',

            'numero_tomo.required'                       => 'El atributo número de tomo es requerido',
            'numero_tomo.string'                         => 'El atributo número de tomo debe ser texto',

            'numero_folios.required'                     => 'El atributo número de folios es requerido',
            'numero_folios.string'                       => 'El atributo número de folios debe ser texto',

            'numero_soporte.required'                    => 'El atributo número de soporte es requerido',
            'numero_soporte.string'                      => 'El atributo número de soporte debe ser texto',

            'numero_frecuencia_consulta.required'        => 'El atributo número de frecuencia de consulta es requerido',
            'numero_frecuencia_consulta.string'          => 'El atributo número de frecuencia de consulta debe ser texto',
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
