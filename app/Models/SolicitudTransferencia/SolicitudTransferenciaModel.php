<?php

namespace App\Models\SolicitudTransferencia;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudTransferenciaModel extends Model
{
    use HasFactory;

        protected $table = 'solicitud_transferencias';
        public $timestamps = true;
        protected $primaryKey = 'id_solicitud_transferencia';

        const CREATED_AT = 'fecha_creacion_solicitud_transferencia';
        const UPDATED_AT = 'fecha_actualizacion_solicitud_transferencia';

        protected $fillable = [
            'id_transferencia',
            'fecha_inicio_solicitud_transferencia',
            'id_usuario_solicitante_solicitud_transferencia',
            'estado_solicitud_transferencia',
            'id_usuario_revisor_solicitud_transferencia',
            'fecha_fin_solicitud_transferencia',
            'observacion_solicitud_transferencia',
            'id_estado',
        ];
}
