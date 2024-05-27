<?php

namespace App\Http\Controllers;

use App\Models\comprobantes;
use App\Models\comprobantesarchivos;
use Illuminate\Http\Request;
use DB;

class ComprobantesController extends Controller
{
    
    public function importar_index(Request $request){
        return view('comprobantes.comprobante_importar');
    }


    public function importar(Request $request){
        
        try {
            //code...
            // $request->validate([
            //     'file' => 'required|mimes:sql',
            // ]);
            
    
            $file = $request->file('file');
            $filePath = $file->getRealPath();
    
            $sql = file_get_contents($filePath);
            // Ejecutar el script SQL
            DB::unprepared($sql);
    
            return redirect()->back()->with('success', 'Script SQL ejecutado correctamente.');
        } catch (\Throwable $th) {
            dd($th);
        }
    }


    public function index(Request $request)
    {   
        $num=request('numero_comprobante');
        $nom=request('nombre_comprobante');
        $est=request('estante_comprobante');
        $paq=request('paquete_comprobante');
        $siaf=request('siaf_comprobante');
        $anoinv=request('anoinv_comprobante');
        
        if (!$num && !$nom &&!$est && !$paq && !$siaf && !$anoinv){
            $obj=DB::table('comprobantes')
            ->orderBy('comprobantes.id','desc')
            ->paginate(150);
            
        }else{
            
            
            if ($num){
                $numero_cond=True;
            }else{$numero_cond=False;}
            if ($nom){
                $nombre_cond=True;
            }else{ $nombre_cond=False;}
            if ($est){
                $estante_cond=True;
            }else{$estante_cond=False;}
            if ($paq){
                $paquete_cond=True;
            }else{$paquete_cond=False;}
            if ($siaf){
                $siaf_cond=True;
            }else{$siaf_cond=False;}
            if($anoinv){
                $anoinv_cond=True;
            }else{
                $anoinv_cond=False;
            }

            $obj=DB::table('comprobantes')
            ->when($numero_cond, function ($query) use ($num) {
                return $query->where('comprobantes.numero', 'like', '%' . $num . '%');
            })
            ->when($nombre_cond, function ($query) use ($nom) {
                return $query->where('comprobantes.nombre', 'like', '%' . $nom . '%');
            })
            ->when($estante_cond, function ($query) use ($est) {
                return $query->where('comprobantes.estante', '=',$est);
            })
            ->when($paquete_cond, function ($query) use ($paq) {
                return $query->where('comprobantes.paquete', 'like', '%' . $paq . '%');
            })
            ->when($siaf_cond, function ($query) use ($siaf) {  
                return $query->where('comprobantes.siaf', 'like', '%' . $siaf . '%');
            })
            ->when($anoinv_cond, function ($query) use ($anoinv) {  
                return $query->where('comprobantes.anhoinventario', '=',$anoinv);
            })

            ->orderBy('comprobantes.id','desc')
            ->paginate(150);
        }

        
        $ids = $obj->pluck('id');
        $arch=comprobantesarchivos::whereIn('id_comprobantes',$ids)->get();
        
        return view('comprobantes.comprobantes_index', ['comprobantes'=>$obj,'archivos'=>$arch,'siaf'=>$siaf,'num'=>$num,'nom'=>$nom,'est'=>$est,'paq'=>$paq,'anoinv'=>$anoinv]);

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
        try {
            $desc=request('descripcion');
            $obs=request('observacion');
            
            if ($desc=='') {
                $desc='-';
            }
            if ($obs=='') {
                $obs='-';
            }

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
            
            $obj->itemfile=request('itemfile');
            $obj->tipodocumento=request('tipodocumento');
            $obj->medio=request('tipodocumento');
            $obj->descripcion=$desc;
            $obj->observacion=$obs;
            $obj->estado=request('estado');
            $obj->anhoinventario=request('anhoinventario');
            $obj->rofidei=request('rofidei');

            


            $obj->usuario_id=auth()->user()->id;
            $obj->save();

            if ($request->hasFile('archivos')) {
                $files=$request->file('archivos');
                foreach ($files as $f) {
                    $file = $f->getClientOriginalName();//archivo recibido
                    $filename = pathinfo($file, PATHINFO_FILENAME);//nombre archivo sin extension
                    $extension = $f->getClientOriginalExtension();//extensión
                    $archivo= $filename.'_'.time().'.'.$extension;//
                    
                    $f->storeAs('comprobantes/',$archivo,'public');//refiere carpeta publica es el nombre de disco
                    $ca=new comprobantesarchivos ();
                    $ca->id_comprobantes=$obj->id;
                    $ca->nombrearchivo=$archivo;
                    $ca->save();
                }   
            }
            return redirect()->route('comprobantes.create')->with('mensaje' ,'Registro Guardado');
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json($th);
            
        }
        
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
        ->OrderBy('comprobantes.id','desc')
        ->limit(200)
        ->get();
        
        return response()->json($obj);
    }


