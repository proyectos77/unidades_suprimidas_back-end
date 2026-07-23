<?php

namespace App\Models\PermisosUsuario;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermisosUsuario extends Model
{
    use HasFactory;
    protected $table = 'permisos_usuarios';
    public $timestamps = false;
    protected $primaryKey = 'id_permiso_usuario';

    protected $fillable = [
        'id_permiso',
        'id_usuario',
        'id_estado'
    ];
}
