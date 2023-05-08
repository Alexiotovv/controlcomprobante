@extends('bases.base')

@section('content')

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <h5 style="text-align: center">Registrar Cliente</h5>
            </div>            
        </div>

        <form action="" id="frmCliente">@csrf
            <div class="row">
                <div class="col-md-6">
                    <label for="">Cliente</label>
                    <input type="text" class="form-control" maxlength="200" id="nombre" name="nombre" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <br>
                    <button type="submit" class="btn btn-primary" id="btnGuardarCliente">Guardar</button>
                </div>
            </div>

        </form>
    </div>

</div>


@endsection

@section('extra_js')
    <script src="../../../app_js/crud.js"></script>    
    <script src="../../../app_js/clientes.js"></script>    
    

    <script>

        // var fecha = new Date();
        // document.getElementById("fecha_salida").value = fecha.toJSON().slice(0, 10);
    </script>    
@endsection
