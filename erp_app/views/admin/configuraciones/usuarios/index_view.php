<h1 class="h4"><?=$header?></h1>
<div id="flash-message" class="alert" role="alert"><?=isset($message)?$message:'';?></div>

<div class=" container-fluid container-fixed-lg">
    <!-- START card -->
    <div class="card card-transparent">
        <div class="card-header ">
            <div class="pull-right">
                <div class="col-xs-12">
                    <a href="<?= $url_agregar ?>" class="show-modal-lg btn btn-primary"><i class="fa fa-plus"></i> Agregar Usuario</a>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="card-block">
            <table class="table table-hover demo-table-dynamic table-responsive-block" id="datatable">
                <thead>
                    <tr>
                        <th></th>
                        <th>Nombre</th>
                        <th>Usuario</th>
                        <th>Sexo</th>
                        <th>Correo</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>