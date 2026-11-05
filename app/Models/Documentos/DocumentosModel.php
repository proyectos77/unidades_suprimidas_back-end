<?php

namespace App\Models\Documentos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentosModel extends Model
{
    use HasFactory;
    protected $table = 'documentos';
    public $timestamps = true;
    protected $primaryKey = 'id_documento';

    const CREATED_AT = 'fecha_creacion_documentos';
    const UPDATED_AT = 'fecha_actualizacion_documentos';

    protected $fillable = [

        'nombre_documento',
        'url_documento',
        'extension_documento',
        'id_estado'
    ];

    // La ruta física del archivo no se expone en las respuestas JSON;
    // el archivo se consulta por id en documento/{id}/visualizar
    protected $hidden = [
        'url_documento'
    ];
}
