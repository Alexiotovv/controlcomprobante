@extends('bases.base')
@section('extra_css')
<link rel="stylesheet" href="../../../assets/plugins/notifications/css/lobibox.min.css" />
@endsection

@section('content')

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <h5 style="text-align: center">Registrar Comprobante</h5>
            </div>            
        </div>

        <form action="" id="frmComprobante">@csrf
            <div class="row">
                <div class="col-md-2">
                    <label for="">Número</label>
                    <input type="number" class="form-control" maxlength="50" id="numero" name="numero" required>
                </div>
                <div class="col-md-2">
                    <label for="">Fecha</label>
                    <input type="date" class="form-control" id="fecha" name="fecha">
                </div>
                <div class="col-md-2">
                    <label for="">Nombre</label>
                    <input type="text" class="form-control" maxlength="250" id="nombre" name="nombre" required>
                </div>
                <div class="col-md-2">
                    <label for="">Importe</label>
                    <input type="number" step="0.01" class="form-control" id="importe" name="importe" required>
                </div>
                <div class="col-md-2">
                    <label for="">SIAF</label>
                    <input type="number" class="form-control" maxlength="50" id="siaf" name="siaf" required>
                </div>
                <div class="col-md-2">
                    <label for="">Fte. Fmto.</label>
                    <input type="number" class="form-control" maxlength="20" id="fuentefto" name="fuentefto">
                </div>
                <div class="col-md-2">
                    <label for="">Folio.</label>
                    <input type="number" class="form-control" maxlength="20" id="folios" name="folios">
                </div>
                <div class="col-md-2">
                    <label for="">Estante</label>
                    <input type="number" class="form-control" maxlength="50" id="estante" name="estante">
                </div>
                <div class="col-md-2">
                    <label for="">Paquete</label>
                    <input type="number" class="form-control" maxlength="50" id="paquete" name="paquete">
                </div>

            </div>
            <div class="row">
                <div class="col-md-4">
                    <br>
                    <button type="submit" class="btn btn-primary" id="btnGuardarComprobante">Guardar</button>
                </div>
            </div>

        </form>
    </div>

</div>


@endsection

@section('extra_js')
    <script src="../../../app_js/crud.js"></script>    
    <script src="../../../app_js/comprobantes.js"></script>    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
    {{-- <script src="../../../assets/plugins/notifications/js/lobibox.min.js"></script>
	<script src="../../../assets/plugins/notifications/js/notifications.min.js"></script>
	<script src="../../../assets/plugins/notifications/js/notification-custom-script.js"></script> --}}

    <script>
        // $("#importe").mask("000,000,00");

        // setInterval(muestrahora, 1000);
        // function muestrahora() { 
        //     var hoy = new Date();
        //     hora = ('0' + hoy.getHours()).slice(-2) + ':' + ('0' + hoy.getMinutes()).slice(-2);
        //     document.getElementById("hora_salida").value = hora;    
        // }

        // var fecha = new Date();
        // document.getElementById("fecha_salida").value = fecha.toJSON().slice(0, 10);
    </script>    
@endsection
