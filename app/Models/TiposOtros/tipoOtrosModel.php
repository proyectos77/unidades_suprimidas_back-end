<?php

namespace App\Models\TiposOtros;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipoOtrosModel extends Model
{
    use HasFactory;

    protected $table = 'tipos_otros';
    protected $primaryKey = 'id_tipo_otro';
    public $timestamps = false;

    protected $fillable = [
        'nombre_tipo_otro',
        'id_estado'
    ];
}
