<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Aseguradoras_model extends MY_model {

    protected $table = 'aseguradoras';
    protected $primary_key = 'id_aseguradora';

    public function __construct() {
        parent::__construct();
    }
}
?>