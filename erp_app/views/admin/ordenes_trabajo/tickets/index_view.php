<h1 class="h4">Orden de Trabajo No.<?=$orden_trabajo['no_orden_trabajo']?></h1>
<div class="row">
    <?php foreach($tickets_ot as $ot):?>
    <div class="col-lg-6">
        <div id="ticket_ot_<?=$ot['id_ticket']?>" class="card card-default">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-5"><h3><?=$ot['titulo']?></h3></div>
                    <div class="col-md-7 text-right">
                        <?php $existe_ticket = FALSE; ?>
                        <?php
                            if($ot['id_guardia'] != NULL && $ot['id_tecnico'] != NULL){
                                $existe_personal  = TRUE;
                                $ticket         = $ot;
                                $tmp_g          = $this->usuarios_model->get($ot['id_guardia']);
                                $tmp_t          = $this->usuarios_model->get($ot['id_tecnico']);
                            }
                        ?>
                        <?php if(!$existe_personal): ?>
                        <a href="<?=base_url('admin/ordenes-trabajo/asignar_ticket/'.$ot['id_ticket'])?>" class="btn btn-primary btn-xs m-t-10 show-modal">Asignar</a>
                    <?php else:?>
                        <?php if(!empty($ticket['fecha_fin'])):?>
                        <div class="m-t-20">
                            <span class="label label-inverse">Ticket Finalizado</span>
                        </div>
                        <?php else:?>
                        <a href="<?=base_url('admin/ordenes-trabajo/cerrar_ticket/'.$ticket['id_ticket'])?>" class="btn btn-danger btn-xs m-t-10 show-modal"><i class="fa fa-times-circle" aria-hidden="true"></i> Cerrar Ticket</a>
                        <a href="<?=base_url('admin/ordenes-trabajo/imprimir_ticket/'.$ticket['id_ticket'])?>" class="btn btn-primary btn-xs m-t-10 show-modal-lg"><i class="fa fa-print" aria-hidden="true"></i> Imprimir Ticket</a>
                        <?php endif; ?>
                    <?php endif; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5"><strong>No.Ticket</strong></div>
                    <div class="col-md-7 text-right red"><?=$ot['no_ticket']?></div>
                </div>
                <div class="row">
                    <div class="col-md-5"><strong>Tipo de Golpe</strong></div>
                    <div class="col-md-7 text-right"><?=$ot['tipo_golpe']?></div>
                </div>
                <div class="row">
                    <div class="col-md-5"><strong>Guardia</strong></div>
                    <div class="col-md-7 text-right"><?=isset($existe_personal)?$tmp_g[0]['nombre'].' '.$tmp_g[0]['paterno'].' '.$tmp_g[0]['materno']:'- Sin Asignar -' ?></div>
                </div>
                <div class="row">
                    <div class="col-md-5"><strong>Técnico</strong></div>
                    <div class="col-md-7 text-right"><?=isset($existe_personal)?$tmp_t[0]['nombre'].' '.$tmp_t[0]['paterno'].' '.$tmp_t[0]['materno']:'- Sin Asignar -' ?></div>
                </div>
                <div class="row">
                    <div class="col-md-5"><strong>Fecha de Inicio</strong></div>
                    <div class="col-md-7 text-right"><?=(isset($ticket) && !is_null($ticket['fecha_inicio']))?$this->functions->fecha_es($ticket['fecha_inicio']):'- Sin Definir -' ?></div>
                </div>
                <div class="row">
                    <div class="col-md-5"><strong>Fecha Termino</strong></div>
                    <div class="col-md-7 text-right"><?=(isset($ticket) && !is_null($ticket['fecha_fin']))?$this->functions->fecha_es($ticket['fecha_fin']):'- Sin Definir -' ?></div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach;?>
</div>
<div class="row">
<?php foreach($areas as $a):?>
    <?php if(!empty($detalles_by_area[$a['id_area']])):?>
