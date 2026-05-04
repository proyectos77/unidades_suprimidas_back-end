<?php

namespace App\Models\CarpetaUnidadActiva;

use App\Models\CajaUnidadActiva\CajaUnidadActivaModel;
use App\Models\Serie\SerieModel;
use App\Models\Subserie\SubserieModel;
use App\Models\Estados\EstadosModell;
use App\Models\Series\SeriesModel;
use App\Models\Subseries\SubseriesModel;
use Illuminate\Database\Eloquent\Model;

class CarpetaUnidadActivaModel extends Model
{
    protected $table = 'carpetas_unidad_activas';
    protected $primaryKey = 'id_carpeta_unidad_activa';
    public $timestamps = true;
    const CREATED_AT = 'fecha_creacion_carpeta_unidad_activa';
    const UPDATED_AT = 'fecha_actualizacion_carpeta_unidad_activa';

    protected $fillable = [
        'id_caja_unidad_activa',
        'id_serie',
        'id_subserie',
        'numero_carpeta_unidad_activa',
        'fecha_extrema_inicio',
        'fecha_extrema_fin',
        'cantidad_folios',
        'fecha_creacion_carpeta_unidad_activa',
        'fecha_actualizacion_carpeta_unidad_activa',
        'id_estado',
    ];

    /* protected $casts = [
        'fecha_extrema_inicio' => 'date',
        'fecha_extrema_fin' => 'date',
        'fecha_creacion_carpeta_unidad_activa' => 'datetime',
        'fecha_actualizacion_carpeta_unidad_activa' => 'datetime',
    ]; */

    public function cajaUnidadActiva()
    {
        return $this->belongsTo(CajaUnidadActivaModel::class, 'id_caja_unidad_activa');
    }

    public function caja()
    {
        return $this->belongsTo(CajaUnidadActivaModel::class, 'id_caja_unidad_activa');
    }

    public function serie()
    {
        return $this->belongsTo(SeriesModel::class, 'id_serie');
    }

    public function subserie()
    {
        return $this->belongsTo(SubseriesModel::class, 'id_subserie');
    }

    public function estado()
    {
        return $this->belongsTo(EstadosModell::class, 'id_estado');
    }
}
