<div class="modal-header clearfix text-left">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i></button>
    <h5><?=$HEADER_MODAL?></h5>
</div>
<form role="form" method="post" action="<?=$URL_FORM?>" class="ajaxPostFormModal" data-function-success="exito_correo">
    <div class="modal-body">
	    <div class="row">
	    <?php foreach($items as $i):?>
            <div class="col-md-6">
                <input type="checkbox" id="correo_<?=$i['id_correo']?>" name="correo_<?=$i['id_correo']?>">
                <label for="correo_<?=$i['id_correo']?>"><?=$i['email']?></label>
            </div>
        <?php endforeach; ?>
            <div class="col-md-6">
                <input type="checkbox" id="chk_otro" name="chk_otro">
                <label for="chk_otro">Otro(s)</label>
                <div class="otro-group" style="display:none">
                <input type="text" name="otro" id="otro" class="form-control" value=""><br/>
                <small class="hint">Ingrese uno o varios correos separados por comas.</small>
                </div>
            </div>
        </div>
        <input type="hidden" name="id_orden" value="<?=$id_orden?>">
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</form>