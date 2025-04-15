<?php

namespace App\Models\Departamentos;

use App\Models\Estados\EstadosModell;
use App\Models\Municipios\MunicipiosModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartamentosModel extends Model
{
    use HasFactory;

    protected $table = 'departamentos';
    public $timestamps = false;
    protected $primaryKey = 'id_departamento';

    const CREATED_AT = 'fecha_creacion_departamento';
    const UPDATED_AT = 'fecha_actualizacion_departamento';

    protected $fillable = [
        'nombre_departamento',
        'fecha_creacion_departamento',
        'fecha_actualizacion_departamento',
        'id_estado'
    ];

    public function estados() {
        return $this->belongsTo(EstadosModell::class, 'id_estado', 'id_estado');
    }

    public function municipios() {
        return $this->hasMany(MunicipiosModel::class, 'id_departamento');
    }
}
