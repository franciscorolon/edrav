<script type="text/javascript" src="<?=base_url('assets/js/timeline.js')?>"></script>
<script type="text/javascript" src="<?=base_url('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')?>"></script>
<script type="text/javascript" src="<?=base_url('assets/plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.es.js')?>" charset="UTF-8"></script>
<script type="text/javascript" src="<?=base_url('assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.js')?>"></script>
<script type="text/javascript" src="<?=base_url('assets/plugins/jquery-autonumeric/autoNumeric.js')?>"></script>
<script type="text/javascript" src="<?=base_url('assets/plugins/dropzone/dropzone.min.js')?> "></script>
<?php $id_grupo = $this->session->userdata('id_grupo'); ?>
<script type="text/javascript">
    var modalDrop, drop, transform;
    $('#myModal').on('shown.bs.modal', function() {
        $('.input-group.date').datepicker({
            format: 'dd/mm/yyyy',
            language: "es"
        });
        $('.autonumeric').autoNumeric('init');
    });

    $('#myBigModal').on('shown.bs.modal', function(){
        var modal = $(this);
        modal.wrap($('<div>',{ id: 'printThis' }));
        $(document).on('click','#chk_otro', function(){
            if($("#chk_otro").is(':checked')){
                $('.otro-group').show();  // checked
            }
            else{
                $('#otro').val('');
                $('.otro-group').hide();
            }
        });
    });
    $('#myBigModal').on('hidden.bs.modal', function(){
        var modal = $(this);
        $('div#printThis').find(modal).unwrap();
    });

    $('#myFolderModal').on('show.bs.modal', function(){

        $.fancybox.defaults.btnTpl.zooms = '<button data-fancybox-zooms class="fancybox-button fancybox-button--zooms" title="Comentarios">' +
  '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">' +
  '<path d="M18.7 17.3l-3-3a5.9 5.9 0 0 0-.6-7.6 5.9 5.9 0 0 0-8.4 0 5.9 5.9 0 0 0 0 8.4 5.9 5.9 0 0 0 7.7.7l3 3a1 1 0 0 0 1.3 0c.4-.5.4-1 0-1.5zM8.1 13.8a4 4 0 0 1 0-5.7 4 4 0 0 1 5.7 0 4 4 0 0 1 0 5.7 4 4 0 0 1-5.7 0z"></path>' +
  '</svg>' +
  '</button>';


        $.fancybox.defaults.btnTpl.comment = '<button data-fancybox-comment class="fancybox-button fancybox-button--comment" title="Comentarios">' +
  '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="zooms">' +
  '<path d="M22.152 4.336c-0.675-0.677-1.619-1.099-2.652-1.098h-15c-1.032-0-1.976 0.421-2.652 1.098-0.677 0.676-1.099 1.619-1.098 2.652v8.579c-0.001 1.033 0.421 1.976 1.098 2.652 0.675 0.677 1.619 1.099 2.652 1.098h0.378l1.060 3.19c0.078 0.25 0.323 0.317 0.551 0.317s0.387-0.131 0.551-0.317l2.623-3.19h9.837c1.032 0.001 1.977-0.421 2.652-1.098 0.677-0.675 1.099-1.619 1.098-2.652v-8.579c0.001-1.032-0.421-1.976-1.098-2.652zM19.936 15.318c0 0.359-0.29 0.649-0.647 0.649h-14.576c-0.358 0-0.647-0.291-0.647-0.649v-0.514c0-0.359 0.289-0.649 0.647-0.649h14.576c0.358 0 0.647 0.291 0.647 0.649v0.514zM19.936 11.518c0 0.359-0.29 0.649-0.647 0.649h-14.576c-0.358 0-0.647-0.291-0.647-0.649v-0.514c0-0.358 0.289-0.649 0.647-0.649h14.576c0.358 0 0.647 0.291 0.647 0.649v0.514zM19.936 7.719c0 0.359-0.29 0.649-0.647 0.649h-14.576c-0.358 0-0.647-0.291-0.647-0.649v-0.514c0-0.358 0.289-0.649 0.647-0.649h14.576c0.358 0 0.647 0.291 0.647 0.649v0.514z" fill="#232323" id="comment"/>' +
  '</svg>' +
  '</button>';

       <?php if (!$this->session->userdata('id_usuario') || ($id_grupo == CVP2) ): ?>
       var comentario = 'hide';
       <?php else: ?>
       var comentario = '';
       <?php endif;?>

       var demo = $('[data-fancybox="gallery"]').fancybox({
            onInit : function( instance ) {
                // Make zoom icon clickable
                instance.$refs.toolbar.find('.fancybox-zoom').on('click', function() {
                    if ( instance.isScaledDown() ) {
                        instance.scaleToActual();
                  } else {
                    instance.scaleToFit();
                  }
                });
            },
            baseClass: "fancybox-custom-layout",
            arrows: true,
            keyboard: false,
            infobar: false,
            touch: {
              vertical: false
            },
            buttons: ["zooms", "fullScreen", "download", "thumbs", "comment", "close"],
            animationEffect: "fade",
            transitionEffect: "fade",
            preventCaptionOverlap: false,
            idleTime: false,
            gutter: 0,
            // Customize caption area
            caption: function(instance, item) {
              return '<div class="text-left"><h3>Comentario de la Imagen</h3><p><div class="row"><div class="form-group col-12"><label for="comentario">Comentario</label><textarea type="text" class="form-control" id="comentario-'+$(this).data('id')+'" name="comentario" readonly style="color:#7a8994 !important">'+$(this).data('caption')+'</textarea></div></div><div class="form-group"><input type="hidden" name="id" id="id_documento" value="'+$(this).data('id')+'" /><a class="btn btn-primary btn-sm show-modal-super '+comentario+'" href="<?=base_url('admin/ordenes/mostrar_comentario')?>/'+$(this).data('id')+'">Editar Comentario</a></div></div>';
            },
        });

        $(document).on('click', '[data-fancybox-comment]', function() {
            $('.fancybox-caption').toggle();
        });

        $(document).on('click', '[data-fancybox-zooms]', function() {
            if($('.fancybox-slide--current .fancybox-content').css('transform') == 'matrix(2, 0, 0, 2, 0, 0)'){
                $('.fancybox-slide--current .fancybox-content').css('transform', transform);
                console.log('quitando zoom');
            }else{
                console.log('agregando zoom');
                transform = $('.fancybox-slide--current .fancybox-content').css('transform');
                $('.fancybox-slide--current .fancybox-content').css('transform', 'scale(2,2)');
            }
        });

        /*modalDrop = new Dropzone(".dropzone", {
            init: function() {
                this.on("success", function(file, response) {
                    showSuccess('Fotografías', 'Se subió correctamente la imagen(es).');
                    var obj = jQuery.parseJSON(response);
                    recargar_imagenes(obj.folder, obj.id_orden);
                });
              },
            parallelChunkUploads: true,
            url: $(".dropzone").data('url'),
            dictDefaultMessage: 'Soltar archivos para subir',
            dictFallbackMessage: 'Su navegador no admite la carga de archivos arrastrados.',
        });

        $('.dz-default.dz-message > span').show(); // Show message span
        $('.dz-default.dz-message').css({'opacity':1, 'background-image': 'none'});*/
    });



