<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Orden_expediente_model extends MY_model {

    protected $table = 'orden_expendiente';
    protected $primary_key = 'id_expediente';

    public function __construct() {
        parent::__construct();
    }
}
?>