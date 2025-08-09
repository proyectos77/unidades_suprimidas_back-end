<?php

namespace App\Models\Denpendencias;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dependencias extends Model
{
    use HasFactory;

    protected $table = 'dependencias';
    public $timestamps = true;
    protected $primaryKey = 'id_dependencia';

    const CREATED_AT = 'fecha_creacion_dependencia';
    const UPDATED_AT = 'fecha_actualizacion_dependencia';

    protected $fillable = [
        'nombre_dependencia',
        'sigla_dependencia',
        'padre_dependencia',
        'id_estado'
    ];
}
