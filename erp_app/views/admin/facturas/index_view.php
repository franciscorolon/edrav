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
                    <?php if( $id_grupo == PROVEEDOR ): ?>
                    <a href="<?= $url_agregar ?>" class="btn btn-primary btn-cons"><i class="fa fa-plus"></i> Nueva Factura</a>
                    <?php endif; ?>
                    <button id="recargar-facturas" class="btn btn-default"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div id="flash-message" class="alert hide" role="alert"><?=isset($message)?$message:'';?></div>
    </div>
    <div class="card-block">
        <table class="table table-hover table-responsive-block" id="datatable_facturas">
            <thead>
                <tr>
                    <th></th>
                    <th>Método de Pago</th>
                    <th>Folio</th>
                    <th>Total</th>
                    <th>Fecha</th>
                    <th>Pagado</th>
					<th>Status</th>
					<th></th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>