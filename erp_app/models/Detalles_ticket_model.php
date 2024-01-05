<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Detalles_ticket_model extends MY_model {

    protected $table = 'detalles_ticket';
    protected $primary_key = 'id_detalle_ticket';

    public function __construct() {
        parent::__construct();
    }
}
?>