<div class="modal-header clearfix text-left">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
</button>
    <h5><?=$HEADER_MODAL?></h5>
</div>
<form id="upload-file"  method="post" action="<?=base_url('apis/admin_api/upload_tmp_image')?>" class="ajaxPostForm"  style="display:none" data-function-success="recargar_imagen">
    <input type="file" id="tmp-image" name="image" accept="image/*" />
    <input type="submit">
</form>
<form role="form" method="post" action="<?= $URL_FORM ?>" class="ajaxPostFormModal" data-function-success="refresh_datatable">
    <div class="modal-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="color">LOGO *</label>
                    <input id="logo" name="logo" type="hidden" value="<?= (isset($item) ? $item[0]['logo'] : '') ?>"/>
                    <p class="text-center">
                    <a href="#" class="upload-image">
                        <img id="img_image" class="img-responsive img-thumbnail" src="<?php
                        if (isset($item) && $item[0]['logo'] != '')
                            echo base_url(MARCAS_FOLDER.$item[0]['logo']);
                        else
                            echo 'http://placehold.it/160x90';
                        ?>" />
                    </a>
                    </p>
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label for="Nombre">Nombre *</label>
                    <input name="nombre" class="form-control" value="<?= (isset($item) ? $item[0]['nombre'] : '') ?>"/>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="descripcion">Descripción </label>
                    <textarea name="descripcion" class="form-control"><?= (isset($item) ? $item[0]['descripcion'] : '') ?></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <input type="hidden" name="id" value="<?= (isset($item) ? $item[0]['id_marca'] : '') ?>"/>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</form>