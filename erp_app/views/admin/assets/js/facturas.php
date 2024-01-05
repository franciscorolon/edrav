<script type="text/javascript">
    var facturas         = $('#datatable_facturas');
    $(document).ready(function() {
        facturas.dataTable({
            //serverSide: true,
            "ajax": {
                url : "<?=$items?>",
                type : 'GET'
            },
            "sPaginationType": "bootstrap",
            "sDom": "<t><'row'<p i>>",
            "destroy": true,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.7/i18n/Spanish.json'
            },
            <?=isset($columns)?$columns:''?>
            "iDisplayLength": 5,
        });
    });
</script>
