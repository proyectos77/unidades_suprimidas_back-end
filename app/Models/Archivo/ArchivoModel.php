<?php

namespace App\Models\Archivo;

use App\Models\DetalleUnidad\DetalleUnidadModel;
use App\Models\Estados\EstadosModell;
use App\Models\Transferencias\TransferenciasModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchivoModel extends Model
{
    use HasFactory;

    protected $table = 'archivo';
    public $timestamps = true;
    protected $primaryKey = 'id_archivo';

    const CREATED_AT = 'fecha_creacion_archivo';
    const UPDATED_AT = 'fecha_actualizacion_archivo';

    protected $fillable = [
        'numero_cajas_archivos',
        'numero_carpetas_archivo',
        'numero_folios_archivo',
        'numero_tomos_archivo',
        'numero_otros_archivo',
        'anio_registro_archivo',
        'id_detalle',
        'id_estado'
    ];

    public function estados() {
        return $this->belongsTo(EstadosModell::class, 'id_estado', 'id_estado');
    }

    public function detalleUnidad() {
        return $this->hasOne(DetalleUnidadModel::class, 'id_detalle', 'id_detalle');
    }

    public function transferencias()
    {
        return $this->hasMany(TransferenciasModel::class, 'id_archivo', 'id_archivo');
    }
}
