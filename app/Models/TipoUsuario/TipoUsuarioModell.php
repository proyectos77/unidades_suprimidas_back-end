<?php

namespace App\Models\TipoUsuario;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoUsuarioModell extends Model
{
    use HasFactory;

    protected $table = 'tipo_usuarios';
    protected $primaryKey = 'id_tipo_usuario';
    const CREATED_AT = 'fecha_creacion_tipo_usuario';
    const UPDATED_AT = 'fecha_actualizacion_tipo_usuario';

    protected $fillable = [
        'nombre_tipo_usuario',
        'id_estado',
        'fecha_creacion_estado',
        'fecha_actualizacion_estado',
    ];
}
