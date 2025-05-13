<?php

namespace App\Http\Requests\Transferencias;

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
            'cantidad_cajas'      => 'required|numeric',
            'cantidad_carpetas'   => 'required|numeric',
            'cantidad_folios'     => 'required|numeric',
            'id_archivo'          => 'required|numeric',
            'documentos'          => 'required|array',
            'documentos.*'        => 'required|file|mimes:pdf,docx,jpg,png|max:10240' // máximo 10MB
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'cantidad_cajas_transferencia'      => $this->cantidad_cajas,
            'cantidad_carpetas_transferencia'   => $this->cantidad_carpetas,
            'cantidad_folios_transferencia'     => $this->cantidad_folios,
            'id_archivo'                        => $this->id_archivo,
            'documentos'                        => $this->documentos,

        ]);
    }

    public function messages()
    {
        return [
            'cantidad_cajas.required'      => 'El atributo cantidad_cajas es requerido',
            'cantidad_cajas.numeric'       => 'El atributo cantidad_cajas solo acepta números',

            'cantidad_carpetas.required'   => 'El atributo cantidad_carpetas es requerido',
            'cantidad_carpetas.numeric'    => 'El atributo cantidad_carpetas solo acepta números',

            'cantidad_folios.required'     => 'El atributo cantidad_folios es requerido',
            'cantidad_folios.numeric'      => 'El atributo cantidad_folios solo acepta números',

            'id_archivo.required'          => 'El atributo id_archivo es requerido',
            'id_archivo.numeric'           => 'El atributo id_archivo solo acepta números',

            'documentos.required'           => 'El atributo documentos es requerido',
        ];
    }

    public function failedValidation(Validator $validator) {

        $errores = $validator->errors()->all();
        $erroresTexto = implode(', ', $errores);
        $response = Responses::warning(422, 'Error de validaciones', $erroresTexto,  $validator->errors());

        throw new HttpResponseException($response);
    }
}
