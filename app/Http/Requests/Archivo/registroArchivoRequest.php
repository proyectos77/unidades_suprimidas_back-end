<?php

namespace App\Http\Requests\Archivo;

use App\Http\Responses\Responses;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class registroArchivoRequest extends FormRequest
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
            'numero_cajas'      => 'required|integer',
            'numero_carpetas'   => 'required|unique:unidades,sigla_unidad',
            'numero_folio'      => 'required|integer',
            'id_detalle'        => 'required|integer'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'numero_cajas_archivos'     => $this->numero_cajas,
            'numero_carpetas_archivo'      => $this->numero_carpetas,
            'numero_folios_archivo'      => $this->numero_folio,
        ]);
    }

    public function messages()
    {
        return [
            'numero_cajas.integer'       => 'El atributo numero de cajas  acepta solo numeros',
            'numero_cajas.required'      => 'El atributo numero de cajas es requerido',

            'numero_carpetas.integer'    => 'El atributo numero de carpetas solo acepta numeros',
            'numero_carpetas.required'   => 'El atributo numero de carpetas es requerido',

            'numero_folio.integer'       => 'El atributo numero de folios  solo acepta numeros',
            'numero_folio.required'      => 'El atributo numero de folios es requerido',

            'id_detalle.integer'          => 'El atributo id detalle numeros',
            'id_detalle.required'         => 'El atributo id detalle es requerido',
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
