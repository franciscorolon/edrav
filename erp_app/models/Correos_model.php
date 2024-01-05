<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Correos_model extends MY_model {

    protected $table = 'correos';
    protected $primary_key = 'id_correo';

    public function __construct() {
        parent::__construct();
    }
}
?>