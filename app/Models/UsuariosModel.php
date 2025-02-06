<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UsuariosModel extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'usuarios';
    public $timestamps = false;
    protected $primaryKey = 'id_usuario';

    const CREATED_AT = 'fecha_creacion_usuario';
    const UPDATED_AT = 'fecha_actualizacion_usuario';

    protected $fillable = [
        'nombre_usuario',
        'user_usuario',
        'identificacion_usuario',
        'email_usuario',
        'password_usuario',
        'fecha_creacion_usuario',
        'fecha_actualizacion_usuario',
        'id_estado'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password_usuario',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_usuario_verified_at' => 'datetime',
        'password_usuario' => 'hashed',
    ];

    public function getAuthPassword()  //Funcion para retornar la contraseña con el nombre que este en la base de datos.
    {
        return $this->password_usuario;
    }




}
