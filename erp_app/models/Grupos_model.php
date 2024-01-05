<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Grupos_model extends MY_model {

    protected $table = 'grupos';
    protected $primary_key = 'id_grupo';

    public function __construct() {
        parent::__construct();
    }
}
?>