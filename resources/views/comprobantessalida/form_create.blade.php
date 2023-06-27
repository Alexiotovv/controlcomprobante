@extends('bases.base')
    
@section('extra_css')
    <link rel="stylesheet" href="../../../assets/plugins/notifications/css/lobibox.min.css" />
@endsection

@section('content')

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <h5 style="text-align: center">Registrar Salida de Comprobante</h5>
            </div>            
        </div>

        <hr>
        <div class="row">
            <div class="col-md-4">
                <h5>Datos del Comprobante</h5>
            </div>
            <div class="col-md-4">
                <button class="btn btn-primary" id="btnBuscarComprobante"><i class="bx bx-search"></i> Buscar Comprobante</button>

            </div>
        </div>
        
        <form action="" method="POST" id="frmSalidaComprobante">@csrf
            <div class="row">
                <div class="col-md-2">
                    <input type="text" name="id_comprobante" id="id_comprobante" hidden>
                    <label for="">N° Comprobante</label>
                    <input type="text" class="form-control" name="numero_comprobante" id="numero_comprobante" required disabled>
                </div>
                <div class="col-md-2">
                    <label for="">Fecha</label>
                    <input type="date" class="form-control modo-lectura" name="fecha" id="fecha" disabled>
                </div>
                <div class="col-md-4">
                    <label for="">Nombre Empresa</label>
                    <input type="text" class="form-control modo-lectura" name="nombre" id="nombre" disabled>
                </div>
                <div class="col-md-2">
                    <label for="">Importe</label>
                    <input type="number" step="0.01" class="form-control modo-lectura" name="importe" id="importe" disabled>
                </div>
                <div class="col-md-2">
                    <label for="">N° SIAF</label>
                    <input type="text" class="form-control modo-lectura" name="numero_siaf" id="numero_siaf" disabled>
                </div>
                <div class="col-md-2">
                    <label for="">Fte. Fto.</label>
                    <input type="text" class="form-control modo-lectura" name="fuente_fmto" id="fuente_fmto" disabled>
                </div>
                <div class="col-md-2">
                    <label for="">Folios</label>
                    <input type="text" class="form-control modo-lectura" name="folios" id="folios" disabled>
                </div>
                <div class="col-md-2">
                    <label for="">Estante</label>
                    <input type="text" class="form-control modo-lectura" name="estante" id="estante" disabled>
                </div>
                <div class="col-md-2">
                    <label for="">Paquete</label>
                    <input type="text" class="form-control modo-lectura" name="paquete" id="paquete" disabled>
                    <br>
                </div>
            </div>
    
            <div class="row">
                <hr>
                <h5>Datos del Oficio</h5>
                <div class="col-md-4">
                    <label for="">Seleccion Institución</label>
                    <div class="input-group">
    
                        <select name="cliente" id="cliente" class="form-select" required>
                            
                        </select>
                        <a class="btn btn-primary btn-md" id="btnAgregarInstitucion"><i class="bx bx-plus"></i></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="">Nro. Cargo</label>
                    <input type="number" class="form-control " name="nro_cargo" id="nro_cargo" required style="font-weight: 800">
                </div>
                <div class="col-md-2">
                    <label for="">Nro. Oficio</label>
                    <input type="number" class="form-control " name="nro_oficio" id="nro_oficio" required>
                </div>
                <div class="col-md-2">
                    <label for="">Folio(s)</label>
                    <input type="text" class="form-control" name="cant_folios" id="cant_folios" placeholder="000-000" required>
                </div>
                <div class="col-md-2">
                    <label for="">Fecha Salida</label>
                    <input type="date" class="form-control" name="fecha_salida" id="fecha_salida" readonly>
                </div>
                <div class="col-md-2">
                    <label for="">Hora Salida</label>
                    <input type="time" class="form-control" name="hora_salida" id="hora_salida" readonly>
                </div>
                
                <div class="row">
                    <div class="col-md-4">
                        <br>
                        <button type="submit" id="btnGuardarSalida" class="btn btn-primary">Guardar</button>
                            <div class="spinner-border" role="status" id="spinner_guardar" hidden>
                        </div>
                    </div>  
                </div>
    
            </div>
            
        </form>
    </div>

</div>

    @include('comprobantessalida.form_buscarcomprobante')
    @include('comprobantessalida.modal_agregarinstitucion')
@endsection

@section('extra_js')
    <script src="../../../app_js/crud.js"></script>    
    <script src="../../../app_js/usuarios.js"></script>
    <script src="../../../app_js/salidacomprobante.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
    <script src="../../../assets/plugins/notifications/js/lobibox.min.js"></script>
	<script src="../../../assets/plugins/notifications/js/notifications.min.js"></script>
	<script src="../../../assets/plugins/notifications/js/notification-custom-script.js"></script>

    <script>
        
        $("#nro_cargo").keypress(function(e) {
            if (e.which === 13) {
                if ($("#nro_cargo").val().trim() ===! '') {   
                    e.preventDefault();
                    $("#nro_oficio").focus();
                }
            }
        });

        $("#nro_oficio").keypress(function(e) {
            if (e.which === 13) {
                if ($("#nro_oficio").val().trim() ===! '') {   
                    e.preventDefault();
                    $("#folio").focus();
                }
            }
        });

        $("#folio").keypress(function(e) {
            if (e.which === 13) {
                if ($("#folio").val().trim() ===! '') {   
                    e.preventDefault();
                    $("#btnGuardarSalida").focus();
                }
            }
        });


        $("#cant_folios").mask("000-000");

        setInterval(muestrahora, 1000);
        function muestrahora() { 
            var hoy = new Date();
            hora = ('0' + hoy.getHours()).slice(-2) + ':' + ('0' + hoy.getMinutes()).slice(-2);
            document.getElementById("hora_salida").value = hora;    
        }

        var fecha = new Date();
        document.getElementById("fecha_salida").value = fecha.toJSON().slice(0, 10);
    </script>    
@endsection
