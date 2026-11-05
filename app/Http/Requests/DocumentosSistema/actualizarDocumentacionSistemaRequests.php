<?php

namespace App\Http\Requests\DocumentosSistema;

use App\Http\Responses\Responses;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class actualizarDocumentacionSistemaRequests extends FormRequest
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
     * El archivo es opcional: solo se reemplaza si se envía uno nuevo.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombreDocumento' => 'required|string|max:255',
            'tipoDocumento' => 'required|integer|exists:tipos_documentacion_sistema,id_tipo_documentacion_sistema',
            'estado' => 'nullable|integer|in:1,2',
            'archivo' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt,mp4|max:10240',
        ];
    }

    public function messages(): array
    {
        return [
            'nombreDocumento.required' => 'El nombre del documento es obligatorio.',
            'nombreDocumento.string' => 'El nombre del documento debe ser una cadena de texto.',
            'nombreDocumento.max' => 'El nombre del documento no debe exceder los 255 caracteres.',
            'tipoDocumento.required' => 'El tipo de documento es obligatorio.',
            'tipoDocumento.integer' => 'El tipo de documento no es válido.',
            'tipoDocumento.exists' => 'El tipo de documento seleccionado no existe.',
            'estado.in' => 'El estado debe ser Activo o Inactivo.',
            'archivo.file' => 'El archivo debe ser un archivo válido.',
            'archivo.mimes' => 'El archivo debe ser de tipo pdf, doc, docx, xls, xlsx, ppt, pptx, txt o mp4.',
            'archivo.max' => 'El archivo no debe superar los 10 MB.',
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
