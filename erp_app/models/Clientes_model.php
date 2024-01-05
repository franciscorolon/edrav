<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Clientes_model extends MY_model {

    protected $table = 'clientes';
    protected $primary_key = 'id_cliente';

    public function __construct() {
        parent::__construct();
    }

    public function get_no_cliente(){
        $this->db->select_max('no_cliente');
        $query = $this->db->get($this->table);
        $row = $query->row();
        $no_cliente = intval($row->no_cliente);
        $no_cliente = $no_cliente+1;
        return $no_cliente;
    }
}
?>