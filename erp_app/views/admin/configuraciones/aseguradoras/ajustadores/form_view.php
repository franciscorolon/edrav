<div class="modal-header clearfix text-left">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
</button>
    <h5><?=$HEADER_MODAL?></h5>
</div>
<div id="file-uploader" class="hidden"></div>
<div id="file-uploader-movil" class="hidden"></div>
<form role="form" method="post" action="<?=$URL_FORM?>" class="ajaxPostFormModal" data-function-success="refresh_datatable">
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
            <div class="col-md-6">
                <div class="form-group form-group-default">
                    <label for="Paterno">Paterno *</label>
                    <input name="paterno" class="form-control" value="<?= (isset($item) ? $item[0]['paterno'] : '') ?>"/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-group-default">
                    <label for="materno">Materno *</label>
                    <input name="materno" class="form-control" value="<?= (isset($item) ? $item[0]['materno'] : '') ?>"/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group form-group-default">
                    <label for="telefono">Teléfono *</label>
                    <input name="telefono" class="form-control" value="<?= (isset($item) ? $item[0]['telefono'] : '') ?>"/>
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group form-group-default">
                    <label for="email">Correo Electrónico *</label>
                    <input name="email" class="form-control" value="<?= (isset($item) ? $item[0]['email'] : '') ?>"/>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <input type="hidden" name="id_aseguradora" value="<?= (isset($item) ? $item[0]['id_aseguradora'] : $id_aseguradora) ?>"/>
        <input type="hidden" name="id" value="<?= (isset($item) ? $item[0]['id_ajustador'] : '') ?>"/>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</form>