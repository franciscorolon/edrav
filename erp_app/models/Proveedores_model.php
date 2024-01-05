<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Proveedores_model extends MY_model {

    protected $table = 'proveedores';
    protected $primary_key = 'id_proveedor';

    public function __construct() {
        parent::__construct();
    }
}
?>