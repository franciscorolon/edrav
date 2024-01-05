<?php $id_grupo = $this->session->userdata('id_grupo'); ?>
<div class="card card-transparent">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h1 class="h4"><?=$header?></h1>
            </div>
            <div class="col-md-6">
                <div class="pull-right">
                    <?php if( $id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == CLIENTES_AVANZADO || $id_grupo == CLIENTES_BASICO): ?>
                    <a href="<?= $url_agregar?>" class="btn btn-primary"><i class="fa fa-plus"></i> Nueva orden</a>
                    <?php endif;?>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="card-block card-margin-top-2">
        <div class="row">
            <div class="col">
                <div id="flash-message" class="alert hide" role="alert"><?=isset($message)?$message:'';?></div>
            </div>
        </div>
        <!-- START card -->
        <div class="card card-borderless">
            <ul class="nav nav-tabs nav-tabs-simple d-none d-md-flex d-lg-flex d-xl-flex" role="tablist" data-init-reponsive-tabs="dropdownfx">
                <li class="nav-item">
                    <a href="#" data-toggle="tab" role="tab" data-target="#tabValuacion" class="active show" aria-selected="true">En Valuación</a>
                </li>
                <li class="nav-item">
                    <a href="#" data-toggle="tab" role="tab" data-target="#tabReparacion" aria-selected="false">En Reparación</a>
                </li>
                <li class="nav-item">
                    <a href="#" data-toggle="tab" role="tab" data-target="#tabResguardo" aria-selected="false">En CVP2</a>
                </li>
                <li class="nav-item">
                    <a href="#" data-toggle="tab" role="tab" data-target="#tabTransito" aria-selected="false">En Tránsito</a>
                </li>
                <li class="nav-item">
                    <a href="#" data-toggle="tab" role="tab" data-target="#tabEntregado" aria-selected="false">Entregado</a>
                </li>
                <?php if ($this->session->userdata('id_usuario') && ($id_grupo != CLIENTES_AVANZADO && $id_grupo != PROCESOS && $id_grupo != CLIENTES_BASICO && $id_grupo != REFACCIONES && $id_grupo != CVP2) ): ?>
                <li class="nav-item">
                    <a href="#" data-toggle="tab" role="tab" data-target="#tabFacturado" aria-selected="false">Facturado</a>
                </li>
                <?php endif; ?>
                <?php if ($this->session->userdata('id_usuario') && ($id_grupo != CLIENTES_AVANZADO && $id_grupo != PROCESOS && $id_grupo != CLIENTES_BASICO && $id_grupo != REFACCIONES && $id_grupo != CVP2) ): ?>
                <li class="nav-item">
                    <a href="#" data-toggle="tab" role="tab" data-target="#tabArchivado" aria-selected="false">Archivado</a>
                </li>
                <?php endif;?>
                <?php if ($this->session->userdata('id_usuario') && ($id_grupo != REFACCIONES && $id_grupo != CVP2) ): ?>
                <li class="nav-item">
                    <a href="#" data-toggle="tab" role="tab" data-target="#tabPerdidas" aria-selected="false">Perdidas Totales</a>
                </li>
                <?php endif;?>
                <?php if ($this->session->userdata('id_usuario') && ($id_grupo != REFACCIONES && $id_grupo != CVP2) ): ?>
                <li class="nav-item">
                    <a href="#" data-toggle="tab" role="tab" data-target="#tabDanos" aria-selected="false">Pago de Daños</a>
                </li>
                <?php endif;?>
                <li class="nav-item">
                    <a href="#" data-toggle="tab" role="tab" data-target="#tabTodos" aria-selected="false">Todos</a>
                </li>
            </ul>
            <div class="nav-tab-dropdown cs-wrapper full-width d-lg-none d-xl-none d-md-none">
                <div class="cs-select cs-skin-slide full-width" tabindex="0">
                    <span class="cs-placeholder">En Valuación</span>
                    <div class="cs-options">
                        <ul>
                            <li data-option="" data-value="#tabValuacion"><span>En Valuación</span></li>
                            <li data-option="" data-value="#tabReparacion"><span>En Reparación</span></li>
                            <li data-option="" data-value="#tabResguardo"><span>En CVP2</span></li>
                            <li data-option="" data-value="#tabTransito"><span>En Tránsito</span></li>
                            <li data-option="" data-value="#tabEntregado"><span>Entregado</span></li>
                            <?php if ($this->session->userdata('id_usuario') && ($id_grupo != CLIENTES_AVANZADO && $id_grupo != PROCESOS && $id_grupo != CLIENTES_BASICO && $id_grupo != REFACCIONES) ): ?>
                            <li data-option="" data-value="#tabFacturado"><span>Facturado</span></li>
                            <?php endif;?>
                            <?php if ($this->session->userdata('id_usuario') && ($id_grupo != CLIENTES_AVANZADO && $id_grupo != PROCESOS && $id_grupo != CLIENTES_BASICO && $id_grupo != REFACCIONES) ): ?>
                            <li data-option="" data-value="#tabArchivado"><span>Archivado</span></li>
                            <?php endif;?>
                            <?php if ($this->session->userdata('id_usuario') && ($id_grupo != REFACCIONES && $id_grupo != CVP2) ): ?>
                            <li data-option="" data-value="#tabPerdidas"><span>Pérdidas Totales</span></li>
                            <?php endif;?>
                            <?php if ($this->session->userdata('id_usuario') && ($id_grupo != REFACCIONES && $id_grupo != CVP2) ): ?>
                            <li data-option="" data-value="#tabDanos"><span>Pago de Daños</span></li>
                            <?php endif;?>
                            <li data-option="" data-value="#tabTodos"><span>Todos</span></li>
                        </ul>
                    </div>
                    <select class="cs-select cs-skin-slide full-width" data-init-plugin="cs-select">
                        <option value="#tabValuacion">En Valuación</option>
                        <option value="#tabReparacion">En Reparación</option>
                        <option value="#tabResguardo">En CVP2</option>
                        <option value="#tabTransito">En Tránsito</option>
                        <option value="#tabEntregado">Entregado</option>
                        <?php if ($this->session->userdata('id_usuario') && ($id_grupo != CLIENTES_AVANZADO && $id_grupo != PROCESOS && $id_grupo != CLIENTES_BASICO && $id_grupo != REFACCIONES) ): ?>
                        <option value="#tabFacturado">Facturado</option>
                        <?php endif;?>
                        <?php if ($this->session->userdata('id_usuario') && ($id_grupo != CLIENTES_AVANZADO && $id_grupo != PROCESOS && $id_grupo != CLIENTES_BASICO && $id_grupo != REFACCIONES) ): ?>
                        <option value="#tabArchivado">Archivado</option>
                        <?php endif;?>
                        <?php if ($this->session->userdata('id_usuario') && ($id_grupo != REFACCIONES && $id_grupo != CVP2) ): ?>
                        <option value="#tabPerdidas">Pérdidas Totales</option>
                        <?php endif;?>
                        <?php if ($this->session->userdata('id_usuario') && ($id_grupo != REFACCIONES && $id_grupo != CVP2) ): ?>
                        <option value="#tabDanos">Pago de Daños</option>
                        <?php endif;?>
                        <option value="#tabTodos" selected="">Todos</option>
                    </select>
                    <div class="cs-backdrop"></div>
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane active show" id="tabValuacion">
                    <div class=" container-fluid container-fixed-lg">
                        <div class="card card-transparent">
                            <div class="card-header">
                                <div class="pull-right">
                                    <div class="col-xs-12">
                                        <input type="text" id="search-valuacion" class="form-control pull-right" placeholder="Buscar Orden">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="card-body">
                                <table class="table table-hover table-responsive-block" id="datatable_valuacion">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Orden</th>
                                            <th>Fecha</th>
                                            <th>Cliente</th>
                                            <th>Teléfono</th>
                                            <th>Estado</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tabReparacion">
                    <div class=" container-fluid container-fixed-lg">
                        <div class="card card-transparent">
                            <div class="card-header">
                                <div class="pull-right">
                                    <div class="col-xs-12">
                                        <input type="text" id="search-reparacion" class="form-control pull-right" placeholder="Buscar Orden">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="card-body">
                                <table class="table table-hover table-responsive-block" id="datatable_reparacion">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Orden</th>
                                            <th>Fecha</th>
                                            <th>Cliente</th>
                                            <th>Teléfono</th>
                                            <th>Estado</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tabTransito">
                    <div class=" container-fluid container-fixed-lg">
                        <div class="card card-transparent">
                            <div class="card-header">
                                <div class="pull-right">
                                    <div class="col-xs-12">
                                        <input type="text" id="search-transito" class="form-control pull-right" placeholder="Buscar Orden">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="card-body">
                                <table class="table table-hover table-responsive-block" id="datatable_transito">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Orden</th>
                                            <th>Fecha</th>
                                            <th>Cliente</th>
                                            <th>Teléfono</th>
                                            <th>Estado</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tabResguardo">
                    <div class=" container-fluid container-fixed-lg">
                        <div class="card card-transparent">
                            <div class="card-header">
                                <div class="pull-right">
                                    <div class="col-xs-12">
                                        <input type="text" id="search-resguardo" class="form-control pull-right" placeholder="Buscar Orden">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="card-body">
                                <table class="table table-hover table-responsive-block" id="datatable_resguardo">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Orden</th>
                                            <th>Fecha</th>
                                            <th>Cliente</th>
                                            <th>Teléfono</th>
                                            <th>Estado</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tabEntregado">
                    <div class=" container-fluid container-fixed-lg">
                        <div class="card card-transparent">
                            <div class="card-header">
                                <div class="pull-right">
                                    <div class="col-xs-12">
                                        <input type="text" id="search-entregado" class="form-control pull-right" placeholder="Buscar Orden">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="card-body">
                                <table class="table table-hover table-responsive-block" id="datatable_entregado">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Orden</th>
                                            <th>Fecha</th>
                                            <th>Cliente</th>
                                            <th>Teléfono</th>
                                            <th>Estado</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if ($this->session->userdata('id_usuario') && ($id_grupo != CLIENTES_AVANZADO && $id_grupo != PROCESOS && $id_grupo != CLIENTES_BASICO && $id_grupo != REFACCIONES) ): ?>
                <div class="tab-pane" id="tabFacturado">
                    <div class=" container-fluid container-fixed-lg">
                        <div class="card card-transparent">
                            <div class="card-header">
                                <div class="pull-right">
                                    <div class="col-xs-12">
                                        <input type="text" id="search-facturado" class="form-control pull-right" placeholder="Buscar Orden">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="card-body">
                                <table class="table table-hover table-responsive-block" id="datatable_facturado">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Orden</th>
                                            <th>Fecha</th>
                                            <th>Cliente</th>
                                            <th>Teléfono</th>
                                            <th>Estado</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php if ($this->session->userdata('id_usuario') && ($id_grupo != CLIENTES_AVANZADO && $id_grupo != PROCESOS && $id_grupo != CLIENTES_BASICO && $id_grupo != REFACCIONES) ): ?>
                <div class="tab-pane" id="tabArchivado">
                    <div class=" container-fluid container-fixed-lg">
                        <div class="card card-transparent">
                            <div class="card-header">
                                <div class="pull-right">
                                    <div class="col-xs-12">
                                        <input type="text" id="search-archivado" class="form-control pull-right" placeholder="Buscar Orden">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="card-body">
                                <table class="table table-hover table-responsive-block" id="datatable_archivado">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Orden</th>
                                            <th>Fecha</th>
                                            <th>Cliente</th>
                                            <th>Teléfono</th>
                                            <th>Estado</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php if ($this->session->userdata('id_usuario') && ($id_grupo != REFACCIONES && $id_grupo != CVP2) ): ?>
                <div class="tab-pane" id="tabPerdidas">
                    <div class=" container-fluid container-fixed-lg">
                        <div class="card card-transparent">
                            <div class="card-header">
                                <div class="pull-right">
                                    <div class="col-xs-12">
                                        <input type="text" id="search-perdidas" class="form-control pull-right" placeholder="Buscar Orden">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="card-body">
                                <table class="table table-hover table-responsive-block" id="datatable_perdidas">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Orden</th>
                                            <th>Fecha</th>
                                            <th>Cliente</th>
                                            <th>Teléfono</th>
                                            <th>Estado</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php if ($this->session->userdata('id_usuario') && ($id_grupo != REFACCIONES && $id_grupo != CVP2) ): ?>
                <div class="tab-pane" id="tabDanos">
                    <div class=" container-fluid container-fixed-lg">
                        <div class="card card-transparent">
                            <div class="card-header">
                                <div class="pull-right">
                                    <div class="col-xs-12">
                                        <input type="text" id="search-danos" class="form-control pull-right" placeholder="Buscar Orden">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="card-body">
                                <table class="table table-hover table-responsive-block" id="datatable_danos">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Orden</th>
                                            <th>Fecha</th>
                                            <th>Cliente</th>
                                            <th>Teléfono</th>
                                            <th>Estado</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif;?>
                <div class="tab-pane" id="tabTodos">
                    <div class=" container-fluid container-fixed-lg">
                        <div class="card card-transparent">
                            <div class="card-header">
                                <div class="pull-right">
                                    <div class="col-xs-12">
                                        <input type="text" id="search-todos" class="form-control pull-right" placeholder="Buscar Orden">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="card-body">
                                <table class="table table-hover table-responsive-block" id="datatable_todos">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Orden</th>
                                            <th>Fecha</th>
                                            <th>Cliente</th>
                                            <th>Teléfono</th>
                                            <th>Estado</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>