<script type="text/javascript" src="<?=base_url('assets/plugins/jquery-datatable/media/js/jquery.dataTables.min.js')?>"></script>
<script type="text/javascript" src="<?=base_url('assets/plugins/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js')?>"></script>
<script type="text/javascript" src="<?=base_url('assets/plugins/jquery-datatable/media/js/dataTables.bootstrap.js')?>"></script>
<script type="text/javascript" src="<?=base_url('assets/plugins/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js')?>"></script>
<script type="text/javascript" src="<?=base_url('assets/plugins/datatables-responsive/js/datatables.responsive.js')?>"></script>
<script type="text/javascript" src="<?=base_url('assets/plugins/datatables-responsive/js/lodash.min.js')?>"></script>


<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

<script type="text/javascript">
    var table;
    $(document).ready(function() {
        table = $('#datatable').DataTable({
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
            "iDisplayLength": 5,
            "oTableTools": {
                "sSwfPath": "<?=base_url('assets/plugins/jquery-datatable/extensions/TableTools/swf/copy_csv_xls_pdf.swf')?>    ",
                "aButtons": [{
                    "sExtends": "csv",
                    "sButtonText": "<i class='pg-grid'></i>",
                }, {
                    "sExtends": "xls",
                    "sButtonText": "<i class='fa fa-file-excel-o'></i>",
                }, {
                    "sExtends": "pdf",
                    "sButtonText": "<i class='fa fa-file-pdf-o'></i>",
                }, {
                    "sExtends": "copy",
                    "sButtonText": "<i class='fa fa-copy'></i>",
                }]
            },
            fnDrawCallback: function(oSettings) {
                $('.export-options-container').append($('.exportOptions'));
            }
        });
    });

    function refresh_datatable(dt){
        if (dt === undefined) {
            dt = table;
        }
        if(dt.result == '1'){
            dt = table;
        }else{
            dt = dt;
        }
        showSubLoader('Espera un momento...');
        dt.ajax.reload();
        closeSubLoader();
    }

    $(document).on('click', '#panel-table-refresh', function(){
        refresh_datatable(table);
    });

    $(document).on("click", ".delete", function (e) {
        e.preventDefault();
        var self = $(this);
        var text = $(this).attr('data-text');
        showConfirm('Eliminar elemento', '¿Deseas eliminar este '+ text +' ?', function () {
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