<?php

namespace App\Http\Requests\Request\Usuarios_requests;

use Illuminate\Foundation\Http\FormRequest;

class registroUsuarioRequest extends FormRequest
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
            'nombre'    => ['required', 'string'],
            'user'      => ['required'],
            'emailUsuario'     => ['required', 'email'],
            'password'  => ['required', 'string', 'min:10', 'max:10'],
        ];
    }

    protected function prepareForValidation() {
        $this->merge([
            'nombre_usuario'            => $this->nombre,
            'user_usuario'              => $this->user,
            'email_usuario'             => $this->emailUsuario,
            'password_usuario'          => $this->password,
        ]);
    }

    public function messages() {
        return [
            'nombre.string'         => 'El atributo nombre solo acepta letras',
            'nombre.required'       => 'El atributo nombre es requerido',

            'user.required'         => 'El atributo usuario es requerido',

            'email.string'          => 'El atributo email no es de tipo email',
            'enail.required'        => 'El atributo emailUsuario es obligatorio',
            'email.unique'          => ['El email ya se encuentra registrado' => 'error'],

            'passUsuario.required'  => 'El atributo contraseña es requerido',
        ];
    }
}
