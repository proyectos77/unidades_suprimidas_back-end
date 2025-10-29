<?php

namespace App\Models\ArchivoUnidadActiva;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchivoUnidadActivaModel extends Model
{
    use HasFactory;

    protected $table = 'archivo_unidades_activas';
    protected $primaryKey = 'id_archivo_unidad_activa';
    public $timestamps = true;
    const CREATED_AT = 'fecha_creacion_archivo_unidad_activa';
    const UPDATED_AT = 'fecha_actualizacion_archivo_unidad_activa';

    protected $fillable = [
        'id_unidad',
        'anio_registro_archivo_unidad_activa',
        'seccion_archivo_unidad_activa',
        'id_serie',
        'id_subserie',
        'cantidad_cajas_archivo_unidad_activa',
        'cantidad_carpetas_archivo_unidad_activa',
        'cantidad_folios_archivo_unidad_activa',
        'cantidad_tomos_archivo_unidad_activa',
        'descripcion_otro_archivo_unidad_activa',
        'cantidad_otros_archivo_unidad_activa',
        'porcentaje_archivo_unidad_activa',
        'id_estado',

    ];
}
