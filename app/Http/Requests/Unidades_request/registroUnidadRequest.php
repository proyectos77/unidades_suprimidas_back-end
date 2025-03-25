<?php

namespace App\Http\Requests\Unidades_request;

use App\Http\Responses\Responses;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class registroUnidadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre'            => 'required|string',
            'sigla'             => 'required|unique:unidades,sigla_unidad',
            'padreUnidad'       => 'required|string',
            'idMunicipio'       => 'required|numeric',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'nombre_unidad'     => $this->nombre,
            'sigla_unidad'      => $this->sigla,
            'padre_unidad'      => $this->padreUnidad,
            'id_municipio'      => $this->idMunicipio,
        ]);
    }

    public function messages()
    {
        return [
            'nombre.string'                 => 'El atributo nombre solo acepta letras',
            'nombre.required'               => 'El atributo nombre es requerido',

            'sigla.required'                => 'El atributo identificacion es requerido',
            'sigla.unique'                  => 'El número de identificación ya se encuentra registrado',

            'padreUnidad.required'          => 'El atributo usuario es requerido',
            'padreUnidad.unique'            => 'El usuario ya se encuentra registrado',

            'cargo.required'                => 'El cargo del usuario es obligatorio',
            'cargo.numeric'                 => 'El cargo solo acepta numero'
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
