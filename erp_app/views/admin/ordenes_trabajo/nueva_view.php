<form id="orden" method="post" action="<?=$url_nueva?>" enctype="multipart/form-data" class="ajaxPostFormModal" data-function-success="exito_orden">
    <div class="row">
        <div class="col-md-6">
            <h3><?=$titulo?></h3>
        </div>
        <div class="col-md-6">
            <div class="pull-right">
                <a href="<?=base_url('admin/ordenes-trabajo')?>" class="btn btn-default btn-cons">Cancelar</a>
                <button type="submit" class="btn btn-success btn-cons">Guardar</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-body">
                    <h4><span class="semi-bold">Datos Generales</span></h4>
                    <div class="row clearfix">
                        <div class="col-md-4">
                            <div class="form-group row" aria-required="true">
                                <label>No. Orden <span class="required"></span></label>
                                <?=form_dropdown('id_orden', $ordenes, [], ['id' => 'id_orden', 'class' => 'form-control full-width', 'required' => '']);?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label>Tipo de Golpe</label>
                                <?=form_dropdown('tipo_golpe', ['-1' => '-- Seleccione --', 'LEVE'=> 'LEVE', 'MEDIO' => 'MEDIO', 'FUERTE' => 'FUERTE'], [], ['class' => 'form-control'])?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row m-t-30">
                                <label class="col-sm-8 col-form-label text-right">No. Orden de Trabajo</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control plaintext text-right red" id="no_orden_trabajo" readonly aria-required="true" value="<?=$no_orden_trabajo?>">
                                    <input type="hidden" name="no_orden_trabajo" value="<?=$no_orden_trabajo?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-1"><span class="bold">Marca</span></div>
                        <div class="col-3"><div id="marca"></div></div>
                        <div class="col-1"><span class="bold">Tipo</span></div>
                        <div class="col-3"><div id="tipo"></div></div>
                        <div class="col-1"><span class="bold">Color</span></div>
                        <div class="col-3"><div id="color"></div></div>
                    </div>
                    <div class="row">
                        <div class="col-1"><span class="bold">Placas</span></div>
                        <div class="col-3"><div id="placas"></div></div>
                        <div class="col-1"><span class="bold">Modelo</span></div>
                        <div class="col-3"><div id="modelo"></div></div>
                        <div class="col-1"><span class="bold">No.Serie</span></div>
                        <div class="col-3"><div id="serie"></div></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 m-b-15">
            <a href="<?=base_url('admin/ordenes-trabajo/detalle_form')?>" class="btn btn-primary btn-xs show-modal-lg">Agregar Detalle</a>
        </div>
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover dataTable no-footer">
                            <thead>
                                <tr>
                                    <th align="center">Trabajo</th>
                                    <th align="center">Pieza</th>
                                    <?php foreach($areas as $a):?>
                                    <th align="center"><?=$a['nombre']?></th>
                                    <?php endforeach;?>
                                    <th align="center">Cobertura de Pintura</th>
                                    <th align="center">Materiales Especiales</th>
                                    <th>Comentario</th>
                                    <th align="center"><button class="btn btn-link"><i class="pg-trash"></i></button></th>
                                </tr>
                            </thead>
                            <tbody id="table-body"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
