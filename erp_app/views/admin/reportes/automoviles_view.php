<div class="card card-default no-print">
	<div class="card-body">
		<h5><b>Reporte de Automóviles</b></h5>
		<form role="form" method="post" action="<?=$url_form?>" class="ajaxPostForm" data-function-success="refresh_reporte">
			<div class="row">
				<div class="col">
					<div class="form-group">
						<label>Aseguradora</label>
						<select name="id_aseguradora" class="form-control">
							<?php foreach($aseguradoras as $index => $a):?>
								<?php if($index==0):?>
								<option value="<?=$index?>" selected><?=$a?></option>
								<?php else:?>
								<option value="<?=$index?>"><?=$a?></option>
								<?php endif;?>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="col">
					<div class="form-group">
						<label>Estado</label>
						<select name="status" class="form-control">
	                        <option value="0" selected>-- Todos --</option>
	                        <option value="VALUACION">En Valuación</option>
	                        <option value="REPARACION">En Reparación</option>
	                        <option value="RESGUARDO">En CVP2</option>
	                        <option value="TRANSITO">En Tránsito</option>
	                        <option value="ENTREGADO">Entregado</option>
	                        <option value="FACTURADO">Facturado</option>
	                        <option value="ARCHIVADO">Archivado</option>
	                        <option value="PERDIDAS">Perdidas Totales</option>
	                        <option value="DANOS">Pago de Daños</option>
						</select>
					</div>
				</div>
				<div class="col">
					<div class="form-group">
						<label>Rango de Fecha</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fa fa-calendar"></i></span>
							</div>
							<input type="text" name="rango" id="daterangepicker" class="form-control" />
                    	</div>
					</div>
				</div>
				<div class="col">
					<div class="form-group m-t-30">
						<button id="reset" class="btn btn-default" type="reset">Limpiar</button>
						<button class="btn btn-primary" type="submit">Generar</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="card card-transparent">
	<div class="card-body">
		<table id="table-automoviles" class="table">
			<thead>
				<tr>
					<th>No.Orden</th>
					<th>Estado</th>
					<th>No. Placas</th>
					<th>Marca</th>
					<th>Tipo</th>
					<th>Aseguradora</th>
					<th>Fecha Recepción</th>
					<th>Fecha Promesa/Entrega</th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
	</div>
</div>