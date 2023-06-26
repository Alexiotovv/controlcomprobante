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
        return view('comprobantes.comprobantes_index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('comprobantes.comprobante_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $obj=new Comprobantes();
        $obj->numero=request('numero');
        $obj->fecha=request('fecha');
        $obj->nombre=request('nombre');
        $obj->importe=request('importe');
        $obj->siaf=request('siaf');
        $obj->fuentefto=request('fuentefto');
        $obj->folios=request('folios');
        $obj->estante=request('estante');
        $obj->paquete=request('paquete');
        $obj->usuario_id=auth()->user()->id;
        $obj->save();
        $data=['Msje'=>'ok'];
        return response()->json($data);
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
        ->get();
        
        return response()->json($obj);
    }


    function listar(Request $request) {
        $texto=$request->get('txtBuscar');
        $comprobantes=comprobantes::where('nombre', 'like','%'.$texto.'%')
        ->orderByDesc('comprobantes.id')
        ->paginate(2);
        return view('comprobantes.comprobantes_listar',['comprobantes'=>$comprobantes,'texto'=>$texto]);
    }

    public function filtrar($num,$nom,$est,$paq)
    {

        if ($num=='-'){
            $num='%';
        }
        if ($nom=='-'){
            $nom='%';
        }
        if ($est=='-'){
            $est='%';
        }
        if ($paq=='-'){
            $paq='%';
        }

        $obj=DB::table('comprobantes')
        ->where('comprobantes.numero','like','%'.$num.'%')
        ->where('comprobantes.nombre','like','%'.$nom.'%')
        ->where('comprobantes.estante','like','%'.$est.'%')
        ->orwhere('comprobantes.estante','=',NULL)
        ->where('comprobantes.paquete','like','%'.$paq.'%')
        ->orwhere('comprobantes.paquete','=',NULL)
        ->get();
        
        return response()->json($obj);
    }

    // public function asignarPorcentaje($valor)
    // {
    //     if ($valor=='-') {
    //         return ('%');
    //     }else{
    //         return ($valor);
    //     }
    // }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $obj=Comprobantes::find($id);
        return response()->json($obj);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, comprobantes $comprobantes)
    {
        $id=request('idComprobante');
        $obj=Comprobantes::findOrFail($id);
        $obj->numero=request('numero');
        $obj->fecha=request('fecha');
        $obj->nombre=request('nombre');
        $obj->importe=request('importe');
        $obj->siaf=request('siaf');
        $obj->fuentefto=request('fuentefto');
        $obj->folios=request('folios');
        $obj->estante=request('estante');
        $obj->paquete=request('paquete');
        $obj->save();
        $data=['Msje'=>'ok'];
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(comprobantes $comprobantes)
    {
        //
    }
}
