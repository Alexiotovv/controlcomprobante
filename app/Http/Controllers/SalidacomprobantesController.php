<?php

namespace App\Http\Controllers;

use App\Models\salidacomprobantes;
use App\Models\tempssalidacomprobantes;
use Illuminate\Http\Request;
use DB;
class SalidacomprobantesController extends Controller
{
    
    public function descargar($nro_cargo,$nro_comp,$nro_oficio,$institucion){
        if ($nro_cargo=='-' && $nro_comp=='-' && $nro_oficio=='-' && $institucion=='-'){
            $obj=DB::table('salidacomprobantes')
            ->leftjoin('users as usuario_salida','usuario_salida.id','=','salidacomprobantes.usuario_id')
            ->leftjoin('comprobantes','comprobantes.id','=','salidacomprobantes.comprobantes_id')
            ->leftjoin('devolucioncomprobantes','devolucioncomprobantes.salidacomprobantes_id','=','salidacomprobantes.id')
            ->leftjoin('users as usuario_devolucion','usuario_devolucion.id','=','devolucioncomprobantes.usuario_id')
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
            
        }else{

            if ($nro_cargo=='-') {
                $nro_cargo_cond=False;
            }else{$nro_cargo_cond=True;}
            if ($nro_comp=='-') {
                $nro_comp_cond=False;
            }else{$nro_comp_cond=True;}
            if ($nro_oficio=='-') {
                $nro_oficio_cond=False;
            }else{$nro_oficio_cond=True;}
            if ($institucion=='-') {
                $institucion_cond=False;
                $simbolo='>';
            }else{
                $simbolo='=';
                $institucion_cond=True;
            }

            $obj=DB::table('salidacomprobantes')
            ->leftjoin('users as usuario_salida','usuario_salida.id','=','salidacomprobantes.usuario_id')
            ->leftjoin('comprobantes','comprobantes.id','=','salidacomprobantes.comprobantes_id')
            ->leftjoin('devolucioncomprobantes','devolucioncomprobantes.salidacomprobantes_id','=','salidacomprobantes.id')
            ->leftjoin('users as usuario_devolucion','usuario_devolucion.id','=','devolucioncomprobantes.usuario_id')
            
            ->when($nro_cargo_cond, function ($query) use ($nro_cargo) {
                return $query->where('salidacomprobantes.numero_cargo', 'like', '%' . $nro_cargo . '%');
            })
            ->when($nro_oficio_cond, function ($query) use ($nro_oficio) {
                return $query->where('salidacomprobantes.numero_oficio', 'like', '%' . $nro_oficio . '%');
            })
            ->when($nro_comp_cond, function ($query) use ($nro_comp) {
                return $query->where('comprobantes.numero', '=',$nro_comp);
            })
            ->when($institucion_cond, function ($query) use ($institucion) {
                return $query->where('salidacomprobantes.clientes_id', $simbolo, $institucion);
            })
            
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
            ->orderBy('salidacomprobantes.id','desc')
            ->get();
        }

        return response()->json($obj);
    }

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
        $comprobantes=DB::table('tempssalidacomprobantes')
        ->where('tempssalidacomprobantes.user_id','=',auth()->user()->id)
        ->select('tempssalidacomprobantes.id_comprobante')
        ->get();
        $insertData = [];
        foreach ($comprobantes as $comps) {
            // Agrega un nuevo array con los datos del comprobante actual al array de datos a insertar
            $insertData[] = [
                'comprobantes_id' => $comps->id_comprobante,
                'clientes_id' => request('cliente'),
                'numero_oficio' => request('nro_oficio'),
                'numero_cargo' => request('nro_cargo'),
                'folios' => request('cant_folios'),
                'fecha_salida' => request('fecha_salida'),
                'hora_salida' => request('hora_salida'),
                'usuario_id' => auth()->user()->id,
                // 'salida' => true, // Solo si es necesario, aunque parece que es el valor por defecto
            ];
        }

        salidacomprobantes::insert($insertData);

        //borrar datos del a tabla temporalcomprobantes
        tempssalidacomprobantes::where('user_id', auth()->user()->id)->delete();

        $data=['Msje'=>'Guardado'];
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show($nro_cargo,$nro_comp,$nro_oficio,$institucion)
    {

        if ($nro_cargo=='-' && $nro_comp=='-' && $nro_oficio=='-' && $institucion=='-'){
            $obj=DB::table('salidacomprobantes')
            ->leftjoin('users as usuario_salida','usuario_salida.id','=','salidacomprobantes.usuario_id')
            ->leftjoin('comprobantes','comprobantes.id','=','salidacomprobantes.comprobantes_id')
            ->leftjoin('devolucioncomprobantes','devolucioncomprobantes.salidacomprobantes_id','=','salidacomprobantes.id')
            ->leftjoin('users as usuario_devolucion','usuario_devolucion.id','=','devolucioncomprobantes.usuario_id')
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
            ->orderBy('salidacomprobantes.id','desc')
            ->get();
            
        }else{

            if ($nro_cargo=='-') {
                $nro_cargo_cond=False;
            }else{$nro_cargo_cond=True;}
            if ($nro_comp=='-') {
                $nro_comp_cond=False;
            }else{$nro_comp_cond=True;}
            if ($nro_oficio=='-') {
                $nro_oficio_cond=False;
            }else{$nro_oficio_cond=True;}
            if ($institucion=='-') {
                $institucion_cond=False;
                $simbolo='>';
            }else{
                $simbolo='=';
                $institucion_cond=True;
            }

            $obj=DB::table('salidacomprobantes')
            ->leftjoin('users as usuario_salida','usuario_salida.id','=','salidacomprobantes.usuario_id')
            ->leftjoin('comprobantes','comprobantes.id','=','salidacomprobantes.comprobantes_id')
            ->leftjoin('devolucioncomprobantes','devolucioncomprobantes.salidacomprobantes_id','=','salidacomprobantes.id')
            ->leftjoin('users as usuario_devolucion','usuario_devolucion.id','=','devolucioncomprobantes.usuario_id')
            
            ->when($nro_cargo_cond, function ($query) use ($nro_cargo) {
                return $query->where('salidacomprobantes.numero_cargo', 'like', '%' . $nro_cargo . '%');
            })
            ->when($nro_oficio_cond, function ($query) use ($nro_oficio) {
                return $query->where('salidacomprobantes.numero_oficio', 'like', '%' . $nro_oficio . '%');
            })
            ->when($nro_comp_cond, function ($query) use ($nro_comp) {
                return $query->where('comprobantes.numero', '=',$nro_comp);
            })
            ->when($institucion_cond, function ($query) use ($institucion) {
                return $query->where('salidacomprobantes.clientes_id', $simbolo, $institucion);
            })
            
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
        }

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
