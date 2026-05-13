<?php

namespace App\Models\TipoDocumental;

use Illuminate\Database\Eloquent\Model;

class TipoDocumentalModel extends Model
{
    protected $table = 'tipos_documentales';
    protected $primaryKey = 'id_tipo_documental';
    public $timestamps = false;

    protected $fillable = [
        'nombre_tipo_documental'
    ];
}
