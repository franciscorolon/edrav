<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sucursales_model extends MY_model {

    protected $table = 'sucursales';
    protected $primary_key = 'id_sucursal';

    public function __construct() {
        parent::__construct();
    }
}
?>