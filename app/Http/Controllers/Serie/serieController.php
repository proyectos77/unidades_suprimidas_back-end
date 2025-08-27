<?php

namespace App\Http\Controllers\Serie;

use App\Http\Controllers\Controller;
use App\Services\Series_services\listadoSeriesServices;
use Illuminate\Http\Request;

class serieController extends Controller
{
    private $listadoSeries;

    public function __construct(listadoSeriesServices $listadoSeries) {
        $this->listadoSeries = $listadoSeries;
    }

    public function index(){

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id){
    }

    public function listadoSeriesPorAnio($anio){
        return $this->listadoSeries->listadoSeries($anio);
    }
}