</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#btn-calendar').on('click', function(e){
            e.preventDefault();
        })
        $('.input-group.date').datepicker({
            format: 'dd/mm/yyyy',
            language: "es",
            autoclose: true
        });

        $('.bootstrap-timepicker input').timepicker({showMeridian: false}).on('show.timepicker', function(e) {
            var widget = $('.bootstrap-timepicker-widget');
            widget.find('.glyphicon-chevron-up').removeClass().addClass('pg-arrow_maximize');
            widget.find('.glyphicon-chevron-down').removeClass().addClass('pg-arrow_minimize');
        });

        $('.autonumeric').autoNumeric('init');

        $('.card-collapse').click();

        //$(".expediente").dropzone({
	    if ($(".drag-n-drop")[0]){
	        drop = new Dropzone(".drag-n-drop", {
	            init: function() {
	                this.on("success", function(file, response) {
	                    var res = JSON.parse(response);
	                    if(res.result == '1'){
	                        $('.drag-n-drop .dz-preview.dz-file-preview').remove();
	                        showSuccess('Expendiente', 'Se subió correctamente el archivo.');
	                        var obj = jQuery.parseJSON(response);
	                        recargar_expendiente(obj.id_orden);
	                    }else{
	                        showAlert('Expendiente', res.error);
	                    }
	                });
	              },
	            parallelChunkUploads: true,
	            url: $(".drag-n-drop").data('url'),
	            dictDefaultMessage: 'Soltar archivos para subir',
	            dictFallbackMessage: 'Su navegador no admite la carga de archivos arrastrados.',
	        });
	    }

        $('.dz-default.dz-message > span').show(); // Show message span
        $('.dz-default.dz-message').css({'opacity':1, 'background-image': 'none'});
    });

    $(document).on('click', '.btn-print', function(e){
        e.preventDefault();
        printElement(document.getElementById("printThis"));
    });

    $(document).on('click', '.valid-check', function(){
        var field = $(this).data('field');
        if($(this).is(':checked') ){
            $('#'+field).show();
        }else{
            $('#'+field).hide();
        }
    });

    $(document).on('change', '#id_aseguradora', function(){
        var val = $(this).val();
        $('#id_ajustador').html("");
        if(val != '-1'){
            $.ajax({
                dataType: "json",
                url: "<?=base_url('admin/configuraciones/ajustadores/get_items')?>/"+val,
                success: function(res){
                    var dropdown = $("#id_ajustador");
                    $(dropdown).html("");
                    dropdown.append($("<option />").val('-1').text('-- seleccione --'));
                    $.each(res.data, function(index) {
                        dropdown.append($("<option />").val(index).text(this));
                    });
                }
            });
        }
    });

    $(document).on('change', '#id_asesor', function(){
        var val = $(this).val();
        if(val != '-1'){
            $('#form_asesor').hide();
            $.ajax({
                dataType: "json",
                url: "<?=base_url('admin/ordenes/get/usuarios_model')?>/"+val,
                success:function(res){

                    $('#info_asesor').html('');
                    var asesor = res[0];
                    var info = '<h4>'+ asesor.nombre+' '+asesor.paterno+' '+ asesor.materno +'</h4>';
                    $('#info_asesor').append(info);
                    $('#hide_asesor').hide();
                    $('#show_asesor').show();
                    $('#info_asesor').show();
                }
            });
        }
    });

    $(document).on('click', '#hide_asesor', function(e){
        e.preventDefault();
        $(this).hide();
        $('#show_asesor').show();
        $('#form_asesor').hide();
        $('#info_asesor').show();
    });

    $(document).on('click', '#show_asesor', function(e){
        e.preventDefault();
        $(this).hide();
        $('#hide_asesor').show();
        $('#info_asesor').hide();
        $('#form_asesor').show();
    });

    $(document).on('click', '#hide_importes', function(e){
        e.preventDefault();
        $(this).hide();
        $('#show_importes').show();
        $('#form_importes').hide();
        $('#info_importes').show();
    });

    $(document).on('click', '#show_importes', function(e){
        e.preventDefault();
        $(this).hide();
        $('#hide_importes').show();
        $('#info_importes').hide();
        $('#form_importes').show();
    });


    $(document).on('click', '#publicar_incidencia', function(e){
        e.preventDefault();
        var incidencia = $('#incidencia').val();
        var es_llamada = ( $('#es_llamada').is(':checked')) ? '1':'0';
        var id_orden   = $('#id_orden').val();
        $.post(
            "<?=base_url('apis/admin_api/insert_incidencia')?>",
            { incidencia: incidencia, llamada: es_llamada, id_orden: id_orden},
            function (res) {
                if(res.result){
                    $('#incidencia').val('');
                    $('#es_llamada').prop('checked', false);
                    showSuccess('Éxito', 'Se ha publicado la incidencia correctamente');
                    refresh_incidencias();
                }
        }, 'json');
    });

    /*Al cerrar el modal de exito de incidencias */
    $("#divSuccess").on("hide.bs.modal", function () {
        var content = $('#divSuccess .modal-body .content').html();
        if(content == 'Se ha publicado la incidencia correctamente'){
            showConfirmA('Envio por Correo', '¿Desea enviar la incidencia por correo electrónico?', enviar_incidencia, refresh_incidencias);
        }
    });

    $(document).on('click', '#show_compania', function(e){
        e.preventDefault();
        $(this).hide();
        $('#hide_compania').show();
        $('#info_compania').hide();
        $('#form_compania').show();
    });

    $(document).on('click','#hide_compania' ,function(e){
        e.preventDefault();
        $(this).hide();
        $('#show_compania').show();
        $('#form_compania').hide();
        $('#info_compania').show();
    });

    $(document).on('click', '#show_datos', function(e){
        e.preventDefault();
        $(this).hide();
        $('#hide_datos').show();
        $('#info_general').hide();
        $('#form_general').show();
    });

    $(document).on('click', '#hide_datos', function(e){
        e.preventDefault();
        $(this).hide();
        $('#show_datos').show();
        $('#form_general').hide();
        $('#info_general').show();
    });

    $('.timepicker').timepicker().on('show.timepicker', function(e) {
        var widget = $('.bootstrap-timepicker-widget');
        widget.find('.glyphicon-chevron-up').removeClass().addClass('pg-arrow_maximize');
        widget.find('.glyphicon-chevron-down').removeClass().addClass('pg-arrow_minimize');
    });

    $(document).on('click', '.eliminar-documento', function(e){
        e.preventDefault();
        var o = {icon:$(this).data('icon'), nombre:$(this).data('nombre')};
        showConfirmA('Eliminar Documento', '¿Está seguro que desea eliminar el documento?', eliminar_documento, o);
    });

    $(document).on('click', '.eliminar-imagen', function(e){
        e.preventDefault();
        var o = {icon:$(this).data('icon'), nombre:$(this).data('nombre')};
        showConfirmA('Eliminar Checklist', '¿Está seguro que desea eliminar el archivo?', eliminar_imagen, o);
    });

    $(document).on('click', '.eliminar-documento-aseguradora', function(e){
        e.preventDefault();
        var o = {icon:$(this).data('icon'), id_documento:$(this).attr('data-id_documento')};
        showConfirmA('Eliminar Documento', '¿Está seguro que desea eliminar el documento de la aseguradora?', eliminar_documento_aseguradora, o);
    });


    $(document).on('click', '.file-upload', function(e){
        e.preventDefault();
        $('#nombre').val($(this).data('nombre'));
        $('#icono').val($(this).data('icon'));
        $('#file').trigger('click');
    });

    $(document).on('click', '.image-upload', function(e){
        e.preventDefault();
        $('#nombre-image').val($(this).data('nombre'));
        $('#icono-image').val($(this).data('icon'));
        $('#file-image').trigger('click');
    });

    $(document).on('click', '.file-upload-aseguradora', function(e){
        e.preventDefault();
        $('#id_documento-aseguradora').val($(this).data('id_documento'));
        $('#icono-aseguradora').val($(this).data('icon'));
        $('#file-aseguradora').trigger('click');
    });

    $(document).on('change', '#file', function(e){
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
                    var icono     = $('#icono').val();
                    var image     = $("#"+icono);
                    var nombre     = $("#nombre").val();
                    image.fadeOut('fast', function () {
                        image.attr('src', '<?=base_url('assets/img/icons/pdf_active.png')?>');
                        image.fadeIn('slow');
                    });
                    image.wrap($('<a>',{ href: o.path + '' + o.file, target:'_blank' }));

                    if(o.canDelete){
                        $('#btn-'+nombre).html('Eliminar');
                        $('#btn-'+nombre).removeClass('btn-primary text-white file-upload').addClass('btn-default eliminar-documento');
                    }else{
                        var parent = $('#btn-'+nombre).parent().html('<div style="display:block;min-height:27px"></div>');
                    }
                    refresh_incidencias();
                } else {
                    Result.showError(o.error);
                }
            }
        });
    });

    $(document).on('change', '#file-image', function(e){
        e.preventDefault();
        var self = $('#upload-image');
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
                    var icono     = $('#icono-image').val();
                    var image     = $("#"+icono);
                    var nombre     = $("#nombre-image").val();
                    image.fadeOut('fast', function () {
                        image.attr('src', '<?=base_url('assets/img/icons/jpg_active.png')?>');
                        image.fadeIn('slow');
                    });
                    image.wrap($('<a>',{ href: o.path + '' + o.file, 'data-fancybox':'gallery' }));

                    if(o.canDelete){
                        $('#btn-'+nombre).html('Eliminar');
                        $('#btn-'+nombre).removeClass('btn-primary text-white image-upload').addClass('btn-default eliminar-imagen');
                    }else{
                        var parent = $('#btn-'+nombre).parent().html('<div style="display:block;min-height:27px"></div>');
                    }
                } else {
                    Result.showError(o.error);
                }
            }
        });
    });

    $(document).on('change', '#file-aseguradora', function(e){
        e.preventDefault();
        var self = $('#upload-aseguradora_documento');
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
                    var icono               = $('#icono-aseguradora').val();
                    var image               = $("#"+icono);
                    var id_documento      = $("#id_documento-aseguradora").val();
                    var id_
                    image.fadeOut('fast', function () {
                        image.attr('src', '<?=base_url('assets/img/icons/pdf_active.png')?>');
                        image.fadeIn('slow');
                    });
                    image.wrap($('<a>',{ href: o.path + '' + o.file, target:'_blank' }));
                    $('#btn-'+id_documento).html('Eliminar');
                    $('#btn-'+id_documento).removeClass('btn-primary text-white file-upload').addClass('btn-default eliminar-documento-aseguradora');
                } else {
                    Result.showError(o.error);
                }
            }
        });
    });

    $(document).on('click', '.delete-image', function(e){
        e.preventDefault();
        var id = 0;
        id = $(this).data('id');
        showConfirmA('Fotografías','¿Realmente deseas eliminar esta imagen?', eliminar_foto, id);
    });

    $(document).on('click', '.show-image', function(e){
        e.preventDefault();
        var id  = $(this).data('id');
        var url = $(this).attr('href');
        var com = $(this).data('comentario');
        $('.show-tabs').hide();
        $('.edit-image').show();
        $('#id_documento').val(id);
        $('#comentario').val(com);
        $('#edit-image').attr('src', url);
    });

    $(document).on('click', '#back-btn', function(e){
        e.preventDefault();
        $('.show-tabs').show();
        $('.edit-image').hide();
    });

    $(document).on('click', '.show-subfolders', function(e){
        var target = $(this).data('target');
        e.preventDefault();
        if($('#' + target).hasClass('open')){
            $('#' + target).removeClass('open');
            $('#' + target).hide();
        }else{
            $('#' + target).addClass('open');
            $('#' + target).show();
        }

    });

    $(document).on('click', '#seleccionar', function(e){
        e.preventDefault();
        $(this).toggleClass('open');
        if($(this).hasClass('open')){
            $(this).html('Cancelar');
            $('#download').show();
        <?php if (!$this->session->userdata('id_usuario') || ($id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR ||  $id_grupo == CLIENTES_AVANZADO) ): ?>
            $('#delete').show();
        <?php endif;?>
            $('.select-image').show();
            $('.select-image .select-image-wrap ').removeClass('selected');
            $('.fancy-image').hide();
        }else{
            $(this).html('Seleccionar');
            $('#download').hide();
        <?php if (!$this->session->userdata('id_usuario') || ($id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR ||  $id_grupo == CLIENTES_AVANZADO) ): ?>
            $('#delete').hide();
        <?php endif;?>
            $('.select-image').hide();
            $('.fancy-image').show();
        }
    });

    $(document).on('click', '.image a.select-image', function(e){
        e.preventDefault();
        $(this).find('.select-image-wrap').toggleClass('selected');
        return false;
    });

    $(document).on('click', '#download', function(e){
        var size = $(".select-image .select-image-wrap.selected").size();
        if(size == 0){
            swal(
              'Descargar Imágenes',
              'Debe seleccionar al menos una imagen para descargar',
              'error'
            );
            return false;
        }
        var items = [];
        $(".select-image .select-image-wrap.selected").each(function(){
            items.push($(this).data('id'));
        });

        $.ajax({
            url: "<?=base_url('apis/admin_api/download_images')?>",
            data:{id:items},
            type:'POST',
            success: function(response){
                var res = JSON.parse(response);
                if(res.result == '1'){
                    window.location = res.file;
                }
            }
        });
    });

    $(document).on('click', '#delete', function(e){
        var size = $(".select-image .select-image-wrap.selected").size();
        if(size == 0){
            swal(
              'Eliminar Imágenes',
              'Debe seleccionar al menos una imagen para eliminar',
              'error'
            );
            return false;
        }

        swal({
            title: '¿Esta seguro que desea eliminar las imagenes?',
            text: "Esta acción no se podrá deshacer!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, deseo eliminarlas',
            cancelButtonText: 'No',
        }).then((result) => {
            if (result.value) {
                var items = [];
                $(".select-image .select-image-wrap.selected").each(function(){
                    items.push($(this).data('id'));
                });

                $.ajax({
                    url: "<?=base_url('apis/admin_api/delete_image')?>",
                    data:{id:items},
                    type:'POST',
                    success: function(response){
                        var res = JSON.parse(response);
                        if(res.result == '1'){
                            swal(
                                'Éxito',
                                'se han eliminado correctamente las imágenes.',
                                'success'
                            );
                            recargar_imagenes(res.folder, res.id_orden);
                        }
                    }
                });
            }
        });
    });
