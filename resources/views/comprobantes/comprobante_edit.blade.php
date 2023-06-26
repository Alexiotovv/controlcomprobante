
<div class="modal fade" id="modalEditarComprobante" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Comprobante 
                    <div class="spinner-border" role="status" id="spinner_guardar" style="position: absolute" hidden>
                    </div>
                </h5>
                
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="frmEditComprobante">@csrf
                    <div class="row">
                        <div class="col-md-2">
                            <input type="text"id="idComprobante" name="idComprobante" hidden>
                            <label for="">Número</label>
                            <input type="text" class="form-control" maxlength="50" id="numero" name="numero" required>
                        </div>
                        <div class="col-md-2">
                            <label for="">Fecha</label>
                            <input type="date" class="form-control" id="fecha" name="fecha">
                        </div>
                        <div class="col-md-4">
                            <label for="">Nombre</label>
                            <input type="text" class="form-control" maxlength="250" id="nombre" name="nombre" required>
                        </div>
                        <div class="col-md-2">
                            <label for="">Importe</label>
                            <input type="number" step="0.01" class="form-control" id="importe" name="importe" required>
                        </div>
                        <div class="col-md-2">
                            <label for="">SIAF</label>
                            <input type="number" class="form-control" maxlength="50" id="siaf" name="siaf" required>
                        </div>
                        <div class="col-md-2">
                            <label for="">Fte. Fmto.</label>
                            <input type="number" class="form-control" maxlength="20" id="fuentefto" name="fuentefto">
                        </div>
                        <div class="col-md-2">
                            <label for="">Folio.</label>
                            <input type="number" class="form-control" maxlength="20" id="folios" name="folios">
                        </div>
                        <div class="col-md-2">
                            <label for="">Estante</label>
                            <input type="number" class="form-control" maxlength="50" id="estante" name="estante">
                        </div>
                        <div class="col-md-2">
                            <label for="">Paquete</label>
                            <input type="number" class="form-control" maxlength="50" id="paquete" name="paquete">
                        </div>
                
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <br>
                            <button type="submit" class="btn btn-primary" id="btnActualizarComprobante">Guardar</button>
                        </div>
                    </div>
                
                </form>
            </div>
        </div>
    </div>
</div>



