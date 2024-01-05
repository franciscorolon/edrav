<script type="text/javascript" src="<?=base_url('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')?>"></script>
<script type="text/javascript" src="<?=base_url('assets/plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.es.js')?>" charset="UTF-8"></script>
<script type="text/javascript">
$('#myModal').on('shown.bs.modal', function() {
    $('.date').datepicker({
        format: 'dd/mm/yyyy',
        language: "es"
    });
});
</script>
<script type="text/javascript">
$(document).on('click', '#empresa', function(){
    if ($(this).prop("checked")) {
        $('.apellidos').hide();
    }else{
        $('.apellidos').show();
    }
});
</script>