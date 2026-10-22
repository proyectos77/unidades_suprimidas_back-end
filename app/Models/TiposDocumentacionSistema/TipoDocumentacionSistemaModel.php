<?php

namespace App\Models\TiposDocumentacionSistema;

use App\Models\Estados\EstadosModell;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDocumentacionSistemaModel extends Model
{
    use HasFactory;

    protected $table = 'tipos_documentacion_sistema';
    protected $primaryKey = 'id_tipo_documentacion_sistema';
    public $timestamps = false;
    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = [
        'nombre_tipo_documento_sistema',
        'descripcion_tipo_documento_sistema',
        'id_estado'
    ];

    public function estados() {
        return $this->belongsTo(EstadosModell::class, 'id_estado', 'id_estado');
    }
}
