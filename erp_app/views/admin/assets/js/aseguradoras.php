<script>
    $(document).on('click', '.upload-image', function(e){
        e.preventDefault();
        $('#tmp-image').click();
    });

    $(document).on('change', '#tmp-image', function(e){
        e.preventDefault();
        var self = $('#upload-file');
        var url = self.attr('action');
        self.addClass("disabled");
        showSubLoader('Espera un momento...');
        var datos = new FormData( self[0] );
        $.ajax({
            'url': url,
            type: 'post',
            data: datos,
            dataType:"json",
            cache: false,
            processData: false,
            contentType: false,
            complete: function (o) {
                self.removeClass("disabled");
                closeSubLoader();
            },
            success: function (o) {
                if (o.result == 1) {
                    var data = o.data.upload_data;

                    //img_image
                    $("#img_image").attr('src', '<?=base_url(TMP_FOLDER)?>/'+data.file_name);
                    $("#logo").val(data.file_name);
                } else {
                    Result.showError(o.data);
                }
            }
        });
    });
</script>