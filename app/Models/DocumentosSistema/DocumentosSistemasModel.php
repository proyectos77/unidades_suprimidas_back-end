<?php

namespace App\Models\DocumentosSistema;

use App\Models\TiposDocumentacionSistema\TipoDocumentacionSistemaModel;
use App\Models\Estados\EstadosModell;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentosSistemasModel extends Model
{
    use HasFactory;

    protected $table = 'documentacion_sistema';
    protected $primaryKey = 'id_documento_sistema';
    public $timestamps = false;
    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = [
        'nombre_documento_sistema',
        'descripcion_documento_sistema',
        'id_tipo_documentacion_sistema',
        'ruta_documento_sistema',
        'id_estado'
    ];

    public function tipoDocumentacionSistema() {
       return $this->belongsTo(TipoDocumentacionSistemaModel::class, 'id_tipo_documentacion_sistema', 'id_tipo_documentacion_sistema');
    }

    public function estados() {
        return $this->belongsTo(EstadosModell::class, 'id_estado', 'id_estado');
    }
}
