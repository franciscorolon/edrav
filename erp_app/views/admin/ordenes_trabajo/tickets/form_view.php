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
                <div class="form-group row">
                    <label for="id_guardia">Guardia <span class="required"></span></label>
                    <?=$id_guardia = (isset($item)?$item['id_guardia']:'')?>
                    <?=form_dropdown('id_guardia', $guardias, $id_guardia, ['id' => 'id_guardia', 'class' => 'form-control full-width', 'required' => '']);?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="id_tecnico">Técnico <span class="required"></span></label>
                    <?=$id_tecnico = (isset($item)?$item['id_tecnico']:'')?>
                    <?=form_dropdown('id_tecnico', $tecnicos, $id_tecnico, ['id' => 'id_tecnico', 'class' => 'form-control full-width', 'required' => '']);?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="fecha_inicio">Fecha de Inicio <span class="required"></span></label>
                    <input type="datetime-local" class="form-control" name="fecha_inicio" value="<?=date('Y-m-d\TH:i')?>" />
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <input type="hidden" name="tipo_golpe" value="<?= (isset($item) ? $item[0]['tipo_golpe'] : $tipo_golpe) ?>"/>
        <input type="hidden" name="id" value="<?= (isset($item) ? $item[0]['id_ticket'] : '') ?>"/>
        <input type="hidden" name="id_orden_trabajo" value="<?= (isset($item) ? $item[0]['id_orden_trabajo'] : $id_orden_trabajo) ?>"/>
        <input type="hidden" name="id_area" value="<?= (isset($item) ? $item[0]['id_area'] : $id_area) ?>"/>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</form>