<div class="col-lg-6">
    <div id="ticket_<?=$a['id_area']?>" class="card card-default">
        <div class="card-body">
            <div class="row">
                <div class="col-md-5"><h3><?=$a['nombre']?></h3></div>
                <div class="col-md-7 text-right">
                    <?php $ticket = NULL;?>
                    <?php $existe_ticket = FALSE; ?>
                    <?php
                        foreach($tickets as $t){
                            if($t['id_area'] == $a['id_area']){
                                $existe_ticket  = TRUE;
                                $ticket         = $t;
                                $tmp_g          = $this->usuarios_model->get($t['id_guardia']);
                                $tmp_t          = $this->usuarios_model->get($t['id_tecnico']);
                            }
                        }
                    ?>
                    <?php if(!$existe_ticket): ?>
                    <a href="<?=base_url('admin/ordenes-trabajo/asignar_ticket/'.$orden_trabajo['id_orden_trabajo'].'/'.$a['id_area'])?>" class="btn btn-primary btn-xs m-t-10 show-modal">Asignar</a>
                <?php else:?>
                    <?php if(!empty($ticket['fecha_fin'])):?>
                    <div class="m-t-20">
                        <span class="label label-inverse">Ticket Finalizado</span>
                    </div>
                    <?php else:?>
                    <a href="<?=base_url('admin/ordenes-trabajo/cerrar_ticket/'.$ticket['id_ticket'])?>" class="btn btn-danger btn-xs m-t-10 show-modal"><i class="fa fa-times-circle" aria-hidden="true"></i> Cerrar Ticket</a>
                    <a href="<?=base_url('admin/ordenes-trabajo/imprimir_ticket/'.$ticket['id_ticket'])?>" class="btn btn-primary btn-xs m-t-10 show-modal-lg"><i class="fa fa-print" aria-hidden="true"></i> Imprimir Ticket</a>
                    <?php endif; ?>
                <?php endif; ?>
                </div>
            </div>
            <?php if($existe_ticket): ?>
            <div class="row">
                <div class="col-md-5"><strong>No.Ticket</strong></div>
                <div class="col-md-7 text-right red"><?=$ticket['no_ticket']?></div>
            </div>
            <?php endif;?>
            <div class="row">
                <div class="col-md-5"><strong>Tipo de Golpe</strong></div>
                <div class="col-md-7 text-right"><?=isset($ticket)?$ticket['tipo_golpe']:$orden_trabajo['tipo_golpe']?></div>
            </div>
            <div class="row">
                <div class="col-md-5"><strong>Guardia</strong></div>
                <div class="col-md-7 text-right"><?=isset($ticket)?$tmp_g[0]['nombre'].' '.$tmp_g[0]['paterno'].' '.$tmp_g[0]['materno']:'- Sin Asignar -' ?></div>
            </div>
            <div class="row">
                <div class="col-md-5"><strong>Técnico</strong></div>
                <div class="col-md-7 text-right"><?=isset($ticket)?$tmp_t[0]['nombre'].' '.$tmp_t[0]['paterno'].' '.$tmp_t[0]['materno']:'- Sin Asignar -' ?></div>
            </div>
            <div class="row">
                <div class="col-md-5"><strong>Fecha de Inicio</strong></div>
                <div class="col-md-7 text-right"><?=(isset($ticket) && !is_null($ticket['fecha_inicio']))?$this->functions->fecha_es($ticket['fecha_inicio']):'- Sin Definir -' ?></div>
            </div>
            <div class="row">
                <div class="col-md-5"><strong>Fecha Promesa</strong></div>
                <div class="col-md-7 text-right"><?=(isset($ticket) && !is_null($ticket['fecha_promesa']))?$this->functions->fecha_es($ticket['fecha_promesa']):'- Sin Definir -' ?></div>
            </div>
            <div class="row">
                <div class="col-md-5"><strong>Fecha Termino</strong></div>
                <div class="col-md-7 text-right"><?=(isset($ticket) && !is_null($ticket['fecha_fin']))?$this->functions->fecha_es($ticket['fecha_fin']):'- Sin Definir -' ?></div>
            </div>
            <div class="row m-t-20">
                <?php if($a['tiene_opciones']){?>
                <div class="col-md-4"><strong>Descripción</strong></div>
                <div class="col-md-4 text-center"><strong>Cobertura Pintura</strong></div>
                <div class="col-md-4 text-center"><strong>Materiales Especiales</strong></div>
                <?php }else{?>
                <div class="col-md-5"><strong>Trabajo</strong></div>
                <div class="col-md-7"><strong>Descripción</strong></div>
                <?php } ?>
            </div>
            <?php if($existe_ticket): ?>
                <?php $detalles_ticket = $this->detalles_ticket_model->get(['id_ticket' => $ticket['id_ticket']]); ?>
                <?php foreach($detalles_ticket as $dt):?>
            <div class="row">
                <?php if($dt['aplica_trabajo']){?>
                <div class="col-md-5"><?=$dt['trabajo']?></div>
                <div class="col-md-7"><?=$dt['descripcion']?></div>
                <?php }else{?>
                <div class="col-md-4"><?=$dt['descripcion']?></div>
                <div class="col-md-4 text-center"><?=$dt['cobertura_pintura']?></div>
                <div class="col-md-4"><?=$dt['materiales_especiales']?></div>
                <?php } ?>
            </div>
                <?php endforeach;?>
            <?php  else:?>
                <?php foreach($detalles_by_area[$a['id_area']] as $dba):?>
            <div class="row">
                <?php if($a['tiene_opciones']){?>
                <div class="col-md-4"><?=$dba['pieza_automovil']?></div>
                <div class="col-md-4 text-center"><?=$dba['cobertura_pintura']?></div>
                <div class="col-md-4"><?=$dba['materiales_especiales']?></div>

                <?php }else{?>
                <div class="col-md-5"><?=$dba['trabajo']?></div>
                <div class="col-md-7"><?=$dba['pieza_automovil']?></div>
                <?php } ?>
            </div>
                <?php endforeach;?>
                <?php endif;?>
        </div>
    </div>
</div>
    <?php endif;?>
<?php endforeach;?>
</div>
