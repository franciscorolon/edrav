<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <meta charset="utf-8" />
        <title><?= NOMBRE_SITIO?> | Iniciar Sesión</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" />
        <link rel="apple-touch-icon" href="pages/ico/60.png">
        <link rel="apple-touch-icon" sizes="76x76" href="pages/ico/76.png">
        <link rel="apple-touch-icon" sizes="120x120" href="pages/ico/120.png">
        <link rel="apple-touch-icon" sizes="152x152" href="pages/ico/152.png">
        <link rel="icon" type="image/x-icon" href="favicon.ico" />
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-touch-fullscreen" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="default">
        <meta content="" name="description" />
        <meta content="" name="author" />
        <link href="<?=base_url('assets/plugins/pace/pace-theme-flash.css')?>" rel="stylesheet" type="text/css" />
        <link href="<?=base_url('assets/plugins/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet" type="text/css" />
        <link href="<?=base_url('assets/plugins/font-awesome/css/font-awesome.css')?>" rel="stylesheet" type="text/css" />
        <link href="<?=base_url('assets/plugins/jquery-scrollbar/jquery.scrollbar.css')?>" rel="stylesheet" type="text/css" media="screen" />
        <link href="<?=base_url('assets/plugins/select2/css/select2.min.css')?>" rel="stylesheet" type="text/css" media="screen" />
        <link href="<?=base_url('assets/plugins/switchery/css/switchery.min.css')?>" rel="stylesheet" type="text/css" media="screen" />
        <link href="<?=base_url('assets/pages/css/pages-icons.css')?>" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="<?=base_url('assets/pages/css/themes/light.css')?>" class="main-stylesheet" />
        <script type="text/javascript">
            window.onload = function()
            {
            // fix for windows 8
                if (navigator.appVersion.indexOf("Windows NT 6.2") != -1)
                document.head.innerHTML += '<link rel="stylesheet" type="text/css" href="<?=base_url('assets/pages/css/windows.chrome.fix.css')?>" />'
            }
        </script>
    </head>
    <body class="fixed-header menu-pin">
        <div class="login-wrapper ">
          <!-- START Login Background Pic Wrapper-->
          <div class="bg-pic">
            <!-- START Background Pic-->
            <img src="<?=base_url('assets/img/edrav/login_bg.jpg')?>" data-src="<?=base_url('assets/img/edrav/login_bg.jpg')?>" data-src-retina="<?=base_url('assets/img/edrav/login_bg.jpg')?>" alt="EDRAV" class="lazy">
            <!-- END Background Pic-->
            <!-- START Background Caption-->
            <div class="bg-caption pull-bottom sm-pull-bottom text-white p-l-20 m-b-20">
              <p class="small">
                 Todos los derechos reservados © <?=date('Y')?> EDRAV.
              </p>
            </div>
            <!-- END Background Caption-->
          </div>
          <!-- END Login Background Pic Wrapper-->
          <!-- START Login Right Container-->
          <div class="login-container bg-white">
            <div class="p-l-50 m-l-20 p-r-50 m-r-20 p-t-50 m-t-30 sm-p-l-15 sm-p-r-15 sm-p-t-40">
              <img src="<?=base_url('assets/img/edrav/logo.png')?>" alt="logo" data-src="<?=base_url('assets/img/edrav/logo.png')?>" data-src-retina="<?=Base_url('assets/img/edrav/logo.png')?>" width="105" height="67">
              <p class="p-t-35">Panel Administrativo</p>
              <div id="login-alert" class="alert alert-danger" style="display:none"></div>
              <!-- START Login Form -->
              <form <form id="loginform" action="<?= $URL_FORM ?>" method="POST"  class="p-t-15" role="form">
                <!-- START Form Control-->
                <div class="form-group form-group-default">
                  <label>Usuario</label>
                  <div class="controls">
                    <input type="text" class="form-control" name="usuario" placeholder="PE. Admin" required>
                  </div>
                </div>
                <!-- END Form Control-->
                <!-- START Form Control-->
                <div class="form-group form-group-default">
                  <label>Contraseña</label>
                  <div class="controls">
                    <input type="password" class="form-control" name="password" placeholder="PE. Contraseña" required>
                  </div>
                </div>
                <button class="btn btn-primary btn-cons m-t-10" type="submit">Ingresar</button>
              </form>
              <!--END Login Form-->
            </div>
          </div>
          <!-- END Login Right Container-->
        </div>
    <!-- BEGIN VENDOR JS -->
    <script type="text/javascript" src="<?=base_url('assets/plugins/pace/pace.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/plugins/jquery/jquery-3.2.1.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/plugins/modernizr.custom.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/plugins/jquery-ui/jquery-ui.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/plugins/tether/js/tether.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/plugins/bootstrap/js/bootstrap.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/plugins/jquery/jquery-easy.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/plugins/jquery-unveil/jquery.unveil.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/plugins/jquery-ios-list/jquery.ioslist.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/plugins/jquery-actual/jquery.actual.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/plugins/select2/js/select2.full.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/plugins/classie/classie.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/plugins/switchery/js/switchery.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/plugins/jquery-validation/js/jquery.validate.min.js')?>"></script>
    <!-- END VENDOR JS -->
    <script type="text/javascript" src="<?=base_url('assets/pages/js/pages.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/js/result.js') ?>"></script>
    <script>
        $(document).ready(function () {
            $('#loginform').validate();
            Result = new Result();
            $("#loginform").submit(function(event) {
            $("#login-alert").fadeOut();
            event.preventDefault();
            var url = $(this).attr('action');
            var postData = $(this).serialize();
            $.post(url, postData, function(o) {
                if (o.result == 1) {
                    window.location.href = '<?= base_url('admin/inicio') ?>';
                }
                else {
                    Result.error(o.error,$("#login-alert"));
                }
            }, 'json');

        });
        });
    </script>
  </body>
</html>