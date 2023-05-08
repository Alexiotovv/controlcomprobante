

<div class="modal fade" id="modalDevolucion" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Devolución de Comprobante </h5>
                
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                        <form action="" id="frmDevolucion">@csrf
                            <div class="row">
                                <input type="text" class="form-control" id="idSalida" name="idSalida" hidden>
                                <div class="col-md-6">
                                    <label for="">Fecha Devolución</label>
                                    <input type="date" class="form-control" id="fecha_devolucion" name="fecha_devolucion">
                                </div>
                                <div class="col-md-6">
                                    <label for="">Hora Devolución</label>
                                    <input type="time" class="form-control"  id="hora_devolucion" name="hora_devolucion">
                                </div>
                                <div class="col-md-12">
                                    <label for="">Comentario</label>
                                    <textarea type="text" class="form-control" maxlength="250"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <br>
                                    <a class="btn btn-primary" id="btnGuardarDevolucion">Guardar</a>
                                </div>
                            </div>
                            
                
                        </form>

            </div>
        </div>
    </div>
</div>


