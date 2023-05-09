<?php

namespace App\Http\Controllers;

use App\Models\clientes;
use Illuminate\Http\Request;
use DB;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    

    
    public function index()
    {
        return view('clientes.clientes_index');
    }


    public function listar(Request $request)
    {
        $clientes=DB::table('clientes')
        ->get();
        return datatables()->of($clientes)->tojson();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clientes.clientes_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $obj=new clientes();
        $obj->nombre=request('nombre');
        $obj->save();
        $data=['Mensaje'=>'ok'];
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(clientes $clientes)
    {
        $clientes=DB::table('clientes')
        ->get();
        return response()->json($clientes);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(clientes $clientes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id=request('idCliente');
        $obj=clientes::findOrFail($id);
        $obj->nombre=request('nombre');
        $obj->save();
        $data=['Mensaje'=>'ok'];
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(clientes $clientes)
    {
        //
    }
}
