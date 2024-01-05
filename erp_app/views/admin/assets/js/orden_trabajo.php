<script>
    var item;
    var cont = 1;
    (function(){
        $('#id_orden').on('change', function() {
            var id_orden = $(this).val();
            $.ajax({
                url:'<?=base_url('admin/ordenes-trabajo/get/ordenes_model/')?>'+id_orden,
                success: function(result){
                    var res = JSON.parse(result);
                    $("#marca").html(res[0].marca);
                    $('#tipo').html(res[0].tipo);
                    $('#color').html(res[0].color);
                    $('#placas').html(res[0].no_placas);
                    $('#modelo').html(res[0].modelo);
                    $('#serie').html(res[0].no_serie);
                    //console.log(result);
                }
            });
        });
    })();

    $('#myBigModal').on('shown.bs.modal', function() {
        $('#id_parte_automovil').on('change', function() {
            var id_parte_automovil  = $(this).val();
            var dropdown           = $("#id_parte_coche");
            dropdown.empty();
            $.ajax({
                url:'<?=base_url('admin/ordenes-trabajo/get_piezas/')?>'+id_parte_automovil,
                success: function(result){
                    var res = JSON.parse(result);
                    $.each(res.items, function (ind, item) {
                        dropdown.append($("<option />").val(ind).text(item));
                    });

                    dropdown.val('-1');
                }
            });
        });
    });

    function refresh_detalles(items){
        var row  = '<tr id="detalle_'+cont+'">';
        var c = 0;
        $.each(items.items, function (ind, it) {
            var align = 'left';
            if(c>1 && c<11){
                align = 'center';
            }
            row += '<td align="'+align+'" id="'+ind+'_'+cont+'">'+it+'</td>';
            c++;
        });
        row += '</tr>';

        $('#table-body').append(row);
        cont++;
    }

    function exito_orden(data){
        $('.page-content-wrapper').pgNotification({
            style: 'flip',
            message: 'Se ha creado exitosamente la Orden de Trabajo',
            position: 'top-right',
            timeout: 0,
            type: 'info'
        }).show();
        setTimeout(function(){window.location.replace("<?=base_url('admin/ordenes-trabajo/editar')?>/"+data.id);}, 3000);
    }
</script>
