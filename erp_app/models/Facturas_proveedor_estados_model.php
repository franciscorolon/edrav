<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Facturas_proveedor_estados_model extends MY_model {

    protected $table 		= 'facturas_proveedor_estados';
    protected $primary_key 	= 'id_facturas_proveedor_estado';

    public function __construct() {
        parent::__construct();
    }
}
?>