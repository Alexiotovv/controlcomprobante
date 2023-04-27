@extends('bases.base')
@section('extra_css')
<style>
    .modo-lectura{
        background: rgb(227, 232, 238)
    }
</style>
@endsection
@section('content')

    <h5>Registrar Salida de Comprobante</h5>
    <form action="" method="POST">@csrf
        <div class="row">
            {{-- <div class="col-md-2">
                <label for="">Id</label>
                <input type="text" class="form-control" name="id" readonly style="background-color: rgb(223, 217, 217)">
            </div> --}}
            {{-- <div class="col-md-2">
                <label for="">N° Cargo</label>
                <input type="number" class="form-control" name="numero_cargo" id="numero_cargo" maxlength="50" required>
                <p id="estado_cargo" style="color: red;display:none">No Disponible</p> 
            </div> --}}
            <div class="col-md-4">
                <label for="">Seleccion Institución</label>
                <input type="text" class="form-control " name="cliente" id="cliente" maxlength="200" required>
            </div>
            <div class="col-md-2">
                <label for="">Buscar N° Comprobante</label>
                <input type="text" class="form-control" name="numero_comprobante" id="numero_comprobante">
            </div>
            <div class="col-md-2">
                <label for="">N° SIAF</label>
                <input type="text" class="form-control modo-lectura" name="numero_siaf" id="numero_siaf" disabled>
            </div>
            <div class="col-md-2">
                <label for="">Nombre Empresa</label>
                <input type="text" class="form-control modo-lectura" name="nombre" id="nombre" disabled>
            </div>
            <div class="col-md-2">
                <label for="">Fecha</label>
                <input type="date" class="form-control modo-lectura" name="fecha" id="fecha" disabled>
            </div>
            <div class="col-md-2">
                <label for="">Importe</label>
                <input type="number" step="0.01" class="form-control modo-lectura" name="importe" id="importe" disabled>
            </div>
            <div class="col-md-2">
                <label for="">Folios</label>
                <input type="text" class="form-control modo-lectura" name="folios" id="folios" disabled>
                <br>
            </div>
            <hr>
            
            <div class="row">
                <div class="col-md-4">
                    <br>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>  
            </div>
        </div>

    </form>
    
@endsection
@section('extra_js')
    <script src="../../../app_js/usuarios.js"></script>
@endsection
