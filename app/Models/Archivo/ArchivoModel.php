<?php

namespace App\Models\Archivo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchivoModel extends Model
{
    use HasFactory;

    protected $table = 'archivo';
    public $timestamps = false;
    protected $primaryKey = 'id_archivo';

    const CREATED_AT = 'fecha_creacion_archivo';
    const UPDATED_AT = 'fecha_actualizacion_archivo';

    protected $fillable = [
        'numero_cajas_archivos',
        'numero_carpetas_archivo',
        'numero_folios_archivo',
        'fecha_creacion_archivo',
        'fecha_actualizacion_archivo',
        'anio_registro_archivo',
        'id_detalle',
        'id_estado'
    ];

   /*  public function estados() {
        return $this->belongsTo(EstadosModell::class, 'id_estado', 'id_estado');
    }

    public function municipio() {
        return $this->belongsTo(UnidadesModel::class, 'id_unidad', 'id_unidad');
    }
} */
}
