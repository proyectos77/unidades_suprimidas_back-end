<?php

namespace App\Http\Requests\DocumentosSistema;

use App\Http\Responses\Responses;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class registroDocumentacionSistemaRequests extends FormRequest
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
            'nombreDocumento' => 'required|string|max:255',
            'tipoDocumento' => 'required|string|max:255',
            'archivo' => 'required|file|mimes:pdf,docx,ods',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'nombre_documento_sistema' => $this->nombreDocumento ?? '',
            'id_tipo_documentacion_sistema' => $this->tipoDocumento ?? '',
        ]);
    }

    public function messages(): array
    {
        return [
            'nombreDocumento.required' => 'El nombre del documento es obligatorio.',
            'nombreDocumento.string' => 'El nombre del documento debe ser una cadena de texto.',
            'nombreDocumento.max' => 'El nombre del documento no debe exceder los 255 caracteres.',
            'tipoDocumento.required' => 'El tipo de documento es obligatorio.',
            'tipoDocumento.string' => 'El tipo de documento debe ser una cadena de texto.',
            'tipoDocumento.max' => 'El tipo de documento no debe exceder los 255 caracteres.',
            'archivo.required' => 'El archivo es obligatorio.',
            'archivo.file' => 'El archivo debe ser un archivo válido.',
            'archivo.mimes' => 'El archivo debe ser de tipo pdf, docx u ods.',
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
