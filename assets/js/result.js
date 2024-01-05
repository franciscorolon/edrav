// JavaScript Document
var Result = function() {

    //-------------------------------------------------------------------------------------------------------

    this.__construct = function() {
    };

    //-------------------------------------------------------------------------------------------------------

    this.success = function(msg,dom) {
        if (typeof msg === 'undefined') {
            dom.html('Success').show();
        }
        else
            dom.html(msg).fadeIn();
        setTimeout(function() {
            dom.fadeOut();
        }, 5000);
    }

    //-------------------------------------------------------------------------------------------------------

    this.showSuccess = function(msg) {
        if (typeof msg === 'undefined') {
            showAlert('Ã‰xito','La operaciÃ³n fue exitosa');
        }
        else {
            if (typeof msg === 'object') {
                //Loop
                var output = '<ul>';
                for (var key in msg) {
                    output += '<li>' + msg[key] + '</li>';
                }
                output += '</ul>';
                showAlert('Ã‰xito',output);
            }
            else {
                showAlert('Ã‰xito',msg);
            }
        }
    }

    //-------------------------------------------------------------------------------------------------------

    this.error = function(msg,dom) {
        if (typeof msg === 'undefined') {
            dom.html('Error').show();
        }
        else {
            if (typeof msg === 'object') {
                //Loop
                var output = '<ul>';
                for (var key in msg) {
                    output += '<li>' + msg[key] + '</li>';
                }
                output += '</ul>';
                dom.html(output).fadeIn();
            }
            else {
                dom.html(msg).fadeIn();
            }
        }
        setTimeout(function() {
            dom.fadeOut();
        }, 5000);
    }

    //-------------------------------------------------------------------------------------------------------

    this.showError = function(msg) {
        if (typeof msg === 'undefined') {
            showAlert('Error','OcurriÃ³ un error');
        }
        else {
            if (typeof msg === 'object') {
                //Loop
                var output = '<ul>';
                for (var key in msg) {
                    output += '<li>' + msg[key] + '</li>';
                }
                output += '</ul>';
                showAlert('Error',output);
            }
            else {
                showAlert('Error',msg);
            }
        }
    }

    //-------------------------------------------------------------------------------------------------------

    this.__construct();

};