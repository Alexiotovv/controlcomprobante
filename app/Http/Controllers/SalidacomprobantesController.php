<?php

namespace App\Http\Controllers;

use App\Models\salidacomprobantes;
use Illuminate\Http\Request;
use DB;
class SalidacomprobantesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes=DB::table('clientes')
        ->get();
        return view('comprobantes.form_create',['clientes'=>$clientes]);
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
    public function show(salidacomprobantes $salidacomprobantes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(salidacomprobantes $salidacomprobantes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, salidacomprobantes $salidacomprobantes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(salidacomprobantes $salidacomprobantes)
    {
        //
    }
}
