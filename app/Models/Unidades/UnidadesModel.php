<?php

namespace App\Models\Unidades;

use App\Models\DetalleUnidad\DetalleUnidadModel;
use App\Models\Estados\EstadosModell;
use App\Models\Municipios\MunicipiosModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnidadesModel extends Model
{
    use HasFactory;

    protected $table = 'unidades';
    public $timestamps = false;
    protected $primaryKey = 'id_unidad';

    const CREATED_AT = 'fecha_creacion_unidad';
    const UPDATED_AT = 'fecha_actualizacion_unidad';

    protected $fillable = [
        'nombre_unidad',
        'sigla_unidad',
        'padre_unidad',
        'id_municipio',
        'fecha_creacion_unidad',
        'fecha_actualizacion_unidad',
        'id_estado'
    ];

    public function estados() {
        return $this->belongsTo(EstadosModell::class, 'id_estado', 'id_estado');
    }

    public function municipio() {
        return $this->belongsTo(MunicipiosModel::class, 'id_municipio', 'id_municipio');
    }
    
    public function detalleUnidad() {
        return $this->belongsTo(DetalleUnidadModel::class, 'id_unidad', 'id_unidad');
    }
}
