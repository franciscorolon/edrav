<div class="card card-default no-print">
	<div class="card-body">
		<h5><b>Reporte de Recibos</b></h5>
		<form role="form" method="post" action="<?=$url_form?>" class="ajaxPostForm" data-function-success="refresh_recibos">
		<div class="row">
			<div class="col">
				<div class="form-group">
					<label>Forma de Pago</label>
					<select name="forma" class="form-control">
						<option value="0" selected>-- Todas --</option>
						<option value="EFECTIVO">Efectivo</option>
						<option value="TRANSFERENCIA">Transferencia</option>
						<option value="TARJETA">Tarjeta</option>
                        <option value="CHEQUE">Cheque</option>
					</select>
				</div>
			</div>
			<div class="col">
				<div class="form-group">
					<label>Rango de Fecha</label>
					<div class="input-daterange input-group">
						<input type="text" class="input-sm form-control" name="start" autocomplete="off">
						<div class="input-group-addon">a</div>
						<input type="text" class="input-sm form-control" name="end" autocomplete="off">
					</div>
				</div>
			</div>
			<div class="col">
				<div class="form-group m-t-30">
					<button class="btn btn-default" type="reset">Limpiar</button>
					<button class="btn btn-primary" type="submit">Generar</button>
				</div>
			</div>
		</div>
		</form>
	</div>
</div>
<div class="card card-transparent">
	<div class="card-body">
		<table id="table-recibos" class="table">
			<thead>
				<tr>
                    <th>No.Recibo</th>
                    <th>No.Orden</th>
                    <th>Fecha</th>
                    <th>Forma Pago</th>
                    <th>Cantidad</th>
                    <th>Factura</th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
	</div>
</div>