</script>
<script type="text/javascript">

    function confirmar_impresion(){
        showConfirm('Impresión de Orden', '¿Desea imprimir la orden?', imprimir_orden, redirect_ordenes);
    }

    function redirect_ordenes(){
        window.location.replace("<?=base_url('admin/ordenes')?>");
    }

    function recargar_orden(){
        $('.page-content-wrapper').pgNotification({
            style: 'flip',
            message: 'Se ha modificado exitosamente la Orden',
            position: 'top-right',
            timeout: 0,
            type: 'info'
        }).show();
        setTimeout(function(){location.reload(true)}, 3000);
    }

    function imprimir_orden(){
        /* $.ajax({
            url: "<?=base_url('admin/ordenes/get/ordenes_model')?>/"+no_orden,
            success: function(result){
                var res = JSON.parse(result);
                var item = res[0];
                /rellenar_orden(item);
                $('#col-orden').show();
            }
        });*/
        window.print();
        showSubLoader('Imprimiendo Orden...');
        setTimeout(function(){ closeSubLoader() }, 3000);
        redirect_ordenes();
    }

    function get_cliente(){
        $.ajax({
            dataType: "json",
            url: "<?=base_url('admin/clientes/get_items')?>",
            success: function(res){
                var dropdown = $("#id_cliente");
                $(dropdown).html("");
                $.each(res.data, function(index) {
                    dropdown.append($("<option />").val(index).text(this));
                });
            }
        });
    }

    function refresh_datatable(){
        $.ajax({
            dataType: "json",
            url: "<?=base_url('admin/clientes/get_items')?>",
            success: function(res){
                var dropdown = $("#id_cliente");
                $(dropdown).html("");
                $.each(res.data, function(index) {
                    dropdown.append($("<option />").val(index).text(this));
                });
            }
        });
    }

    function update_status(o){
        var edo = '';
        switch(o.status) {
            case 'VALUACION':
                edo = 'En Valuación';
                break;
            case 'REPARACION':
                edo = 'En Reparación';
                break;
            case 'TRANSITO':
                edo = "En tránsito";
                break;
            case 'ENTREGADO':
                edo = "Entregado";
                break;
            case 'FACTURADO':
                edo = 'Facturado';
                break;
            case 'ARCHIVADO':
                edo = 'Archivado';
                break;
            case 'PERDIDAS':
                edo = 'Perdidas totales';
                break;
            case 'DANOS':
                edo = 'Pago de daños';
                break;
        }
        $('#status').html(edo);
        refresh_incidencias();
        enviar_incidencia();
    }

    function refresh_incidencias(){
        var id_orden = $('#id_orden').val();
        $('.timeline').html('');
        $.ajax({
            dataType: "json",
            type:'post',
            url: "<?=base_url('admin/ordenes/get_incidencias')?>",
            data: {id_orden:id_orden},
            success: function(res){
                $('.timeline').html(res);
            }
        });
    }

    function refresh_recibos(){
        var id_orden = $('#id_orden').val();
        $('#info_recibos').html('');
        $.ajax({
            dataType: "json",
            type:'post',
            url: "<?=base_url('admin/ordenes/get_recibos')?>",
            data: {id_orden:id_orden},
            success: function(res){
                $('#info_recibos').html(res);
                $('#info_recibos').show();
            }
        });
    }

    function mostrar_recibo(data){
        var url = '<?=base_url('admin/ordenes/mostrar_recibo')?>/'+data.id_recibo;
        $.post(url, '', function (response) {
                $('#myBigModal .modal-content').html('');
                $('#myBigModal .modal-content').append(response);
                setTimeout(function(){ $('#myBigModal').modal('show'); }, 3000);
            });
        refresh_recibos();
        refresh_incidencias();
    }

    function eliminar_documento(item){
        var icono         = item.icon;
        var image         = $("#"+icono);
        var nombre         = item.nombre;
        var id_orden     = $('#id_orden').val();
        var url         = '<?=base_url('apis/admin_api/delete_documento')?>';
        $.post(url, {id_orden:id_orden, nombre:nombre}, function (response) {
            image.fadeOut('fast', function () {
                image.attr('src', '<?=base_url('assets/img/icons/pdf_disabled.png')?>');
                image.fadeIn('slow');
            });
            $('a').find(image).unwrap();
            $('#btn-'+nombre).html('Agregar');
            $('#btn-'+nombre).removeClass('btn-default eliminar-documento').addClass('btn-primary text-white file-upload');
            refresh_incidencias();
        });
    }

    function eliminar_imagen(item){
        var icono         = item.icon;
        var image         = $("#"+icono);
        var nombre         = item.nombre;
        var id_orden     = $('#id_orden').val();
        var url         = '<?=base_url('apis/admin_api/delete_checklist')?>';
        $.post(url, {id_orden:id_orden, nombre:nombre}, function (response) {
            image.fadeOut('fast', function () {
                image.attr('src', '<?=base_url('assets/img/icons/jpg_disabled.png')?>');
                image.fadeIn('slow');
            });
            $('a').find(image).unwrap();
            $('#btn-'+nombre).html('Agregar');
            $('#btn-'+nombre).removeClass('btn-default eliminar-imagen').addClass('btn-primary text-white image-upload');
        });
    }

    function eliminar_documento_aseguradora(item){
        var icono          = item.icon;
        var image          = $("#"+icono);
        var id_documento = item.id_documento;
        var id_orden      = $('#id_orden').val();
        var url          = '<?=base_url('apis/admin_api/delete_documento_aseguradora')?>';
        $.post(url, {id_orden:id_orden, id_documento:id_documento}, function (response) {
            image.fadeOut('fast', function () {
                image.attr('src', '<?=base_url('assets/img/icons/pdf_disabled.png')?>');
                image.fadeIn('slow');
            });
            $('a').find(image).unwrap();
            $('#btn-'+id_documento).html('Agregar');
            $('#btn-'+id_documento).removeClass('btn-default eliminar-documento-aseguradora').addClass('btn-primary text-white file-upload-aseguradora');
            refresh_incidencias();
        });
    }

    function exito_correo(data){
        if(data.result == '1'){
            showSuccess('Éxito', 'Se ha enviado la incidencia correctamente a los correos seleccionados.');
        }
    }

    function enviar_incidencia(){
        var url             = '<?=base_url('admin/ordenes/mostrar_correos')?>';
        var id_orden     = $('#id_orden').val();
        $.post(url, {id_orden:id_orden}, function (response) {
                $('#myBigModal .modal-content').html('');
                $('#myBigModal .modal-content').append(response);
                setTimeout(function(){ $('#myBigModal').modal('show'); }, 3000);
            });
    }

    function recargar_imagenes(folder, id_orden){
        var url = "<?=base_url('admin/imagenes/get_grid')?>";
        $.post(url, {folder:folder,id_orden:id_orden}, function (response) {
            $('.media-content').html('');
            $('.media-content').html(JSON.parse(response));
        });
    }

    function recargar_expendiente(id_orden){
        var url = "<?=base_url('admin/ordenes/get_expediente')?>";
        $.post(url, {id_orden:id_orden}, function (response) {
            $('#expediente').html('');
            $('#expediente').html(JSON.parse(response));
        });
    }

    function printElement(elem) {
        var domClone = elem.cloneNode(true);

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

    function refresh_comentario(dt){

        if(dt.result == '1'){
            $item = "#comentario-"+dt.id;
            showSubLoader('Espera un momento...');
            $($item).val('');
            $($item).val(dt.comentario);
            closeSubLoader();
            $('#superModal').modal('hide');
        }
    }

    /*function eliminar_foto(ident){
        var url = '<?=base_url('apis/admin_api/delete_image')?>';
        $.post(url, {id:ident}, function (response) {
            var res = JSON.parse(response);
            if(res.result == '1'){
                swal(
                  'Éxito',
                  'se ha eliminado correctamente la imagen.',
                  'success'
                );
                recargar_imagenes(res.folder, res.id_orden);
            }
        });
    }*/

    $(document).on("click", ".delete-expediente", function (e) {
        e.preventDefault();
        var self = $(this);
        var text = $(this).data('text');
        var id   = $(this).data('id');
        showConfirm('Eliminar elemento', '¿Deseas eliminar el archivo '+ text +'?', function () {
            var url = self.attr('href');
            setTimeout(function(){ showSubLoader('Espera un momento...');}, 3000);
            $.post(url, {
            }, function (o) {
                recargar_expendiente(id);
                setTimeout(function(){ closeSubLoader(); }, 3000);
            }, 'json');

            return  false;
        });
    });
</script>
