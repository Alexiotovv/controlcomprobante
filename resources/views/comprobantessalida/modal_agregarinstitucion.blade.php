<div class="modal fade" id="modalAgregarInstitucion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="frmAgregarInstitucion" method="POST">@csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Institución</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="">Ingrese Nombre de Institución</label>
                    <input type="text" class="form-control" name="nombreInstitucion" maxlength="100">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
                    <button type="button" class="btn btn-primary" id="btnGuardarInstitucion">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>