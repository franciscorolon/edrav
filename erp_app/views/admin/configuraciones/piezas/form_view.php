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
                    <label for="nombre_comercial">Nombre Comercial *</label>
                    <input name="nombre_comercial" class="form-control" value="<?= (isset($item) ? $item[0]['nombre_comercial'] : '') ?>"/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group form-group-default" >
                    <label for="id_categoria_parte">Parte del Automóvil *</label>
                    <?php $id_categoria_parte = isset($item) ? $item[0]['id_categoria_parte'] : '';?>
                    <?php echo form_dropdown('id_categoria_parte', $partes, $id_categoria_parte, ['class' => 'full-width form-control', 'data-init-plugin' => "select2"  ]); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group form-group-default">
                    <label for="tiempo_promedio">Tiempo Promedio Reparación (mins)</label>
                    <input type="number" min="1" max="100" name="tiempo_promedio" class="form-control" value="<?= (isset($item) ? $item[0]['tiempo_promedio'] : '') ?>"/>
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
        <input type="hidden" name="id" value="<?= (isset($item) ? $item[0]['id_parte_coche'] : '') ?>"/>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</form>