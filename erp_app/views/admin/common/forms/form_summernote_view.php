<div class="modal-header bg-primary">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="myModalLabel"><?= $HEADER_MODAL ?></h4>
</div>
<form role="form" method="post" action="<?= $URL_FORM ?>" class="ajaxPostFormModalCK" data-function-success="<?= $FUNCION ?>">
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <div class="summernote-wrapper">
                        <div id="txtContenidoCK" name="txtContenidoCK" ><?= isset($VALOR)?$VALOR:''?></div>
                    </div>              
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <input type="hidden" name="id" value="<?= (isset($ID) ? $ID : '') ?>"/>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</form>
<script>
$(document).ready(function() {
   $('#txtContenidoCK').summernote();
});
</script>