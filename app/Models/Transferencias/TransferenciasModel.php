<?php

namespace App\Models\Transferencias;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferenciasModel extends Model
{
    use HasFactory;

    protected $table = 'transferencias';
    protected $primaryKey = 'id_transferencia';
    const CREATED_AT = 'fecha_creacion_transferencia';
    const UPDATED_AT = 'fecha_actualizacion_transferencia';

    protected $fillable = [
        'cantidad_cajas_transferencia',
        'cantidad_carpetas_transferencia',
        'cantidad_folios_transferencia',
        'porcentaje_transferencia',
        'id_archivo',
        'fecha_creacion_transferencia',
        'fecha_actualizacion_transferencia'
    ];
}
