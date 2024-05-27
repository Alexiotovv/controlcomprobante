@extends('bases.base')


@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <h5 style="text-align: center">Importar</h5>
            </div>            
        </div>

        <form action="{{route('comprobantes.importar')}}" method="POST" enctype="multipart/form-data">@csrf
            <div class="row">
                <div class="col-md-2">
                    <label for="">Archivo</label>
                    <input type="file" class="form-control" id="file" name="file" required>
                </div>
                <button type="submit" class="btn btn-primary">Importar</button>
               
        </form>
               
        
    </div>
</div>

@endsection

@section('extra_js')

    <script src="../../../assets/plugins/notifications/js/lobibox.min.js"></script>
	<script src="../../../assets/plugins/notifications/js/notifications.min.js"></script>
	<script src="../../../assets/plugins/notifications/js/notification-custom-script.js"></script>
@endsection
