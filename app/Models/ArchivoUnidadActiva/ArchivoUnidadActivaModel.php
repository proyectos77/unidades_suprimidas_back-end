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
        'ubicacion_archivo_unidad_activa',
        'direccion_archivo_unidad_activa',
        'edificio_archivo_unidad_activa',
        'piso_archivo_unidad_activa',
        'bodega_archivo_unidad_activa',
    ];
}
