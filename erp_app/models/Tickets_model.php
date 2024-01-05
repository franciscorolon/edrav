<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tickets_model extends MY_model {

    protected $table = 'tickets';
    protected $primary_key = 'id_ticket';

    public function __construct() {
        parent::__construct();
    }

    public function get_no_ticket(){
        $this->db->select_max('no_ticket');
        $query = $this->db->get($this->table);
        $row = $query->row();
        $no_ticket = intval($row->no_ticket);
        $no_ticket = $no_ticket+1;
        return $no_ticket;
    }
}
?>