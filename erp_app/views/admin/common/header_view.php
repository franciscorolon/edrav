<?php $id_grupo = $this->session->userdata('id_grupo');?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <meta http-equiv="Access-Control-Allow-Origin" content="*">
        <meta charset="utf-8" />
        <title><?= isset($title) ? $title.' | ' : '' ?><?= NOMBRE_SITIO ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <link rel="apple-touch-icon" href="pages/ico/60.png">
        <link rel="apple-touch-icon" sizes="76x76" href="pages/ico/76.png">
        <link rel="apple-touch-icon" sizes="120x120" href="pages/ico/120.png">
        <link rel="apple-touch-icon" sizes="152x152" href="pages/ico/152.png">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-touch-fullscreen" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="default">
        <meta content="" name="description" />
        <meta content="" name="author" />
        <link rel="stylesheet" type="text/css" href="<?=base_url('assets/plugins/pace/pace-theme-flash.css')?>" />
        <link rel="stylesheet" type="text/css" href="<?=base_url('assets/plugins/bootstrap/css/bootstrap.min.css')?>" />
        <link rel="stylesheet" type="text/css" href="<?=base_url('assets/plugins/font-awesome/css/font-awesome.css')?>" />
        <link rel="stylesheet" type="text/css" href="<?=base_url('assets/plugins/jquery-scrollbar/jquery.scrollbar.css')?>" media="screen" />
        <link rel="stylesheet" type="text/css" href="<?=base_url('assets/plugins/select2/css/select2.min.css')?>" media="screen" />
        <link rel="stylesheet" type="text/css" href="<?=base_url('assets/plugins/switchery/css/switchery.min.css')?>" media="screen" />
        <link rel="stylesheet" type="text/css" href="<?=base_url('assets/plugins/fancybox/jquery.fancybox.min.css')?>" />
        <link rel="stylesheet" type="text/css" href="<?=base_url('assets/pages/css/pages-icons.css')?>">
        <?=isset($css)?$css:''?>
        <link rel="stylesheet" type="text/css" href="<?=base_url('assets/pages/css/themes/light.css')?>" class="main-stylesheet" />
        <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/style.css')?>" />
    </head>
    <body class="fixed-header menu-pin">
    <?=load_view('admin/common/custom_dialogs.php', '') ?>
    <!-- BEGIN SIDEBAR -->
        <!-- BEGIN SIDEBPANEL-->
    <nav class="page-sidebar" data-pages="sidebar">
        <!-- BEGIN SIDEBAR MENU TOP TRAY CONTENT-->
        <div class="sidebar-overlay-slide from-top" id="appMenu"></div>
        <!-- END SIDEBAR MENU TOP TRAY CONTENT-->
        <!-- BEGIN SIDEBAR MENU HEADER-->
        <div class="sidebar-header">
            <img src="<?=base_url('assets/img/edrav/logo_dashboard.png')?>" alt="logo" class="brand" data-src="<?=base_url('assets/img/edrav/logo_dashboard.png')?>" data-src-retina="<?=base_url('assets/img/edrav/logo_dashboard.png')?>" width="210" height='60'>
        </div>
        <!-- END SIDEBAR MENU HEADER-->
        <!-- START SIDEBAR MENU -->
        <div class="sidebar-menu">
            <!-- BEGIN SIDEBAR MENU ITEMS-->
            <ul class="menu-items">
                <li id='liInicio' class="m-t-30">
                    <a href="<?=base_url('admin/inicio')?>">
                    <span class="title">Inicio</span>
                    </a>
                    <span class="icon-thumbnail "><i data-feather="home"></i></span>
                </li>
                <?php if (!$this->session->userdata('id_usuario') || ($id_grupo != PROVEEDOR) ): ?>
                <li id="liOrdenes">
                    <a href="<?=base_url('admin/ordenes')?>">
                        <span class="title">Órdenes</span>
                    </a>
                    <span class="icon-thumbnail "><i data-feather="file"></i></span>
                </li>
                <?php endif;?>
                <?php if (!$this->session->userdata('id_usuario') || ($id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR ||  $id_grupo == CLIENTES_AVANZADO || $id_grupo == CLIENTES_BASICO) ): ?>
                <li id="liOrdenesTrabajo">
                    <a href="<?=base_url('admin/ordenes-trabajo')?>">
                        <span class="title">Órdenes de Trabajo</span>
                    </a>
                    <span class="icon-thumbnail "><i data-feather="file-plus"></i></span>
                </li>
                <?php endif;?>
                <?php if (!$this->session->userdata('id_usuario') || ($id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR ||  $id_grupo == CLIENTES_AVANZADO || $id_grupo == CLIENTES_BASICO) ): ?>
                <li id="liRecibos">
                    <a href="<?=base_url('admin/recibos')?>">
                        <span class="title">Recibos</span>
                    </a>
                    <span class="icon-thumbnail "><i data-feather="file-text"></i></span>
                </li>
                <?php endif; ?>
                <?php if (!$this->session->userdata('id_usuario') || ($id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR) ): ?>
                <li id="liContabilidad">
                    <a href="<?=base_url('admin/contabilidad')?>">
                        <span class="title">Contabilidad</span>
                    </a>
                    <span class="icon-thumbnail "><i data-feather="list"></i></span>
                </li>
                <?php endif; ?>
                <?php if (!$this->session->userdata('id_usuario') || ($id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR)):?>
                <li id="liReportes">
                	<a><span class="title">Reportes</span>
                        <span class=" arrow"></span>
                    </a>
                    <span class="icon-thumbnail"><i data-feather="box"></i></span>
                    <ul class="sub-menu">
                        <li id="lkAutomoviles">
                            <a href="<?=base_url('admin/reportes/automoviles')?>">Automóviles</a>
                            <span class="icon-thumbnail">A</span>
                        </li>
                        <li id="lkRecibos">
                            <a href="<?=base_url('admin/reportes/recibos')?>">Recibos</a>
                            <span class="icon-thumbnail">S</span>
                        </li>
                        <li id="lkVales">
                        	<a href="<?=base_url('admin/reportes/vales-refacciones')?>">Vales de Refacciones</a>
                        	<span class="icon-thumbnail">V</span>
                        </li>
                    </ul>
                </li>
                <?php endif; ?>
                <?php if (!$this->session->userdata('id_usuario') || ($id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == CLIENTES_AVANZADO || $id_grupo == CLIENTES_BASICO)):?>
                <li id="liClientes">
                    <a href="<?=base_url('admin/clientes')?>">
                        <span class="title">Clientes</span>
                    </a>
                    <span class="icon-thumbnail "><i data-feather="user"></i></span>
                </li>
                <?php endif; ?>
                <?php if (!$this->session->userdata('id_usuario') || ($id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == CLIENTES_AVANZADO)):?>
                <li id="liConfiguracion">
                    <a><span class="title">Configuración</span>
                        <span class=" arrow"></span>
                    </a>
                    <span class="icon-thumbnail"><i data-feather="settings"></i></span>
                    <ul class="sub-menu">
                         <?php if (!$this->session->userdata('id_usuario') || ($id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR) ): ?>
                        <li id="lkUsuarios">
                            <a href="<?=base_url('admin/configuraciones/usuarios')?>">Usuarios</a>
                            <span class="icon-thumbnail">U</span>
                        </li>
                        <?php endif;?>
                         <?php if (!$this->session->userdata('id_usuario') || ($id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR) ): ?>
                        <li id="lkSucursales">
                            <a href="<?=base_url('admin/configuraciones/sucursales')?>">Sucursales</a>
                            <span class="icon-thumbnail">S</span>
                        </li>
                        <?php endif;?>
                        <?php if (!$this->session->userdata('id_usuario') || ($id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR || $id_grupo == CLIENTES_AVANZADO) ): ?>
                        <li id="lkAseguradoras">
                            <a href="<?=base_url('admin/configuraciones/aseguradoras')?>">Aseguradoras</a>
                            <span class="icon-thumbnail">A</span>
                        </li>
                        <?php endif; ?>
                        <?php if (!$this->session->userdata('id_usuario') || ($id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR) ): ?>
                        <li id="lkCorreos">
                            <a href="<?=base_url('admin/configuraciones/correos')?>">Correos</a>
                            <span class="icon-thumbnail">C</span>
                        </li>
                        <?php endif;?>
                        <?php if (!$this->session->userdata('id_usuario') || ($id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR) ): ?>
                        <li id="lkColores">
                            <a href="<?=base_url('admin/configuraciones/colores')?>">Colores</a>
                            <span class="icon-thumbnail">Co</span>
                        </li>
                        <?php endif;?>
                        <?php if (!$this->session->userdata('id_usuario') || ($id_grupo == SUPER_ADMINISTRADOR || $id_grupo == ADMINISTRADOR) ): ?>
                        <li id="lkMarcas">
                            <a href="<?=base_url('admin/configuraciones/marcas')?>">Marcas</a>
                            <span class="icon-thumbnail">M</span>
                        </li>
                        <?php endif;?>
                        <?php if (!$this->session->userdata('id_usuario') || ($id_grupo == SUPER_ADMINISTRADOR) ): ?>
                        <li id="lkPiezas">
                            <a href="<?=base_url('admin/configuraciones/piezas-automovil')?>">Piezas del Automóvil</a>
                            <span class="icon-thumbnail">PA</span>
                        </li>
                        <?php endif;?>
                        <?php if (!$this->session->userdata('id_usuario') || ($id_grupo == SUPER_ADMINISTRADOR) ): ?>
                        <li id="lkPartes">
                            <a href="<?=base_url('admin/configuraciones/partes-automovil')?>">Partes del Automóvil</a>
                            <span class="icon-thumbnail">PA</span>
                        </li>
                        <?php endif;?>
                        <?php if (!$this->session->userdata('id_usuario') || ($id_grupo == SUPER_ADMINISTRADOR) ): ?>
                        <li id="lkProveedores">
                            <a href="<?=base_url('admin/configuraciones/proveedores')?>">Proveedores</a>
                            <span class="icon-thumbnail">P</span>
                        </li>
                        <?php endif;?>
                    </ul>
                </li>
                <?php endif; ?>
                <?php if (!$this->session->userdata('id_usuario') || ($id_grupo != PROVEEDOR) ): ?>
                <li id="liFacturas">
                    <a href="<?=base_url('admin/facturas-proveedor')?>">
                        <span class="title">Facturas Proveedor</span>
                    </a>
                    <span class="icon-thumbnail "><i data-feather="file"></i></span>
                </li>
                <?php endif;?>
                <?php if (!$this->session->userdata('id_usuario') || ($id_grupo == PROVEEDOR) ): ?>
                <li id="liFacturas">
                    <a href="<?=base_url('admin/facturas')?>">
                        <span class="title">Facturas</span>
                    </a>
                    <span class="icon-thumbnail "><i data-feather="file"></i></span>
                </li>
                <?php endif;?>
            </ul>
        <div class="clearfix"></div>
      </div>
      <!-- END SIDEBAR MENU -->
    </nav>
    <!-- END SIDEBAR -->
    <!-- END SIDEBAR -->
    <!-- START PAGE-CONTAINER -->
    <div class="page-container">
      <!-- START PAGE HEADER WRAPPER -->
      <!-- START HEADER -->
      <div class="header ">
        <!-- START MOBILE SIDEBAR TOGGLE -->

        <a href="#" class="btn-link toggle-sidebar d-lg-none pg pg-menu" data-toggle="sidebar">
        </a>
        <!-- END MOBILE SIDEBAR TOGGLE -->
        <div class="">
          <div class="brand inline">
            <img src="<?=base_url('assets/img/edrav/logo_dashboard.png')?>" alt="logo" data-src="<?=base_url('assets/img/edrav/logo_dashboard.png')?>" data-src-retina="<?=base_url('assets/img/edrav/logo_dashboard.png')?>" width="37" height="22">
          </div>
        </div>
        <div class="d-flex align-items-center">
          <!-- START User Info-->
          <div class="pull-left p-r-10 fs-14 font-heading hidden-md-down m-l-20">
            <span class="semi-bold"><?=$this->session->userdata('nombre')?></span> <span class="text-master"><?=$this->session->userdata('paterno').' '.$this->session->userdata('materno')?></span>
          </div>
          <div class="dropdown pull-right hidden-md-down">
            <button class="profile-dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="thumbnail-wrapper d32 circular inline">
                <?php
                    $id_grupo = $this->session->userdata('id_grupo');
                    $avatar   = '';
                    if($id_grupo == '1'){
                        $avatar = base_url('assets/img/users/super_admin.png');
                    }else{
                        //if()
                    }
                ?>
              <img src="<?=$avatar?>" alt="" data-src="<?=$avatar?>" data-src-retina="<?=$avatar?>" width="48" height="48">
              </span>
            </button>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown" role="menu">
              <a href="<?=base_url('admin/mi-perfil')?>" class="dropdown-item"><i class="pg-outdent"></i> Mi Perfil</a>
              <a href="<?=base_url('admin/salir')?>" class="clearfix bg-master-lighter dropdown-item">
                <span class="pull-left">Salir</span>
                <span class="pull-right"><i class="pg-power"></i></span>
              </a>
            </div>
          </div>
          <!-- END User Info-->
        </div>
      </div>
      <!-- END HEADER -->
      <!-- END PAGE HEADER WRAPPER -->
      <!-- START PAGE CONTENT WRAPPER -->
      <div class="page-content-wrapper">
        <!-- START PAGE CONTENT -->
        <div class="content">
          <div class=" container-fluid container-fixed-lg sm-p-l-0 sm-p-r-0">
            <div class="inner">
              <!-- START BREADCRUMB -->
              <?php if (isset($breadcumb)) { ?>
                  <!-- begin breadcrumb -->
                  <ol class="breadcrumb">
                      <?php
                      for ($i = 0; $i < sizeof($breadcumb); $i++) {
                          if ($i == (sizeof($breadcumb) - 1)) {
                              echo '<li class="breadcrumb-item active">' . $breadcumb[$i]['label'];
                          } else {
                              echo '<li class="breadcrumb-item">';
                              echo '<a href="' . (isset($breadcumb[$i]['url']) ? $breadcumb[$i]['url'] : 'javascript:;') . '">';
                              echo $breadcumb[$i]['label'] . '</a>';
                          }

                          echo '</li>';
                      }
                      ?>
                  </ol>
                  <!-- end breadcrumb -->
              <?php } ?>
              <!-- END BREADCRUMB -->
            </div>
          </div>
          <!-- START CONTAINER FLUID -->
          <div class="container-fluid container-fixed-lg">