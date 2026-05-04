<?php

namespace App\Models\Balda;

use App\Models\Estante\EstanteModel;
use Illuminate\Database\Eloquent\Model;

class BaldaModel extends Model
{
    protected $table = 'baldas';
    protected $primaryKey = 'id_balda';
    public $timestamps = false;

    protected $fillable = [
        'nombre_balda',
        'id_estante',
    ];

    public function estante()
    {
        return $this->belongsTo(EstanteModel::class, 'id_estante');
    }
}
