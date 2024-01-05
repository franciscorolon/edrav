<div class="modal-header clearfix text-left">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
</button>
    <h5><?=$HEADER_MODAL?></h5>
</div>
<?php
    $estados = [
    "Aguascalientes"        => "Aguascalientes",
    "Baja California"       => "Baja California",
    "Baja California Sur"   => "Baja California Sur",
    "Campeche"              => "Campeche",
    "Ciudad de México"      => "Ciudad de México",
    "Coahuila"              => "Coahuila",
    "Colima"                => "Colima",
    "Chiapas"               => "Chiapas",
    "Chihuahua"             => "Chihuahua",
    "Durango"               => "Durango",
    "Guanajuato"            => "Guanajuato",
    "Guerrero"              => "Guerrero",
    "Hidalgo"               => "Hidalgo",
    "Jalisco"               => "Jalisco",
    "México"                => "México",
    "Michoacán"             => "Michoacán",
    "Morelos"               => "Morelos",
    "Nayarit"               => "Nayarit",
    "Nuevo León"            => "Nuevo León",
    "Oaxaca"                => "Oaxaca",
    "Puebla"                => "Puebla",
    "Querétaro"             => "Querétaro",
    "Quintana Roo"          => "Quintana Roo",
    "San Luis Potosí"       => "San Luis Potosí",
    "Sinaloa"               => "Sinaloa",
    "Sonora"                => "Sonora",
    "Tabasco"               => "Tabasco",
    "Tamaulipas"            => "Tamaulipas",
    "Tlaxcala"              => "Tlaxcala",
    "Veracruz"              => "Veracruz",
    "Yucatán"               => "Yucatán",
    "Zacatecas"             => "Zacatecas",
    ];
?>
<form id="upload-file"  method="post" action="<?=base_url('apis/admin_api/upload_tmp_image')?>" class="ajaxPostForm"  style="display:none" data-function-success="recargar_imagen">
    <input type="file" id="tmp-image" name="image" accept="image/*" />
    <input type="submit">
