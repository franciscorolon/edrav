<div class="modal-header clearfix text-left">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
</button>
    <h5><?=$HEADER_MODAL?></h5>
</div>
<div id="file-uploader" class="hidden"></div>
<div id="file-uploader-movil" class="hidden"></div>
<form role="form" method="post" action="<?=$URL_FORM?>" class="ajaxPostFormModal" data-function-success="refresh_ticket">
    <div class="modal-body">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="fecha_fin">Fecha de Termino <span class="required"></span></label>
                    <input type="datetime-local" class="form-control" name="fecha_fin" value="<?=date('Y-m-d\TH:i')?>" />
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <input type="hidden" name="id" value="<?=$item[0]['id_ticket']?>"/>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</form>
