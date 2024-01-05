<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Marcas_model extends MY_model {

    protected $table = 'marcas';
    protected $primary_key = 'id_marca';

    public function __construct() {
        parent::__construct();
    }
}
?>