
<div class="modal fade" id="modalCliente" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <h5 id="etiquetaCliente">-</h5>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="" id="frmCliente">@csrf
                    <div class="row">
                        <div class="col-md-12">
                            <br>
                            <input type="text" id="idCliente" name="idCliente" hidden>
                            <label for="">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                            <br>
                            <button type="submit" class="btn btn-primary" id="btnGuardarCliente">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>