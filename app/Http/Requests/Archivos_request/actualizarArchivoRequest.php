<?php

namespace App\Http\Requests\Archivos_request;

use App\Http\Responses\Responses;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class actualizarArchivoRequest extends FormRequest
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
         $id = request()->route('registroArchivo'); // Capturar el ID de la ruta
        /* dd($id); */

        $method = $this->method();

        if ($method === 'PUT') {
            return [
                'cajas'     => 'required|numeric',
                'carpetas'  => 'required|numeric',
                'folios'    => 'required|numeric',
                'otros'     => 'required|numeric',
                'tomos'     => 'required|numeric',
            ];
        }elseif ($method === 'PATCH') {
            return [
                'cajas'     => 'sometimes|numeric',
                'carpetas'  => 'sometimes|numeric',
                'folios'    => 'sometimes|numeric',
                'otros'     => 'sometimes|numeric',
                'tomos'     => 'sometimes|numeric',
            ];
        }
    }

    protected function prepareForValidation()
    {
        if($this->cajas) $this->merge(['numero_cajas_archivos' => $this->cajas]);
        if($this->carpetas) $this->merge(['numero_carpetas_archivo' => $this->carpetas]);
        if($this->folios) $this->merge(['numero_folios_archivo' => $this->folios]);
        if($this->otros) $this->merge(['numero_otros_archivo' => $this->otros]);
        if($this->tomos) $this->merge(['numero_tomos_archivo' => $this->tomos]);

    }

    public function messages()
    {
        return [
            'cajas.integer'              => 'El atributo numero de cajas  acepta solo numeros',
            'cajas.required'             => 'El atributo numero de cajas es requerido',

            'carpetas.integer'           => 'El atributo numero de carpetas solo acepta numeros',
            'carpetas.required'          => 'El atributo numero de carpetas es requerido',

            'folios.integer'             => 'El atributo numero de folios  solo acepta numeros',
            'folios.required'            => 'El atributo numero de folios es requerido',

            'otros.integer'              => 'El atributo otros solo acepta numeros',
            'otros.required'             => 'El atributo otros es requerido',

            'tomos.integer'              => 'El atributo tomos solo acepta numeros',
            'tomos.required'             => 'El atributo tomos es requerido',

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
