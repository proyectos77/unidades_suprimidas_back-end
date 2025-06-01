<?php

namespace App\Models\Estados;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadosModell extends Model
{
    use HasFactory;

    protected $table = 'estados';
    protected $primaryKey = 'id_estado';
    public $timestamps = true;
    const CREATED_AT = 'fecha_creacion_estado';
    const UPDATED_AT = 'fecha_actualizacion_estado';

    protected $fillable = [
        'nombre_estado',
        'descripcion_estado',
        'estado',
    ];
}
