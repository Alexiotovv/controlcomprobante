<?php

namespace App\Http\Controllers;

use App\Models\comprobantesarchivos;
use Illuminate\Http\Request;

class ComprobantesarchivosController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(comprobantesarchivos $comprobantesarchivos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(comprobantesarchivos $comprobantesarchivos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, comprobantesarchivos $comprobantesarchivos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {   
        
        $obj=comprobantesarchivos::find($id);
        $obj->delete();
        
        return response()->json(['message'=>'Archivo Eliminado'], 200);

    }
}