    function listar(Request $request) {
        $texto=$request->get('txtBuscar');
        $comprobantes=comprobantes::where('nombre', 'like','%'.$texto.'%')
        ->orderByDesc('comprobantes.id')
        ->paginate(50);
        return view('comprobantes.comprobantes_listar',['comprobantes'=>$comprobantes,'texto'=>$texto]);
    }

    public function filtrar($num,$nom,$est,$paq)
    {

        
        

    }

    
    public function edit($id)
    {
        $obj=Comprobantes::find($id);
        return response()->json($obj);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $desc=request('descripcion');
        $obs=request('observacion');
        if ($desc=='') {
            $desc='-';
        }
        if ($obs=='') {
            $obs='-';
        }
        $id=request('idComprobante');
        $obj=Comprobantes::findOrFail($id);
        $obj->numero=request('edit_numero');
        $obj->fecha=request('edit_fecha');
        $obj->nombre=request('edit_nombre');
        $obj->importe=request('edit_importe');
        $obj->siaf=request('edit_siaf');
        $obj->fuentefto=request('edit_fuentefto');
        $obj->folios=request('edit_folios');
        $obj->estante=request('edit_estante');
        $obj->paquete=request('edit_paquete');

        $obj->itemfile=request('edit_itemfile');
        $obj->tipodocumento=request('edit_tipodocumento');
        $obj->medio=request('edit_tipodocumento');
        $obj->descripcion=$desc;
        $obj->observacion=$obs;
        $obj->estado=request('edit_estado');
        $obj->anhoinventario=request('edit_anhoinventario');
        $obj->rofidei=request('edit_rofidei');

        $obj->save();
        
        if ($request->hasFile('edit_archivos')) {
            $files=$request->file('edit_archivos');
            foreach ($files as $f) {
                $file = $f->getClientOriginalName();//archivo recibido
                $filename = pathinfo($file, PATHINFO_FILENAME);//nombre archivo sin extension
                $extension = $f->getClientOriginalExtension();//extensión
                $archivo= $filename.'_'.time().'.'.$extension;//
                
                $f->storeAs('comprobantes/',$archivo,'public');//refiere carpeta publica es el nombre de disco
                $ca=new comprobantesarchivos ();
                $ca->id_comprobantes=$obj->id;
                $ca->nombrearchivo=$archivo;
                $ca->save();
            }   
        }
        return redirect()->route('comprobantes.index')->with('Mensaje','Registro Guardado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(comprobantes $comprobantes)
    {
        //
    }

    public function validarDuplicado($anho, $numero,$siaf){
        // $existe_siaf = DB::table('comprobantes')
        // ->whereYear('comprobantes.fecha','=',$anho)
        // ->where('comprobantes.siaf','=',$siaf)
        // ->exists();

        $existe_num = DB::table('comprobantes')
        ->whereYear('comprobantes.fecha','=',$anho)
        ->where('comprobantes.numero','=',$numero)
        ->exists();


        return response()->json(['data'=>['existe_num'=>$existe_num]], 200);
    }

}
