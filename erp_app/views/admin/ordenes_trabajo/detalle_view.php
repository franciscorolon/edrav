<div class="modal-header clearfix text-left">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
</button>
    <h5><?=$HEADER_MODAL?></h5>
</div>
<form role="form" method="post" action="<?= $URL_FORM ?>" class="ajaxPostFormModal" data-function-success="refresh_detalles">
    <div class="modal-body">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="id_parte_automovil">Parte del Automóvil *</label>
                    <?=form_dropdown('id_parte_automovil', $categorias, '', ['class' => 'full-width form-control', 'id' => 'id_parte_automovil' ]); ?>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="id_parte_coche">Pieza del Automóvil *</label>
                    <?=form_multiselect('id_parte_coche', '', '', ['class' => 'full-width form-control disabled', 'id' => 'id_parte_coche' ]); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="id_trabajo">Trabajo *</label>
                    <?=form_dropdown('id_trabajo', $servicios, '', ['class' => 'full-width form-control', 'id' => 'id_trabajo' ]); ?>
                </div>
            </div>
        </div>
        <?php $i = 1;?>
        <?php $ar = array_chunk($areas, 2);?>
        <?php foreach($ar as $col):?>
            <div class="row">
            <?php foreach($col as $a):?>
                <div class="col-12 col-md-6">
                    <div class="from-group">
                        <div class="checkbox check-success">
                            <input type="checkbox" value="<?=$a['id_area']?>" id='area_<?=$i?>' name="area[]">
                            <label for="area_<?=$i?>"><?=$a['nombre']?></label>
                        </div>
                    </div>
                </div>
            <?php $i++;?>
            <?php endforeach;?>
            </div>
        <?php endforeach; ?>
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="id_tipo_pintura">Cobertura de Pintura *</label>
                    <?=form_dropdown('id_tipo_pintura', $tipo_pinturas, '-1', ['class' => 'full-width form-control', 'id' => 'id_tipo_pintura' ]); ?>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="id_material_especial">Materiales Especiales *</label>
                    <?=form_dropdown('id_material_especial', $materiales, '-1', ['class' => 'full-width form-control', 'id' => 'id_material_especial' ]); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="comentarios">Comentarios</label>
                    <textarea name="comentarios" class="form-control" value=""></textarea>
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
