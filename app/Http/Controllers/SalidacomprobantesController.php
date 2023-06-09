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
        $clientes=DB::table('clientes')
        ->get();
        return view('comprobantessalida.comprobantesalida_index',['clientes'=>$clientes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $clientes=DB::table('clientes')
        // ->get();
        return view('comprobantessalida.form_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $obj=new salidacomprobantes();
        $obj->comprobantes_id=request('id_comprobante');
        $obj->clientes_id=request('cliente');
        $obj->numero_oficio=request('nro_oficio');
        $obj->numero_cargo=request('nro_cargo');
        $obj->folios=request('cant_folios');
        $obj->fecha_salida=request('fecha_salida');
        $obj->hora_salida=request('hora_salida');
        //$obj->salida = true // por defecto guarda True
        $obj->usuario_id=auth()->user()->id;
        $obj->save();
        $data=['Msje'=>'Guardado'];
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show($nro_cargo,$nro_comp,$nro_oficio,$institucion)
    {
        if ($nro_cargo=='-') {
            $nro_cargo='%';
        }
        if ($nro_comp=='-') {
            $nro_comp='%';
        }
        if ($nro_oficio=='-') {
            $nro_oficio='%';
        }
        if ($institucion=='-') {
            $institucion=0;
            $simbolo='>';
        }else{
            $simbolo='=';
        }

        $obj=DB::table('salidacomprobantes')
        ->leftjoin('users as usuario_salida','usuario_salida.id','=','salidacomprobantes.usuario_id')
        ->leftjoin('comprobantes','comprobantes.id','=','salidacomprobantes.comprobantes_id')
        ->leftjoin('devolucioncomprobantes','devolucioncomprobantes.salidacomprobantes_id','=','salidacomprobantes.id')
        ->leftjoin('users as usuario_devolucion','usuario_devolucion.id','=','devolucioncomprobantes.usuario_id')
        ->where('salidacomprobantes.numero_cargo','like','%'.$nro_cargo.'%')
        ->where('salidacomprobantes.numero_oficio','like','%'.$nro_oficio.'%')
        ->where('comprobantes.numero','like','%'.$nro_comp.'%')
        ->where('salidacomprobantes.clientes_id',$simbolo,$institucion)
        ->select('salidacomprobantes.id',
        'comprobantes.numero',
        'salidacomprobantes.numero_cargo',
        'salidacomprobantes.numero_oficio',
        'salidacomprobantes.folios',
        'salidacomprobantes.fecha_salida',
        'salidacomprobantes.hora_salida',
        'salidacomprobantes.salida',
        'usuario_salida.name as usuariosalida',
        'devolucioncomprobantes.fecha_devolucion',
        'devolucioncomprobantes.hora_devolucion',
        'usuario_devolucion.name as usuariodevolucion',

        )
        ->limit(200)
        ->get();
        return response()->json($obj);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $obj=salidacomprobantes::find($id);
        $obj->get();
        return response()->json($obj);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id=request('idSalidaComprobante');
        $obj=salidacomprobantes::findOrFail($id);
        $obj->numero_oficio=request('nro_oficio');
        $obj->numero_cargo=request('nro_cargo');
        $obj->folios=request('cant_folios');
        // $obj->fecha_salida=request('fecha_salida');
        // $obj->hora_salida=request('hora_salida');
        $obj->save();
        $data=['Msje'=>'ok'];
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(salidacomprobantes $salidacomprobantes)
    {
        //
    }
}
