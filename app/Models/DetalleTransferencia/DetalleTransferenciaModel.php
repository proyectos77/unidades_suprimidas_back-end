<?php

namespace App\Models\DetalleTransferencia;

use App\Models\Series\SeriesModel;
use App\Models\SolicitudTransferencia\SolicitudTransferenciaModel;
use App\Models\Subseries\SubseriesModel;
use App\Models\Transferencias\TransferenciasModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleTransferenciaModel extends Model
{
    use HasFactory;

    protected $table = 'detalle_transferencia';
    protected $primaryKey = 'id_detalle_transferencia';
    public $timestamps = true;
    const CREATED_AT = 'fecha_creacion_detalle_transferencia';
    const UPDATED_AT = 'fecha_actualizacion_detalle_transferencia';

    protected $fillable = [
        'id_transferencia',
        'seccion_detalle_transferencia',
        'id_serie',
        'id_subserie',
        'cantidad_cajas_detalle_transferencia',
        'cantidad_carpetas_detalle_transferencia',
        'cantidad_folios_detalle_transferencia',
        'cantidad_tomos_detalle_transferencia',
        'descripcion_otro_detalle_transferencia',
        'cantidad_otros_detalle_transferencia',
        'porcentaje_detalle_transferencia',
        'id_estado',

    ];

    public function transferencia()
    {
        return $this->belongsTo(TransferenciasModel::class, 'id_transferencia', 'id_transferencia');
    }

    public function serie()
    {
        return $this->belongsTo(SeriesModel::class, 'id_serie', 'id_serie');
    }

    public function subserie()
    {
        return $this->belongsTo(SubseriesModel::class, 'id_subserie', 'id_subserie');
    }
}
