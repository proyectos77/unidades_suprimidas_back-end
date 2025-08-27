<?php

namespace App\Http\Requests\Transferencias_request;

use App\Http\Responses\Responses;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class registroTransferenciaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

     public function rules(): array
    {
        return [
            'transferencia.*.id_archivo' => 'required|numeric',

            'detalles' => 'required|array|min:1',
            'detalles.*.seccion'           => 'required|string',
            'detalles.*.serie'             => 'nullable|numeric',
            'detalles.*.subserie'          => 'nullable|numeric',
            'detalles.*.cantidad_cajas'    => 'required|numeric',
            'detalles.*.cantidad_carpetas' => 'required|numeric',
            'detalles.*.cantidad_folios'   => 'required|numeric',
            'detalles.*.cantidad_otros'    => 'nullable|numeric',
            'detalles.*.cantidad_tomos'    => 'nullable|numeric',

            'documentos' => 'required|array|min:1',
            'documentos.*' => 'required|file|mimes:pdf,docx,jpg,png|max:10240',
        ];
    }

    protected function prepareForValidation()
    {
        // Si "detalles" viene como string JSON, lo decodificamos
        if (is_string($this->detalles)) {
            $this->merge([
                'detalles' => json_decode($this->detalles, true),
            ]);
        }
    }

    public function messages()
    {
        return [
            'id_archivo.required' => 'El campo id_archivo es obligatorio.',
            'id_archivo.numeric' => 'El campo id_archivo debe ser numérico.',

            'detalles.required' => 'Debe proporcionar al menos un detalle de transferencia.',
            'detalles.*.seccion.required' => 'Cada detalle debe incluir una sección.',
            'detalles.*.cantidad_cajas.required' => 'Cada detalle debe tener cantidad de cajas.',
            'detalles.*.cantidad_carpetas.required' => 'Cada detalle debe tener cantidad de carpetas.',
            'detalles.*.cantidad_folios.required' => 'Cada detalle debe tener cantidad de folios.',

            'documentos.required' => 'Debe adjuntar al menos un documento.',
            'documentos.*.file' => 'Cada documento debe ser un archivo válido.',
            'documentos.*.mimes' => 'Los documentos deben ser pdf, docx, jpg o png.',
            'documentos.*.max' => 'Cada archivo no debe superar los 10 MB.',
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
