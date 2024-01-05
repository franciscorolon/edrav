<script type="text/javascript" src="<?=base_url('assets/plugins/jquery-datatable/media/js/jquery.dataTables.min.js')?>"></script>
<script type="text/javascript" src="<?=base_url('assets/plugins/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js')?>"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js""></script>


<script type="text/javascript" src="<?=base_url('assets/plugins/jquery-datatable/media/js/dataTables.bootstrap.js')?>"></script>
<script type="text/javascript" src="<?=base_url('assets/plugins/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js')?>"></script>
<script type="text/javascript" src="<?=base_url('assets/plugins/datatables-responsive/js/datatables.responsive.js')?>"></script>

<script type="text/javascript" src="<?=base_url('assets/plugins/jquery-datatable/extensions/Scroller/js/dataTables.scroller.min.js')?>"></script>

<script type="text/javascript" src="<?=base_url('assets/plugins/datatables-responsive/js/lodash.min.js')?>"></script>
<script type="text/javascript" src="<?=base_url('assets/plugins/moment/moment.min.js')?>"></script>
<script type="text/javascript" src="<?=base_url('assets/plugins/bootstrap-daterangepicker/daterangepicker.js')?>"></script>

<script type="text/javascript">
$(document).ready(function() {
	$('#daterangepicker').daterangepicker({
		autoApply: true,
		timePicker: false,
		format: 'DD/MM/YYYY',
		locale: {
			applyLabel: 'Aplicar',
			cancelLabel: 'Cancelar',
            fromLabel: 'De',
            toLabel: 'Hasta',
            weekLabel: 'W',
			daysOfWeek: [
	            "Do",
	            "Lu",
	            "Ma",
	            "Mi",
	            "Ju",
	            "Vi",
	            "Sa"
	        ],
	        monthNames: [
	            "Enero",
	            "Febrero",
	            "Marzo",
	            "Abril",
	            "Mayo",
	            "Junio",
	            "Julio",
	            "Agosto",
	            "Septiembre",
	            "Octubre",
	            "Noviembre",
	            "Diciembre"
	        ],
		}
	}, function (start, end, label) {
	});
});

function refresh_reporte(info){
	$('#table-automoviles tbody').html('');
	if(info.total > 0){
		$.each(info.data, function (index, d) {
			var tr 	 = '<tr>';
			tr 		+= '<td>'+d.no_orden+'</td>';
			tr 		+= '<td>'+d.status+'</td>';
			tr 		+= '<td>'+d.no_placas+'</td>';
			tr 		+= '<td>'+d.marca+'</td>';
			tr 		+= '<td>'+d.tipo+'</td>';
			tr 		+= '<td>'+d.aseguradora+'</td>';
			tr 		+= '<td>'+d.fecha_recepcion+'</td>';
			tr 		+= '<td>'+d.fecha_entrega+'</td>';
			tr 		+= '</tr>';
			$('#table-automoviles tbody').append(tr);
		});

		$('#table-automoviles').DataTable({
			"oLanguage": { "sSearch": "" },
			"sDom": "<'d-flex justify-content-between'<<'exportOptions'B>><<'search'f>>><'table-responsive't><'row'<p i>>",
			buttons: [
				{
	              extend: 'copyHtml5',
	              text: '<i class="fa fa-files-o"></i> Copiar',
	              className: 'btn btn-outline-primary',
	              title: 'Copiar Filas'
	          	},
				{
	              extend: 'excelHtml5',
	              text: '<i class="fa fa-file-excel-o"></i> Excel',
	              className: 'btn btn-outline-primary'
	          	},
			  	{
	              extend: 'csvHtml5',
	              text: '<i class="fa fa-file-text-o"></i> CSV',
	              className: 'btn btn-outline-primary'
	          	},
			  	{
	              extend: 'pdfHtml5',
	              text: '<i class="fa fa-file-pdf-o"></i> PDF',
	              className: 'btn btn-outline-primary'
	          	}
			],
	        "sPaginationType": "bootstrap",
	        "destroy": true,
	        language: {
	        	url: '//cdn.datatables.net/plug-ins/1.10.7/i18n/Spanish.json',
	        },
	        ordering: 		false,
	        scrollY:        500,
			deferRender:    true,
			scroller:       true,
			paging: 		false,
		});
	}else{
		$('#table-automoviles tbody').html('<tr><td colspan="8" align="center">No se encontraron resultados.</tr>');
	}
}

function refresh_recibos(info){
	$('#table-recibos tbody').html('');
	if(info.total > 0){
		$.each(info.data, function (index, d) {
			var tr 	 = '<tr>';
			tr 		+= '<td>'+d.no_recibo+'</td>';
			tr 		+= '<td>'+d.no_orden+'</td>';
			tr 		+= '<td>'+d.fecha+'</td>';
			tr 		+= '<td>'+d.forma_pago+'</td>';
			tr 		+= '<td>'+d.cantidad+'</td>';
			tr 		+= '<td>'+d.factura+'</td>';
			tr 		+= '</tr>';
			$('#table-recibos tbody').append(tr);
		});
		$('#table-recibos tbody').append('<tr><td colspan="5" align="right"><strong>Total:</strong></td><td>'+info.total+'</td></tr>');
	}else{
		$('#table-recibos tbody').html('');
		$('#table-recibos tbody').html('<tr><td colspan="8" align="center">No se encontraron resultados.</tr>');
	}
}


function refresh_vales(info){
	$('#table-vales tbody').html('');
	if(info.total > 0){
		$.each(info.data, function (index, d) {
			console.log(d);
			var tr 	 = '<tr>';
			tr 		+= '<td>'+d.no_vale+'</td>';
			tr 		+= '<td>'+d.no_orden+'</td>';
			tr 		+= '<td>'+d.fecha+'</td>';
			tr		+= '<td>'+d.cliente+'</td>';
			tr 		+= '<td>'+d.no_placas+'</td>';
			tr 		+= '<td>'+d.vale_por+'</td>';
			tr 		+= '</tr>';
			$('#table-vales tbody').append(tr);
		});
		$('#table-vales tbody').append('<tr><td colspan="5" align="right"><strong>Total:</strong></td><td>'+info.total+'</td></tr>');
	}else{
		$('#table-vales tbody').html('');
		$('#table-vales tbody').html('<tr><td colspan="8" align="center">No se encontraron resultados.</tr>');
	}
}
</script>