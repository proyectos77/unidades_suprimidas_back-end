<?php

namespace App\Models\SolicitudTransferencia;

use App\Models\Estados\EstadosModell;
use App\Models\Transferencias\TransferenciasModel;
use App\Models\Usuarios\UsuariosModel;
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

        public function estadoSolicitud(){
            return $this->belongsTo(EstadosModell::class, 'estado_solicitud_transferencia', 'id_estado');
        }

        public function estado(){
            return $this->belongsTo(EstadosModell::class, 'id_estado', 'id_estado');
        }

        public function usuarioSolicitante() {
            return $this->belongsTo(UsuariosModel::class, 'id_usuario_solicitante_solicitud_transferencia', 'id_usuario');
        }

        public function usuarioRevisor() {
            return $this->belongsTo(UsuariosModel::class, 'id_usuario_revisor_solicitud_transferencia', 'id_usuario');
        }

        public function transferencia() {
            return $this->belongsTo(TransferenciasModel::class, 'id_transferencia', 'id_transferencia');
        }
}
