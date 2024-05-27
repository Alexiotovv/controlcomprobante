
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
                <form action="{{route('comprobantes.update')}}" id="frmEditComprobante" method="POST" enctype="multipart/form-data">@csrf
                    <div class="row">
                        <div class="col-md-2">
                            <input type="text"id="idComprobante" name="idComprobante" hidden>
                            <label for="">Número</label>
                            <input type="text" value="-" class="form-control" maxlength="50" id="edit_numero" name="edit_numero" required>
                        </div>
                        <div class="col-md-2">
                            <label for="">Fecha</label>
                            <input type="date" class="form-control" id="edit_fecha" name="edit_fecha">
                        </div>
                        <div class="col-md-4">
                            <label for="">Nombre</label>
                            <input type="text" value="-" class="form-control" maxlength="250" id="edit_nombre" name="edit_nombre" required>
                        </div>
                        <div class="col-md-2">
                            <label for="">Importe</label>
                            <input type="number" step="0.01" class="form-control" id="edit_importe" name="edit_importe" required>
                        </div>
                        <div class="col-md-2">
                            <label for="">SIAF</label>
                            <input type="text" class="form-control" maxlength="50" id="edit_siaf" name="edit_siaf" required>
                        </div>
                        <div class="col-md-2">
                            <label for="">Fte. Fmto.</label>
                            <input type="text" class="form-control" maxlength="20" id="edit_fuentefto" name="edit_fuentefto">
                        </div>
                        <div class="col-md-2">
                            <label for="">Folio.</label>
                            <input type="text" class="form-control" maxlength="20" id="edit_folios" name="edit_folios" placeholder="000-000">
                        </div>
                        <div class="col-md-2">
                            <label for="">Estante</label>
                            <input type="text" value="-" class="form-control" maxlength="50" id="edit_estante" name="edit_estante">
                        </div>
                        <div class="col-md-2">
                            <label for="">Paquete</label>
                            <input type="text" value="-" class="form-control" maxlength="50" id="edit_paquete" name="edit_paquete">
                        </div>
                        <div class="col-md-4">
                            <label for="">Adjuntar + Documentos</label>
                            <input type="file" class="form-control" maxlength="50" id="edit_archivos" name="edit_archivos[]" accept=".pdf" multiple>
                            <div id="archivos-seleccionados">
                            </div>
                        </div>


                        <div class="col-md-2">
                            <label for="">ItemFile</label>
                            <input type="text" class="form-control" value="0" name="edit_itemfile" id="edit_itemfile">    
                        </div>
                        <div class="col-md-2">
                            <label for="">TipoDocumento</label>
                            <input type="text" class="form-control" name="edit_tipodocumento" id="edit_tipodocumento">    
                        </div>
                        <div class="col-md-2">
                            <label for="">Medio</label>
                            <input type="text" class="form-control" name="edit_medio" id="edit_medio">    
                        </div>
                       
                        <div class="col-md-2">
                            <label for="">Estado</label>
                            <input type="text" class="form-control" name="edit_estado" id="edit_estado">    
                        </div>
                        <div class="col-md-2">
                            <label for="">Año Inventario</label>
                            <input type="number" class="form-control" name="edit_anhoinventario" id="edit_anhoinventario">    
                        </div>
                        <div class="col-md-2">
                            <label for="">RO/FIDEI</label>
                            <input type="text"  class="form-control" name="edit_rofidei" id="edit_rofidei">
                        </div>
                        <div class="col-md-4">
                            <label for="">Descripción</label>
                            <textarea name="edit_descripcion" id="edit_descripcion" cols="20" rows="5" class="form-control">-</textarea>
                        </div>
                        <div class="col-md-4">
                            <label for="">Observación</label>
                            <textarea name="edit_observacion" id="edit_observacion" cols="20" rows="5" class="form-control">-</textarea>
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



