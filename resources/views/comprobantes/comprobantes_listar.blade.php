@extends('bases.base')

@section('extra_css')
    <link rel="stylesheet" href="../../../assets/plugins/notifications/css/lobibox.min.css" />
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <h5 style="text-align: center">Listar Comprobantes</h5>
            </div>            
        </div>

        <form action="">
            <div class="row">
                <div class="col-md-2">
                    <label for="">Buscar por Nombre</label>
                    <input type="text" class="form-control" maxlength="50" id="txtBuscar" name="txtBuscar" value="{{$texto}}">
                </div>
                <div class="col-md-2">
                    <br>    
                    <button class="btn btn-primary">Buscar</button>
                </div>
                
                
                <table class="table table-striped table-hover" id="DTListaComprobantes">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>N°Comp.</th>
                            <th>Fecha</th>
                            <th>Nombre</th>
                            <th>Importe</th>
                            <th>SIAF</th>
                            <th>Fte.Fmto.</th>
                            <th>Folio</th>
                            <th>Estante</th>
                            <th>Paquete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($comprobantes as $c)
                            <tr>
                                <td>{{$c->id}}</td>
                                <td>{{$c->numero}}</td>
                                <td>{{$c->fecha}}</td>
                                <td>{{$c->nombre}}</td>
                                <td>{{$c->importe}}</td>
                                <td>{{$c->siaf}}</td>
                                <td>{{$c->fuentefto}}</td>
                                <td>{{$c->folios}}</td>
                                <td>{{$c->estante}}</td>
                                <td>{{$c->paquete}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $comprobantes->links() !!}
            </div>
        </form>
    </div>
</div>

@endsection


@section('extra_js')
    
    
@endsection
