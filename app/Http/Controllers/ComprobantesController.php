<?php

namespace App\Http\Controllers;

use App\Models\comprobantes;
use Illuminate\Http\Request;
use DB;
class ComprobantesController extends Controller
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
    public function show($nrocomp,$nomemp)
    {
        if ($nrocomp=='-'){
            $nrocomp='%';
        }
        if ($nomemp=='-'){
            $nomemp='%';
        }
        $obj=DB::table('comprobantes')
        ->where('comprobantes.numero','like','%'.$nrocomp.'%')
        ->where('comprobantes.nombre','like','%'.$nomemp.'%')
        ->limit(100)
        ->get();
        
        return response()->json($obj);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(comprobantes $comprobantes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, comprobantes $comprobantes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(comprobantes $comprobantes)
    {
        //
    }
}
