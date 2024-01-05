function nl2br(str, is_xhtml) {
    var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br ' + '/>' : '<br>';
    return (str + '')
            .replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
}

$.fn.serializeObject = function () {
    var o = {};
    var a = this.serializeArray();
    $.each(a, function () {
        if (o[this.name]) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};


$(document).ready(function () {

    $('.modal').on('hidden.bs.modal', function () {
        if ($(".modal.in").length > 0) {
            $("body").addClass("modal-open");
        }
    });

    $(".sortable").sortable({
        handle: '.handle-sortable',
        update: function () {
            var self = $(this);
            if (self.data("url") !== undefined) {
                var data = self.data("post-function") !== undefined ? window[self.data("post-function")].apply(null) :  $(this).sortable("serialize", {attribute: 'sort'});
                $.post(self.data("url"), data, function (o) {

                }, 'json');
            }
        }
    }).disableSelection();

    $(document).on('click', '.chk-update-activo', function (e) {
        var self = $(this);
        $.post(self.data('url'), {activo: self.is(':checked') ? 1 : 0});
    });
    $(document).on('click', '.chk-update-textfield', function (e) {
        var self = $(this);
        $.post(self.data('url'), {valor: self.is(':checked') ? 1 : 0});
    });
    $(document).on('submit', '.ajaxPostForm', function (e) {
        e.preventDefault();
        var self = $(this);
        var urlSuccess = self.data('url-success');
        var function_success = self.data('function-success');
        var url = self.attr('action');
        datos = $(this).serialize();
        $.ajax({
            'url': url,
            type: 'post',
            dataType: 'json',
            data: datos,
            beforeSend: function( o ) {
		        self.addClass("disabled");
		        showLoader('Espera un momento...');
            },
            complete: function (o) {
                self.removeClass("disabled");
                closeLoader();
            },
            success: function (o) {
                if (o.result == 1) {
	                if (function_success !== undefined) {
                            window[function_success].apply(null, [o]);
                    }else{
                    	window.location = urlSuccess;
                   	}
                } else {
                    Result.showError(o.error);
                }
            }
        });
    });
    $(document).on('submit', '.ajaxPostFormURL', function (e) {
        e.preventDefault();
        var self = $(this);
        var url = self.attr('action');
        self.addClass("disabled");
        showLoader('Espera un momento...');
        datos = $(this).serialize();
        $.ajax({
            'url': url,
            type: 'post',
            dataType: 'json',
            data: datos,
            complete: function (o) {
                self.removeClass("disabled");
            },
            success: function (o) {
                closeLoader();
                if (o.result == 1) {
                    window.location = o.url;
                } else {
                    Result.showError(o.error);
                }
            }
        });
    });

    $(document).on('click', '.eliminarRowDataTable', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        var a = $(this);
        var texto = $(this).attr('title');
        showConfirm('Información', texto, function () {
            $.ajax({
                'url': url,
                type: 'post',
                dataType: 'json',
                data: {},
                success: function (o) {
                    closeLoader();
                    if (o.result == 1) {
                        a.closest('.data-table').DataTable()
                                .row(a.closest('tr'))
                                .remove()
                                .draw();
                    } else {
                        Result.showError(o.error);
                    }
                }
            });
        });
    });
    $(document).on('click', '.eliminarRow', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        var a = $(this);
        var texto = $(this).attr('title');
        showConfirm('Información', texto, function () {
            $.ajax({
                'url': url,
                type: 'post',
                dataType: 'json',
                data: {},
                success: function (o) {
                    closeLoader();
                    if (o.result == 1) {
                        a.closest('tr').remove();
                    } else {
                        Result.showError(o.error);
                    }
                }
            });
        });
    });
    $(document).on('click', '.eliminarSimpleRow', function (e) {
        e.preventDefault();
        var a = $(this);
        var texto = $(this).attr('title');
        showConfirm('Información', texto, function () {
            a.closest('tr').remove();
        });
    });

    $(document).on('click', '.show-confirm-post', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        var self = $(this);
        var titulo = $(this).data('title') === undefined ? 'Información' : $(this).data('title');
        var texto = $(this).data('content');

        showConfirm(titulo, texto, function () {
            var function_success = self.data('function-success');
            $.ajax({
                'url': url,
                type: 'post',
                dataType: 'json',
                data: {},
                success: function (o) {
                    closeLoader();
                    if (o.result == 1) {
                        $('#myModal').modal('hide');
                        if (function_success !== undefined) {
                            window[function_success].apply(null, [o]);
                        }
                    } else {
                        Result.showError(o.error);
                    }
                }
            });
        });
    });

    $(document).on("click", ".show-modal", function (e) {
        e.preventDefault();
        var self = $(this);
        var url = self.attr('href');
        self.addClass("disabled");
        $.post(url,
                ((self.data("post") !== undefined) ? $.JSON.decode(self.data("post")) : {})
                , function (response) {

                    $('#myModal .modal-content').html('');
                    $('#myModal .modal-content').append(response);
                    $('#myModal').modal('show');
                    self.removeClass("disabled");
                });
        return  false;
    });

    $(document).on("click", ".show-modal-lg", function (e) {
        e.preventDefault();
        var self = $(this);
        var url = self.attr('href');
        self.addClass("disabled");
        $.post(url,
                ((self.data("post") !== undefined) ? $.JSON.decode(self.data("post")) : {})
                , function (response) {

                    $('#myBigModal .modal-content').html('');
                    $('#myBigModal .modal-content').append(response);
                    $('#myBigModal').modal('show');
                    self.removeClass("disabled");
                });
        return  false;
    });

    $(document).on("click", ".show-modal-folder", function (e) {
        e.preventDefault();
        var self = $(this);
        var url = self.attr('href');
        self.addClass("disabled");
        $.post(url,
                ((self.data("post") !== undefined) ? $.JSON.decode(self.data("post")) : {})
                , function (response) {

                    $('#myFolderModal .modal-content').html('');
                    $('#myFolderModal .modal-content').append(response);
                    $('#myFolderModal').modal('show');
                    self.removeClass("disabled");
                });
        return  false;
    });

    $(document).on("click", ".show-modal-super", function (e) {
        e.preventDefault();
        var self = $(this);
        var url = self.attr('href');
        self.addClass("disabled");
        $.post(url,
            ((self.data("post") !== undefined) ? $.JSON.decode(self.data("post")) : {})
            , function (response) {
                $('#superModal .modal-content').html('');
                $('#superModal .modal-content').append(response);
                $('#superModal').modal('show');
                self.removeClass("disabled");
            });
        return  false;
    });

    $(document).on("click", ".disabled", function (e) {
        e.preventDefault();
    });


    $(document).on('submit', '.ajaxPostFormModal', function (e) {
        e.preventDefault();
        var self = $(this);
        self.addClass("disabled");
        var url = self.attr('action');
        var function_success = self.data('function-success');

        datos = $(this).serialize();
        $.ajax({
            url: url,
            type: 'post',
            dataType: 'json',
            data: datos,
            success: function (o) {

                self.removeClass("disabled");
                if (o.result == 1) {
                    self.closest(".modal").modal('hide');
                    if (function_success !== undefined)
                        window[function_success].apply(null, [o]);
                } else {
                    Result.showError(o.error);
                }
            }
        });
    });

    $(document).on('submit', '.ajaxPostFormModalCK', function (e) {
        e.preventDefault();
        var self = $(this);
        self.addClass("disabled");
        var url = self.attr('action');
        var function_success = self.data('function-success');

        $.ajax({
            url: url,
            type: 'post',
            dataType: 'json',
            data: {
                valor: CKEDITOR.instances.txtContenidoCK.getData()
            },
            complete: function (o) {
                self.removeClass("disabled");
            },
            success: function (o) {
                if (o.result == 1) {
                    self.closest(".modal").modal('hide');
                    if (function_success !== undefined)
                        window[function_success].apply(null, [o]);
                } else {
                    Result.showError(o.error);
                }
            }
        });
    });

    $(document).on("click", ".show-big-modal", function (e) {
        e.preventDefault();
        var self = $(this);
        var url = self.attr('href');

        self.addClass("disabled");
        $.post(url,
            ((self.data("post") !== undefined) ? $.JSON.decode(self.data("post")) : {})
        , function (response) {

            $('#myBigModal .modal-content').html('');
            $('#myBigModal .modal-content').append(response);
            $('#myBigModal').modal('show');
            self.removeClass("disabled");
        });
        return  false;
    });


});

