<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ajustadores_model extends MY_model {

    protected $table = 'ajustadores';
    protected $primary_key = 'id_ajustador';

    public function __construct() {
        parent::__construct();
    }
}
?>