<?php

namespace App\Http\Requests\Request\Usuarios_requests;

use App\Http\Responses\Responses;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class registroUsuarioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre'            => 'required|string',
            'user'              => 'required|unique:usuarios,user_usuario',
            'identificacion'    => 'required|numeric|unique:usuarios,identificacion_usuario',
            'emailUsuario'      => 'required|email|unique:usuarios,email_usuario',
            'tipoUsuario'       => 'required|numeric',
            'cargo'             => 'required|numeric'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'nombre_usuario'            => $this->nombre,
            'identificacion_usuario'    => $this->identificacion,
            'email_usuario'             => $this->emailUsuario,
            'user_usuario'              => $this->user,
            'password_usuario'          => Hash::make($this->identificacion),
            'id_tipo_usuario'           => $this->tipoUsuario,
            'id_cargo'                  => $this->cargo
        ]);
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
