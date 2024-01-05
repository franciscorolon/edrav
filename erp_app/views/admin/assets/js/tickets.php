<script>
function refresh_ticket(data){
    //var d = JSON.parse(data);
    if(data.result){
        showSubLoader('Espera un momento...');
        $.ajax({
            'url': '<?=base_url('admin/ordenes-trabajo/get_ticket')?>/'+data.id,
            type: 'post',
            data: datos,
            dataType:"json",
            cache: false,
            processData: false,
            contentType: false,
            complete: function (o) {
                closeSubLoader();
            },
            success: function (o) {
                console.log(o.id_area);
                if (o.result == 1) {
                    $('#ticket_'+o.id_area).html('');
                    $('#ticket_'+o.id_area).html(o.string_ticket);
                } else {
                    Result.showError(o.data);
                }
            }
        });
    }
}
</script>
