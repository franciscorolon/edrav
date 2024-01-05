<?php
	$id_grupo 	= $this->session->userdata('id_grupo');
	$id_usuario = $this->session->userdata('id_usuario');
?>
<form id="upload-file"  method="post" action="<?=base_url('apis/admin_api/subir_archivo_orden')?>" class="ajaxPostForm"  style="display:none" data-function-success="recargar_documento">
    <input type="file" id="file" name="file" accept="pdf" />
    <input type="hidden" id="nombre" name="nombre" value="" />
    <input type="hidden" id="icono" name="icono" value="" />
    <input type="hidden" name="id_orden" value="<?=$orden['id_orden']?>" />
    <input type="submit">
</form>
<form id="upload-image"  method="post" action="<?=base_url('apis/admin_api/subir_imagen_orden')?>" class="ajaxPostForm"  style="display:none" data-function-success="recargar_imagen">
    <input type="file" id="file-image" name="file" accept="image/*" />
    <input type="hidden" id="nombre-image" name="nombre" value="" />
    <input type="hidden" id="icono-image" name="icono" value="" />
    <input type="hidden" name="id_orden" value="<?=$orden['id_orden']?>" />
    <input type="submit">
</form>
<form id="upload-aseguradora_documento"  method="post" action="<?=base_url('apis/admin_api/upload_aseguradora_documento')?>" class="ajaxPostForm"  style="display:none" data-function-success="recargar_aseguradora_documento">
    <input type="file" id="file-aseguradora" name="file" accept="pdf" />
    <input type="hidden" id="id_documento-aseguradora" name="id_documento-aseguradora" value="" />
    <input type="hidden" id="icono-aseguradora" name="icono-aseguradora" value="" />
    <input type="hidden" name="id_orden-aseguradora" value="<?=$orden['id_orden']?>" />
    <input type="submit">
