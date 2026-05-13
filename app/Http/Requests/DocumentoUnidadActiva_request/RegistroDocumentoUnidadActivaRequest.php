<?php

namespace App\Http\Requests\DocumentoUnidadActiva_request;

use Illuminate\Foundation\Http\FormRequest;

class RegistroDocumentoUnidadActivaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'documentos' => 'nullable|array',
            'documentos.*.carpetaUnidadActiva' => 'nullable|integer',
            'documentos.*.numeroRadicado' => 'nullable|string',
            'documentos.*.fechaElaboracion' => 'nullable|date',
            'documentos.*.unidad' => 'nullable|integer',
            'documentos.*.nombreFuncionarioDestino' => 'nullable|string',
            'documentos.*.asunto' => 'nullable|string',
            'documentos.*.nombreQuienFirma' => 'nullable|string',
            'documentos.*.cargoQuienFirma' => 'nullable|string',
            'documentos.*.tipoSoporte' => 'nullable|string',
            'documentos.*.cantidadFolios' => 'nullable|integer',
            'documentos.*.tipoDocumental' => 'nullable|string',
            'documentos.*.observaciones' => 'nullable|string',
            'documentos.*.estado' => 'nullable|integer',

            'carpetaUnidadActiva' => 'nullable|integer',
            'numeroRadicado' => 'nullable|string',
            'fechaElaboracion' => 'nullable|date',
            'unidad' => 'nullable|integer',
            'nombreFuncionarioDestino' => 'nullable|string',
            'asunto' => 'nullable|string',
            'nombreQuienFirma' => 'nullable|string',
            'cargoQuienFirma' => 'nullable|string',
            'tipoSoporte' => 'nullable|string',
            'cantidadFolios' => 'nullable|integer',
            'tipoDocumental' => 'nullable|string',
            'observaciones' => 'nullable|string',
            'estado' => 'nullable|integer',
        ];
    }
}
