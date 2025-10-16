<?php

namespace App\Http\Controllers\Otros;

use App\Http\Controllers\Controller;
use App\Services\Ortros\listadoOtrosServices;
use Illuminate\Http\Request;

class otrosController extends Controller
{

    private $listadoOtrosServices;

    public function __construct(listadoOtrosServices $listadoOtrosServices) {
        $this->listadoOtrosServices = $listadoOtrosServices;
    }

    public function index()
    {
        return $this->listadoOtrosServices->getListadoOtros();
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
}