</form>
<form id="orden" method="post" action="<?=$url_form?>" class="ajaxPostFormModal" data-function-success="recargar_orden">
    <input type="hidden" id="id_orden" name="id" value="<?=$orden['id_orden']?>"/>
    <div class="row">
        <div class="col-md-2">
            <h3><span class="semi-bold">Orden</span><?=$orden['no_orden']?></h3>
        </div>
        <div class="col-md-6">
            <p class="align-left m-t-20"><span class="bold">Fecha recepción</span> <?=$this->functions->fecha_incidencia($orden['fecha_recepcion'])?></p>
        </div>
        <div class="col-md-4">
            <div class="pull-right">
                <a href="<?=base_url('admin/ordenes')?>" class="btn btn-default btn-cons">Cancelar</a>
                <?php if( $id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == VALUACION || $id_grupo == CLIENTES_AVANZADO): ?>
                <button type="submit" class="btn btn-success btn-cons">Guardar</button>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-body">
                    <h4>
                        <span class="semi-bold">Datos Generales</span>
                        <div class="pull-right">
                            <?php if (!$this->session->userdata('id_usuario') || ($id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == CLIENTES_AVANZADO) ){ ?>
                            <a id="show_datos" href='#' class="btn-link cambiar">Editar</a>
                            <a id="hide_datos" href="#" class="btn-link cambiar" style="display:none">Ocultar</a>
                            <?php } ?>
                        </div>
                    </h4>
                    <div id="info_general">
                        <div class="row">
                            <div class="col-6"></div>
                            <div class="col-3 text-right"><span class="bold">Fecha Tentativa:</span></div>
                            <div class="col-3"><?=$this->functions->solo_fecha_incidencia($orden['fecha_promesa'])?></div>
                        </div>
                        <h4><?=$cliente['nombre'].' '.$cliente['paterno'].' '.$cliente['materno']?></h4>
                        <div class="row m-b-10">
                            <div class="col-1"><span class="bold">Celular</span></div>
                            <div class="col-3"><?=$cliente['celular']?></div>
                            <div class="col-1"><span class="bold">Correo</span></div>
                            <div class="col-7"><?=$cliente['email']?></div>
                        </div>
                        <div class="row">
                            <div class="col-1"><span class="bold">Marca</span></div>
                            <div class="col-3"><?=$orden['marca']?></div>
                            <div class="col-1"><span class="bold">Tipo</span></div>
                            <div class="col-3"><?=$orden['tipo']?></div>
                            <div class="col-1"><span class="bold">Color</span></div>
                            <div class="col-3"><?=$orden['color']?></div>
                        </div>
                        <div class="row">
                            <div class="col-1"><span class="bold">Placas</span></div>
                            <div class="col-3"><?=$orden['no_placas']?></div>
                            <div class="col-1"><span class="bold">Modelo</span></div>
                            <div class="col-3"><?=$orden['modelo']?></div>
                            <div class="col-1"><span class="bold">Serie</span></div>
                            <div class="col-3"><?=$orden['no_serie']?></div>
                        </div>
                    </div>
                    <div id="form_general" style="display:none">
                        <div class="row clearfix">
                            <div class="col-md-8"></div>
                            <div class="col-md-4">
                                <?php if ($this->session->userdata('id_usuario') && $id_grupo == SUPER_ADMINISTRADOR ): ?>
                                <div class="form-group">
                                    <label>Fecha Tentativa</label>
                                    <div class="input-group date col-md-12 p-l-0">
                                        <input type="text" name="fecha_promesa" class="form-control" value="<?=date('d/m/Y', strtotime($orden['fecha_promesa']))?>" >
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button" id="btn-calendar"><i class="fa fa-calendar"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <?php endif;?>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="id_cliente">Cliente <span class="required"></span></label>
                                    <?=form_dropdown('id_cliente', $clientes, $orden['id_cliente'], ['id' => 'id_cliente', 'class' => 'form-control full-width', 'required' => '']);?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <a id="nuevo_cliente" href="<?=base_url('admin/clientes/mostrar_form')?>" class="btn-link cambiar show-modal m-t-10" data-function-success="refresh_clientes">Nuevo Cliente</a>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Marca <span class="required"></span></label>
                                    <input type="text" class="form-control" id="marca" name="marca" required="" aria-required="true" value="<?=$orden['marca']?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tipo <span class="required"></span></label>
                                    <input type="text" class="form-control" id="tipo" name="tipo" required="" aria-required="true" value="<?=$orden['tipo']?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Color <span class="required"></span></label>
                                    <input type="text" class="form-control" id="color" name="color" required="" aria-required="true" value="<?=$orden['color']?>">
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Placas <span class="required"></span></label>
                                    <input type="text" class="form-control" id="no_placas" name="no_placas" required="" aria-required="true" value="<?=$orden['no_placas']?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Modelo <span class="required"></span></label>
                                    <select id="modelo" name="modelo" class="form-control" required aria-required="true">
                                    <?php
                                        $start_y  = date('Y', strtotime('-80 year'));
                                        $end_y    = date('Y', strtotime('+2 years'));
                                        for($end_y; $end_y >= $start_y+2; $end_y--) {?>
                                        <option value="<?=$end_y?>" <?=( $end_y ==  $orden['modelo'] )?'selected="selected"':'';?>><?=$end_y?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>No. de Serie <span class="required"></span></label>
                                    <input type="text" class="form-control" id="no_serie" name="no_serie" required="" aria-required="true" value="<?=$orden['no_serie']?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-transparent">
                <div class="card-body">
                    <header><h4><span class="semi-bold"></span></h4></header>
                    <div id="carpetas" class="row justify-content-md-center clearfix">
                        <div class="col-2 text-center">
                            <a href="<?=base_url('admin/imagenes/mostrar_form/'.$orden['id_orden'].'/ingreso')?>" class="show-modal-folder">
                                <img class="img-fluid" src="<?=base_url('assets/img/icons/folder.png')?>" />
                                Ingreso
                            </a>
                        </div>
                        <div class="col-2 text-center">
                            <a href="<?=base_url('admin/imagenes/mostrar_form/'.$orden['id_orden'].'/procesos')?>" class="show-subfolders" data-target="carpetas-procesos">
                                <img class="img-fluid" src="<?=base_url('assets/img/icons/folder.png')?>" />
                                Procesos
                            </a>
                        </div>
                        <div class="col-2 text-center">
                            <a href="<?=base_url('admin/imagenes/mostrar_form/'.$orden['id_orden'].'/entrega')?>" class="show-modal-folder">
                                <img class="img-fluid" src="<?=base_url('assets/img/icons/folder.png')?>" />
                                Entrega
                            </a>
                        </div>
                        <div class="col-2 text-center">
                            <a href="<?=base_url('admin/imagenes/mostrar_form/'.$orden['id_orden'].'/reingreso')?>" class="show-modal-folder">
                                <img class="img-fluid" src="<?=base_url('assets/img/icons/folder.png')?>" />
                                Reingreso
                            </a>
                        </div>
                        <div class="col-2 text-center">
                            <a href="#" class="show-subfolders" data-target="carpetas-cvp2">
                                <img class="img-fluid" src="<?=base_url('assets/img/icons/folder.png')?>" />
                                CVP2
                            </a>
                        </div>
                        <div class="col-2 text-center">
                            <a href="<?=base_url('admin/imagenes/mostrar_form/'.$orden['id_orden'].'/otros')?>" class="show-modal-folder">
                                <img class="img-fluid" src="<?=base_url('assets/img/icons/folder.png')?>" />
                                Otros
                            </a>
                        </div>
                    </div>
                    <div id="carpetas-procesos" class="row justify-content-md-center clearfix" style="display:none">
                        <div class="col-md-10">
                            <div class="row justify-content-md-center clearfix">
                                <div class="col-1-5 text-center">
                                    <a href="<?=base_url('admin/imagenes/mostrar_form/'.$orden['id_orden'].'/auto_desarmado')?>" class="show-modal-folder">
                                        <img class="img-fluid" src="<?=base_url('assets/img/icons/folder.png')?>" />
                                        <span class="bold">Auto desarmado</span>
                                    </a>
                                </div>
                                <div class="col-1-5 text-center">
                                    <a href="<?=base_url('admin/imagenes/mostrar_form/'.$orden['id_orden'].'/piezas')?>" class="show-modal-folder">
                                        <img class="img-fluid" src="<?=base_url('assets/img/icons/folder.png')?>" />
                                        <span class="bold">Piezas</span>
                                    </a>
                                </div>
                                <div class="col-1-5 text-center">
                                    <a href="<?=base_url('admin/imagenes/mostrar_form/'.$orden['id_orden'].'/laminacion')?>" class="show-modal-folder">
                                        <img class="img-fluid" src="<?=base_url('assets/img/icons/folder.png')?>" />
                                        <span class="bold">Laminación</span>
                                    </a>
                                </div>
                                <div class="col-1-5 text-center">
                                    <a href="<?=base_url('admin/imagenes/mostrar_form/'.$orden['id_orden'].'/pintura')?>" class="show-modal-folder">
                                        <img class="img-fluid" src="<?=base_url('assets/img/icons/folder.png')?>" />
                                        <span class="bold">Pintura</span>
                                    </a>
                                </div>
                                <div class="col-1-5 text-center">
                                    <a href="<?=base_url('admin/imagenes/mostrar_form/'.$orden['id_orden'].'/mecanica')?>" class="show-modal-folder">
                                        <img class="img-fluid" src="<?=base_url('assets/img/icons/folder.png')?>" />
                                        <span class="bold">Mecánica</span>
                                    </a>
                                </div>
                                <div class="col-1-5 text-center">
                                    <a href="<?=base_url('admin/imagenes/mostrar_form/'.$orden['id_orden'].'/armado')?>" class="show-modal-folder">
                                        <img class="img-fluid" src="<?=base_url('assets/img/icons/folder.png')?>" />
                                        <span class="bold">Armado</span>
                                    </a>
                                </div>
                                <div class="col-1-5 text-center">
                                    <a href="<?=base_url('admin/imagenes/mostrar_form/'.$orden['id_orden'].'/detallado')?>" class="show-modal-folder">
                                        <img class="img-fluid" src="<?=base_url('assets/img/icons/folder.png')?>" />
                                        <span class="bold">Detallado</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="carpetas-cvp2" class="row justify-content-md-center clearfix" style="display:none">
                        <div class="col-md-4 offset-md-6">
                            <div class="row justify-content-md-center ">
                                <div class="col-6 text-center">
                                    <a href="<?=base_url('admin/imagenes/mostrar_form/'.$orden['id_orden'].'/cvp2_1')?>" class="show-modal-folder subfolder">
                                        <img class="img-fluid" src="<?=base_url('assets/img/icons/folder.png')?>" />
                                        <span class="bold">1</span>
                                    </a>
                                </div>
                                <div class="col-6 text-center">
                                    <a href="<?=base_url('admin/imagenes/mostrar_form/'.$orden['id_orden'].'/cvp2_2')?>" class="show-modal-folder subfolder">
                                        <img class="img-fluid" src="<?=base_url('assets/img/icons/folder.png')?>" />
                                        <span class="bold">2</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-transparent">
                <div class="card-body">
                    <header><h4><span class="semi-bold">Incidencias</span></h4></header>
                     <?php if( $id_grupo != OPERADORES){ ?>
                    <div class="row clearfix m-b-20">
                        <div class="col-10">
                            <textarea class="form-control m-b-5" id="incidencia" rows="4"></textarea>
                            <input type="checkbox" id="es_llamada" value="">
                            <label for="es_llamada">¿Esta incidencia es una <b>llamada</b> al cliente?</label>
                        </div>
                        <div class="col-2">
                            <a href="#" class="btn btn-primary" id="publicar_incidencia">Publicar</a>
                        </div>
                    </div>
                     <?php } ?>
                    <div class="container-fluid sm-p-l-5 bg-master-lighter">
                        <div class="timeline-container center top-circle">
                          <section class="timeline">
                            <?php foreach($incidencias as $i):?>
                                <?php if(!empty($i['status'])){?>
                                <div class="timeline-block">
                                    <div class="timeline-point success"><i class="pg-settings_small"></i></div>
                                    <div class="timeline-content">
                                        <div class="card social-card share full-width">
                                            <div class="card-description">
                                                <p class="bold"><?='#'.$i['no_sucesivo'].'<br>'.$i['incidencia']?></p>
                                                <div class="via"><?=$i['generado_por']?></div>
                                            </div>
                                        </div>
                                        <div class="event-date">
                                            <?php if(!empty($i['status'])){?>
                                            <h6><?=$i['status']?></h6>
                                            <?php } ?>
                                            <small class="fs-12 hint-text"><?=$this->functions->fecha_incidencia($i['fecha_incidencia'])?></small>
                                        </div>
                                    </div>
                                </div>
                                <?php }else{ ?>
                                <div class="timeline-block">
                                    <?php if($i['llamada']){ ?>
                                    <div class="timeline-point warning">
                                        <i class="pg-telephone"></i>
                                    </div>
                                    <?php }else{?>
                                    <div class="timeline-point small"></div>
                                        <?php } ?>
                                   <div class="timeline-content">
                                        <div class="card social-card share full-width">
                                            <div class="card-description">
                                                <p class="bold"><?='#'.$i['no_sucesivo'].'<br>'.$i['incidencia']?></p>
                                                <div class="via"><?=$i['generado_por']?></div>
                                            </div>
                                        </div>
                                        <div class="event-date">
                                            <?php if(!empty($i['status'])){?>
                                            <h6><?=$i['status']?></h6>
                                            <?php } ?>
                                            <small class="fs-12 hint-text"><?=$this->functions->fecha_incidencia($i['fecha_incidencia'])?></small>
                                        </div>
                                   </div>
                                </div>
                                <?php } ?>
                            <?php endforeach; ?>
                          </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-default">
                <div class="card-body">
                    <h4>
                        <span class="semi-bold">Estado</span>
                        <div class="pull-right">
                            <?php if (!$this->session->userdata('id_usuario') || ($id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == VALUACION || $id_grupo == CLIENTES_AVANZADO) ): ?>
                            <a href='<?=base_url('admin/ordenes/status/'.$orden['id_orden'])?>' class="btn-link cambiar show-modal">Cambiar</a>
                            <?php endif; ?>
                        </div>
                    </h4>
                    <?php
                        $estado           = [
                            'VALUACION'     => 'En Valuación',
                            'REPARACION'    => 'En Reparación',
                            'RESGUARDO'     => 'En CVP2',
                            'TRANSITO'      => 'En Tránsito',
                            'ENTREGADO'     => 'Entregado',
                            'FACTURADO'     => 'Facturado',
                            'ARCHIVADO'     => 'Archivado',
                            'PERDIDAS'      => 'Perdidas Totales',
                            'DANOS'         => 'Pago de Daños',
                        ];
                    ?>
                    <h5 id="status"><?=$estado[$orden['status']]?></h5>
                </div>
            </div>
            <div class="card card-default">
                <div class="card-body">
                    <h4>
                        <span class="semi-bold">Asesor</span>
                        <div class="pull-right">
                            <a id="hide_asesor" href='#' class="btn-link cambiar" style="display:none">Ocultar</a>
                            <?php if( $id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == CLIENTES_AVANZADO): ?>
                            <a id="show_asesor" href='#' class="btn-link cambiar">Editar</a>
                            <?php endif; ?>
                        </div>
                    </h4>
                    <div id="form_asesor" style="display:none">
                        <div class="form-group" aria-required="true">
                            <label>Asesor <span class="required"></span></label>
                            <?=form_dropdown('id_asesor', $asesores, $orden['id_asesor'], ['id' => 'id_asesor', 'class' => 'form-control full-width', 'required' => '']);?>
                        </div>
                    </div>
                    <div id="info_asesor">
                        <h4><?=$asesor['nombre'].' '.$asesor['paterno'].' '.$asesor['materno']?></h4>
                    </div>
                </div>
            </div>
            <div class="card card-default">
                <div class="card-body">
                    <h4>
                        <span class="semi-bold">Compañía</span>
                        <div class="pull-right">
                            <a id="hide_compania" href="#" class="btn-link cambiar" style="display:none">Ocultar</a>
                            <?php if( $id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == CLIENTES_AVANZADO): ?>
                            <a id="show_compania" href='#' class="btn-link cambiar">Cambiar</a>
                            <?php endif; ?>
                        </div>
                    </h4>
                    <div id="info_compania">
                        <h5><?=$aseguradora['nombre']?></h5>
                        <div class="row">
                            <div class="col-md-4"><span class="bold">Tipo Cliente</span></div>
                            <div class="col-md-8"><?=$orden['tipo_cliente']?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"><span class="bold">No. Siniestro</span></div>
                            <div class="col-md-8"><?=$orden['no_siniestro']?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"><span class="bold">No. Póliza</span></div>
                            <div class="col-md-8"><?=$orden['no_poliza']?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"><span class="bold">Iniciso</span></div>
                            <div class="col-md-8"><?=$orden['inciso']?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"><span class="bold">Ajustador</span></div>
                            <div class="col-md-8"><?=$ajustador['nombre'].' '.$ajustador['paterno'].' '.$ajustador['materno']?></div>
                        </div>
                    </div>
                    <div id="form_compania" style="display:none">
                        <div class="form-group">
                            <label>Aseguradora <span class="required"></span></label>
                            <?=form_dropdown('id_aseguradora', $aseguradoras, $orden['id_aseguradora'], ['id' => 'id_aseguradora', 'class' => 'form-control full-width', 'required' => '']);?>
                        </div>
                        <div class="form-group clearfix">
                            <label>Ajustador <span class="required"></span></label>
                            <?=form_dropdown('id_ajustador', $ajustadores, $orden['id_ajustador'], ['id' => 'id_ajustador', 'class' => 'form-control full-width', 'required' => '']);?>
                        </div>
                        <div class="form-group">
                            <label>Tipo Cliente <span class="required"></span></label>
                            <div class="row">
                                <label class="col-sm-4 col-form-label" for="asegurado">Asegurado</label>
                                <div class="col-sm-2">
                                <?=form_radio('tipo_cliente', 'ASEGURADO', ($orden['tipo_cliente'] == 'ASEGURADO')?TRUE:FALSE , ['id' => 'asegurado']);?>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-4 col-form-label " for="tecero">Tercero</label>
                                <div class="col-sm-2">
                                <?=form_radio('tipo_cliente', 'TERCERO', ($orden['tipo_cliente'] == 'TERCERO')?TRUE:FALSE, ['id' => 'tercero']);?>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-4 col-form-label " for="no-aplica">No Aplica</label>
                                <div class="col-sm-2">
                                <?=form_radio('tipo_cliente', 'NO APLICA', ($orden['tipo_cliente'] == 'NO APLICA')?TRUE:FALSE, ['id' => 'no-aplica']);?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>No. Sieniestro <span class="required"></span></label>
                            <input type="text" class="form-control" id="no_siniestro" name="no_siniestro" required="" aria-required="true" value="<?=$orden['no_siniestro']?>">
                        </div>
                        <div class="form-group">
                            <label>No. Póliza <span class="required"></span></label>
                            <input type="text" class="form-control" id="no_poliza" name="no_poliza" required="" aria-required="true" value="<?=$orden['no_poliza']?>">
                        </div>
                        <div class="form-group clearfix">
                            <label>Inciso</label>
                            <input type="text" class="form-control" name="inciso" value="<?=$orden['inciso']?>">
                        </div>
                    </div>
                </div>
            </div>
            <?php if( $id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == VALUACION  || $id_grupo == CLIENTES_AVANZADO  || $id_grupo == CLIENTES_BASICO ): ?>
            <div class="card card-default">
                <div class="card-body">
                    <h4>
                        <span class="semi-bold">Importes</span>
                        <div class="pull-right">
                            <a id="hide_importes" href="#" class="btn-link cambiar" style="display:none">Ocultar</a>
                            <?php if( $id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == VALUACION || $id_grupo == CLIENTES_AVANZADO): ?>
                            <a id="show_importes" href='#' class="btn-link cambiar">Cambiar</a>
                            <?php endif;?>
                        </div>
                    </h4>
                    <div id="info_importes">
                        <?php if(!is_null($orden['deducible'])):?>
                        <div class="row">
                            <div class="col-md-4"><span class="bold">Deducible</span></div>
                            <div class="col-md-8">$ <?=number_format($orden['deducible'], 2);?></div>
                        </div>
                        <?php endif; ?>
                        <?php if(!is_null($orden['demerito'])):?>
                        <div class="row">
                            <div class="col-md-4"><span class="bold">Demérito</span></div>
                            <div class="col-md-8">$ <?=number_format($orden['demerito'], 2);?></div>
                        </div>
                        <?php endif; ?>
                        <?php if(!is_null($orden['valuacion'])):?>
                        <div class="row">
                            <div class="col-md-4"><span class="bold">Valuación</span></div>
                            <div class="col-md-8">$ <?=number_format($orden['valuacion'], 2);?></div>
                        </div>
                        <?php endif; ?>
                        <?php if(!is_null($orden['varios'])):?>
                        <div class="row">
                            <div class="col-md-4"><span class="bold">Varios</span></div>
                            <div class="col-md-8">$ <?=number_format($orden['varios'], 2);?></div>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div id="form_importes" style="display:none">
                        <div class="row m-b-10">
                            <div class="col-6">
                                <input type="checkbox" id="es_deducible" name="es_deducible" class="valid-check" data-field="deducible" <?=(!is_null($orden['deducible'])) ? 'checked="checked"':'' ?>>
                                <label for="es_deducible">Deducible</label>
                                <input type="text" data-a-sign="$ " class="autonumeric form-control text-right" id="deducible" name="deducible" <?=(!is_null($orden['deducible'])) ? '':'style="display:none"' ?> value="<?=$orden['deducible']?>">
                            </div>
                            <div class="col-6">
                                <input type="checkbox" id="es_demerito" name="es_demerito" class="valid-check" data-field="demerito" <?=(!is_null($orden['demerito'])) ? 'checked="checked"':'' ?>>
                                <label for="es_demerito">Demérito</label>
                                <input type="text" data-a-sign="$ " class="autonumeric form-control text-right" id="demerito" name="demerito" <?=(!is_null($orden['demerito'])) ? '':'style="display:none"' ?> value="<?=$orden['demerito']?>">
                            </div>
                        </div>
                        <div class="row m-b-10">
                            <div class="col-6">
                                <input type="checkbox" id="es_valuacion" name="es_valuacion" class="valid-check" data-field="valuacion" <?=(!is_null($orden['valuacion'])) ? 'checked="checked"':'' ?>>
                                <label for="es_valuacion">Valuación</label>
                                <input type="text" data-a-sign="$ " class="autonumeric form-control text-right" id="valuacion" name="valuacion" <?=(!is_null($orden['valuacion'])) ? '':'style="display:none"' ?> value="<?=$orden['valuacion']?>"/>
                            </div>
                            <div class="col-6">
                                <input type="checkbox" id="es_varios" name="es_varios" class="valid-check" data-field="varios" <?=(!is_null($orden['varios'])) ? 'checked="checked"':'' ?>>
                                <label for="es_varios">Varios</label>
                                <input type="text" data-a-sign="$ " class="autonumeric form-control text-right" id="varios" name="varios" <?=(!is_null($orden['varios'])) ? '':'style="display:none"' ?> value="<?=$orden['varios']?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php if( $id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == CLIENTES_AVANZADO || $id_grupo == CLIENTES_BASICO ): ?>
            <div class="card card-default">
                <div class="card-body">
                    <h4>
                        <span class="semi-bold">Recibos</span>
                        <div class="pull-right">
                            <?php if( $id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == CLIENTES_AVANZADO || $id_grupo == CLIENTES_BASICO ): ?>
                            <a id="add_recibo" href='<?=base_url('admin/ordenes/nuevo_recibo/'.$orden['id_orden'])?>' class="btn btn-primary btn-xs show-modal">Nuevo</a>
                            <?php endif; ?>
                        </div>
                    </h4>
                    <div id="info_recibos">
                        <?php if(!empty($recibos) && ( is_array($recibos) || is_object($recibos)) ){ ?>
                        <div class="row">
                            <div class="col-6 text-center"><b>No.Recibo</b></div>
                            <div class="col-6 text-center"><b>Cantidad</b></div>
                        </div>
                        <?php foreach($recibos as $recibo){ ?>
                        <div class="row">
                            <div class="col-6 text-center">
                                <?php $label = ($recibo['cancelado'])?'<i class="fa fa-ban"></i> '.$recibo['no_recibo']:$recibo['no_recibo'];?>
                                <?=anchor(base_url('admin/ordenes/mostrar_recibo/'.$recibo['id_recibo']), $label , ['class' => 'show-modal-lg'])?></div>
                            <div class="col-6 text-right">$ <?=number_format($recibo['cantidad'],2)?></div>
                        </div>
                        <?php }
                        }?>
                    </div>
                </div>
            </div>
            <?php endif;?>
            <?php if( $id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == CLIENTES_AVANZADO || $id_grupo == CLIENTES_BASICO ): ?>
            <div class="card card-default">
                <div class="card-body">
                    <h4>
                        <span class="semi-bold">Vales de Refacción</span>
                        <div class="pull-right">
                            <?php if( $id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == CLIENTES_AVANZADO || $id_grupo == CLIENTES_BASICO ): ?>
                            <a id="add_vale" href='<?=base_url('admin/ordenes/nuevo_vale/'.$orden['id_orden'])?>' class="btn btn-primary btn-xs show-modal">Nuevo</a>
                            <?php endif; ?>
                        </div>
                    </h4>
                    <div id="info_vales">
                        <?php if(!empty($vales) && ( is_array($vales) || is_object($vales)) ){ ?>
                        <div class="row">
                            <div class="col-6 text-center"><b>No.Vale</b></div>
                            <div class="col-6 text-center"><b>Vale por</b></div>
                        </div>
                        <?php foreach($vales as $vale){ ?>
                        <div class="row">
                            <div class="col-6 text-center">
                                <?php $label = ($vale['cancelado'])?'<i class="fa fa-ban"></i> '.$vale['no_vale']:$vale['no_recibo'];?>
                                <?=anchor(base_url('admin/ordenes/mostrar_vale/'.$vale['id_vale']), $label , ['class' => 'show-modal-lg'])?></div>
                            <div class="col-6 text-right"><?=$vale['vale_por']?></div>
                        </div>
                        <?php }
                        }?>
                    </div>
                </div>
            </div>
            <?php endif;?>
            <?php if( $id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == CLIENTES_AVANZADO || $id_grupo == CLIENTES_BASICO ): ?>
            <div class="card card-default">
                <div class="card-body">
                    <h4>
                        <span class="semi-bold">Bonificaciones</span>
                        <div class="pull-right">
                            <?php if( $id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == CLIENTES_AVANZADO || $id_grupo == CLIENTES_BASICO ): ?>
                            <a id="add_vale" href='<?=base_url('admin/ordenes/nueva_bonificacion/'.$orden['id_orden'])?>' class="btn btn-primary btn-xs show-modal">Nuevo</a>
                            <?php endif; ?>
                        </div>
                    </h4>
                    <div id="info_bonificaciones">
                        <?php if(!empty($bonificaciones) && ( is_array($bonificaciones) || is_object($bonificaciones)) ){ ?>
                        <div class="row">
                            <div class="col-6 text-center"><b>No.Bonificación</b></div>
                            <div class="col-6 text-center"><b>Bonifiación</b></div>
                        </div>
                        <?php foreach($bonificaciones as $bonificacion){ ?>
                        <div class="row">
                            <div class="col-6 text-center">
                                <?php $label = ($bonificacion['cancelado'])?'<i class="fa fa-ban"></i> '.$bonificacion['no_vale']:$vale['no_bonificacion'];?>
                                <?=anchor(base_url('admin/ordenes/mostrar_bonificacion/'.$bonificacion['id_bonificacion']), $label , ['class' => 'show-modal-lg'])?></div>
                            <div class="col-6 text-right"><?=$bonificacion['bonificacion']?></div>
                        </div>
                        <?php }
                        }?>
                    </div>
                </div>
            </div>
            <?php endif;?>
            <?php if( $id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == CLIENTES_AVANZADO || $id_grupo == CLIENTES_BASICO ): ?>
            <div class="card card-default">
                <div class="card-body">
                    <h4>
                        <span class="semi-bold">Encerado/Otros</span>
                        <div class="pull-right">
                            <?php if( $id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == CLIENTES_AVANZADO || $id_grupo == CLIENTES_BASICO ): ?>
                            <a id="add_vale" href='<?=base_url('admin/ordenes/nuevo_encerado/'.$orden['id_orden'])?>' class="btn btn-primary btn-xs show-modal">Nuevo</a>
                            <?php endif; ?>
                        </div>
                    </h4>
                    <div id="info_encerado">
                        <?php if(!empty($encerados) && ( is_array($encerados) || is_object($encerados)) ){ ?>
                        <div class="row">
                            <div class="col-6 text-center"><b>No.Encerado</b></div>
                            <div class="col-6 text-center"><b>Beneficio</b></div>
                        </div>
                        <?php foreach($encerados as $encerado){ ?>
                        <div class="row">
                            <div class="col-6 text-center">
                                <?php $label = ($encerado['cancelado'])?'<i class="fa fa-ban"></i> '.$encerado['no_vale']:$encerado['no_recibo'];?>
                                <?=anchor(base_url('admin/ordenes/mostrar_encerado/'.$encerado['id_encerado']), $label , ['class' => 'show-modal-lg'])?></div>
                            <div class="col-6 text-right"><?=$encerado['beneficio']?></div>
                        </div>
                        <?php }
                        }?>
                    </div>
                </div>
            </div>
            <?php endif;?>
            <div id="document-card" class="card card-default">
                <div class="card-header">
                    <div class="card-title">
                        <h4><span class="semi-bold">Documentos</span></h4>
                    </div>
                    <div class="card-controls">
                        <ul>
                            <li><a href="#" class="card-collapse" data-toggle="collapse"><i class="card-icon card-icon-collapse"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td class="v-align-middle p-0 p-l-10">
                                <?php if(isset($orden['volante']) && !is_null($orden['volante'])){?>
                                <a target="_blank" href="<?=base_url(ORDENES_PATH.sha1($orden['id_orden']).'/documentos/'.$orden['volante'])?>"><img id="icon-volante" class="img-fluid" src="<?=base_url('assets/img/icons/pdf_active.png')?>" /></a>
                                <?php }else{ ?>
                                <img id="icon-volante" class="img-fluid" src="<?=base_url('assets/img/icons/pdf_disabled.png')?>" />
                                <?php } ?>
                            </td>
                            <td class="v-align-middle p-0 p-l-10">Volante</td>
                            <td class="v-align-middle">
                            <?php
                                if(array_key_exists('volante', $orden) && !is_null($orden['volante'])){
                                    if( $id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR  || $id_grupo == CLIENTES_AVANZADO){
                                        $clases = 'btn btn-default btn-xs eliminar-documento';
                                        $text    = 'Eliminar';
                                        echo anchor('',$text, ['id' => 'btn-volante', 'class' => $clases, 'data-icon' => 'icon-volante', 'data-nombre' => 'volante'] );
                                    }else{
                                        echo '<div style="display:block;min-height:27px"></div>';
                                    }
                                }else{
                                    $clases = 'btn btn-primary btn-xs text-white file-upload';
                                    $text     = 'Agregar';
                                    if( $id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == VALUACION  || $id_grupo == CLIENTES_AVANZADO){
                                    echo anchor('',$text, ['id' => 'btn-volante', 'class' => $clases, 'data-icon' => 'icon-volante', 'data-nombre' => 'volante'] );
                                    }
                                }
                            ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="v-align-middle p-0 p-l-10">
                                <?php if(isset($orden['poliza']) && !is_null($orden['poliza'])){?>
                                <a target="_blank" href="<?=base_url(ORDENES_PATH.sha1($orden['id_orden']).'/documentos/'.$orden['poliza'])?>"><img id="icon-poliza" class="img-fluid" src="<?=base_url('assets/img/icons/pdf_active.png')?>" /></a>
                                <?php }else{ ?>
                                <img id="icon-poliza" class="img-fluid" src="<?=base_url('assets/img/icons/pdf_disabled.png')?>" />
                                <?php } ?>
                            </td>
                            <td class="v-align-middle p-0 p-l-10">Póliza</td>
                            <td class="v-align-middle">
                            <?php
                                if(array_key_exists('poliza', $orden) && !is_null($orden['poliza'])){
                                    if( $id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == CLIENTES_AVANZADO){
                                        $clases = 'btn btn-default btn-xs eliminar-documento';
                                        $text    = 'Eliminar';
                                        echo anchor('',$text, ['id' => 'btn-poliza', 'class' => $clases, 'data-icon' => 'icon-volante', 'data-nombre' => 'poliza'] );
                                    }else{
                                        echo '<div style="display:block;min-height:27px"></div>';
                                    }
                                }else{
                                    $clases = 'btn btn-primary btn-xs text-white file-upload';
                                    $text     = 'Agregar';
                                    if( $id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == VALUACION  || $id_grupo == CLIENTES_AVANZADO){
                                    echo anchor('',$text, ['id' => 'btn-poliza', 'class' => $clases, 'data-icon' => 'icon-poliza', 'data-nombre' => 'poliza'] );
                                    }
                                }
                            ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="v-align-middle p-0 p-l-10">
                                <?php if(isset($orden['identificacion']) && !is_null($orden['identificacion'])){?>
                                <a target="_blank" href="<?=base_url(ORDENES_PATH.sha1($orden['id_orden']).'/documentos/'.$orden['identificacion'])?>"><img id="icon-identificacion" class="img-fluid" src="<?=base_url('assets/img/icons/pdf_active.png')?>" /></a>
                                <?php }else{ ?>
                                <img id="icon-identificacion" class="img-fluid" src="<?=base_url('assets/img/icons/pdf_disabled.png')?>" />
                                <?php } ?>
                            </td>
                            <td class="v-align-middle p-0 p-l-10">Identificación</td>
                            <td class="v-align-middle">
                            <?php
                                if(array_key_exists('identificacion', $orden) && !is_null($orden['identificacion'])){
                                    if( $id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == CLIENTES_AVANZADO){
                                        $clases = 'btn btn-default btn-xs eliminar-documento';
                                        $text    = 'Eliminar';
                                        echo anchor('',$text, ['id' => 'btn-identificacion', 'class' => $clases, 'data-icon' => 'icon-identificacion', 'data-nombre' => 'identificacion'] );
                                    }else{
                                        echo '<div style="display:block;min-height:27px"></div>';
                                    }
                                }else{
                                    $clases = 'btn btn-primary btn-xs text-white file-upload';
                                    $text     = 'Agregar';
                                    if( $id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == VALUACION  || $id_grupo == CLIENTES_AVANZADO){
                                    echo anchor('',$text, ['id' => 'btn-identificacion', 'class' => $clases, 'data-icon' => 'icon-identificacion', 'data-nombre' => 'identificacion'] );
                                    }
                                }
                            ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="v-align-middle p-0 p-l-10">
                                <?php if(isset($orden['tarjeta_circulacion']) && !is_null($orden['tarjeta_circulacion'])){?>
                                <a target="_blank" href="<?=base_url(ORDENES_PATH.sha1($orden['id_orden']).'/documentos/'.$orden['tarjeta_circulacion'])?>"><img id="icon-tarjeta_circulacion" class="img-fluid" src="<?=base_url('assets/img/icons/pdf_active.png')?>" /></a>
                                <?php }else{ ?>
                                <img id="icon-tarjeta_circulacion" class="img-fluid" src="<?=base_url('assets/img/icons/pdf_disabled.png')?>" />
                                <?php } ?>
                            </td>
                            <td class="v-align-middle p-0 p-l-10">Tarjeta de Circulación</td>
                            <td class="v-align-middle">
                            <?php
                                if(array_key_exists('tarjeta_circulacion', $orden) && !is_null($orden['tarjeta_circulacion'])){
                                    if( $id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == CLIENTES_AVANZADO){
                                        $clases = 'btn btn-default btn-xs eliminar-documento';
                                        $text    = 'Eliminar';
                                        echo anchor('',$text, ['id' => 'btn-tarjeta_circulacion', 'class' => $clases, 'data-icon' => 'icon-tarjeta_circulacion', 'data-nombre' => 'tarjeta_circulacion'] );
                                    }else{
                                        echo '<div style="display:block;min-height:27px"></div>';
                                    }
                                }else{
                                    $clases = 'btn btn-primary btn-xs text-white file-upload';
                                    $text     = 'Agregar';
                                    if( $id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == VALUACION  || $id_grupo == CLIENTES_AVANZADO){
                                    echo anchor('',$text, ['id' => 'btn-tarjeta_circulacion', 'class' => $clases, 'data-icon' => 'icon-tarjeta_circulacion', 'data-nombre' => 'tarjeta_circulacion'] );
                                    }
                                }
                            ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="v-align-middle p-0 p-l-10">
                                <?php if(isset($orden['valor_comercial']) && !is_null($orden['valor_comercial'])){?>
                                <a target="_blank" href="<?=base_url(ORDENES_PATH.sha1($orden['id_orden']).'/documentos/'.$orden['valor_comercial'])?>"><img id="icon-valor_comercial" class="img-fluid" src="<?=base_url('assets/img/icons/pdf_active.png')?>" /></a>
                                <?php }else{ ?>
                                <img id="icon-valor_comercial" class="img-fluid" src="<?=base_url('assets/img/icons/pdf_disabled.png')?>" />
                                <?php } ?>
                            </td>
                            <td class="v-align-middle p-0 p-l-10">Valor Comercial</td>
                            <td class="v-align-middle">
                            <?php
                                if(array_key_exists('valor_comercial', $orden) && !is_null($orden['valor_comercial'])){
                                    if( $id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == CLIENTES_AVANZADO){
                                        $clases = 'btn btn-default btn-xs eliminar-documento';
                                        $text    = 'Eliminar';
                                        echo anchor('',$text, ['id' => 'btn-valor_comercial', 'class' => $clases, 'data-icon' => 'icon-valor_comercial', 'data-nombre' => 'valor_comercial'] );
                                    }else{
                                        echo '<div style="display:block;min-height:27px"></div>';
                                    }
                                }else{
                                    $clases = 'btn btn-primary btn-xs text-white file-upload';
                                    $text     = 'Agregar';
                                    if( $id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == VALUACION  || $id_grupo == CLIENTES_AVANZADO){
                                    echo anchor('',$text, ['id' => 'btn-valor_comercial', 'class' => $clases, 'data-icon' => 'icon-valor_comercial', 'data-nombre' => 'valor_comercial'] );
                                    }
                                }
                            ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="v-align-middle p-0 p-l-10">
                                <?php if(isset($orden['inventario']) && !is_null($orden['inventario'])){?>
                                <a target="_blank" href="<?=base_url(ORDENES_PATH.sha1($orden['id_orden']).'/documentos/'.$orden['inventario'])?>"><img id="icon-inventario" class="img-fluid" src="<?=base_url('assets/img/icons/pdf_active.png')?>" /></a>
                                <?php }else{ ?>
                                <img id="icon-inventario" class="img-fluid" src="<?=base_url('assets/img/icons/pdf_disabled.png')?>" />
                                <?php } ?>
                            </td>
                            <td class="v-align-middle p-0 p-l-10">Inventario</td>
                            <td class="v-align-middle">
                            <?php
                                if(array_key_exists('inventario', $orden) && !is_null($orden['inventario'])){
                                    if( $id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == CLIENTES_AVANZADO){
                                        $clases = 'btn btn-default btn-xs eliminar-documento';
                                        $text    = 'Eliminar';
                                        echo anchor('',$text, ['id' => 'btn-inventario', 'class' => $clases, 'data-icon' => 'icon-inventario', 'data-nombre' => 'inventario'] );
                                    }else{
                                        echo '<div style="display:block;min-height:27px"></div>';
                                    }
                                }else{
                                    $clases = 'btn btn-primary btn-xs text-white file-upload';
                                    $text     = 'Agregar';
                                    if( $id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == VALUACION  || $id_grupo == CLIENTES_AVANZADO){
                                    echo anchor('',$text, ['id' => 'btn-inventario', 'class' => $clases, 'data-icon' => 'icon-inventario', 'data-nombre' => 'inventario'] );
                                    }
                                }
                            ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="v-align-middle p-0 p-l-10">
                                <?php if(isset($orden['diagnostico']) && !is_null($orden['diagnostico'])){?>
                                <a target="_blank" href="<?=base_url(ORDENES_PATH.sha1($orden['id_orden']).'/documentos/'.$orden['diagnostico'])?>"><img id="icon-diagnostico" class="img-fluid" src="<?=base_url('assets/img/icons/pdf_active.png')?>" /></a>
                                <?php }else{ ?>
                                <img id="icon-diagnostico" class="img-fluid" src="<?=base_url('assets/img/icons/pdf_disabled.png')?>" />
                                <?php } ?>
                            </td>
                            <td class="v-align-middle p-0 p-l-10">Diagnóstico</td>
                            <td class="v-align-middle">
                            <?php
                                if(array_key_exists('diagnostico', $orden) && !is_null($orden['diagnostico'])){
                                    if( $id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == CLIENTES_AVANZADO){
                                        $clases = 'btn btn-default btn-xs eliminar-documento';
                                        $text    = 'Eliminar';
                                        echo anchor('',$text, ['id' => 'btn-diagnostico', 'class' => $clases, 'data-icon' => 'icon-diagnostico', 'data-nombre' => 'diagnostico'] );
                                    }else{
                                        echo '<div style="display:block;min-height:27px"></div>';
                                    }
                                }else{
                                    $clases = 'btn btn-primary btn-xs text-white file-upload';
                                    $text     = 'Agregar';
                                    if( $id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == VALUACION  || $id_grupo == CLIENTES_AVANZADO){
                                    echo anchor('',$text, ['id' => 'btn-diagnostico', 'class' => $clases, 'data-icon' => 'icon-diagnostico', 'data-nombre' => 'diagnostico'] );
                                    }
                                }
                            ?>
                            </td>
                        </tr>
<tr>
                            <td class="v-align-middle p-0 p-l-10">
                                <?php if(isset($orden['preexistente']) && !is_null($orden['preexistente'])){?>
                                <a target="_blank" href="<?=base_url(ORDENES_PATH.sha1($orden['id_orden']).'/documentos/'.$orden['preexistente'])?>"><img id="icon-preexistente" class="img-fluid" src="<?=base_url('assets/img/icons/pdf_active.png')?>" /></a>
                                <?php }else{ ?>
                                <img id="icon-preexistente" class="img-fluid" src="<?=base_url('assets/img/icons/pdf_disabled.png')?>" />
                                <?php } ?>
                            </td>
                            <td class="v-align-middle p-0 p-l-10">Preexistente</td>
                            <td class="v-align-middle">
                            <?php
                                if(array_key_exists('preexistente', $orden) && !is_null($orden['preexistente'])){
                                    if( $id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == CLIENTES_AVANZADO){
                                        $clases = 'btn btn-default btn-xs eliminar-documento';
                                        $text    = 'Eliminar';
                                        echo anchor('',$text, ['id' => 'btn-preexistente', 'class' => $clases, 'data-icon' => 'icon-preexistente', 'data-nombre' => 'preexistente'] );
                                    }else{
                                        echo '<div style="display:block;min-height:27px"></div>';
                                    }
                                }else{
                                    $clases = 'btn btn-primary btn-xs text-white file-upload';
                                    $text     = 'Agregar';
                                    if( $id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == VALUACION  || $id_grupo == CLIENTES_AVANZADO){
                                    echo anchor('',$text, ['id' => 'btn-preexistente', 'class' => $clases, 'data-icon' => 'icon-preexistente', 'data-nombre' => 'preexistente'] );
                                    }
                                }
                            ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="v-align-middle p-0 p-l-10">
                                <?php if(isset($orden['vale']) && !is_null($orden['vale'])){?>
                                <a target="_blank" href="<?=base_url(ORDENES_PATH.sha1($orden['id_orden']).'/documentos/'.$orden['vale'])?>"><img id="icon-vale" class="img-fluid" src="<?=base_url('assets/img/icons/pdf_active.png')?>" /></a>
                                <?php }else{ ?>
                                <img id="icon-vale" class="img-fluid" src="<?=base_url('assets/img/icons/pdf_disabled.png')?>" />
                                <?php } ?>
                            </td>
                            <td class="v-align-middle p-0 p-l-10">Vale</td>
                            <td class="v-align-middle">
                            <?php
                                if(array_key_exists('vale', $orden) && !is_null($orden['vale'])){
                                    if( $id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == CLIENTES_AVANZADO){
                                        $clases = 'btn btn-default btn-xs eliminar-documento';
                                        $text    = 'Eliminar';
                                        echo anchor('',$text, ['id' => 'btn-vale', 'class' => $clases, 'data-icon' => 'icon-vale', 'data-nombre' => 'vale'] );
                                    }else{
                                        echo '<div style="display:block;min-height:27px"></div>';
                                    }
                                }else{
                                    $clases = 'btn btn-primary btn-xs text-white file-upload';
                                    $text     = 'Agregar';
                                    if( $id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == VALUACION  || $id_grupo == CLIENTES_AVANZADO){
                                    echo anchor('',$text, ['id' => 'btn-vale', 'class' => $clases, 'data-icon' => 'icon-vale', 'data-nombre' => 'vale'] );
                                    }
                                }
                            ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="v-align-middle p-0 p-l-10">
                                <?php if(isset($orden['vo_bo']) && !is_null($orden['vo_bo'])){?>
                                <a target="_blank" href="<?=base_url(ORDENES_PATH.sha1($orden['id_orden']).'/documentos/'.$orden['vo_bo'])?>"><img id="icon-vo_bo" class="img-fluid" src="<?=base_url('assets/img/icons/pdf_active.png')?>" /></a>
                                <?php }else{ ?>
                                <img id="icon-vo_bo" class="img-fluid" src="<?=base_url('assets/img/icons/pdf_disabled.png')?>" />
                                <?php } ?>
                            </td>
                            <td class="v-align-middle p-0 p-l-10">Vo.Bo. Reparación</td>
                            <td class="v-align-middle">
                            <?php
                                if(array_key_exists('vo_bo', $orden) && !is_null($orden['vo_bo'])){
                                    if( $id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == CLIENTES_AVANZADO){
                                        $clases = 'btn btn-default btn-xs eliminar-documento';
                                        $text    = 'Eliminar';
                                        echo anchor('',$text, ['id' => 'btn-vo_bo', 'class' => $clases, 'data-icon' => 'icon-vo_bo', 'data-nombre' => 'vo_bo'] );
                                    }else{
                                        echo '<div style="display:block;min-height:27px"></div>';
                                    }
                                }else{
                                    $clases = 'btn btn-primary btn-xs text-white file-upload';
                                    $text     = 'Agregar';
                                    if( $id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == VALUACION  || $id_grupo == CLIENTES_AVANZADO){
                                    echo anchor('',$text, ['id' => 'btn-vo_bo', 'class' => $clases, 'data-icon' => 'icon-vo_bo', 'data-nombre' => 'vo_bo'] );
                                    }
                                }
                            ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="v-align-middle p-0 p-l-10">
                                <?php if(isset($orden['orden_trabajo']) && !is_null($orden['orden_trabajo'])){?>
                                <a target="_blank" href="<?=base_url(ORDENES_PATH.sha1($orden['id_orden']).'/documentos/'.$orden['orden_trabajo'])?>"><img id="icon-orden_trabajo" class="img-fluid" src="<?=base_url('assets/img/icons/pdf_active.png')?>" /></a>
                                <?php }else{ ?>
                                <img id="icon-orden_trabajo" class="img-fluid" src="<?=base_url('assets/img/icons/pdf_disabled.png')?>" />
                                <?php } ?>
                            </td>
                            <td class="v-align-middle p-0 p-l-10">Orden de Trabajo</td>
                            <td class="v-align-middle">
                            <?php
                                if(array_key_exists('orden_trabajo', $orden) && !is_null($orden['orden_trabajo'])){
                                    if( $id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == CLIENTES_AVANZADO){
                                        $clases = 'btn btn-default btn-xs eliminar-documento';
                                        $text    = 'Eliminar';
                                        echo anchor('',$text, ['id' => 'btn-orden_trabajo', 'class' => $clases, 'data-icon' => 'icon-orden_trabajo', 'data-nombre' => 'orden_trabajo'] );
                                    }else{
                                        echo '<div style="display:block;min-height:27px"></div>';
                                    }
                                }else{
                                    $clases = 'btn btn-primary btn-xs text-white file-upload';
                                    $text     = 'Agregar';
                                    if( $id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == VALUACION  || $id_grupo == CLIENTES_AVANZADO){
                                    echo anchor('',$text, ['id' => 'btn-orden_trabajo', 'class' => $clases, 'data-icon' => 'icon-orden_trabajo', 'data-nombre' => 'orden_trabajo'] );
                                    }
                                }
                            ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="v-align-middle p-0 p-l-10">
                                <?php if(isset($orden['orden_pintura']) && !is_null($orden['orden_pintura'])){?>
                                <a target="_blank" href="<?=base_url(ORDENES_PATH.sha1($orden['id_orden']).'/documentos/'.$orden['orden_pintura'])?>"><img id="icon-orden_pintura" class="img-fluid" src="<?=base_url('assets/img/icons/pdf_active.png')?>" /></a>
                                <?php }else{ ?>
                                <img id="icon-orden_pintura" class="img-fluid" src="<?=base_url('assets/img/icons/pdf_disabled.png')?>" />
                                <?php } ?>
                            </td>
                            <td class="v-align-middle p-0 p-l-10">Orden de Pintura</td>
                            <td class="v-align-middle">
                            <?php
                                if(array_key_exists('orden_pintura', $orden) && !is_null($orden['orden_pintura'])){
                                    if( $id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == CLIENTES_AVANZADO){
                                        $clases = 'btn btn-default btn-xs eliminar-documento';
                                        $text    = 'Eliminar';
                                        echo anchor('',$text, ['id' => 'btn-orden_pintura', 'class' => $clases, 'data-icon' => 'icon-orden_pintura', 'data-nombre' => 'orden_pintura'] );
                                    }else{
                                        echo '<div style="display:block;min-height:27px"></div>';
                                    }
                                }else{
                                    $clases = 'btn btn-primary btn-xs text-white file-upload';
                                    $text     = 'Agregar';
                                    if( $id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == VALUACION  || $id_grupo == CLIENTES_AVANZADO){
                                    echo anchor('',$text, ['id' => 'btn-orden_pintura', 'class' => $clases, 'data-icon' => 'icon-orden_pintura', 'data-nombre' => 'orden_pintura'] );
                                    }
                                }
                            ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="v-align-middle p-0 p-l-10">
                                <?php if(isset($orden['desglose_danos']) && !is_null($orden['desglose_danos'])){?>
                                <a target="_blank" href="<?=base_url(ORDENES_PATH.sha1($orden['id_orden']).'/documentos/'.$orden['desglose_danos'])?>"><img id="icon-desglose_danos" class="img-fluid" src="<?=base_url('assets/img/icons/pdf_active.png')?>" /></a>
                                <?php }else{ ?>
                                <img id="icon-desglose_danos" class="img-fluid" src="<?=base_url('assets/img/icons/pdf_disabled.png')?>" />
                                <?php } ?>
                            </td>
                            <td class="v-align-middle p-0 p-l-10">Desglose de Daños</td>
                            <td class="v-align-middle">
                            <?php
                                if(array_key_exists('desglose_danos', $orden) && !is_null($orden['desglose_danos'])){
                                    if( $id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == CLIENTES_AVANZADO){
                                        $clases = 'btn btn-default btn-xs eliminar-documento';
                                        $text    = 'Eliminar';
                                        echo anchor('',$text, ['id' => 'btn-desglose_danos', 'class' => $clases, 'data-icon' => 'icon-desglose_danos', 'data-nombre' => 'desglose_danos'] );
                                    }else{
                                        echo '<div style="display:block;min-height:27px"></div>';
                                    }
                                }else{
                                    $clases = 'btn btn-primary btn-xs text-white file-upload';
                                    $text     = 'Agregar';
                                    if( $id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == VALUACION  || $id_grupo == CLIENTES_AVANZADO || $id_grupo == PROCESOS){
                                    echo anchor('',$text, ['id' => 'btn-desglose_danos', 'class' => $clases, 'data-icon' => 'icon-desglose_danos', 'data-nombre' => 'desglose_danos'] );
                                    }
                                }
                            ?>
                            </td>
                        </tr>
                        <?php if( $id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == VALUACION  || $id_grupo == REFACCIONES): ?>
                        <tr>
                            <td class="v-align-middle p-0 p-l-10">
                                <?php if(isset($orden['piezas_autorizadas']) && !is_null($orden['piezas_autorizadas'])){?>
                                <a target="_blank" href="<?=base_url(ORDENES_PATH.sha1($orden['id_orden']).'/documentos/'.$orden['piezas_autorizadas'])?>"><img id="icon-piezas_autorizadas" class="img-fluid" src="<?=base_url('assets/img/icons/pdf_active.png')?>" /></a>
                                <?php }else{ ?>
                                <img id="icon-piezas_autorizadas" class="img-fluid" src="<?=base_url('assets/img/icons/pdf_disabled.png')?>" />
                                <?php } ?>
                            </td>
                            <td class="v-align-middle p-0 p-l-10">Piezas Autorizadas</td>
                            <td class="v-align-middle">
                            <?php
                                if(array_key_exists('piezas_autorizadas', $orden) && !is_null($orden['piezas_autorizadas'])){
                                    if( $id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == CLIENTES_AVANZADO){
                                        $clases = 'btn btn-default btn-xs eliminar-documento';
                                        $text    = 'Eliminar';
                                        echo anchor('',$text, ['id' => 'btn-piezas_autorizadas', 'class' => $clases, 'data-icon' => 'icon-piezas_autorizadas', 'data-nombre' => 'piezas_autorizadas'] );
                                    }else{
                                        echo '<div style="display:block;min-height:27px"></div>';
                                    }
                                }else{
                                    $clases = 'btn btn-primary btn-xs text-white file-upload';
                                    $text     = 'Agregar';
                                    if( $id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == VALUACION  || $id_grupo == CLIENTES_AVANZADO){
                                    echo anchor('',$text, ['id' => 'btn-piezas_autorizadas', 'class' => $clases, 'data-icon' => 'icon-piezas_autorizadas', 'data-nombre' => 'piezas_autorizadas'] );
                                    }
                                }
                            ?>
                            </td>
                        </tr>
                        <?php endif; ?>
                        <?php if( ($id_grupo == SUPER_ADMINISTRADOR)||($id_grupo == ADMINISTRADOR)||($id_grupo == VALUACION)): ?>
                        <tr>
                            <td class="v-align-middle p-0 p-l-10">
                                <?php if(isset($orden['valuacion_inicial']) && !is_null($orden['valuacion_inicial'])){?>
                                <a target="_blank" href="<?=base_url(ORDENES_PATH.sha1($orden['id_orden']).'/documentos/'.$orden['valuacion_inicial'])?>"><img id="icon-valuacion_inicial" class="img-fluid" src="<?=base_url('assets/img/icons/pdf_active.png')?>" /></a>
                                <?php }else{ ?>
                                <img id="icon-valuacion_inicial" class="img-fluid" src="<?=base_url('assets/img/icons/pdf_disabled.png')?>" />
                                <?php } ?>
                            </td>
                            <td class="v-align-middle p-0 p-l-10">Valuación Inicial</td>
                            <td class="v-align-middle">
                            <?php
                                if(array_key_exists('valuacion_inicial', $orden) && !is_null($orden['valuacion_inicial'])){
                                        $clases = 'btn btn-default btn-xs eliminar-documento';
                                        $text    = 'Eliminar';
                                        echo anchor('',$text, ['id' => 'btn-valuacion_inicial', 'class' => $clases, 'data-icon' => 'icon-valuacion_inicial', 'data-nombre' => 'valuacion_inicial'] );
                                }else{
                                    $clases = 'btn btn-primary btn-xs text-white file-upload';
                                    $text     = 'Agregar';
                                    echo anchor('',$text, ['id' => 'btn-valuacion_inicial', 'class' => $clases, 'data-icon' => 'icon-valuacion_inicial', 'data-nombre' => 'valuacion_inicial'] );
                                }
                            ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="v-align-middle p-0 p-l-10">
                                <?php if(isset($orden['valuacion_autorizada']) && !is_null($orden['valuacion_autorizada'])){?>
                                <a target="_blank" href="<?=base_url(ORDENES_PATH.sha1($orden['id_orden']).'/documentos/'.$orden['valuacion_autorizada'])?>"><img id="icon-valuacion_autorizada" class="img-fluid" src="<?=base_url('assets/img/icons/pdf_active.png')?>" /></a>
                                <?php }else{ ?>
                                <img id="icon-valuacion_autorizada" class="img-fluid" src="<?=base_url('assets/img/icons/pdf_disabled.png')?>" />
                                <?php } ?>
                            </td>
                            <td class="v-align-middle p-0 p-l-10">Valuación Autorizada</td>
                            <td class="v-align-middle">
                            <?php
                                if(array_key_exists('valuacion_autorizada', $orden) && !is_null($orden['valuacion_autorizada'])){
                                        $clases = 'btn btn-default btn-xs eliminar-documento';
                                        $text    = 'Eliminar';
                                        echo anchor('',$text, ['id' => 'btn-valuacion_autorizada', 'class' => $clases, 'data-icon' => 'icon-valuacion_autorizada', 'data-nombre' => 'valuacion_autorizada'] );
                                }else{
                                    $clases = 'btn btn-primary btn-xs text-white file-upload';
                                    $text     = 'Agregar';
                                    echo anchor('',$text, ['id' => 'btn-valuacion_autorizada', 'class' => $clases, 'data-icon' => 'icon-valuacion_autorizada', 'data-nombre' => 'valuacion_autorizada'] );
                                }
                            ?>
                            </td>
                        </tr>
                        <?php endif; ?>
                        <?php if( $id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == VALUACION
                        || $id_grupo == CLIENTES_BASICO || ($id_usuario == '4' || $id_usuario == '28') ):
                        ?>
                        <tr>
                            <td class="v-align-middle p-0 p-l-10">
                                <?php if(isset($orden['cotizacion_particular']) && !is_null($orden['cotizacion_particular'])){?>
                                <a target="_blank" href="<?=base_url(ORDENES_PATH.sha1($orden['id_orden']).'/documentos/'.$orden['cotizacion_particular'])?>"><img id="icon-cotizacion_particular" class="img-fluid" src="<?=base_url('assets/img/icons/pdf_active.png')?>" /></a>
                                <?php }else{ ?>
                                <img id="icon-cotizacion_particular" class="img-fluid" src="<?=base_url('assets/img/icons/pdf_disabled.png')?>" />
                                <?php } ?>
                            </td>
                            <td class="v-align-middle p-0 p-l-10">Cotización Particular</td>
                            <td class="v-align-middle">
                            <?php
                                if(array_key_exists('cotizacion_particular', $orden) && !is_null($orden['cotizacion_particular'])){
                                        $clases = 'btn btn-default btn-xs eliminar-documento';
                                        $text    = 'Eliminar';
                                        echo anchor('',$text, ['id' => 'btn-cotizacion_particular', 'class' => $clases, 'data-icon' => 'icon-cotizacion_particular', 'data-nombre' => 'cotizacion_particular'] );
                                }else{
                                    $clases = 'btn btn-primary btn-xs text-white file-upload';
                                    $text     = 'Agregar';
                                    echo anchor('',$text, ['id' => 'btn-cotizacion_particular', 'class' => $clases, 'data-icon' => 'icon-cotizacion_particular', 'data-nombre' => 'cotizacion_particular'] );
                                }
                            ?>
                            </td>
                        </tr>
                        <?php endif;?>
                    </table>
                </div>
            </div>
            </form>
            <?php if($aseguradora['nombre'] != 'PARTICULAR' || ($aseguradora['id_aseguradora'] != '8') ):?>
            <?php if( $id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == VALUACION  || $id_grupo == CLIENTES_AVANZADO  || $id_grupo == CLIENTES_BASICO ): ?>
            <div id="insurance-document-card" class="card card-default">
                <div class="card-header">
                    <div class="card-title">
                        <h4><span class="semi-bold">Documentos Aseguradora</span></h4>
                    </div>
                    <div class="card-controls">
                        <ul>
                            <li><a href="#" class="card-collapse" data-toggle="collapse"><i class="card-icon card-icon-collapse"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <?php if(isset($docs) && (is_array($docs) || is_object($docs)) && !empty($docs)):?>
                        <?php foreach($docs as $d):?>
                        <tr>
                            <td class="v-align-middle p-0 p-l-10">
                                <?php $index = array_search($d['id_documento'], array_column($docs_orden, 'id_documento')); ?>
                                <?php if($index !== FALSE): ?>
                                <a target="_blank" href="<?=base_url(ORDENES_PATH.sha1($orden['id_orden']).'/aseguradora/'.$docs_orden[$index]['nombre'])?>"><img id="icon-<?=$d['id_documento']?>" class="img-fluid" src="<?=base_url('assets/img/icons/pdf_active.png')?>" /></a>
                                <?php else: ?>
                                <img id="icon-<?=$d['id_documento']?>" class="img-fluid" src="<?=base_url('assets/img/icons/pdf_disabled.png')?>" />
                                <?php endif; ?>
                            </td>
                            <td class="v-align-middle p-0 p-l-10"><?=$d['nombre']?></td>
                            <td class="v-align-middle">
                                <?php if($index !== FALSE):
                                        $clases = 'btn btn-default btn-xs eliminar-documento-aseguradora';
                                        $text    = 'Eliminar';
                                        if( $id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == VALUACION):
                                        echo anchor('',$text, ['id' => 'btn-'.$d['id_documento'], 'class' => $clases, 'data-icon' => 'icon-'.$d['id_documento'], 'data-id_documento' => $d['id_documento']] );
                                        endif;
                                else:
                                    $clases = 'btn btn-primary btn-xs text-white file-upload-aseguradora';
                                    $text     = 'Agregar';
                                    if( $id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == VALUACION){
                                    echo anchor('',$text, ['id' => 'btn-'.$d['id_documento'], 'class' => $clases, 'data-icon' => 'icon-'.$d['id_documento'], 'data-id_documento' => $d['id_documento']] );
                                    }
                                endif;
                            ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif;?>

                    </table>
                </div>
            </div>
            <?php endif; ?>
            <?php endif; ?>
            <?php if ($this->session->userdata('id_usuario') && $id_grupo != CVP2 ): ?>
            <div id="checklist-document-card" class="card card-default">
                <div class="card-header">
                    <div class="card-title">
                        <h4><span class="semi-bold">Checklist</span></h4>
                    </div>
                    <div class="card-controls">
                        <ul>
                            <li><a href="#" class="card-collapse" data-toggle="collapse"><i class="card-icon card-icon-collapse"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td class="v-align-middle p-0 p-l-10">
                                <?php if(isset($orden['checklist_1']) && !is_null($orden['checklist_1'])){?>
                                <a data-fancybox="checklist" href="<?=base_url(ORDENES_PATH.sha1($orden['id_orden']).'/checklist/'.$orden['checklist_1'])?>"><img id="icon-checklist_1" class="img-fluid" src="<?=base_url('assets/img/icons/jpg_active.png')?>" /></a>
                                <?php }else{ ?>
                                <img id="icon-checklist_1" class="img-fluid" src="<?=base_url('assets/img/icons/jpg_disabled.png')?>" />
                                <?php } ?>
                            </td>
                            <td class="v-align-middle p-0 p-l-10">Alineación Inicial</td>
                            <td class="v-align-middle">
                            <?php
                                if(array_key_exists('checklist_1', $orden) && !is_null($orden['checklist_1'])){
                                    if( $id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == VALUACION){
                                        $clases = 'btn btn-default btn-xs eliminar-imagen';
                                        $text    = 'Eliminar';
                                        echo anchor('',$text, ['id' => 'btn-checklist_1', 'class' => $clases, 'data-icon' => 'icon-checklist_1', 'data-nombre' => 'checklist_1'] );
                                    }else{
                                        echo '<div style="display:block;min-height:27px"></div>';
                                    }
                                }else{
                                    $clases = 'btn btn-primary btn-xs text-white image-upload';
                                    $text     = 'Agregar';
                                    echo anchor('',$text, ['id' => 'btn-checklist_1', 'class' => $clases, 'data-icon' => 'icon-checklist_1', 'data-nombre' => 'checklist_1'] );
                                }
                            ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="v-align-middle p-0 p-l-10">
                                <?php if(isset($orden['checklist_2']) && !is_null($orden['checklist_2'])){?>
                                <a data-fancybox="checklist" href="<?=base_url(ORDENES_PATH.sha1($orden['id_orden']).'/checklist/'.$orden['checklist_2'])?>"><img id="icon-checklist_2" class="img-fluid" src="<?=base_url('assets/img/icons/jpg_active.png')?>" /></a>
                                <?php }else{ ?>
                                <img id="icon-checklist_2" class="img-fluid" src="<?=base_url('assets/img/icons/jpg_disabled.png')?>" />
                                <?php } ?>
                            </td>
                            <td class="v-align-middle p-0 p-l-10">Alineación Final</td>
                            <td class="v-align-middle">
                            <?php
                                if(array_key_exists('checklist_2', $orden) && !is_null($orden['checklist_2'])){
                                    if( $id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == VALUACION){
                                        $clases = 'btn btn-default btn-xs eliminar-imagen';
                                        $text    = 'Eliminar';
                                        echo anchor('',$text, ['id' => 'btn-checklist_2', 'class' => $clases, 'data-icon' => 'icon-checklist_2', 'data-nombre' => 'checklist_2'] );
                                    }else{
                                        echo '<div style="display:block;min-height:27px"></div>';
                                    }
                                }else{
                                    $clases = 'btn btn-primary btn-xs text-white image-upload';
                                    $text     = 'Agregar';
                                    echo anchor('',$text, ['id' => 'btn-checklist_2', 'class' => $clases, 'data-icon' => 'icon-checklist_2', 'data-nombre' => 'checklist_2'] );
                                }
                            ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="v-align-middle p-0 p-l-10">
                                <?php if(isset($orden['checklist_3']) && !is_null($orden['checklist_3'])){?>
                                <a data-fancybox="checklist" href="<?=base_url(ORDENES_PATH.sha1($orden['id_orden']).'/checklist/'.$orden['checklist_3'])?>"><img id="icon-checklist_3" class="img-fluid" src="<?=base_url('assets/img/icons/jpg_active.png')?>" /></a>
                                <?php }else{ ?>
                                <img id="icon-checklist_3" class="img-fluid" src="<?=base_url('assets/img/icons/jpg_disabled.png')?>" />
                                <?php } ?>
                            </td>
                            <td class="v-align-middle p-0 p-l-10">Termino de laminación</td>
                            <td class="v-align-middle">
                            <?php
                                if(array_key_exists('checklist_3', $orden) && !is_null($orden['checklist_3'])){
                                    if( $id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == VALUACION){
                                        $clases = 'btn btn-default btn-xs eliminar-imagen';
                                        $text    = 'Eliminar';
                                        echo anchor('',$text, ['id' => 'btn-checklist_3', 'class' => $clases, 'data-icon' => 'icon-checklist_3', 'data-nombre' => 'checklist_3'] );
                                    }else{
                                        echo '<div style="display:block;min-height:27px"></div>';
                                    }
                                }else{
                                    $clases = 'btn btn-primary btn-xs text-white image-upload';
                                    $text     = 'Agregar';
                                    echo anchor('',$text, ['id' => 'btn-checklist_3', 'class' => $clases, 'data-icon' => 'icon-checklist_3', 'data-nombre' => 'checklist_3'] );
                                }
                            ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="v-align-middle p-0 p-l-10">
                                <?php if(isset($orden['checklist_4']) && !is_null($orden['checklist_4'])){?>
                                <a data-fancybox="checklist" href="<?=base_url(ORDENES_PATH.sha1($orden['id_orden']).'/checklist/'.$orden['checklist_4'])?>"><img id="icon-checklist_4" class="img-fluid" src="<?=base_url('assets/img/icons/jpg_active.png')?>" /></a>
                                <?php }else{ ?>
                                <img id="icon-checklist_4" class="img-fluid" src="<?=base_url('assets/img/icons/jpg_disabled.png')?>" />
                                <?php } ?>
                            </td>
                            <td class="v-align-middle p-0 p-l-10">Termino de pintura</td>
                            <td class="v-align-middle">
                            <?php
                                if(array_key_exists('checklist_4', $orden) && !is_null($orden['checklist_4'])){
                                    if( $id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == VALUACION){
                                        $clases = 'btn btn-default btn-xs eliminar-imagen';
                                        $text    = 'Eliminar';
                                        echo anchor('',$text, ['id' => 'btn-checklist_4', 'class' => $clases, 'data-icon' => 'icon-checklist_4', 'data-nombre' => 'checklist_4'] );
                                    }else{
                                        echo '<div style="display:block;min-height:27px"></div>';
                                    }
                                }else{
                                    $clases = 'btn btn-primary btn-xs text-white image-upload';
                                    $text     = 'Agregar';
                                    echo anchor('',$text, ['id' => 'btn-checklist_4', 'class' => $clases, 'data-icon' => 'icon-checklist_4', 'data-nombre' => 'checklist_4'] );
                                }
                            ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="v-align-middle p-0 p-l-10">
                                <?php if(isset($orden['checklist_5']) && !is_null($orden['checklist_5'])){?>
                                <a data-fancybox="checklist" href="<?=base_url(ORDENES_PATH.sha1($orden['id_orden']).'/checklist/'.$orden['checklist_5'])?>"><img id="icon-checklist_5" class="img-fluid" src="<?=base_url('assets/img/icons/jpg_active.png')?>" /></a>
                                <?php }else{ ?>
                                <img id="icon-checklist_5" class="img-fluid" src="<?=base_url('assets/img/icons/jpg_disabled.png')?>" />
                                <?php } ?>
                            </td>
                            <td class="v-align-middle p-0 p-l-10">Checklist Final</td>
                            <td class="v-align-middle">
                            <?php
                                if(array_key_exists('checklist_5', $orden) && !is_null($orden['checklist_5'])){
                                    if( $id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == VALUACION){
                                        $clases = 'btn btn-default btn-xs eliminar-imagen';
                                        $text    = 'Eliminar';
                                        echo anchor('',$text, ['id' => 'btn-checklist_5', 'class' => $clases, 'data-icon' => 'icon-checklist_5', 'data-nombre' => 'checklist_5'] );
                                    }else{
                                        echo '<div style="display:block;min-height:27px"></div>';
                                    }
                                }else{
                                    $clases = 'btn btn-primary btn-xs text-white image-upload';
                                    $text     = 'Agregar';
                                    echo anchor('',$text, ['id' => 'btn-checklist_5', 'class' => $clases, 'data-icon' => 'icon-checklist_5', 'data-nombre' => 'checklist_5'] );
                                }
                            ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <?php endif; ?>
            <?php if( ($id_grupo == SUPER_ADMINISTRADOR)||($id_grupo == ADMINISTRADOR)||($id_grupo == VALUACION) ): ?>
            <div class="card card-default card-dropzone">
                <div class="card-body no-scroll no-padding">
                    <h4>
                        <span class="semi-bold">Expediente</span>
                    </h4>
                    <form action="<?=$url_expediente?>" data-url="<?=$url_expediente?>" class="drag-n-drop no-margin">
                        <div class="dz-default dz-message" style="opacity: 1; background-image: none;"><span style="display: inline;">Soltar archivos para subir</span></div>
                        <div class="fallback">
                            <input name="file" type="file"/>
                        </div>
                    </form>
                    <div id="expediente" <?=(isset($expediente) && (is_array($expediente) || is_object($expediente) ) && !empty($expediente))?'':'style="display:none"'?>>
                    <?php if(isset($expediente) && (is_array($expediente) || is_object($expediente) ) && !empty($expediente) ): ?>
                    <ul class="list-group list-group-flush">
                    <?php foreach($expediente as $e):?>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-11"><?=anchor(base_url(ORDENES_PATH.sha1($e['id_orden']).'/expediente/'.$e['nombre']), $e['nombre'], ['target' => '_blank'])?></div>
                                <div class="col-1">
                                    <a class="delete-expediente" href="<?=base_url('apis/admin_api/delete_expediente/'.$e['id_expediente'])?>" data-text="<?=$e['nombre']?>" data-id="<?=$e['id_orden']?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </li>
                    <?php endforeach;?>
                    </ul>
                    <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
