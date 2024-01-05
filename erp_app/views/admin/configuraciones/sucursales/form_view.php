<div class="modal-header clearfix text-left">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
</button>
    <h5><?=$HEADER_MODAL?></h5>
</div>
<div id="file-uploader" class="hidden"></div>
<div id="file-uploader-movil" class="hidden"></div>
<form role="form" method="post" action="<?= $URL_FORM ?>" class="ajaxPostFormModal" data-function-success="refresh_datatable">
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group form-group-default">
                    <label for="nombre">Nombre *</label>
                    <input name="nombre" class="form-control" value="<?= (isset($item) ? $item[0]['nombre'] : '') ?>"/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group form-group-default">
                    <label for="descripcion">Descripción</label>
                    <textarea name="descripcion" class="form-control" value=""><?= (isset($item) ? $item[0]['descripcion'] : '') ?></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group form-group-default">
                    <label for="telefono">Teléfono</label>
                    <input name="telefono" class="form-control" value="<?= (isset($item) ? $item[0]['telefono'] : '') ?>"/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group form-group-default">
                    <label for="calle">Calle *</label>
                    <input name="calle" class="form-control" value="<?= (isset($item) ? $item[0]['calle'] : '') ?>"/>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group form-group-default">
                    <label for="no_ext">No Ext. *</label>
                    <input name="no_ext" class="form-control" value="<?= (isset($item) ? $item[0]['no_ext'] : '') ?>"/>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group form-group-default">
                    <label for="no_int">No. Int</label>
                    <input name="no_int" class="form-control" value="<?= (isset($item) ? $item[0]['no_int'] : '') ?>"/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="form-group form-group-default">
                    <label for="colonia">Colonia *</label>
                    <input name="colonia" class="form-control" value="<?= (isset($item) ? $item[0]['colonia'] : '') ?>"/>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group form-group-default">
                    <label for="cp">C.P.</label>
                    <input name="cp" class="form-control" value="<?= (isset($item) ? $item[0]['cp'] : '') ?>"/>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-6">
                <div class="form-group form-group-default">
                    <label for="municipio">Municipio *</label>
                    <input name="municipio" class="form-control" value="<?= (isset($item) ? $item[0]['municipio'] : '') ?>"/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-group-default">
                    <label for="estado">Estado *</label>
                    <select name="estado" class="form-control">
                        <option value="Aguascalientes" <?=(isset($item) && $item[0]['estado'] == 'Aguascalientes')?'selected="selected"':''?>>Aguascalientes</option>
                        <option value="Baja California" <?=(isset($item) && $item[0]['estado'] == 'Baja California')?'selected="selected"':''?>>Baja California</option>
                        <option value="Baja California Sur" <?=(isset($item) && $item[0]['estado'] == 'Baja California Sur')?'selected="selected"':''?>>Baja California Sur</option>
                        <option value="Campeche" <?=(isset($item) && $item[0]['estado'] == 'Campeche')?'selected="selected"':''?>>Campeche</option>
                        <option value="Coahuila" <?=(isset($item) && $item[0]['estado'] == 'Coahuila')?'selected="selected"':''?>>Coahuila de Zaragoza</option>
                        <option value="Colima" <?=(isset($item) && $item[0]['estado'] == 'Colima')?'selected="selected"':''?>>Colima</option>
                        <option value="Chiapas" <?=(isset($item) && $item[0]['estado'] == 'Chiapas')?'selected="selected"':''?>>Chiapas</option>
                        <option value="Chihuahua" <?=(isset($item) && $item[0]['estado'] == 'Chihuahua')?'selected="selected"':''?>>Chihuahua</option>
                        <option value="Distrito Federal" <?=(isset($item) && $item[0]['estado'] == 'Distrito Federal')?'selected="selected"':''?>>Distrito Federal</option>
                        <option value="Durango" <?=(isset($item) && $item[0]['estado'] == 'Durango')?'selected="selected"':''?>>Durango</option>
                        <option value="Guanajuato" <?=(isset($item) && $item[0]['estado'] == 'Guanajuato')?'selected="selected"':''?>>Guanajuato</option>
                        <option value="Guerrero" <?=(isset($item) && $item[0]['estado'] == 'Guerrero')?'selected="selected"':''?>>Guerrero</option>
                        <option value="Hidalgo" <?=(isset($item) && $item[0]['estado'] == 'Hidalgo')?'selected="selected"':''?>>Hidalgo</option>
                        <option value="Jalisco" <?=(isset($item) && $item[0]['estado'] == 'Jalisco')?'selected="selected"':''?>>Jalisco</option>
                        <option value="México" <?=(isset($item) && $item[0]['estado'] == 'México')?'selected="selected"':''?>>México</option>
                        <option value="Michoacán" <?=(isset($item) && $item[0]['estado'] == 'Michoacán')?'selected="selected"':''?>>Michoacán</option>
                        <option value="Morelos" <?=(isset($item) && $item[0]['estado'] == 'Morelos')?'selected="selected"':''?>>Morelos</option>
                        <option value="Nayarit" <?=(isset($item) && $item[0]['estado'] == 'Nayarit')?'selected="selected"':''?>>Nayarit</option>
                        <option value="Nuevo León" <?=(isset($item) && $item[0]['estado'] == 'Nuevo León')?'selected="selected"':''?>>Nuevo León</option>
                        <option value="Oaxaca" <?=(isset($item) && $item[0]['estado'] == 'Oaxaca')?'selected="selected"':''?>>Oaxaca</option>
                        <option value="Puebla" <?=(isset($item) && $item[0]['estado'] == 'Puebla')?'selected="selected"':''?>>Puebla</option>
                        <option value="Querétaro" <?=(isset($item) && $item[0]['estado'] == 'Querétaro')?'selected="selected"':''?>>Querétaro</option>
                        <option value="Quintana Roo" <?=(isset($item) && $item[0]['estado'] == 'Quintana Roo')?'selected="selected"':''?>>Quintana Roo</option>
                        <option value="San Luis Potosí" <?=(isset($item) && $item[0]['estado'] == 'San Luis Potosí')?'selected="selected"':''?>>San Luis Potosí</option>
                        <option value="Sinaloa" <?=(isset($item) && $item[0]['estado'] == 'Sinaloa')?'selected="selected"':''?>>Sinaloa</option>
                        <option value="Sonora" <?=(isset($item) && $item[0]['estado'] == 'Sonora')?'selected="selected"':''?>>Sonora</option>
                        <option value="Tabasco" <?=(isset($item) && $item[0]['estado'] == 'Tabasco')?'selected="selected"':''?>>Tabasco</option>
                        <option value="Tamaulipas" <?=(isset($item) && $item[0]['estado'] == 'Tamaulipas')?'selected="selected"':''?>>Tamaulipas</option>
                        <option value="Tlaxcala" <?=(isset($item) && $item[0]['estado'] == 'Tlaxcala')?'selected="selected"':''?>>Tlaxcala</option>
                        <option value="Veracruz" <?=(isset($item) && $item[0]['estado'] == 'Veracruz')?'selected="selected"':''?>>Veracruz</option>
                        <option value="Yucatán" <?=(isset($item) && $item[0]['estado'] == 'Yucatán')?'selected="selected"':''?>>Yucatán</option>
                        <option value="Zacatecas" <?=(isset($item) && $item[0]['estado'] == 'Zacatecas')?'selected="selected"':''?>>Zacatecas</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <input type="hidden" name="id" value="<?= (isset($item) ? $item[0]['id_sucursal'] : '') ?>"/>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</form>