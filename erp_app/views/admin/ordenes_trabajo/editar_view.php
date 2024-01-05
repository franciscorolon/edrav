<div class="row">
    <div class="col-md-6">
        <h3><?=$titulo?></h3>
    </div>
    <div class="col-md-6"></div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-body">
                <h4><span class="semi-bold">Datos Generales</span></h4>
                <div class="row clearfix">
                    <div class="col-md-4">
                        <div class="form-group row m-t-30">
                            <label class="col-sm-8 col-form-label text-right">No. Orden</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control plaintext text-right red" id="no_orden" readonly aria-required="true" value="<?=$orden[0]['no_orden']?>">
                                <input type="hidden" name="no_orden" value="<?=$orden[0]['no_orden']?>" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row m-t-30">
                            <label class="col-sm-8 col-form-label text-right">Tipo de Golpe</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control plaintext text-right red" id="no_orden_trabajo" readonly aria-required="true" value="<?=$orden_trabajo['tipo_golpe']?>">
                                <input type="hidden" name="tipo_golpe" value="<?=$orden_trabajo['tipo_golpe']?>" />
                            </div>
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
                    <div class="col-3"><div id="marca"><?=$orden[0]['marca']?></div></div>
                    <div class="col-1"><span class="bold">Tipo</span></div>
                    <div class="col-3"><div id="tipo"><?=$orden[0]['tipo']?></div></div>
                    <div class="col-1"><span class="bold">Color</span></div>
                    <div class="col-3"><div id="color"><?=$orden[0]['color']?></div></div>
                </div>
                <div class="row">
                    <div class="col-1"><span class="bold">Placas</span></div>
                    <div class="col-3"><div id="placas"><?=$orden[0]['no_placas']?></div></div>
                    <div class="col-1"><span class="bold">Modelo</span></div>
                    <div class="col-3"><div id="modelo"><?=$orden[0]['modelo']?></div></div>
                    <div class="col-1"><span class="bold">No.Serie</span></div>
                    <div class="col-3"><div id="serie"><?=$orden[0]['no_serie']?></div></div>
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
                        <tbody id="table-body">
                            <?php foreach($detalles as $d):?>
                            <tr>
                                <td><?=$d['trabajo']?></td>
                                <td><?=$d['pieza_automovil']?></td>
                                <?php
                                    foreach($areas as $a){
                                        foreach($d['areas_detalles'] as $ad){
                                            if($a['id_area'] == $ad['id_area']){
                                                echo ($ad['valor'])?'<td align="center"><i class="fa fa-check text-primary" aria-hidden="true"></i></td>':'<td align="center"><i class="fa fa-times text-danger" aria-hidden="true"></i></td>';
                                            }
                                        }
                                    }
                                ?>
                                <td><?=mb_strtoupper($d['cobertura_pintura'])?></td>
                                <td><?=mb_strtoupper($d['materiales_especiales'])?></td>
                                <td><?=mb_strtoupper($d['comentario'])?></td>
                                <td><?=anchor('#', '<i class="fa fa-trash-o" aria-hidden="true"></i>', ['class' => 'btn btn-danger eliminar-detalle', 'title'=> '¿Desea realmente eliminar este detalle?', 'data-id' => $d['id_detalle']])?></td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>