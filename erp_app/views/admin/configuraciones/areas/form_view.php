<div class="modal-header clearfix text-left">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
</button>
    <h5><?=$HEADER_MODAL?></h5>
</div>
<div id="file-uploader" class="hidden"></div>
<div id="file-uploader-movil" class="hidden"></div>
<form role="form" method="post" action="<?= $URL_FORM ?>" class="ajaxPostFormModal" data-function-success="refresh_datatable">
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group form-group-default">
                    <label for="nombre">Nombre *</label>
                    <input name="nombre" class="form-control" value="<?= (isset($item) ? $item[0]['nombre'] : '') ?>"/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group form-group-default">
                    <label for="descripcion">Descripción</label>
                    <textarea name="descripcion" class="form-control" value=""><?= (isset($item) ? $item[0]['descripcion'] : '') ?></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <input type="hidden" name="id" value="<?= (isset($item) ? $item[0]['id_area'] : '') ?>"/>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</form>
