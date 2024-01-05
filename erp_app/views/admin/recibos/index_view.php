<!-- START card -->
<?php $id_grupo = $this->session->userdata('id_grupo'); ?>
<div class="card card-transparent">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h1 class="h4"><?=$header?></h1>
            </div>
            <div class="col-md-6">
                <div class="pull-right">
                    <?php if( $id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == CLIENTES_AVANZADO || $id_grupo == CLIENTES_BASICO ): ?>
                    <a href="<?= $url_agregar ?>" class="show-modal btn btn-primary btn-cons"><i class="fa fa-plus"></i> Nuevo Recibo</a>
                    <?php endif; ?>
                    <button id="recargar-recibo" class="btn btn-default"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div id="flash-message" class="alert hide" role="alert"><?=isset($message)?$message:'';?></div>
    </div>
    <div class="card-block">
        <table class="table table-hover table-responsive-block" id="recibo-datatable">
            <thead>
                <tr>
                    <th></th>
                    <th>No.Recibo</th>
                    <th>No.Orden</th>
                    <th>Fecha</th>
                    <th>Forma Pago</th>
                    <th>Cantidad</th>
                    <th>Factura</th>
                    <?php if (!$this->session->userdata('id_usuario') || ($this->session->userdata('id_grupo') == SUPER_ADMINISTRADOR) ){?>
                    <th></th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
