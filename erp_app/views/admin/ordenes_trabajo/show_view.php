<div class="modal-header clearfix text-left">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
</button>
    <h5><?=$HEADER_MODAL?></h5>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-sm-8 col-form-label">No. Orden</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control plaintext text-right red" id="no_orden" readonly="" aria-required="true" value="<?=$orden[0]['no_orden']?>">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-sm-8 col-form-label">No. Orden de Trabajo</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control plaintext text-right red" id="no_orden_trabajo" readonly="" aria-required="true" value="<?=$orden_trabajo[0]['no_orden_trabajo']?>">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-sm-6 col-form-label">Tipo de Golpe</label>
                <div class="col-sm-6">
                    <input type="text" name="tipo_golpe" class="form-control plaintext text-right black" readonly="" aria-required="true" value="<?=$orden_trabajo[0]['tipo_golpe']?>" />
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-sm-6 col-form-label" for="fecha">Fecha</label>
                <div class="col-sm-6">
                    <input type="text" name="fecha" class="form-control plaintext text-right black" readonly="" aria-required="true" value="<?=date('d-m-Y')?>" />
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group row">
                <label class="col-sm-5 col-form-label">Marca</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control plaintext text-right black" readonly="" aria-required="true" value="<?=$orden[0]['marca']?>">
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group row">
                <label class="col-sm-5 col-form-label">Tipo</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control plaintext text-right black" readonly="" aria-required="true" value="<?=$orden[0]['tipo']?>">
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group row">
                <label class="col-sm-5 col-form-label">Color</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control plaintext text-right black" readonly="" aria-required="true" value="<?=$orden[0]['color']?>">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group row">
                <label class="col-sm-5 col-form-label">Placas</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control plaintext text-right black" readonly="" value="<?=$orden[0]['no_placas']?>">
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group row">
                <label class="col-sm-5 col-form-label">Modelo</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control plaintext text-right black" readonly="" value="<?=$orden[0]['modelo']?>">
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group row">
                <label class="col-sm-5 col-form-label">No.Serie</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control plaintext text-right black" readonly="" value="<?=$orden[0]['no_serie']?>">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th>TRABAJO</th>
                    <th>PIEZA</th>
                    <?php foreach($areas as $a):?>
                    <th class="rotate"><div><?=mb_strtoupper($a['nombre'])?></div></th>
                    <?php endforeach;?>
                    <th>COBERTURA DE PINTURA</th>
                    <th>MATERIALES ESPECIALES</th>
                    <th>COMENTARIOS</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($detalles as $d):?>
                <tr>
                    <td><?=mb_strtoupper($d['trabajo'])?></td>
                    <td><?=mb_strtoupper($d['pieza_automovil'])?></td>
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
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
</div>
