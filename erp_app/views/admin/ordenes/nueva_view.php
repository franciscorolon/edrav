<form id="orden" method="post" action="<?=$url_nueva?>" enctype="multipart/form-data" class="ajaxPostFormModal" data-function-success="confirmar_impresion">
    <div class="row">
        <div class="col-md-6">
            <h3>Nueva Orden</h3>
        </div>
        <div class="col-md-6">
            <div class="pull-right">
                <a href="<?=base_url('admin/ordenes')?>" class="btn btn-default btn-cons">Cancelar</a>
                <button type="submit" class="btn btn-success btn-cons">Guardar</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-body">
                    <h4><span class="semi-bold">Datos Generales</span></h4>
                    <div class="row clearfix">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Fecha Ingreso</label>
                                <div class="input-group date col-md-12 p-l-0">
                                    <input type="text" id="fecha_recepcion" name="fecha_recepcion" class="form-control" value="<?=date('d-m-Y')?>">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Hora Ingreso</label>
                                <div class="input-group bootstrap-timepicker">
                                    <input id="timepicker" name="hora_recepcion" type="text" class="form-control" readonly />
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Fecha Tentativa</label>
                                <div class="input-group date col-md-12 p-l-0">
                                    <input type="text" id="fecha_promesa" name="fecha_promesa" class="form-control" value="<?=date('d-m-Y')?>">
                                    <span class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">No. orden</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control plaintext text-right red" id="no_orden" readonly aria-required="true" value="<?=$no_orden?>">
                                    <input type="hidden" name="no_orden" value="<?=$no_orden?>" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Estado</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control plaintext text-right" readonly value="En Valuación">
                                    <input type="hidden" value="VALUACION" id="status" name="status" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <div class="form-group" aria-required="true">
                                <label>Cliente <span class="required"></span></label>
                                <div class="pull-right">
                                    <a id="nuevo_cliente" href="<?=base_url('admin/clientes/mostrar_form')?>" class="btn-link cambiar show-modal" data-function-success="refresh_clientes">Nuevo Cliente</a>
                                </div>
                                <?=form_dropdown('id_cliente', $clientes, [], ['id' => 'id_cliente', 'class' => 'form-control full-width', 'required' => '']);?>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Marca <span class="required"></span></label>
                                <input type="text" class="form-control" id="marca" name="marca" required="" aria-required="true">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tipo <span class="required"></span></label>
                                <input type="text" class="form-control" id="tipo" name="tipo" required="" aria-required="true">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Color <span class="required"></span></label>
                                <input type="text" class="form-control" id="color" name="color" required="" aria-required="true">
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Placas <span class="required"></span></label>
                                <input type="text" class="form-control" id="no_placas" name="no_placas" required="" aria-required="true">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Modelo <span class="required"></span></label>
                                <select id="modelo" name="modelo" class="form-control" required aria-required="true">
                                <?php
                                    $start_y  = date('Y', strtotime('-80 year'));
                                    $end_y    = date('Y', strtotime('+2 years'));
                                    for($end_y; $end_y >= $start_y; $end_y--) {?>
                                    <option value="<?=$end_y?>"><?=$end_y?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>No. de Serie <span class="required"></span></label>
                                <input type="text" class="form-control" id="no_serie" name="no_serie" required="" aria-required="true">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-default">
                <div class="card-body">
                    <h4>
                        <span class="semi-bold">Asesor</span>
                        <div class="pull-right">
                            <a id="hide_asesor" href='#' class="btn-link cambiar" style="display:none">Ocultar</a>
                            <a id="show_asesor" href='#' class="btn-link cambiar" style="display:none">Cambiar</a>
                        </div>
                    </h4>
                    <?php $id_asesor = $this->session->userdata('id_usuario'); ?>
                                <?=form_dropdown('id_asesor', $asesores, $id_asesor, ['class' => 'form-control full-width', 'required' => '']);?>
                    <div id="info_asesor"></div>
                </div>
            </div>
            <div class="card card-default">
                <div class="card-body">
                    <h4><span class="semi-bold">Compañía</span>
                    <div class="form-group">
                        <label>Aseguradora <span class="required"></span></label>
                        <?=form_dropdown('id_aseguradora', $aseguradoras, [], ['id' => 'id_aseguradora', 'class' => 'form-control full-width', 'required' => '']);?>
                    </div>
                    <div class="form-group clearfix">
                        <label>Ajustador <span class="required"></span></label>
                        <select name="id_ajustador" id="id_ajustador" class="form-control" required="" aria-required="true">
                            <option value="-1">-- seleccione --</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tipo Cliente <span class="required"></span></label>
                        <div class="row">
                            <label class="col-sm-4 col-form-label" for="asegurado">Asegurado</label>
                            <div class="col-sm-2">
                                <?=form_radio('tipo_cliente', 'ASEGURADO', TRUE, ['id' => 'asegurado']);?>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label " for="tercero">Tercero</label>
                            <div class="col-sm-2">
                                <?=form_radio('tipo_cliente', 'TERCERO', FALSE, ['id' => 'tercero']);?>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-4 col-form-label " for="no-aplica">No Aplica</label>
                            <div class="col-sm-2">
                                <?=form_radio('tipo_cliente', 'NO APLICA', FALSE, ['id' => 'no-aplica']);?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>No. Siniestro <span class="required"></span></label>
                        <input type="text" class="form-control" id="no_siniestro" name="no_siniestro" required="" aria-required="true">
                    </div>
                    <div class="form-group">
                        <label>No. Póliza <span class="required"></span></label>
                        <input type="text" class="form-control" id="no_poliza" name="no_poliza" required="" aria-required="true">
                    </div>
                    <div class="form-group clearfix">
                        <label>Inciso</label>
                        <input type="text" class="form-control" name="inciso">
                    </div>
                    <div class="form-group clearfix">
                        <label for="aplica_deducible">Aplica Deducible</label>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-sm-8 col-form-label " for="tercero">Si Aplica</label>
                                    <div class="col-sm-3">
                                        <?=form_radio('aplica_deducible', 'SI', FALSE, ['id' => 'aplica']);?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <label class="col-sm-8 col-form-label " for="no-aplica">No Aplica</label>
                                    <div class="col-sm-3">
                                        <?=form_radio('aplica_deducible', 'NO', TRUE, ['id' => 'no-aplica']);?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-default">
                <div class="card-body">
                    <h4>
                        <span class="semi-bold">Importes</span>
                    </h4>
                    <div class="row m-b-10">
                        <div class="col-6">
                            <input type="checkbox" id="es_deducible" name="es_deducible" class="valid-check" data-field="deducible">
                            <label for="es_deducible">Deducible</label>
                            <input type="text" data-a-sign="$ " class="autonumeric form-control" id="deducible" name="deducible" style="display:none">
                        </div>
                        <div class="col-6">
                            <input type="checkbox" id="es_demerito" name="es_demerito" class="valid-check" data-field="demerito">
                            <label for="es_demerito">Demérito</label>
                            <input type="text" data-a-sign="$ " class="autonumeric form-control" id="demerito" name="demerito" style="display:none">
                        </div>
                    </div>
                    <div class="row m-b-10">
                        <div class="col-6">
                            <input type="checkbox" id="es_valuacion" name="es_valuacion" class="valid-check" data-field="valuacion">
                            <label for="es_valuacion">Valuación</label>
                            <input type="text" data-a-sign="$ " class="autonumeric form-control" id="valuacion" name="valuacion" style="display:none">
                        </div>
                        <div class="col-6">
                            <input type="checkbox" id="es_varios" name="es_varios" class="valid-check" data-field="varios">
                            <label for="es_varios">Varios</label>
                            <input type="text" data-a-sign="$ " class="autonumeric form-control" id="varios" name="varios" style="display:none">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>