</form>
<form role="form" method="post" action="<?= $URL_FORM ?>" class="ajaxPostFormModal" data-function-success="refresh_datatable">
    <div class="modal-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="color">LOGO *</label>
                    <input id="logo" name="logo" type="hidden" value="<?= (isset($item) ? $item[0]['logo'] : '') ?>"/>
                    <p class="text-center">
                    <a href="#" class="upload-image">
                        <img id="img_image" class="img-responsive img-thumbnail" src="<?php
                        if (isset($item) && $item[0]['logo'] != '')
                            echo base_url(ASEGURADORAS_FOLDER.$item[0]['logo']);
                        else
                            echo 'http://placehold.it/160x90';
                        ?>" />
                    </a>
                    </p>
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label for="razon_social">Razón Social *</label>
                    <input name="razon_social" class="form-control" value="<?= (isset($item) ? $item[0]['razon_social'] : '') ?>"/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="rfc">RFC *</label>
                    <input name="rfc" class="form-control" value="<?= (isset($item) ? $item[0]['rfc'] : '') ?>"/>
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label for="nombre">Nombre *</label>
                    <input name="nombre" class="form-control" value="<?= (isset($item) ? $item[0]['nombre'] : '') ?>"/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea name="descripcion" class="form-control" value=""><?= (isset($item) ? $item[0]['descripcion'] : '') ?></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="telefono">Teléfono *</label>
                    <input name="telefono" class="form-control" value="<?= (isset($item) ? $item[0]['telefono'] : '') ?>"/>
                </div>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input name="email" class="form-control" value="<?= (isset($item) ? $item[0]['email'] : '') ?>"/>
                </div>
            </div>
        </div>
        <ul class="nav nav-tabs nav-tabs-simple d-none d-md-flex d-lg-flex d-xl-flex" role="tablist" data-init-reponsive-tabs="dropdownfx">
            <li class="nav-item">
                <a class="active" data-toggle="tab" role="tab" data-target="#tabDireccion" href="#">Dirección Sucursal</a>
            </li>
            <li class="nav-item">
                <a href="#" data-toggle="tab" role="tab" data-target="#tabDireccionFiscal">Dirección Fiscal</a>
            </li>
        </ul>
        <div class="nav-tab-dropdown cs-wrapper full-width d-lg-none d-xl-none d-md-none">
            <div class="cs-select cs-skin-slide full-width" tabindex="0">
                <span class="cs-placeholder">Dirección Sucursal</span>
                <div class="cs-options">
                    <ul>
                        <li data-option="" data-value="#tabDireccion"><span>Dirección Sucursal</span></li>
                        <li data-option="" data-value="#tabDireccionFiscal"><span>Dirección Fiscal</span></li>
                    </ul>
                </div>
                <select class="cs-select cs-skin-slide full-width" data-init-plugin="cs-select">
                    <option value="#tabDireccion" selected="">Dirección Sucursal</option>
                    <option value="#tabDireccionFiscal">Dirección Fiscal</option>
                </select>
                <div class="cs-backdrop"></div>
            </div>
        </div>
        <div class="tab-content">
            <div class="tab-pane active" id="tabDireccion">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="calle">Calle *</label>
                            <input name="calle" class="form-control" value="<?= (isset($item) ? $item[0]['calle'] : '') ?>"/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="num_ext">No Ext. *</label>
                            <input name="num_ext" class="form-control" value="<?= (isset($item) ? $item[0]['num_ext'] : '') ?>"/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="num_int">No. Int</label>
                            <input name="num_int" class="form-control" value="<?= (isset($item) ? $item[0]['num_int'] : '') ?>"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="colonia">Colonia *</label>
                            <input name="colonia" class="form-control" value="<?= (isset($item) ? $item[0]['colonia'] : '') ?>"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="cp">C.P.</label>
                            <input name="cp" class="form-control" value="<?= (isset($item) ? $item[0]['cp'] : '') ?>"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="municipio">Municipio *</label>
                            <input name="municipio" class="form-control" value="<?= (isset($item) ? $item[0]['municipio'] : '') ?>"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="estado">Estado *</label>
                            <?php $id_estado = isset($item)?$item[0]['estado']:'';?>
                            <?=form_dropdown('estado', $estados, $id_estado , ['id' => 'id_estado', 'class' => 'form-control full-width', 'required' => '']);?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane " id="tabDireccionFiscal">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fiscal_calle">Calle *</label>
                            <input name="fiscal_calle" class="form-control" value="<?= (isset($item) ? $item[0]['fiscal_calle'] : '') ?>"/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="fiscal_num_ext">No Ext. *</label>
                            <input name="fiscal_num_ext" class="form-control" value="<?= (isset($item) ? $item[0]['fiscal_num_ext'] : '') ?>"/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="fiscal_num_int">No. Int</label>
                            <input name="fiscal_num_int" class="form-control" value="<?= (isset($item) ? $item[0]['fiscal_num_int'] : '') ?>"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="fiscal_colonia">Colonia *</label>
                            <input name="fiscal_colonia" class="form-control" value="<?= (isset($item) ? $item[0]['fiscal_colonia'] : '') ?>"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="fiscal_cp">C.P.</label>
                            <input name="fiscal_cp" class="form-control" value="<?= (isset($item) ? $item[0]['fiscal_cp'] : '') ?>"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fiscal_municipio">Municipio *</label>
                            <input name="fiscal_municipio" class="form-control" value="<?= (isset($item) ? $item[0]['fiscal_municipio'] : '') ?>"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fiscal_estado">Estado *</label>
                            <?php $fiscal_id_estado = isset($item)?$item[0]['fiscal_estado']:'';?>
                            <?=form_dropdown('fiscal_estado', $estados, $fiscal_id_estado , ['id' => 'fiscal_estado', 'class' => 'form-control full-width', 'required' => '']);?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <input type="hidden" name="id" value="<?= (isset($item) ? $item[0]['id_aseguradora'] : '') ?>"/>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</form>