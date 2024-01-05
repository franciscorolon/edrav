<form id="orden" method="post" action="<?=$url_nueva?>" class="ajaxPostFormModal" data-function-success="confirmar_impresion">
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
                            <div class="form-group row">
                                <label class="col-sm-8 col-form-label text-right">No. Orden</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control plaintext text-right red" id="no_orden" readonly aria-required="true" value="<?=$orden['no_orden']?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label class="col-sm-8 col-form-label text-right">Tipo de Golpe</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control plaintext text-right" id="tipo_golpe" readonly aria-required="true" value="<?=$orden_trabajo['tipo_golpe']?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label class="col-sm-8 col-form-label text-right">No. Orden de Trabajo</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control plaintext text-right red" id="no_orden_trabajo" readonly aria-required="true" value="<?=$orden_trabajo['no_orden_trabajo']?>">
                                    <input type="hidden" name="id_orden_trabajo" value="<?=$orden_trabajo['id_orden_trabajo']?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-2"><span class="bold">Marca</span></div>
                        <div class="col-2"><div id="marca"><?=$orden['marca']?></div></div>
                        <div class="col-1"><span class="bold">Tipo</span></div>
                        <div class="col-3"><div id="tipo"><?=$orden['tipo']?></div></div>
                        <div class="col-1"><span class="bold">Color</span></div>
                        <div class="col-3"><div id="color"><?=$orden['color']?></div></div>
                    </div>
                    <div class="row">
                        <div class="col-2"><span class="bold">Placas</span></div>
                        <div class="col-2"><div id="placas"><?=$orden['no_placas']?></div></div>
                        <div class="col-1"><span class="bold">Modelo</span></div>
                        <div class="col-3"><div id="modelo"><?=$orden['modelo']?></div></div>
                        <div class="col-1"><span class="bold">No.Serie</span></div>
                        <div class="col-3"><div id="serie" class="bg-yellow"><?=$orden['no_serie']?></div></div>
                    </div>
                    <div class="row">
                        <div class="col-2"><span class="bold">Aseguradora</span></div>
                        <div class="col-2"><div id="serie" class="bg-yellow"><?=$orden['aseguradora']?></div></div>
                        <div class="col-1"><span class="bold">No.Siniestro</span></div>
                        <div class="col-3"><div id="placas"><?=$orden['no_siniestro']?></div></div>
                        <div class="col-1"><span class="bold">Poliza</span></div>
                        <div class="col-3"><div id="modelo"><?=$orden['no_poliza']?></div></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 m-b-15">
            <a href="<?=base_url('admin/ordenes-trabajo/mostrar_detalle_cotizacion/'.$orden_trabajo['id_orden_trabajo'])?>" class="btn btn-primary btn-xs show-modal-lg">Agregar Detalle</a>
        </div>
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-detail" class="table table-hover no-footer">
                            <thead>
                                <tr>
                                    <th align="center">Cant.</th>
                                    <th align="center">Descripción</th>
                                    <th id="col_delete" align="center"><button class="btn btn-link"><i class="pg-trash"></i></button></th>
                                </tr>
                            </thead>
                            <tbody id="table-body">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