function ajaxPost(form, postData, funcionExito, funcionError) {

    $(form).submit(function (event) {
        event.preventDefault();
        var self = $(this);
        showLoader('Espera un momento...');

        var url = $(this).attr('action');
        if (typeof (postData) === 'function') {
            datos = postData();
        } else if (typeof (postData) === 'object') {
            datos = postData;
        } else {
            datos = $(this).serialize();
        }
        //self.addClass("disabled");
        $.ajax({
            'url': url,
            type: 'post',
            dataType: 'json',
            data: datos,
            success: function (o) {
                closeLoader();
                self.removeClass("disabled");
                if (o.result == 1) {
                    funcionExito(o);
                } else {
                    if (typeof (funcionError) === 'function') {
                        funcionError(o);
                    }
                }
            }
        });
    });
}


function ajaxPostFiles(form, postData, funcionExito, funcionError) {
    $(form).submit(function (event) {
        event.preventDefault();
        showLoader('Espera un momento...');
        var url = $(this).attr('action');
        if (typeof (postData) === 'function') {
            datos = postData();
        } else if (typeof (postData) === 'object') {
            datos = postData;
        } else {
            datos = $(this).serialize();
        }

        $.ajax({
            'url': url,
            type: 'post',
            dataType: 'json',
            data: datos,
            processData: false,
            contentType: false,
            success: function (o) {
                closeLoader();
                if (o.result == 1) {
                    funcionExito(o);
                } else {
                    if (typeof (funcionError) === 'function') {
                        funcionError(o);
                    }
                }
            }
        });
    });
}

