<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Colores_model extends MY_model {

    protected $table = 'colores';
    protected $primary_key = 'id_color';

    public function __construct() {
        parent::__construct();
    }
}
?>