<?php

namespace App\Models\Permisos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Permisos extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'permisos';
    public $timestamps = true;
    protected $primaryKey = 'id_permiso';

    const CREATED_AT = 'fecha_creacion_permiso';
    const UPDATED_AT = 'fecha_actualizacion_permiso';

    protected $fillable = [
        'nombre_permiso',
        'descripcion_permiso',
        'id_estado'
    ];
}
