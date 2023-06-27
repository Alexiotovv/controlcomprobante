@extends('bases.base')
c
@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <h5 style="text-align: center">Salidas de Comprobante</h5>
            </div>            
        </div>

        <form action="">
            <div class="row">
                <div class="col-md-2">
                    <label for="">Número de Cargo</label>
                    <input type="number" class="form-control" maxlength="50" id="numero_cargo" name="numero_cargo">
                </div>
                <div class="col-md-2">
                    <label for="">Número de Comprobante</label>
                    <input type="text" class="form-control" maxlength="50" id="numero_comp" name="numero_comp">
                </div>
                <div class="col-md-2">
                    <label for="">Número de Oficio</label>
                    <input type="text" class="form-control" maxlength="50" id="numero_oficio" name="numero_oficio">
                </div>
                <div class="col-md-2">
                    <label for="">Institución</label>
                    <select name="institucion" id="institucion" class="form-select">
                        <option value="-">-</option>
                        @foreach ($clientes as $cli)
                            <option value="{{$cli->id}}">{{$cli->nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <div class="spinner-border" role="status" id="spinner_buscar_salida" style="position: absolute" hidden>
                    </div>

                </div>
                
                <table class="table table-striped" id="DTSalidasComprobantes">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Acciones</th>
                            <th>N°Comp.</th>
                            <th>N°Cargo</th>
                            <th>N°Oficio</th>
                            <th>Folios</th>
                            <th>FechaSalida</th>
                            <th>HoraSalida</th>
                            <th>Estado</th>
                            <th>AbiertoPor</th>
                            <th>FechaDevolucion</th>
                            <th>HoraDevolucion</th>
                            <th>CerradoPor</th>

                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>

@include('comprobantesdevolucion.comprobantesdevolucion_create')
@include('comprobantessalida.comprobantesalida_edit')
@endsection

@section('extra_js')
    <script src="../../../app_js/crud.js"></script>    
    <script src="../../../app_js/salidacomprobante.js"></script>
    <script src="../../../app_js/devolucioncomprobante.js"></script>
    <script>
        $("#numero_cargo").keypress(function(e) {
            if (e.which === 13) {
                if ($("#numero_cargo").val().trim() ===! '') {   
                    e.preventDefault();
                    $("#numero_comp").focus();
                }
            }
        });
    </script>
@endsection
