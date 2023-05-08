@extends('bases.base')

@section('extra_css')
    <link rel="stylesheet" href="../../../assets/plugins/notifications/css/lobibox.min.css" />
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <h5 style="text-align: center">Filtro para Listar Comprobantes</h5>
            </div>            
        </div>

        <form action="">
            <div class="row">
                <div class="col-md-2">
                    <label for="">N° Comp.</label>
                    <input type="text" class="form-control" maxlength="50" id="numero_comprobante" name="numero_comprobante">
                </div>
                <div class="col-md-2">
                    <label for="">Nombre</label>
                    <input type="text" class="form-control" maxlength="50" id="nombre_comprobante" name="nombre_comprobante">
                </div>
                <div class="col-md-2">
                    <label for="">Estante</label>
                    <input type="text" class="form-control" maxlength="50" id="estante_comprobante" name="estante_comprobante">
                </div>
                <div class="col-md-2">
                    <label for="">Paquete</label>
                    <input type="text" class="form-control" maxlength="50" id="paquete_comprobante" name="paquete_comprobante">
                </div>
                <div class="col-md-2">
                    <br>
                    <button class="btn btn-primary" id="btnFiltrarComprobantes">Filtrar</button>
                    <div class="spinner-border" role="status" id="spinner_filtrar_comprobantes" style="position: absolute" hidden>
                    </div>
                </div>
                
                <table class="table table-striped" id="DTComprobantes">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Acciones</th>
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

                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>
@include('comprobantes.comprobante_edit')
@endsection


@section('extra_js')
    <script src="../../../app_js/crud.js"></script>    
    <script src="../../../app_js/comprobantes.js"></script>    
    <script src="../../../assets/plugins/notifications/js/lobibox.min.js"></script>
	<script src="../../../assets/plugins/notifications/js/notifications.min.js"></script>
	<script src="../../../assets/plugins/notifications/js/notification-custom-script.js"></script>
@endsection
