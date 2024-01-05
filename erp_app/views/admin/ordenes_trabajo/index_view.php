<h1 class="h4"><?=$header?></h1>
<div id="flash-message" class="alert hide" role="alert"><?=isset($message)?$message:'';?></div>
<!-- START card -->
<div class="card card-transparent">
    <div class="card-header">
        <div class="pull-right">
            <div class="col-xs-12">
                <a href="<?= $url_agregar ?>" class="btn btn-primary"><?=$txt_agregar?></a>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="card-block">
        <table class="table table-hover table-responsive-block" id="datatable">
            <thead>
                <tr>
                    <th></th>
                    <th>No.Orden Trabajo</th>
                    <th>No.Orden</th>
                    <th>Fecha Creación</th>
                    <!--<th>Fecha Modificación</th>-->
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
