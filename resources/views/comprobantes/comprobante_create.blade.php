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
                    <input type="text" class="form-control" maxlength="50" id="numero" name="numero" required>
                </div>
                <div class="col-md-2">
                    <label for="">Fecha</label>
                    <input type="date" class="form-control" id="fecha" name="fecha" required>
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
                    <input type="text" class="form-control" maxlength="50" id="siaf" name="siaf" required>
                </div>
                <div class="col-md-2">
                    <label for="">Fte. Fmto.</label>
                    <input type="text" class="form-control" maxlength="20" id="fuentefto" name="fuentefto" required>
                </div>
                <div class="col-md-2">
                    <label for="">Folio.</label>
                    <input type="text" class="form-control" maxlength="20" id="folios" name="folios" placeholder="000-000" required>
                </div>
                <div class="col-md-2">
                    <label for="">Estante</label>
                    <input type="text" class="form-control" maxlength="50" id="estante" name="estante" required>
                </div>
                <div class="col-md-2">
                    <label for="">Paquete</label>
                    <input type="text" class="form-control" maxlength="50" id="paquete" name="paquete" required>
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
        $("#folios").mask("000-000");

        $("#numero").keypress(function(e) {
            if (e.which === 13) {
                if ($("#numero").val().trim() ===! '') {   
                    e.preventDefault();
                    $("#fecha").focus();
                }
            }
        });
        

        $("#nombre").keypress(function(e) {
            if (e.which === 13) {
                if ($("#nombre").val().trim() ===! '') {   
                    e.preventDefault();
                    $("#importe").focus();
                }
            }
        });

        $("#importe").keypress(function(e) {
            if (e.which === 13) {
                if ($("#importe").val().trim() ===! '') {   
                    e.preventDefault();
                    $("#siaf").focus();
                }
            }
        });
        $("#siaf").keypress(function(e) {
            if (e.which === 13) {
                if ($("#siaf").val().trim() ===! '') {   
                    e.preventDefault();
                    $("#fuentefto").focus();
                }
            }
        });
        $("#fuentefto").keypress(function(e) {
            if (e.which === 13) {
                if ($("#fuentefto").val().trim() ===! '') {   
                    e.preventDefault();
                    $("#folios").focus();
                }
            }
        });
        $("#folios").keypress(function(e) {
            if (e.which === 13) {
                if ($("#folios").val().trim() ===! '') {   
                    e.preventDefault();
                    $("#estante").focus();
                }
            }
        });
        $("#estante").keypress(function(e) {
            if (e.which === 13) {
                if ($("#estante").val().trim() ===! '') {   
                    e.preventDefault();
                    $("#paquete").focus();
                }
            }
        });
        $("#paquete").keypress(function(e) {
            if (e.which === 13) {
                if ($("#paquete").val().trim() ===! '') {   
                    e.preventDefault();
                    $("#btnGuardarComprobante").focus();
                }
            }
        });
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
