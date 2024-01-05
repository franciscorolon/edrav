<form id="upload-file"  method="post" action="<?=base_url('apis/admin_api/subir_archivo_factura')?>" class="ajaxPostForm"  style="display:none" data-function-success="recargar_documento">
    <input type="file" id="file" name="file" accept=".pdf, .xml" />
    <input type="hidden" id="nombre" name="nombre" value="" />
    <input type="hidden" id="icono" name="icono" value="" />
    <input type="submit">
</form>
<form id="orden" method="post" action="<?=$url_nueva?>" enctype="multipart/form-data" class="ajaxPostFormModal" data-function-success="redirect_facturas">
    <div class="row">
        <div class="col-md-6">
            <h3>Nueva Factura</h3>
        </div>
        <div class="col-md-6">
            <div class="pull-right">
                <a href="<?=base_url('admin/facturas')?>" class="btn btn-default btn-cons">Cancelar</a>
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
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">No. Factura</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control plaintext text-right red" id="no_factura" readonly aria-required="true" value="<?=$no_factura?>">
                                    <input type="hidden" name="no_factura" value="<?=$no_factura?>" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Estado</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control plaintext text-right" readonly value="PENDIENTE">
                                    <input type="hidden" value="PENDIENTE" id="status" name="status" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Fecha Factura <span class="required"></span></label>
                                <div class="input-group date col-md-12 p-l-0">
                                    <input type="text" id="fecha" name="fecha" class="form-control" value="<?=date('d/m/Y')?>">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Folio <span class="required"></span></label>
                                <input type="text" class="form-control text-right" id="folio" name="folio" required="" aria-required="true">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Monto <span class="required"></span></label>
                                <input type="text" data-a-sign="$ " class="autonumeric form-control text-right" id="monto" name="monto"	>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Método de Pago <span class="required"></span></label>
                                <?=form_dropdown('id_metodo_pago', $metodos, '', ['class' => 'form-control full-width', 'required' => '']);?>
								<div id="info_id_metodo_pago"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix mb-3">
                        <div class="col">
	                        <table class="table">
		                        <tbody>
			                        <tr>
			                            <td class="v-align-middle p-0 p-l-10">
			                                <img id="icon-pdf" class="img-fluid" src="<?=base_url('assets/img/icons/pdf_disabled.png')?>" />
			                            </td>
			                            <td class="v-align-middle p-0 p-l-10">PDF</td>
			                            <td class="v-align-middle">
			                            <?php
			                        		$clases = 'btn btn-primary btn-xs text-white file-upload';
		                                    $text     = 'Agregar';
		                                    echo anchor('#',$text, ['id' => 'btn-pdf', 'class' => $clases, 'data-icon' => 'icon-pdf', 'data-nombre' => 'pdf'] );
			                            ?>
			                            	<input type="hidden" id="pdf_file" name="pdf_file" value="" />
			                            </td>
									</tr>
		                        </tbody>
	                        </table>
                        </div>
                        <div class="col">
                            <table class="table">
		                        <tbody>
			                        <tr>
			                            <td class="v-align-middle p-0 p-l-10">
			                                <img id="icon-xml" class="img-fluid" src="<?=base_url('assets/img/icons/xml_disabled.png')?>" />
			                            </td>
			                            <td class="v-align-middle p-0 p-l-10">XML</td>
			                            <td class="v-align-middle">
			                            <?php
			                        		$clases = 'btn btn-primary btn-xs text-white file-upload';
		                                    $text     = 'Agregar';
		                                    echo anchor('#',$text, ['id' => 'btn-xml', 'class' => $clases, 'data-icon' => 'icon-xml', 'data-nombre' => 'xml'] );
			                            ?>
			                            	<input type="hidden" id="xml_file" name="xml_file" value="" />
			                            </td>
									</tr>
		                        </tbody>
	                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>