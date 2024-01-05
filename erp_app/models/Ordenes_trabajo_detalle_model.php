<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ordenes_trabajo_detalle_model extends MY_model {

    protected $table = 'orden_trabajo_detalles';
    protected $primary_key = 'id_detalle';

    public function __construct() {
        parent::__construct();
    }
}
?>
