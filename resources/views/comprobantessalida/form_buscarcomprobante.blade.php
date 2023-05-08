
<div class="modal fade" id="modalBuscarComprobante" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Búsqueda de Comprobante 
                    <div class="spinner-border" role="status" id="spinner_buscar_comprobante" style="position: absolute" hidden>
                    </div>
                </h5>
                
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <div class="row">
                    <div class="col-md-3">
                        <label for="">N° Comprobante</label>
                        <input type="text" class="form-control" id="modal_nrocomprobante">
                    </div>
                    
                    <div class="col-md-9">
                        <label for="">Nombre Empresa</label>
                        <input type="text" class="form-control" id="modal_nombreempresa">
                    </div>
                </div>
                
                <table class="table table-stripped table-hover" id="modal_DTComprobante">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Selecc.</th>
                            <th>N° Comp.</th>
                            <th>Fecha</th>
                            <th>Nombre Empresa</th>
                            <th>Importe</th>
                            <th>N° SIAF</th>
                            <th>Fte. Fmto.</th>
                            <th>Folios</th>
                            <th>Estante</th>
                            <th>Paquete</th>
                        </tr>
                    </thead>
                    <tbody>
                
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

