
<div class="modal fade" id="modalEditarSalidaComprobante" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Salida de Comprobante 
                    <div class="spinner-border" role="status" id="spinner_guardar" style="position: absolute" hidden>
                    </div>
                </h5>
                
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="frmEditSalidaComprobante">@csrf   
                    <div class="row">
                        <div class="col-md-2">
                            <label for="">Nro.Cargo</label>
                            <input type="text" id="idSalidaComprobante" name="idSalidaComprobante" hidden>
                            <input type="number" class="form-control " name="nro_cargo" id="nro_cargo" required style="font-weight: 800">
                        </div>
                        <div class="col-md-2">
                            <label for="">Nro. Oficio</label>
                            <input type="number" class="form-control " name="nro_oficio" id="nro_oficio" required>
                        </div>
                        <div class="col-md-2">
                            <label for="">Folio(s)</label>
                            <input type="text" class="form-control" name="cant_folios" id="cant_folios" placeholder="000-000" required>
                        </div>
                        <div class="col-md-2">
                            <label for="">Fecha Salida</label>
                            <input type="date" class="form-control" name="fecha_salida" id="fecha_salida" disabled>
                        </div>
                        <div class="col-md-2">
                            <label for="">Hora Salida</label>
                            <input type="time" class="form-control" name="hora_salida" id="hora_salida" disabled>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <br>
                                <button type="submit" id="btnActualizasSalidaComprobante" class="btn btn-primary">Guardar</button>
                                    <div class="spinner-border" role="status" id="spinner_guardar" hidden>
                                </div>
                            </div>  
                        </div>
                
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>

