<div class="modal-header clearfix text-left">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
</button>
    <h5><?=$HEADER_MODAL?></h5>
</div>
<div id="file-uploader" class="hidden"></div>
<div id="file-uploader-movil" class="hidden"></div>
<form role="form" method="post" action="<?=$URL_FORM?>" class="ajaxPostFormModal" data-function-success="update_status">
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="status">Estado *</label>
                    <?=form_dropdown('status', $estados, $item[0]['status'], ['class' => 'form-control full-width', 'required' => '']);?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="incidencia">Incidencia *</label>
                    <textarea name="incidencia" class="form-control" />
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <input type="hidden" name="id_orden" value="<?=$item[0]['id_orden']?>"/>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Cambiar</button>
    </div>
</form>