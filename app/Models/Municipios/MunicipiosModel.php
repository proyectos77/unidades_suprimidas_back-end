<?php

namespace App\Models\Municipios;

use App\Models\Departamentos\DepartamentosModel;
use App\Models\Estados\EstadosModell;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MunicipiosModel extends Model
{
    use HasFactory;

    protected $table = 'municipios';
    public $timestamps = false;
    protected $primaryKey = 'id_municipio';

    const CREATED_AT = 'fecha_creacion_municipio';
    const UPDATED_AT = 'fecha_actualizacion_municipio';

    protected $fillable = [
        'nombre_municipio',
        'id_departamento',
        'fecha_creacion_municipio',
        'fecha_actualizacion_municipio',
        'id_estado'
    ];

    public function estados() {
        return $this->belongsTo(EstadosModell::class, 'id_estado', 'id_estado');
    }

    public function departamentos() {
        return $this->belongsTo(DepartamentosModel::class, 'id_departamento', 'id_departamento');
    }
}
