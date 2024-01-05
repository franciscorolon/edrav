<div class="modal-header clearfix text-left">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
</button>
    <h5><?=$HEADER_MODAL?></h5>
</div>
<div id="file-uploader" class="hidden"></div>
<div id="file-uploader-movil" class="hidden"></div>
<form role="form" method="post" action="<?=$URL_FORM?>" class="ajaxPostFormModal" data-function-success="recargar_tabla">
    <div class="modal-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-sm-6 col-form-label">No. Orden</label>
                    <div class="col-sm-6">
                        <?=form_dropdown('id_orden',$ordenes,['-1'],['class' => 'form-control', 'id' => 'id_orden']);?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-sm-6 col-form-label">No. Recibo</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control plaintext text-right red" id="no_recibo" readonly="" aria-required="true" value="<?=$no_recibo?>">
                        <input type="hidden" name="no_recibo" value="<?=$no_recibo?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group row" id="placas-group" style="display:none">
                    <label class="col-sm-6 col-form-label">Placas</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control plaintext red" id="placas" readonly="" value="">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-sm-6 col-form-label" for="fecha">Fecha</label>
                    <div class="col-sm-6">
                        <input type="text" name="fecha" class="form-control plaintext text-right black" readonly="" aria-required="true" value="<?=date('d-m-Y')?>" />
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group" id="auto-group" style="display:none">
                    <label for="auto">Auto *</label>
                    <input type="text" class="form-control plaintext red" id="auto" readonly="" aria-required="true" value="">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="recibimos_de">Recibimos de <span class="required"></span></label>
                    <input name="recibimos_de" class="form-control" value=""/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="cantidad">Cantidad <span class="required"></span></label>
                    <input name="cantidad" type="text" data-a-sign="$ " class="autonumeric form-control text-right"/>
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label for="concepto">Concepto <span class="required"></span></label>
                    <input name="concepto" class="form-control" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="cantidad">Forma de Pago <span class="required"></span></label>
                    <select class="form-control" name="forma_pago">
                        <option value="" disabled selected>-- seleccione --</option>
                        <option value="EFECTIVO">Efectivo</option>
                        <option value="TRANSFERENCIA">Transferencia</option>
                        <option value="TARJETA">Tarjeta de Débito/Crédito</option>
                        <option value="CHEQUE">Cheque</option>
                    </select>
                </div>
            </div>
            <div class="col-md-8">
                <input type="checkbox" id="factura" name="factura">
                <label for="factura">Factura</label>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</form>