<?php

namespace App\Models\DocumentoGeneralFuid;

use App\Models\Estados\EstadosModell;
use App\Models\CajaUnidadActiva\CajaUnidadActivaModel;
use App\Models\DocumentoGeneralFuid\DetalleDocumentoGeneralFuidModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentoGeneralFuidModel extends Model
{
    use HasFactory;

    protected $table = 'documento_general_fuid';
    public $timestamps = true;
    protected $primaryKey = 'id_documento_general';

    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = [
        'id_caja_unidad_activa',
        'nombre_documento_general',
        'url_documento',
        'id_estado',
    ];

    public function estados()
    {
        return $this->belongsTo(EstadosModell::class, 'id_estado', 'id_estado');
    }

    public function cajaUnidadActiva()
    {
        return $this->belongsTo(CajaUnidadActivaModel::class, 'id_caja_unidad_activa', 'id_caja_unidad_activa');
    }

    public function detalles()
    {
        return $this->hasMany(DetalleDocumentoGeneralFuidModel::class, 'id_documento_general', 'id_documento_general');
    }
}
