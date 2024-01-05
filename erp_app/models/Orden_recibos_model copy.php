<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Orden_recibos_model extends MY_model {

    protected $table = 'orden_recibos';
    protected $primary_key = 'id_recibo';

    public function __construct() {
        parent::__construct();
    }

    public function get($id = NULL, $order_by = NULL, $like = null, $desactivarComillas = null, $limit = null) {
        if (is_numeric($id)) {
            $this->db->where($this->primary_key, $id);
        }
        if (is_array($id)) {
            foreach ($id as $_key => $_value) {
                $this->db->where($_key, $_value, $desactivarComillas);
            }
        }
        if(is_string($order_by)){
            $this->db->order_by($order_by);
        }
        if (is_array($order_by)) {
            foreach ($order_by as $_value) {
                $this->db->order_by($_value);
            }
        }

        if($like != null){
            if(is_array($like)){
                foreach ($like as $k => $v){
                    $this->db->like($k, $v);
                }
            }
        }

        if($limit != null){
            $this->db->limit($limit);
        }

        $this->db->select($this->table.'.*, CONCAT_WS(" ",usuarios.nombre, usuarios.paterno, usuarios.materno) AS generado_por, ordenes.*');
        $this->db->from($this->table);
        $this->db->join('usuarios', $this->table.'.creado_por=usuarios.id_usuario');
        $this->db->join('ordenes', $this->table.'.id_orden=ordenes.id_orden', 'left');
        $q = $this->db->get();
        return $q->result_array();
    }

    public function get_no_recibo(){
        $this->db->select_max('no_recibo');
        $query = $this->db->get($this->table);
        $row = $query->row();
        $no_sucesivo = intval($row->no_recibo);
        $no_sucesivo = $no_sucesivo+1;
        return $no_sucesivo;
    }
}
?>