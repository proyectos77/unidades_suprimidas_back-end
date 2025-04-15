<?php

namespace App\Http\Requests\Unidades_request;

use App\Http\Responses\Responses;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class actualizarUnidadRequest extends FormRequest
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

        $id = $this->route('unidade');
        $method = $this->method();

        $reglas = []; // Definir $reglas por defecto

        if ($method === 'PUT') {
            $reglas = [
                'nombre'            => 'required|string',
                'sigla'             => 'required|unique:unidades,sigla_unidad,' . $id . ',id_unidad',
                'padreUnidad'       => 'required|string',
                'idMunicipio'       => 'required|numeric',
            ];
        }elseif ($method === 'PATCH') {
            $reglas = [
                'nombre'            => 'sometimes|string',
                'sigla'             => 'sometimes|unique:unidades,sigla_unidad,' . $id . ',id_unidad',
                'padreUnidad'       => 'sometimes|string',
                'idMunicipio'       => 'sometimes|numeric',
                'estado'            => 'sometimes|numeric'
            ];
        }

        return $reglas;
    }

    protected function prepareForValidation()
    {
        $data = [
            'nombre_unidad' => $this->nombre ?? null,
            'sigla_unidad' => $this->sigla ?? null,
            'padre_unidad' => $this->padreUnidad ?? null,
            'id_municipio' => $this->idMunicipio ?? null,
            'id_estado'     => $this->estado ?? null
        ];

        $this->merge(array_filter($data, function ($value) {
            return !is_null($value);
        }));
    }

    public function messages()
    {
        return [
            'nombre.string'                 => 'El atributo nombre solo acepta letras',
            'nombre.required'               => 'El atributo nombre es requerido',

            'sigla.required'                => 'El atributo sigla es requerido',
            'sigla.unique'                  => 'La sigla ya se encuentra registrada',

            'padreUnidad.required'          => 'El atributo padre unidad es requerido',
            'padreUnidad.string'            => 'El atributo padre unidad',

            'idMunicipio.required'          => 'El municipio es obligatorio',
            'idMunicipio.numeric'           => 'El municipio solo acepta numero'
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
