<?php $id_grupo = $this->session->userdata('id_grupo'); ?>
<div class="card card-transparent">
	<div class="card-header">
		<div class="row">
			<div class="col-md-6">
				<h1 class="h4"><?=$header?></h1>
			</div>
			<div class="col-md-6">
				<div class="pull-right">
					<?php if( $id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == CLIENTES_AVANZADO): ?>
					<a href="<?= $url_agregar?>" class="btn btn-primary"><i class="fa fa-plus"></i> Nueva factura</a>
					<?php endif;?>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="card-block card-margin-top-2">
		<div class="row">
			<div class="col">
				<div id="flash-message" class="alert hide" role="alert"><?=isset($message)?$message:'';?></div>
			</div>
		</div>
		<!-- START card -->
		<div class="card card-borderless">
			<ul class="nav nav-tabs nav-tabs-simple d-none d-md-flex d-lg-flex d-xl-flex">
				<li class="nav-item">
					<a class="active" data-toggle="tab" role="tab" data-target="#tabTodas">Todas</a>
				</li>
				<li class="nav-item">
					<a data-toggle="tab" role="tab" data-target="#tabPendiente">Pendiente</a>
				</li>
				<li class="nav-item">
					<a data-toggle="tab" role="tab" data-target="#tabValidacion">Validación</a>
				</li>
				<li class="nav-item">
					<a data-toggle="tab" role="tab" data-target="#tabBanco">Banco</a>
				</li>
				<li class="nav-item">
					<a data-toggle="tab" role="tab" data-target="#tabCaja">Caja</a>
				</li>
				<li class="nav-item">
					<a data-toggle="tab" role="tab" data-target="#tabPagado">Pagado</a>
				</li>
				<!--<li class="nav-item">
					<a data-toggle="tab" role="tab" data-target="#tabPagado">Pagado</a>
				</li>-->
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tabTodas">
					<div class=" container-fluid container-fixed-lg">
						<div class="card card-transparent">
							<div class="card-header">
								<div class="pull-right">
									<div class="col-xs-12">
										<input type="text" id="search-todas" class="form-control pull-right" placeholder="Buscar Factura">
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="card-body">
								<table class="table table-hover table-responsive-block" id="datatable_todas">
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
					</div>
				</div>
			</div>
		</div>
	</div>
</div>