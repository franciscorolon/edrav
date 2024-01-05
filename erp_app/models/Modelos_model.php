<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Modelos_model extends MY_model {

    protected $table = 'modelos';
    protected $primary_key = 'id_modelo';

    public function __construct() {
        parent::__construct();
    }
}
?>