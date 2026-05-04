<?php

namespace App\Models\Estante;

use App\Models\Balda\BaldaModel;
use App\Models\Cuerpo\CuerpoModel;
use Illuminate\Database\Eloquent\Model;

class EstanteModel extends Model
{
    protected $table = 'estantes';
    protected $primaryKey = 'id_estante';
    public $timestamps = false;

    protected $fillable = [
        'nombre_estante',
        'id_cuerpo',
    ];

    public function cuerpo()
    {
        return $this->belongsTo(CuerpoModel::class, 'id_cuerpo');
    }

    public function baldas()
    {
        return $this->hasMany(BaldaModel::class, 'id_estante');
    }
}
