@extends('bases.base')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <h5>Registrar Salida de Comprobante</h5>
        </div>
        <div class="col-md-4">
            <button class="btn btn-primary" id="btnBuscarComprobante"><i class="bx bx-search"></i> Buscar Comprobante</button>
            {{-- <div class="spinner-border" role="status"></div> --}}
        </div>
        
    </div>
    <hr>
    <form action="" method="POST">@csrf
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

        <div class="row" id="div_bloque_guardar" hidden>
            <hr>
            <div class="col-md-4">
                <label for="">Seleccion Institución</label>
                <select name="cliente" id="cliente" class="form-select" required>
                    @foreach ($clientes as $cli)
                        <option value="{{$cli->id}}">{{$cli->nombre}}</option>    
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label for="">Nro. Oficio</label>
                <input type="text" class="form-control " name="nro_oficio" id="nro_oficio" required>
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
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>  
            </div>

        </div>
        
    </form>

    @include('comprobantes.form_buscarcomprobante')
    
@endsection

@section('extra_js')
    <script src="../../../app_js/usuarios.js"></script>
    <script src="../../../app_js/salidacomprobante.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>

    <script>
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
