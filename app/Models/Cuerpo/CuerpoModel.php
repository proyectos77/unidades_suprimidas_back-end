<?php

namespace App\Models\Cuerpo;

use App\Models\Estante\EstanteModel;
use Illuminate\Database\Eloquent\Model;

class CuerpoModel extends Model
{
    protected $table = 'cuerpos';
    protected $primaryKey = 'id_cuerpo';
    public $timestamps = false;

    protected $fillable = [
        'nombre_cuerpo',
    ];

    public function estantes()
    {
        return $this->hasMany(EstanteModel::class, 'id_cuerpo');
    }
}
