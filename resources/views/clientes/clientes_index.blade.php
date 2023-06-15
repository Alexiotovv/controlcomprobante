@extends('bases.base')

@section('extra_css')
    {{-- <link rel="stylesheet" href="../../../assets/plugins/notifications/css/lobibox.min.css" /> --}}
    <link rel="stylesheet" href="../../../assets/plugins/datatable/css/dataTables.bootstrap5.min.css" />
  
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <button class="btn btn-primary" id="btnNuevoCliente">Nuevo</button>
            <div class="row">
                <div class="col-md-12">
                    <h5 style="text-align: center">Lista de Clientes</h5>
                </div>
                
            </div>
            
            <div class="row">
                
                <table class="table table-striped" id="DTListarClientes">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Acciones</th>
                            <th>Nombre del Cliente</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('clientes.clientes_form')

@endsection

@section('extra_js')
    <script src="../../../assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="../../../assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
    <script src="../../../app_js/crud.js"></script>    
    <script src="../../../app_js/clientes.js"></script>    

@endsection
