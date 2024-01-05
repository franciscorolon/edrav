<div class="show-tabs">
    <ul class="nav nav-tabs nav-tabs-simple" role="tablist" data-init-reponsive-tabs="dropdownfx">
        <li class="nav-item">
             <a class="active" data-toggle="tab" role="tab" data-target="#tabArchivos">Archivos</a>
        </li>
        <li class="nav-item">
             <a data-toggle="tab" role="tab" data-target="#tabNuevoArchivo" href="#">Subir Archivo</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tabArchivos">
            <div class="collapse navbar-collapse" id="sub-nav">
                <div class="row">
                    <div class="col-sm-4">
                        <ul class="navbar-nav d-flex flex-row">
                            <li class="nav-item"><a href="#" class="p-r-10" id="cuadricula"><i class="fa fa-th-large"></i></a></li>
                            <li class="nav-item"><a href="#" class="p-r-10" id="listado"><i class="fa fa-th-list"></i></a></li>
                        </ul>
                    </div>
                    <div class="col-sm-4">
                        <ul class="navbar-nav d-flex flex-row">
                            <li class="nav-item">
                                <a  href="#" id="download" data-toggle="download" data-placement="bottom" title="" data-original-title="Download" style="display:none"><i class="fa fa-download"></i> Descargar</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" id="delete" data-toggle="delete" data-placement="bottom" title="" data-original-title="Delete" style="display:none"><i class="fa fa-trash"></i> Eliminar</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-4">
                        <ul class="navbar-nav d-flex flex-row justify-content-sm-end">
                            <li class="nav-item"><a href="#" id="seleccionar" class="p-r-10">Seleccionar</a></li>
                            <li class="nav-item"><a href="#" id="guardar-listado" class="p-r-10" style="display:none">Guardar</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="media-content">
                <div class="row">
                    <div class="col">
                        <?php if(isset($items) && !empty($items) ): ?>
                        <?php $chunk = array_chunk($items, 6);?>
                        <?php foreach($chunk as $c):?>
                        <div class="row m-b-20">
                            <?php foreach($c as $i):?>
                            <div class="col-2 listado-item">
                                <div class="row">
                                    <div class="col-12 image">
                                        <a class="select-image">
                                            <img class="img-fluid mx-auto d-block" src="<?=base_url(ORDENES_PATH.sha1($i['id_orden']).'/imagenes/'.$i['carpeta'].'/'.$i['nombre'])?>" />
                                            <div class="select-image-wrap" data-id="<?=$i['id_documento']?>"><img class="img-fluid" src="<?=base_url('assets/img/icons/blue_check_32.png')?>" /></div>
                                        </a>
                                        <a class="fancy-image" data-fancybox="gallery" href="<?=base_url(ORDENES_PATH.sha1($i['id_orden']).'/imagenes/'.$i['carpeta'].'/'.$i['nombre'])?>" data-caption="<?=$i['comentario']?>" data-id="<?=$i['id_documento']?>">
                                            <img class="img-fluid mx-auto d-block" src="<?=base_url(ORDENES_PATH.sha1($i['id_orden']).'/imagenes/'.$i['carpeta'].'/'.$i['nombre'])?>" />
                                        </a>
                                    </div>
                                    <div class="col-9 nombre" style="display:none">
                                        <input class="nombre form-control" data-id="<?=$i['id_orden']?>" value="<?=$i['orden']?>" />
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <p class="no-results"> No se encontraron archivos en esta carpeta</p>
                        <?php endif; ?>
                    </div>
                  </div>
            </div>
        </div>
        <div class="tab-pane" id="tabNuevoArchivo">
             <div class="row column-seperation">
                <div class="col-12">
                    <form action="/file-upload" data-url="<?=$URL_FORM?>" class="dropzone no-margin">
                        <div class="fallback">
                            <input name="file" type="file" multiple/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="edit-image" style="display:none">
    <div class="card card-image">
        <div class="card-header"><h2>Editar Imagen</h2></div>
        <div class="m-0 row card-body">
            <div class="col-sm-8">
                <img id="edit-image" style="height:auto;width:100%" class="img-fluid" />
            </div>
            <div class="col-sm-4">
                <h4>Comentario de la Imagen</h4>
                <form role="form" method="post" action="<?=base_url('apis/admin_api/update_documento')?>" class="ajaxPostFormModal">
                    <div class="form-group">
                        <label for="comentario">Comentario</label>
                        <textarea class="form-control" id="comentario" name="comentario"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="id" id="id_documento" value="" />
                        <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
                    </div>
                </forn>
            </div>
        </div>
        <div class="card-footer">
            <a id="back-btn" href="#" class="btn btn-primary pull-right">Regresar</a>
        </div>
    </div>
</div>