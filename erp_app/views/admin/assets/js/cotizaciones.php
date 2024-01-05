<script type="text/javascript">
	var t_recibos;

	$(document).ready(function() {
        t_recibos = $('#recibo-datatable').DataTable({
            "ajax": {
                url : "<?=$items?>",
                type : 'GET'
            },
            "sDom": "<'exportOptions'T><'table-responsive't><'row'<p i>>",
            "sPaginationType": "bootstrap",
            "destroy": true,
            language: {
            url: '//cdn.datatables.net/plug-ins/1.10.7/i18n/Spanish.json'
            },
            <?=isset($columns)?$columns:''?>
            "iDisplayLength": 20,
            "order": [[ 0, "desc" ]],
            "oTableTools": {
            	"aButtons": [],
            },
        });
    });

    $('#myBigModal').on('shown.bs.modal', function(){
        var modal = $(this);
        modal.wrap($('<div>',{ id: 'printThis' }));
    });
    $('#myBigModal').on('hidden.bs.modal', function(){
        var modal = $(this);
        $('div#printThis').find(modal).unwrap();
    });

    $(document).on('change', '#id_orden', function(){
        if($(this).val() == -1){
            $('#placas-group').hide();
            $('#auto-group').hide();
            $('#auto').val('');
            $('#placas').val('');
        }else{
            var id_orden = $(this).val();
            $.post("<?=base_url('admin/recibos/get/ordenes_model')?>/"+id_orden, function(result){
                var res = JSON.parse(result);
                $('#placas-group').show();
                $('#auto-group').show();
                $('#auto').val(res[0].marca+' '+res[0].tipo+' '+res[0].color+' '+res[0].modelo);
                $('#placas').val(res[0].no_placas);
            });
        }
    });

	$(document).on('click', '#recargar-recibo', function(){
		refresh_datatable(t_recibos);
	});

    $(document).on('click', '.btn-print', function(e){
        e.preventDefault();
        printElement(document.getElementById("printThis"));
    });

    function recargar_tabla(){
        refresh_datatable(t_recibos);
    }

    function refresh_datatable(table){
        showSubLoader('Espera un momento...');
        table.ajax.reload();
        closeSubLoader();
    }

    function printElement(elem) {
        var domClone = elem.cloneNode(true);
        console.log(domClone);

        var $printSection = document.getElementById("printSection");

        if (!$printSection) {
            var $printSection = document.createElement("div");
            $printSection.id = "printSection";
            document.body.appendChild($printSection);
        }

        $printSection.innerHTML = "";
        $printSection.appendChild(domClone);
        window.print();
    }

    $(document).on("click", ".cancel", function (e) {
        e.preventDefault();
        var self = $(this);
        var text = $(this).attr('data-text');
        showConfirm('Cancelar recibo', '¿Deseas cancelar este '+ text +' ?', function () {
            var url = self.attr('href');
            showSubLoader('Espera un momento...');
            $.post(url, {
            }, function (o) {
                $('#divConfirm').modal('hide');
                refresh_datatable(table);
                closeSubLoader();
            }, 'json');

            return  false;
        });
    });
</script>