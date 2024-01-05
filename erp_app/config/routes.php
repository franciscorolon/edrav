<?php defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller']    = 'inicio';
$route['404_override']          = '';
$route['admin']                 = 'admin/login';
$route['admin/mi-perfil']       = 'admin/mi_perfil';
$route['translate_uri_dashes']  = FALSE;
$route['admin/ordenes/(:num)']  = 'admin/ordenes/mostrar/$1';

$route['admin/configuraciones/aseguradoras/(:num)/ajustadores']                     = 'admin/configuraciones/ajustadores/index/$1';
$route['admin/configuraciones/aseguradoras/(:num)/ajustadores/mostrar_form']        = 'admin/configuraciones/ajustadores/mostrar_form/$1';
$route['admin/configuraciones/aseguradoras/(:num)/ajustadores/mostrar_form/(:any)'] = 'admin/configuraciones/ajustadores/mostrar_form/$1/$2';


$route['apis/admin_api/upload_images/(:num)/(:any)'] = 'apis/admin_api/upload_images/$1/$2';

$route['admin/ordenes-trabajo']                    = "admin/ordenes_trabajo";
$route['admin/ordenes-trabajo/(:any)']             = "admin/ordenes_trabajo/$1";
$route['admin/ordenes-trabajo/(:any)/(:any)']      = "admin/ordenes_trabajo/$1/$2";

$route['admin/configuraciones/piezas-automovil']   = "admin/configuraciones/piezas";
$route['admin/configuraciones/partes-automovil']   = "admin/configuraciones/categorias";

$route['admin/reportes/vales-refacciones'] = 'admin/reportes/vales_refacciones';

/* 12/06/2022 */
$route['admin/facturas-proveedor']                    = "admin/facturas_proveedor";
$route['admin/facturas-proveedor/(:any)']             = "admin/facturas_proveedor/$1";
$route['admin/facturas-proveedor/(:any)/(:any)']      = "admin/facturas_proveedor/$1/$2";