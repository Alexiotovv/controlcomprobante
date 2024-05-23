@extends('bases.base')
@section('extra_css')
<link rel="stylesheet" href="../../../assets/plugins/notifications/css/lobibox.min.css" />
@endsection

@section('content')

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h5 style="text-align: center">Registrar Comprobante</h5>
            </div>
            <div class="col-md-6">
                @if(session()->has('mensaje'))
                    <div class="alert border-0 border-start border-5 border-success alert-dismissible fade show py-2">
                        <div class="d-flex align-items-center">
                            <div class="font-35 text-success"><i class='bx bxs-check-circle'></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-0 text-success">{{Session::get('mensaje')}}</h6>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
        </div>
        <form action="{{route('comprobantes.store')}}" id="frmComprobante" method="POST" enctype="multipart/form-data">@csrf
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
                    <input type="text" class="form-control" maxlength="250" name="nombre" required>
                </div>
                <div class="col-md-2">
                    <label for="">Importe</label>
                    <input type="number" step="0.01" class="form-control" name="importe" required>
                </div>
                <div class="col-md-2">
                    <label for="">SIAF</label>
                    <input type="text" class="form-control" id="siaf" maxlength="50" name="siaf" required>
                </div>
                <div class="col-md-2">
                    <label for="">Fte. Fmto.</label>
                    <input type="text" class="form-control" maxlength="20" id="fuentefto" name="fuentefto" required>
                </div>
                <div class="col-md-2">
                    <label for="">Folio.</label>
                    <input type="text" class="form-control" maxlength="20" id="folios" name="folios" placeholder="000000-000000" value="000000-000000" required>
                </div>
                <div class="col-md-2">
                    <label for="">Estante</label>
                    <input type="text" class="form-control" maxlength="50" id="estante" name="estante" value="0" required>
                </div>
                <div class="col-md-2">
                    <label for="">Paquete</label>
                    <input type="text" class="form-control" maxlength="50" id="paquete" name="paquete" value="0" required>
                </div>
                <div class="col-md-4">
                    <label for="">Adjuntar Documentos</label>
                    <input type="file" class="form-control" maxlength="50" id="archivos" name="archivos[]" accept=".pdf" multiple>
                    <div id="archivos-seleccionados">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <br>
                    <button type="submit" class="btn btn-primary" id="btnGuardarComprobantes">Guardar</button>
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
    
    var archivosSeleccionados = [];
    
    $("#btnGuardarComprobantes").on("click",function (e) { 
        var numero = $("#numero").val()
        var siaf = $("#siaf").val()
        if (validarDuplicidad($("#fecha").val(),numero,siaf)) {
            e.preventDefault()
        }
    })

    function validarDuplicidad(fecha,numero,siaf) {
        var fechaObj = new Date(fecha);
        var year = fechaObj.getFullYear();

        if (!fecha) {
                alert("Fecha no válida");
                return;
            }
            var fechaObj = new Date(fecha);
            if (isNaN(fechaObj.getTime())) {
                alert("Fecha no válida");
                return;
            }
            var year = fechaObj.getFullYear();
            let valor_devuelto=false
            $.ajax({
                type: "GET",
                url: "/comprobantes/validarduplicado/"+year+"/"+numero+"/"+siaf,
                dataType: "json",
                success: function (response) {
                    if (response.data.existe_num===true) {
                        return(true)
                        alert("Ya existe un numero de comprobante en el año correspondiente")
                    }

                    if(response.data.existe_siaf===true){
                        return(true)
                        alert("Ya existe un numero de siaf en el año correspondiente")
                    }
                }
            });

        return(false)
        
    }


    $('#archivos').change(function() {
        $('#archivos-seleccionados').empty();
        
        archivosSeleccionados = [];
        archivosSeleccionados = $(this)[0].files;
        
        for (var i = 0; i < archivosSeleccionados.length; i++) {
   
            var nombreArchivo = $('<label>').text(archivosSeleccionados[i].name);
   
            var iconoEliminar = $('<i>').addClass('lni lni-cross-circle eliminar-archivo').attr('data-indice', i); 
   
            $('#archivos-seleccionados').append(nombreArchivo).append(iconoEliminar);
            $('#archivos-seleccionados').append('<br>');
        }
    });
    
    // Manejar clic en el icono de eliminar
    $(document).on('click', '.eliminar-archivo', function() {
        var indice = $(this).data('indice'); // Obtener el índice del archivo desde el atributo de datos
        archivosSeleccionados = Array.from(archivosSeleccionados); // Convertimos a un array
        archivosSeleccionados.splice(indice, 1); // Eliminar el archivo del array de archivos seleccionados
        // Actualizar la vista de archivos seleccionados
        $('#archivos-seleccionados').empty();
        for (var i = 0; i < archivosSeleccionados.length; i++) {
            var nombreArchivo = $('<label>').text(archivosSeleccionados[i].name);
            var iconoEliminar = $('<i>').addClass('lni lni-cross-circle eliminar-archivo').attr('data-indice', i);
            $('#archivos-seleccionados').append(nombreArchivo).append(iconoEliminar);
            $('#archivos-seleccionados').append('<br>');
        }

        $('#archivos').attr('value', archivosSeleccionados.length + ' archivo(s) seleccionado(s)');

    });


    $("#folios").mask("000000-000000");

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

    </script>    
@endsection
