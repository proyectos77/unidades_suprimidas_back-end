<?php

namespace App\Models\CajaUnidadActiva;

use App\Models\Balda\BaldaModel;
use App\Models\ArchivoUnidadActiva\ArchivoUnidadActivaModel;
use App\Models\Estados\EstadosModell;
use Illuminate\Database\Eloquent\Model;

class CajaUnidadActivaModel extends Model
{
    protected $table = 'cajas_unidad_activas';
    protected $primaryKey = 'id_caja_unidad_activa';
    public $timestamps = true;
    const CREATED_AT = 'fecha_creacion_caja_unidad_activa';
    const UPDATED_AT = 'fecha_actualizacion_caja_unidad_activa';

    protected $fillable = [
        'id_archivo_unidad_activa',
        'id_balda',
        'codigo_caja_unidad_activa',
        'numero_consecutivo_bodega_unidad_activa',
        'numero_correlativo_dependencia_unidad_activa',
        'anio_caja_unidad_activa',
        'cantidad_libros_unidad_activa',
        'cantidad_carpetas_unidad_activa',
        'fecha_creacion_caja_unidad_activa',
        'fecha_actualizacion_caja_unidad_activa',
        'id_estado',
    ];

    /* protected $casts = [
        'fecha_creacion_caja_unidad_activa' => 'datetime',
        'fecha_actualizacion_caja_unidad_activa' => 'datetime',
    ]; */

    public function balda()
    {
        return $this->belongsTo(BaldaModel::class, 'id_balda');
    }

    public function archivo()
    {
        return $this->belongsTo(ArchivoUnidadActivaModel::class, 'id_archivo_unidad_activa');
    }

    public function estado()
    {
        return $this->belongsTo(EstadosModell::class, 'id_estado');
    }
}
