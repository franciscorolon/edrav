function showLoader(Titulo) {
    $('#divLoader h5').html(Titulo);
    $('#divLoader').modal('show');
}
function closeLoader() {
	setTimeout(function(){ $('#divLoader').modal('toggle'); }, 3000);
    //$('.modal-backdrop').remove();
}
function showSubLoader(Titulo) {
    $('#divSubLoader h5').html(Titulo);
    $('#divSubLoader').modal('show');
}
function closeSubLoader() {
    setTimeout(function(){ $('#divSubLoader').modal('toggle'); }, 3000);
}
function showAlert(Titulo, Texto) {
	$('#divAlert h4').html(Titulo);
	$("#divAlert .modal-body .content").html(Texto);
	if(Titulo == 'Éxito'){
		showSuccess(Titulo, Texto);
	}
	$('#divAlert').modal('show');
}

function showSuccess(Titulo, Texto) {
    $('#divSuccess h4').html(Titulo);
    $("#divSuccess .modal-body .content").html(Texto);
    if( $('#divSuccess').hasClass('show') != true){
        $('#divSuccess').modal('show');
    }
}
function showConfirm(Titulo, Texto, Funcion, funcionCancelar) {
    $('#divConfirm h5').html(Titulo);
    $("#divConfirm .modal-body").html(Texto);
    $("#divConfirm .btn-default").on("click", function(){
        if (typeof (funcionCancelar) === 'function') {
            funcionCancelar();
        }
        setTimeout(function(){ $('#divConfirm').modal('toggle'); }, 3000);
    });
    $("#divConfirm .btn-primary").off("click");
    $("#divConfirm .btn-primary").on('click', function() {
        $('#divConfirm').modal('hide');
        $('#divConfirm').on('hidden.bs.modal', function (e) {
            Funcion();
        });
    });

    if( $('#divConfirm').hasClass('show') != true){
        $('#divConfirm').modal('show');
    }

}

function loadModal(url, data) {
    showLoader('Espera un momento...');
    $('#myModal .modal-content').html('');
    $.post(url, data, function(response) {
        closeLoader();
        $('#myModal .modal-content').append(response);
        setTimeout(function(){
            $('#myModal').modal('show');
        },500);
    });
    return  false;
}

function loadBigModal(url, data) {
    showLoader('Espera un momento...');
    $('#myBigModal .modal-content').html('');
    $.post(url, data, function(response) {
        closeLoader();
        $('#myBigModal .modal-content').append(response);
        setTimeout(function(){
            $('#myBigModal').modal('show');
        },400);
    });
    return  false;
}

function showModal(Texto) {
    $("#myModal .modal-content").html(Texto);
    $('#myModal').modal('show');
}

function showModalBig(Texto) {
    $("#myBigModal .modal-content").html(Texto);
    $('#myBigModal').modal('show');
}

function showSuperModal(Texto) {
    $("#superModal .modal-content").html(Texto);
    $('#superModal').modal('show');
}

function showConfirmA(Titulo, Texto, Funcion, objeto, FunctionCancelar) {
    swal({
        title: Titulo,
        text: Texto,
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No',
    }).then((result) => {
        if (result.value) {
            Funcion(objeto);
        }else{
            if (typeof (FunctionCancelar) === 'function') {
                funcionCancelar();
            }
        }
    });
}

function showConfirmB(Titulo, Texto, Funcion, FunctionCancelar, objeto) {
    $('#divConfirm h4').html(Titulo);
    $("#divConfirm .modal-body").html(Texto);
    $("#divConfirm .btn-default").on('click', function() {
        FunctionCancelar(objeto);
        $('#divConfirm').modal('hide');
    });
    $("#divConfirm .btn-primary").on('click', function() {
        Funcion();
        $('#divConfirm').modal('hide');
    });
    $('#divConfirm').modal('show');
}

$('#myModal').bind('hidden.bs.modal', function () {
  $("html").css("margin-right", "0px");
});
$('#myModal').bind('show.bs.modal', function () {
  $("html").css("margin-right", "-15px");
});
$('#myBigModal').bind('hidden.bs.modal', function () {
  $("html").css("margin-right", "0px");
});
$('#myBigModal').bind('show.bs.modal', function () {
  $("html").css("margin-right", "-15px");
});