function ajaxPostForm(form, postData, url) {
    ajaxPost(form, postData, function () {
        window.location = url;
    }, function (o) {
        Result.showError(o.error);
    });
}

function ajaxPostFormFiles(form, postData, url) {
    ajaxPostFiles(form, postData, function () {
        window.location = url;
    },
            function (o) {
                Result.showError(o.error);
            }, true);
}

function ajaxPostSimple(postData, url, funcionExito, funcionError, loader) {

    var datos = '';
    if (typeof (postData) == "function") {
        datos = postData();
    } else if (typeof (postData) === 'object') {
        datos = postData;
    } else {
        datos = decodeURIComponent($.param(postData));
    }

    if (typeof (loader) === 'undefined' || loader == true) {
        showLoader('Espera un momento...');
    }

    $.post(url, datos, function (o) {
        if (typeof (loader) === 'undefined' || loader == true) {
            closeLoader();
        }
        if (o.result == 1) {
            funcionExito(o);
        } else {
            if (typeof (funcionError) === 'function') {
                funcionError(o);
            }
        }
    }, 'json');

}

function ajaxPostFilesSimple(postData, url, funcionExito, funcionError) {
    showLoader('Espera un momento...');
    if (typeof (postData) === 'function') {
        datos = postData();
    } else if (typeof (postData) === 'object') {
        datos = postData;
    } else {
        datos = postData;
    }

    $.ajax({
        'url': url,
        type: 'post',
        dataType: 'json',
        data: datos,
        processData: false,
        contentType: false,
        success: function (o) {
            closeLoader();
            if (o.result == 1) {
                funcionExito(o);
            } else {
                if (typeof (funcionError) === 'function') {
                    funcionError(o);
                }
            }
        }
    });
}

function  ajaxRequest(postData, urlPost, urlRedirect) {
    ajaxPostSimple(postData, urlPost, function (o) {
        window.location = urlRedirect;
    },
            function (o) {
                Result.showError(o.error);
            }
    );
}

function  ajaxRequestEliminar(postData, urlPost, element) {
    ajaxPostSimple(postData, urlPost, function (o) {

        var table = $("#idDatatable").DataTable();
        table.row($(element).parents('.trRegistro')).remove().draw();
    },
            function (o) {
                Result.showError(o.error);
            }
    );
}

function  ajaxRequestActualizar(postData, urlPost, element, funcionExtra) {

    var funcionOk = function (o) {

        if (typeof o.objeto != 'undefined') {
            var obj = o.objeto;
            var tr = $(element).parents('.trRegistro');
            var cell = tr.children();
            Object.keys(obj).forEach(function (key) {
                cell[key].innerHTML = obj[key];
            });
        }

        funcionExtra(element);

    }

    ajaxPostSimple(postData, urlPost, funcionOk,
            function (o) {
                Result.showError(o.error);
            }

    );
}

function reGraficar(instanciaGrafica, objectData) {

    instanciaGrafica.options.data[0].dataPoints = objectData;
    instanciaGrafica.render();

}

function formatCurrency(num, show_symbol, symbol) {
    show_symbol = typeof show_symbol !== 'undefined' ? show_symbol : true;
    symbol = typeof symbol !== 'undefined' ? symbol : '$ ';
    num = num.toString().replace(/\$|\,/g, '');
    if (isNaN(num))
        num = "0";
    sign = (num == (num = Math.abs(num)));
    num = Math.floor(num * 100 + 0.50000000001);
    cents = num % 100;
    num = Math.floor(num / 100).toString();
    if (cents < 10)
        cents = "0" + cents;
    for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3); i++)
        num = num.substring(0, num.length - (4 * i + 3)) + ',' +
                num.substring(num.length - (4 * i + 3));
    return (((sign) ? '' : '-') + symbol + num + '.' + cents);
}

function round(value, exp) {
    if (typeof exp === 'undefined' || +exp === 0)
        return Math.round(value);

    value = +value;
    exp = +exp;

    if (isNaN(value) || !(typeof exp === 'number' && exp % 1 === 0))
        return NaN;

    // Shift
    value = value.toString().split('e');
    value = Math.round(+(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp)));

    // Shift back
    value = value.toString().split('e');
    return +(value[0] + 'e' + (value[1] ? (+value[1] - exp) : -exp));
}
