<?php

namespace App\Http\Controllers;

use App\Models\tempssalidacomprobantes;
use App\Models\comprobantes;
use Illuminate\Http\Request;
use DB;
class TempssalidacomprobantesController extends Controller
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
    public function store($id)
    {   
        $comp=comprobantes::find($id);
        $objverificar= tempssalidacomprobantes::where('id_comprobante',$id)->exists();
        if ($objverificar) {
            return response()->json(['statusCode'=>409,'message'=>'Ya existe el comprobante'], 409);
        }else{
            $obj = new tempssalidacomprobantes();
            $obj->id_comprobante=$comp->id;
            $obj->numerocomprobante=$comp->numero;
            $obj->fecha=$comp->fecha;
            $obj->nombreempresa=$comp->nombre;
            $obj->importe=$comp->importe;
            $obj->siaf=$comp->siaf;
            $obj->ftefto=$comp->fuentefto;
            $obj->folio =$comp->folios;
            $obj->estante=$comp->estante;
            $obj->paquete=$comp->paquete;
            $obj->user_id=auth()->user()->id;
            $obj->save();        
            
            $data=DB::table('tempssalidacomprobantes')
            ->where('user_id',auth()->user()->id)
            ->get();
    
            return response()->json(['data'=>$data,'message'=>'Registo Ok'], 200);

        }

        
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {   
        $data=DB::table('tempssalidacomprobantes')
        ->where('tempssalidacomprobantes.user_id','=',auth()->user()->id)
        ->get();

        return response()->json(['data'=>$data,'message'=>'Ok'], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(tempssalidacomprobantes $tempssalidacomprobantes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, tempssalidacomprobantes $tempssalidacomprobantes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $obj=tempssalidacomprobantes::find($id);
        $obj->delete();

        $data=DB::table('tempssalidacomprobantes')
        ->where('tempssalidacomprobantes.user_id','=',auth()->user()->id)
        ->get();
        
        return response()->json(['data'=>$data,'message'=>'Registro Eliminado'], 200);
    }
}
