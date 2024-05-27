@extends('bases.base')

@section('extra_css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

@endsection

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
                    <label for="">N° Cargo</label>
                    <input type="number" class="form-control" maxlength="50" id="numero_cargo" name="numero_cargo">
                </div>
                <div class="col-md-2">
                    <label for="">N° Comprobante</label>
                    <input type="text" class="form-control" maxlength="50" id="numero_comp" name="numero_comp">
                </div>
                <div class="col-md-2">
                    <label for="">N° Oficio</label>
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
                <div class="col-md-2">
                    <label for="">búsqueda</label>
                    <br>
                    <button type="button" class="btn btn-primary btn-sm" id="btnBuscarSalida" onclick="BuscarSalidasComprobantes()">Buscar</button>
                </div>

                <div class="col-md-2">
                    <label for="">Descargar</label>
                    <br>
                    <a type="button" class="btn btn-success btn-sm" id="btnExcel" onclick="descargarExcel()">Excel</a>
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


        function descargarExcel() {
            var inst=$("#institucion").val()
            var cargo=$("#cargo").val()
            var comp=$("#comp").val()
            var ofic=$("#ofic").val()
            
            var jsonData=[]

            if (inst.trim()==='-') {
                alert("Debe Seleccionar al menos una Institución")
                return false;
            }
                
            $.ajax({
                type: "GET",
                url: "/salidacomprobantes/descargar/"+inst+"/"+cargo+"/"+comp+"/"+ofic,
                dataType: "json",
                success: function (response) {
                    
                    jsonData=response;
                    var worksheet = XLSX.utils.json_to_sheet(jsonData);

                    var workbook = XLSX.utils.book_new();
                    XLSX.utils.book_append_sheet(workbook, worksheet, 'Sheet1');

                    XLSX.writeFile(workbook, 'data.xlsx');
                }
            });
            
        }

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
