<h1 class="h4"><?=$header?></h1>
<div id="flash-message" class="alert hide" role="alert"><?=isset($message)?$message:'';?></div>
<!-- START card -->
<div class="card card-transparent">
    <div class="card-header">
        <div class="pull-right">
            <div class="col-xs-12">
                <a href="<?= $url_agregar ?>" class="show-modal btn btn-primary"><i class="fa fa-plus"></i> Agregar Color</a>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="card-block">
        <table class="table table-hover table-responsive-block" id="datatable">
            <thead>
                <tr>
                    <th></th>
                    <th>Color</th>
                    <th>Nombre</th>
                    <th></th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
