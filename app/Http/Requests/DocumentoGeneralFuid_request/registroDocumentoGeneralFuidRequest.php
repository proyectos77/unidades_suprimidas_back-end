<?php

namespace App\Http\Requests\DocumentoGeneralFuid_request;

use App\Http\Responses\Responses;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class registroDocumentoGeneralFuidRequest extends FormRequest
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
            'id_caja_unidad_activa'      => 'required|integer|exists:cajas_unidad_activas,id_caja_unidad_activa',
            'nombre_documento_general'   => 'required|string',
            'url_documento'              => 'nullable|string',
            'archivo_documento'          => 'nullable|file|max:10240',
            'id_estado'                  => 'sometimes|numeric',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'id_caja_unidad_activa'      => $this->id_caja_unidad_activa,
            'nombre_documento_general'   => $this->nombre_documento_general,
            'url_documento'              => $this->url_documento ?? null,
            'id_estado'                  => $this->id_estado ?? 1,
        ]);
    }

    public function messages()
    {
        return [
            'id_caja_unidad_activa.required'    => 'La caja a la que pertenece el documento es requerida',
            'id_caja_unidad_activa.integer'     => 'El identificador de la caja debe ser numérico',
            'id_caja_unidad_activa.exists'      => 'La caja seleccionada no existe',

            'nombre_documento_general.required' => 'El nombre del documento general es requerido',
            'nombre_documento_general.string'   => 'El nombre del documento general debe ser texto',

            'archivo_documento.file'            => 'El archivo debe ser un archivo válido',
            'archivo_documento.max'             => 'El archivo no debe exceder 10 MB',
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
