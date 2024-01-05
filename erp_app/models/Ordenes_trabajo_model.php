<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ordenes_trabajo_model extends MY_model {

    protected $table = 'ordenes_trabajo';
    protected $primary_key = 'id_orden_trabajo';

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

        $this->db->select('ot.*, o.no_orden');
        $this->db->from($this->table. ' ot');
        $this->db->join('ordenes o', 'o.id_orden=ot.id_orden');

        $q = $this->db->get();
        return $q->result_array();
    }

    public function get_no_orden(){
       $this->db->select_max('no_orden_trabajo');
       $query = $this->db->get($this->table);
        $row = $query->row();
        $no_orden = 0;
        if(!is_null($row->no_orden_trabajo)){
            $no_orden = intval($row->no_orden_trabajo);
            $no_orden = $no_orden+1;
        }
        return $no_orden;
    }
}
?>
