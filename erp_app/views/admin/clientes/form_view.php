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
            <div class="col-md-4">
                <div class="form-group">
                    <?=form_checkbox('empresa', 'empresa', isset($item) ? $item[0]['empresa'] : '', ['id' => 'empresa']);?>
                    <label for="empresa">Empresa *</label>
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label for="nombre">Nombre *</label>
                    <input name="nombre" class="form-control" value="<?= (isset($item) ? $item[0]['nombre'] : '') ?>"/>
                </div>
            </div>

        </div>
        <div class="row apellidos" <?=(isset($item) && $item[0]['empresa'] == '1')?'style="display:none"':''?>>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="Paterno">Paterno *</label>
                    <input name="paterno" class="form-control" value="<?= (isset($item) ? $item[0]['paterno'] : '') ?>"/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="materno">Materno *</label>
                    <input name="materno" class="form-control" value="<?= (isset($item) ? $item[0]['materno'] : '') ?>"/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="fecha_nacimiento">Fecha Nacimiento *</label>
                    <div class="input-group col-md-12 p-l-0">
                        <input type="text" name="fecha_nacimiento" class="form-control date" value="<?= (isset($item) ? date('d/m/Y',strtotime($item[0]['fecha_nacimiento'])) : '') ?>">
                        <span class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="telefono_1">Teléfono 1</label>
                    <input name="telefono_1" class="form-control" value="<?= (isset($item) ? $item[0]['telefono_1'] : '') ?>"/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="telefono2">Teléfono 2</label>
                    <input name="telefono_2" class="form-control" value="<?= (isset($item) ? $item[0]['telefono_2'] : '') ?>"/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="celular">Celular *</label>
                    <input name="celular" class="form-control" value="<?= (isset($item) ? $item[0]['celular'] : '') ?>"/>
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label for="email">Correo Electrónico *</label>
                    <input name="email" class="form-control" value="<?= (isset($item) ? $item[0]['email'] : '') ?>"/>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <input type="hidden" name="id" value="<?= (isset($item) ? $item[0]['id_cliente'] : '') ?>"/>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</form>