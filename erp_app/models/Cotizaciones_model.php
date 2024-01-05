<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cotizaciones_model extends MY_model {

    protected $table = 'cotizaciones';
    protected $primary_key = 'id_cotizacion';

    public function __construct() {
        parent::__construct();
    }

    public function get_no_cotizacion(){
        $this->db->select_max('no_cotizacion');
        $query = $this->db->get($this->table);
        $row = $query->row();
        $no_sucesivo = intval($row->no_cotizacion);
        $no_sucesivo = $no_sucesivo+1;
        return $no_sucesivo;
    }
}
?>