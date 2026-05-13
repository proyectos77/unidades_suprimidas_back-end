<?php

namespace App\Models\DocumentoUnidadActiva;

use App\Models\CarpetaUnidadActiva\CarpetaUnidadActivaModel;
use App\Models\CajaUnidadActiva\CajaUnidadActivaModel;
use App\Models\Unidades\UnidadesModel;
use App\Models\Estados\EstadosModell;
use Illuminate\Database\Eloquent\Model;

class DocumentoUnidadActivaModel extends Model
{
    protected $table = 'documentos_unidad_activas';
    protected $primaryKey = 'id_unidad_activa';
    public $timestamps = true;

    const CREATED_AT = 'fecha_creacion_documento_unidad_activa';
    const UPDATED_AT = 'fecha_actualizacion_documento_unidad_activa';

    protected $fillable = [
        'id_carpeta_unidad_activa',
        'numero_radicado',
        'fecha_elaboracion',
        'id_unidad',
        'nombre_funcionario_destino',
        'asunto',
        'nombre_quien_firma',
        'cargo_quien_firma',
        'tipo_soporte',
        'cantidad_folios',
        'tipo_documental',
        'observaciones',
        'id_estado'
    ];

    public function carpeta()
    {
        return $this->belongsTo(CarpetaUnidadActivaModel::class, 'id_carpeta_unidad_activa');
    }

    public function unidad()
    {
        return $this->belongsTo(UnidadesModel::class, 'id_unidad');
    }

    public function estado()
    {
        return $this->belongsTo(EstadosModell::class, 'id_estado');
    }
}
