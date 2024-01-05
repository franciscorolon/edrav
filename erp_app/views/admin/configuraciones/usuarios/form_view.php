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
            <div class="col-md-4">
                <div class="form-group form-group-default">
                    <label for="nombre">Nombre *</label>
                    <input name="nombre" class="form-control" value="<?= (isset($item) ? $item[0]['nombre'] : '') ?>"/>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group form-group-default">
                    <label for="paterno">Paterno *</label>
                    <input name="paterno" class="form-control" value="<?= (isset($item) ? $item[0]['paterno'] : '') ?>"/>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group form-group-default">
                    <label for="materno">Materno *</label>
                    <input name="materno" class="form-control" value="<?= (isset($item) ? $item[0]['materno'] : '') ?>"/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group form-group-default">
                    <label for="telefono2">Sexo</label>
                    <?php $sexo = ['FEMENINO' => 'Femenino', 'MASCULINO' => 'Masculino']?>
                    <?php $sex = (isset($item) ? $item[0]['sexo'] : '') ?>
                    <?=form_dropdown('sexo', $sexo, $sex, ['class' => 'form-control'])?>
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group form-group-default">
                    <label for="correo">Correo Electrónico</label>
                    <input name="correo" class="form-control" value="<?= (isset($item) ? $item[0]['correo'] : '') ?>"/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group form-group-default">
                    <label for="id_grupo">Tipo</label>
                    <?php $id_grupo = (isset($item) ? $item[0]['id_grupo'] : '') ?>
                    <?=form_dropdown('id_grupo', $grupos, $id_grupo, ['class' => 'form-control'])?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-group-default">
                    <label for="usuario">Nombre de Usuario</label>
                    <input name="usuario" class="form-control" autocomplete="off" value="<?= (isset($item) ? $item[0]['usuario'] : '') ?>" autocomplete="off"/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group form-group-default">
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" autocomplete="off" class="form-control" autocomplete="off" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-group-default">
                    <label for="confirmar_password">Confirmar Contraseña</label>
                    <input type="password" name="confirmar_password" autocomplete="off" class="form-control" autocomplete="off" />
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <input type="hidden" name="id" value="<?= (isset($item) ? $item[0]['id_usuario'] : '') ?>"/>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</form>