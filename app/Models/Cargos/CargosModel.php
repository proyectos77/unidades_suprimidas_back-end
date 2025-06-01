<?php

namespace App\Models\Cargos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CargosModel extends Model
{
    use HasFactory;

    protected $table = 'cargos';
    protected $primaryKey = 'id_cargo';
    public $timestamps = true;
    const CREATED_AT = 'fecha_creacion_cargo';
    const UPDATED_AT = 'fecha_actualizacion_cargo';

    protected $fillable = [
        'nombre_cargo',
        'id_estado',
    ];
}
