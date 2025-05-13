<?php

namespace App\Models\DocumentoTransferencia;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentoTransferenciaModel extends Model
{
    use HasFactory;
    protected $table = 'documentos_transferencias';
    public $timestamps = false;
    protected $primaryKey = 'id_documento_transferencia';

    protected $fillable = [
        'id_documento',
        'id_transferencia',
        'id_estado'
    ];
}
