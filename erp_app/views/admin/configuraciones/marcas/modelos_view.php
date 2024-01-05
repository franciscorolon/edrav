<div class="modal-header clearfix text-left">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
</button>
    <h5><?=$HEADER_MODAL?></h5>
</div>
<div class="modal-body">
    <div class="card card-transparent">
        <div class="card-header">
            <form id="add_model" role="form" method="post" action="<?= $URL_FORM ?>" class="ajaxPostForm" data-function-success="refresh_datatable_models">
                <div class="row">
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="modelo">Modelo</label>
                            <input id="modelo" name="modelo" class="form-control" />
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="estilo">Estilo</label>
                            <select id="estilo" name="estilo" class="form-control">
                                <option value="-1" disabled selected>Seleccione Estilo</option>
                                <option value="BUS">Bus</option>
                                <option value="CAMION">Camión</option>
                                <option value="DEPORTIVO">Deportivo</option>
                                <option value="ECO">Eco</option>
                                <option value="FURGONETA">Furgoneta</option>
                                <option value="HATCHBACK">Hatchback</option>
                                <option value="MAQUINARIA">Maquinaria Pesada</option>
                                <option value="MINIVAN">Minivan</option>
                                <option value="PICKUP">Pick Up</option>
                                <option value="SEDAN">Sedán</option>
                                <option value="4X2">Todo Terreno 4x2</option>
                                <option value="4X4">Todo Terreno 4x4</option>
                                <option value="TRAILER">Trailer</option>
                            </select>
                        </div>
                        <input type="hidden" name="id_marca" value="<?=$id_marca?>" />
                    </div>
                    <div class="col-xs-4"><button type="submit" class="btn btn-primary m-t-30"><i class="fa fa-plus"></i> Agregar Modelo</button></div>
                </div>
            </form>
        </div>
        <div class="card-block">
            <table class="table table-hover table-responsive-block" id="datatable-models" data-url="<?= $URL_ITEMS ?>">
                <thead>
                    <tr>
                        <th></th>
                        <th>Modelo</th>
                        <th>Estilo</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>