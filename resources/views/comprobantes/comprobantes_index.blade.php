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

        <form action="{{route('comprobantes.index')}}" >
            <div class="row">
                <div class="col-md-2">
                    <label for="">N° Comp</label>
                    <input type="text" class="form-control" maxlength="100" value="{{$num}}" id="numero_comprobante" name="numero_comprobante">
                </div>
                <div class="col-md-2">
                    <label for="">Nombre</label>
                    <input type="text" class="form-control" maxlength="250" value="{{$nom}}" id="nombre_comprobante" name="nombre_comprobante">
                </div>
                <div class="col-md-2">
                    <label for="">Estante</label>
                    <input type="text" class="form-control" maxlength="50" value="{{$est}}" id="estante_comprobante" name="estante_comprobante">
                </div>
                <div class="col-md-2">
                    <label for="">Paquete</label>
                    <input type="text" class="form-control" maxlength="50" value="{{$paq}}" id="paquete_comprobante" name="paquete_comprobante">
                </div>
                <div class="col-md-2">
                    <label for="">N° Siaf</label>
                    <input type="text" class="form-control" value="{{$siaf}}" maxlength="50" id="siaf_comprobante" name="siaf_comprobante">
                </div>
                <div class="col-md-2">
                    <label for="">Año Inventario</label>
                    <input type="text" placeholder="2024" class="form-control" value="{{$anoinv}}" maxlength="20" id="anoinv_comprobante" name="anoinv_comprobante">
                </div>
                <div class="col-md-2">
                    <br>
                    <button class="btn btn-primary" id="btnFiltrarComprobantes">Filtrar</button>
                    <div class="spinner-border" role="status" id="spinner_filtrar_comprobantes" style="position: absolute" hidden>
                    </div>
                </div>
                
        </form>
                <table class="table table-striped" id="DTComprobantes">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Acciones</th>
                            <th>Archivos</th>
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
                        @foreach ($comprobantes as $c)
                            <tr>
                                <td>{{$c->id}}</td>
                                <td>
                                    <a class="btn btn-warning btn-sm btnEditarComprobante"><i class="lni lni-pencil-alt"></i></a>
                                </td>
                                <td>
                                    @foreach ($archivos as $a)
                                        @if ($a->id_comprobantes==$c->id)
                                            <table>
                                                <tbody>

                                                    <tr>
                                                        <td style="visibility: hidden">{{$a->id}}</td>
                                                        <td><a target="_blank" href="{{asset('storage/comprobantes/'.$a->nombrearchivo)}}">{{$a->nombrearchivo}}</a></td>
                                                        <td>
                                                            <a class="btnModalEliminarArchivo">
                                                                <i class="lni lni-cross-circle"></i>
                                                            </a>
                                                        </td>

                                                    </tr>
                                                </tbody>
                                            </table>
                                            <br>
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{$c->numero}}</td>
                                <td>{{$c->fecha}}</td>
                                <td>{{$c->nombre}}</td>
                                <td>{{$c->importe}}</td>
                                <td>{{$c->siaf}}</td>
                                <td>{{$c->fuentefto}}</td>
                                <td>{{$c->folios}}</td>
                                <td>{{$c->estante}}</td>
                                <td>{{$c->paquete}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <nav aria-label="Page navigation example">

                    <!-- En tu vista Blade -->
            @if ($comprobantes->hasPages())
            <ul class="pagination">
                <!-- Botón para ir a la página anterior -->
                <li class="page-item {{ $comprobantes->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $comprobantes->previousPageUrl() }}" rel="prev">Anterior</a>
                </li>

                <!-- Enlace a la primera página -->
                <li class="page-item {{ $comprobantes->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $comprobantes->url(1) }}">1</a>
                </li>

                <!-- Enlaces a las páginas intermedias -->
                @for ($i = 2; $i < $comprobantes->lastPage(); $i++)
                    <li class="page-item {{ $comprobantes->currentPage() == $i ? 'active' : '' }}">
                        <a class="page-link" href="{{ $comprobantes->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor

                <!-- Enlace a la última página -->
                <li class="page-item {{ $comprobantes->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $comprobantes->url($comprobantes->lastPage()) }}">
                        {{ $comprobantes->lastPage() }}
                    </a>
                </li>

                <!-- Enlace a la página siguiente -->
                <li class="page-item {{ $comprobantes->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $comprobantes->nextPageUrl() }}" rel="next">Siguiente</a>
                </li>
            </ul>
            @endif



                </nav>

            </div>
        
    </div>
</div>

@include('comprobantes.comprobante_edit')
@include('comprobantes.modal_eliminar')

@endsection

@section('extra_js')
    <script>
        $(document).on("click",".btnEditarComprobante",function (e){
            e.preventDefault();
            fila = $(this).closest("tr");
            id= (fila).find('td:eq(0)').text();
            
            $("#idComprobante").val(id);
            $.ajax({
                type: "GET",
                url: "/comprobantes/edit/"+id,
                dataType: "json",
                success: function (response) {
                    
                    $("#edit_numero").val(response.numero);
                    $("#edit_nombre").val(response.nombre);
                    $("#edit_importe").val(response.importe);
                    $("#edit_fecha").val(response.fecha);
                    $("#edit_siaf").val(response.siaf);
                    $("#edit_fuentefto").val(response.fuentefto);
                    $("#edit_folios").val(response.folios);
                    $("#edit_estante").val(response.estante);
                    $("#edit_paquete").val(response.paquete);

                    $("#edit_itemfile").val(response.itemfile);
                    $("#edit_tipodocumento").val(response.tipodocumento);
                    $("#edit_medio").val(response.medio);
                    $("#edit_estado").val(response.estado);
                    $("#edit_anhoinventario").val(response.anhoinventario);
                    $("#edit_rofidei").val(response.rofidei);
                    $("#edit_descripcion").text(response.descripcion);
                    $("#edit_   observacion").text(response.observacion);
                }
            });
            $("#modalEditarComprobante").modal('show');

        });


        var archivosSeleccionados = [];
    
        $('#archivos').change(function() {
            $('#archivos-seleccionados').empty();
            
            archivosSeleccionados = [];
            archivosSeleccionados = $(this)[0].files;
            
            for (var i = 0; i < archivosSeleccionados.length; i++) {
    
                var nombreArchivo = $('<label>').text(archivosSeleccionados[i].name);
    
                $('#archivos-seleccionados').append(nombreArchivo);
                $('#archivos-seleccionados').append('<br>');
            }
        });



        $(document).on("click",".btnModalEliminarArchivo",function (e){
            e.preventDefault();
            fila = $(this).closest("tr");
            id= (fila).find('td:eq(0)').text();
            $("#id_archivo").val(id);
            $("#modalEliminarArchivo").modal('show')
        });
        
        $("#btnEliminarArchivo").on("click",function (e) { 
            e.preventDefault();
            
            $.ajax({
                type: "GET",
                url: "/archivos/destroy/"+$("#id_archivo").val(),
                dataType: "json",
                success: function (response) {
                    $("#modalEliminarArchivo").modal('hide');
                    location.reload()
                }
            });

        });
        
       
        

    </script>
    <script src="../../../assets/plugins/notifications/js/lobibox.min.js"></script>
	<script src="../../../assets/plugins/notifications/js/notifications.min.js"></script>
	<script src="../../../assets/plugins/notifications/js/notification-custom-script.js"></script>
@endsection
