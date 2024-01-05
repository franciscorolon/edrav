<script>
    var table_models;

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

    $('#myBigModal').on('shown.bs.modal', function() {
        var url = $('#datatable-models').data('url');
        load_models(url);
    });

    function load_models(items){
        table_models = $('#datatable-models').DataTable({
            "ajax": {
                url : items,
                type : 'GET'
            },
            "sDom": "<'exportOptions'T><'table-responsive't><'row'<p i>>",
            "sPaginationType": "bootstrap",
            "destroy": true,
            language: {
            url: '//cdn.datatables.net/plug-ins/1.10.7/i18n/Spanish.json'
            },
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
    }

    function refresh_datatable_models(dt){
        showSubLoader('Espera un momento...');
        table_models.ajax.reload();
        closeSubLoader();
        $('#add_model')[0].reset();
    }
</script>