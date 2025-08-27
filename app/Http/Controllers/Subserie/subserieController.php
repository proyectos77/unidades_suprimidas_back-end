<?php

namespace App\Http\Controllers\Subserie;

use App\Http\Controllers\Controller;
use App\Services\Subseries_services\listadoSubseriesPorSerieServices;
use Illuminate\Http\Request;

class subserieController extends Controller
{
    private $listadoSubseries;

    public function __construct(listadoSubseriesPorSerieServices $listadoSubseries) {
        $this->listadoSubseries = $listadoSubseries;
    }
    public function index()
    {
        //
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
    public function destroy(string $id)
    {
        //
    }

    public function listadoSubSeriesPorSerie($idSerie) {
        return $this->listadoSubseries->listadoSubseries($idSerie);
    }
}
