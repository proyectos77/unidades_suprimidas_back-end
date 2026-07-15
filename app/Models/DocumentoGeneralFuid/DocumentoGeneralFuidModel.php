<?php

namespace App\Models\DocumentoGeneralFuid;

use App\Models\Estados\EstadosModell;
use App\Models\CarpetaUnidadActiva\CarpetaUnidadActivaModel;
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
        'id_carpeta_unidad_activa',
        'numero_orden',
        'codigo',
        'nombre_serie_subserie_asunto',
        'fecha_extrema_inicio',
        'fecha_extrema_fin',
        'numero_caja',
        'numero_carpeta',
        'numero_tomo',
        'numero_otro',
        'numero_folios',
        'numero_soporte',
        'numero_frecuencia_consulta',
        'notas',
        'url_documento',
        'id_estado',
    ];

    public function estados()
    {
        return $this->belongsTo(EstadosModell::class, 'id_estado', 'id_estado');
    }

    public function carpetaUnidadActiva()
    {
        return $this->belongsTo(CarpetaUnidadActivaModel::class, 'id_carpeta_unidad_activa', 'id_carpeta_unidad_activa');
    }
}
