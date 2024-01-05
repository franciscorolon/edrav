<!-- begin row -->
<div class="row">
    <!-- begin col-10 -->
    <div class="col-md-12">
        <div class="card card-default">
            <h5 class="card-header">Datos del Usuario</h5>
            <div class="card-block">
                <form class="ajaxPostForm" action="<?= $URL_ACTION ?>" method="POST" data-url-success="<?= $URL_SUCCESS ?>">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-group-default required">
                                <label>Tipo de Usuario</label>
                                <select class="form-control select2" name="id_grupo" >
                                    <?php foreach ($TIPOS_USUARIO as $TIPO) { ?>
                                        <option value="<?= $TIPO['id'] ?>" <?=
                                        ((!isset($USUARIO)&&$TIPO['id'] == $TIPO_USUARIO_SELECCIONADO)
                                        	|| isset($USUARIO) && $USUARIO[0]['id_grupo']==$TIPO['id']) ? ' selected="selected" ' : ''
                                        ?>><?= $TIPO['label'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-group-default required">
                                <label>Usuario</label>
                                <input type="text" name="usuario" class="form-control" placeholder="Introduce el usuario para ingresar" value="<?= isset($USUARIO)?$USUARIO[0]['usuario']:''?>"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-default required">
                                <label>Correo Electrónico</label>
                                <input type="email" name="correo" class="form-control" autocomplete="off" placeholder="Introduce la dirección de correo del usuario" autocomplete="off" value="<?= isset($USUARIO)?$USUARIO[0]['correo']:''?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group form-group-default required">
                                <label>Nombre(s)</label>
                                <input type="text" name="nombre" class="form-control" placeholder="Nombre" value="<?= isset($USUARIO)?$USUARIO[0]['nombre']:''?>"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-group-default required">
                                <label>Paterno</label>
                                <input type="text" name="paterno" class="form-control" placeholder="Apellido Paterno" value="<?= isset($USUARIO)?$USUARIO[0]['paterno']:''?>"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group form-group-default required">
                                <label>Materno</label>
                                <input type="text" name="materno" class="form-control" placeholder="Materno" value="<?= isset($USUARIO)?$USUARIO[0]['materno']:''?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-group-default required">
                                <label>Contraseña</label>
                                <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="off" value="<?= isset($USUARIO)?$USUARIO[0]['password']:''?>" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-default required">
                                <label>Confirmar Contraseña</label>
                                <input type="password" name="confirmar_password" class="form-control" placeholder="Confirmar Password" autocomplete="off" value="<?= isset($USUARIO)?$USUARIO[0]['password']:''?>" />
                            </div>
                        </div>
                        <input type="hidden" class="form-control" name="id" id="id" value="<?= isset($USUARIO) ? $USUARIO[0]['id_usuario'] : '' ?>">
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-sm btn-primary m-r-5">Guardar</button>
                                <a href="<?= $URL_CANCELAR ?>" class="btn btn-sm btn-default">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end col-10 -->
</div>