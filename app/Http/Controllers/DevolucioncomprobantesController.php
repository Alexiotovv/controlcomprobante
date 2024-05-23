<?php

namespace App\Http\Controllers;

use App\Models\devolucioncomprobantes;
use App\Models\salidacomprobantes;
use Illuminate\Http\Request;

class DevolucioncomprobantesController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cerrar=salidacomprobantes::findOrFail(request('idSalida'));
        $cerrar->salida=0;
        $cerrar->save();

        $obj=new devolucioncomprobantes;
        $obj->salidacomprobantes_id=request('idSalida');
        $obj->fecha_devolucion=request('fecha_devolucion');
        $obj->hora_devolucion=request('hora_devolucion');
        $obj->comentario=request('comentario');
        $obj->usuario_id=auth()->user()->id;
        $obj->save();
        $data=['Msje'=>'Ok'];
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(devolucioncomprobantes $devolucioncomprobantes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(devolucioncomprobantes $devolucioncomprobantes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, devolucioncomprobantes $devolucioncomprobantes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(devolucioncomprobantes $devolucioncomprobantes)
    {
        //
    }
}
