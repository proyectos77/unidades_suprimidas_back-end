<?php

namespace App\Models\Subseries;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubseriesModel extends Model
{
    use HasFactory;

    protected $table = 'subseries';
    public $timestamps = true;
    protected $primaryKey = 'id_subserie';

    const CREATED_AT = 'fecha_creacion_subserie';
    const UPDATED_AT = 'fecha_actualizacion_subserie';

    protected $fillable = [
        'codigo_subserie',
        'nombre_subserie',
        'id_serie',
        'id_estado'
    ];
}
