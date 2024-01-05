<script type="text/javascript">
    var t_todos         = $('#datatable_todos');
    var t_valuacion     = $('#datatable_valuacion');
    var t_reparacion    = $('#datatable_reparacion');
    var t_resguardo     = $('#datatable_resguardo');
    var t_transito      = $('#datatable_transito');
    var t_entregado     = $('#datatable_entregado');
    var t_facturado     = $('#datatable_facturado');
    var t_archivado     = $('#datatable_archivado');
    var t_perdidas      = $('#datatable_perdidas');
    var t_danos         = $('#datatable_danos');

    $(document).ready(function() {
        t_todos.dataTable({
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

        t_valuacion.dataTable({
            //serverSide: true,
            "ajax": {
                url : "<?=$items_valuacion?>",
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

        t_reparacion.dataTable({
            //serverSide: true,
            "ajax": {
                url : "<?=$items_reparacion?>",
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

        t_resguardo.dataTable({
            //serverSide: true,
            "ajax": {
                url : "<?=$items_resguardo?>",
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

        t_transito.dataTable({
            //serverSide: true,
            "ajax": {
                url : "<?=$items_transito?>",
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

        t_entregado.dataTable({
            //serverSide: true,
            "ajax": {
                url : "<?=$items_entregado?>",
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

        t_facturado.dataTable({
            //serverSide: true,
            "ajax": {
                url : "<?=$items_facturado?>",
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

        t_archivado.dataTable({
            //serverSide: true,
            "ajax": {
                url : "<?=$items_archivado?>",
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

        t_perdidas.dataTable({
            //serverSide: true,
            "ajax": {
                url : "<?=$items_perdidas?>",
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

        t_danos.dataTable({
            //serverSide: true,
            "ajax": {
                url : "<?=$items_danos?>",
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

        // search box for table
        $('#search-valuacion').keyup(function() {
            t_valuacion.fnFilter($(this).val());
        });

        $('#search-reparacion').keyup(function() {
            t_reparacion.fnFilter($(this).val());
        });

        $('#search-resguardo').keyup(function() {
            t_resguardo.fnFilter($(this).val());
        });

        $('#search-transito').keyup(function() {
            t_transito.fnFilter($(this).val());
        });

        $('#search-entregado').keyup(function() {
            t_entregado.fnFilter($(this).val());
        });

        $('#search-facturado').keyup(function() {
            t_facturado.fnFilter($(this).val());
        });

        $('#search-archivado').keyup(function() {
            t_archivado.fnFilter($(this).val());
        });

        $('#search-perdidas').keyup(function() {
            t_perdidas.fnFilter($(this).val());
        });

        $('#search-danos').keyup(function() {
            t_danos.fnFilter($(this).val());
        });

        $('#search-todos').keyup(function() {
            t_todos.fnFilter($(this).val());
        });
    });

    $(document).on("click", ".delete-item", function (e) {
        e.preventDefault();
        var self = $(this);
        var st   = $(this).attr('data-table');
        var text = $(this).attr('data-text');
        var tbl  = '';
        showConfirm('Eliminar elemento', '¿Deseas eliminar esta '+ text +' ?', function () {
            var url = self.attr('href');
            setTimeout(function(){ showSubLoader('Espera un momento...');}, 3000);
            $.post(url, {
            }, function (o) {
                switch(st) {
                    case 'REPARACION':
                        tbl = t_reparacion;
                        break;
                    case 'RESGUARDO':
                        tbl = t_resguardo;
                        break;
                    case 'TRANSITO':
                        tbl = t_transito;
                        break;
                    case 'ENTREGRADO':
                        tbl = t_entregrado;
                        break;
                    case 'FACTURADO':
                        tbl = t_facturado;
                        break;
                    default:
                        tbl = t_todos;
                }
                refresh_datatable(tbl);
                setTimeout(function(){ closeSubLoader(); }, 3000);
            }, 'json');

            return  false;
        });
    });

    function refresh_datatable(table){
        showSubLoader('Espera un momento...');
        table.ajax.reload();
        closeSubLoader();
    }
</script>