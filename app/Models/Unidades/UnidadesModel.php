<?php

namespace App\Models\Unidades;

use App\Models\DetalleUnidad\DetalleUnidadModel;
use App\Models\Estados\EstadosModell;
use App\Models\Municipios\MunicipiosModel;
use App\Models\Usuarios\UsuariosModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnidadesModel extends Model
{
    use HasFactory;

    protected $table = 'unidades';
    public $timestamps = true;
    protected $primaryKey = 'id_unidad';

    const CREATED_AT = 'fecha_creacion_unidad';
    const UPDATED_AT = 'fecha_actualizacion_unidad';

    protected $fillable = [
        'nombre_unidad',
        'unidad_superior_jerarquicamente_unidad',
        'sigla_unidad',
        'unidad_que_asume_archivo_unidad',
        'id_municipio',
        'id_estado',
        'id_usuario',
        'padre_unidad',
        'codigo_unidad_activa',

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

    public function usuario() {
        return $this->belongsTo(UsuariosModel::class, 'id_usuario', 'id_usuario');
    }
}
