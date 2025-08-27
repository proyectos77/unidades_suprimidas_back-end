<?php

namespace App\Models\Series;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeriesModel extends Model
{
    use HasFactory;

    protected $table = 'series';
    public $timestamps = true;
    protected $primaryKey = 'id_serie';

    const CREATED_AT = 'fecha_creacion_serie';
    const UPDATED_AT = 'fecha_actualizacion_serie';

    protected $fillable = [
        'nombre_serie',
        'codigo_serie',
        'anio_inicio_serie',
        'anio_fin_serie',
        'id_estado'
    ];
}
