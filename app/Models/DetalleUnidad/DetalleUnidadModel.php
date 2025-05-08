<?php

namespace App\Models\DetalleUnidad;

use App\Models\Archivo\ArchivoModel;
use App\Models\Estados\EstadosModell;
use App\Models\Unidades\UnidadesModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleUnidadModel extends Model
{
    use HasFactory;

    protected $table = 'detalle_unidad';
    public $timestamps = false;
    protected $primaryKey = 'id_detalle';

    const CREATED_AT = 'fecha_creacion_detalle';
    const UPDATED_AT = 'fecha_actualizacion_detalle';

    protected $fillable = [

        'acto_administrativo_creacion_detalle',
        'acto_administrativo_desactivacion_detalle',
        'fecha_creacion_unidad_detalle',
        'fecha_desactivacion_unidad_detalle',
        'puesto_mando_adelantado_detalle',
        'puesto_mando_atrasado_detalle',
        'plan_reorganizacion_diorg_detalle',
        'observacion_detalle',
        'id_unidad',
        'fecha_creacion_detalle',
        'fecha_actualizacion_detalle',
        'id_estado'
    ];

    public function estados() {
        return $this->belongsTo(EstadosModell::class, 'id_estado', 'id_estado');
    }

    public function municipio() {
        return $this->belongsTo(UnidadesModel::class, 'id_unidad', 'id_unidad');
    }

    public function archivo(){
        return $this->hasOne(ArchivoModel::class, 'id_detalle', 'id_detalle');
    }
}
