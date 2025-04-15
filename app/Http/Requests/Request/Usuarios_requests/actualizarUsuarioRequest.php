<?php

namespace App\Http\Requests\Request\Usuarios_requests;

use App\Http\Responses\Responses;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class actualizarUsuarioRequest extends FormRequest
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


        $id = request()->route('usuario'); // Capturar el ID de la ruta
        /* dd($id); */

        $method = $this->method();

        if ($method === 'PUT') {
            return [
                'nombre'            => 'required|string',
                'user'              => 'required|unique:usuarios,user_usuario,' . $id . ',id_usuario',
                'identificacion'    => 'required|numeric|unique:usuarios,identificacion_usuario,' . $id . ', id_usuario',
                'emailUsuario'      => 'required|email|unique:usuarios,email_usuario,' . $id . ',id_usuario',
                'tipoUsuario'       => 'required|numeric',
                'cargo'             => 'required|numeric',
            ];
        }elseif ($method === 'PATCH') {
            return [
                'nombre'            => 'sometimes|string',
                'user'              => 'sometimes|unique:usuarios,user_usuario,' . $id . ',id_usuario',
                'identificacion'    => 'sometimes|numeric|unique:usuarios,identificacion_usuario,' . $id . ',id_usuario',
                'emailUsuario'      => 'sometimes|email|unique:usuarios,email_usuario,' . $id . ',id_usuario',
                'tipoUsuario'       => 'sometimes|numeric',
                'cargo'             => 'sometimes|numeric',
                'estado'            => 'sometimes|numeric'
            ];
        }

    }

    protected function prepareForValidation()
    {
        $data = [
            'nombre_usuario' => $this->nombre ?? null,
            'identificacion_usuario' => $this->identificacion ?? null,
            'email_usuario' => $this->emailUsuario ?? null,
            'user_usuario' => $this->user ?? null,
            'id_tipo_usuario' => $this->tipoUsuario ?? null,
            'id_cargo' => $this->cargo ?? null,
            'estado_usuario' => $this->estado ?? null
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

            'identificacion.numeric'        => 'El atributo identificacion solo acepta números',
            'identificacion.required'       => 'El atributo identificacion es requerido',
            'identificacion.unique'         => 'El número de identificación ya se encuentra registrado',

            'user.required'                 => 'El atributo usuario es requerido',
            'user.unique'                   => 'El usuario ya se encuentra registrado',

            'emailUsuario.email'            => 'El atributo email no es válido',
            'emailUsuario.required'         => 'El atributo emailUsuario es obligatorio',
            'emailUsuario.unique'           => 'El email ya se encuentra registrado',

            'tipoUsuario.required'          => 'El tipo de usaurios es obligatorio',
            'tipoUsuario.numeric'           => 'El tipo usuario solo acepta numero',

            'cargo.required'                => 'El cargo del usuario es obligatorio',
            'cargo.numeric'                 => 'El cargo solo acepta numero'
        ];
    }

    public function failedValidation(Validator $validator) {

        $errores = $validator->errors()->all();
        $erroresTexto = implode(', ', $errores);
        $response = Responses::warning(422, 'Error de validaciones', $erroresTexto,  $validator->errors());

        throw new HttpResponseException($response);
    }
}
