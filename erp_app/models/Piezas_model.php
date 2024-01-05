<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Piezas_model extends MY_model {

    protected $table = 'partes_coche';
    protected $primary_key = 'id_parte_coche';

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

        $this->db->select($this->table.'.*, categorias_partes.nombre as parte_automovil, categorias_partes.id_categoria_parte id_parte_automovil');
        $this->db->from($this->table);
        $this->db->join('categorias_partes', 'categorias_partes.id_categoria_parte='.$this->table.'.id_categoria_parte');
        $q = $this->db->get();
        return $q->result_array();
    }

    public function get_dropdown() {
        $this->db->where('activo', 1);
        $this->db->where('eliminado',0);
        $this->db->order_by('id_parte_coche', 'ASC');
        $q      = $this->db->get($this->table);
        $result = $q->result_array();
        $r      = [];
        if($result === FALSE){
            return false;
        }

        $r['-1'] = '- Seleccione una pieza -';
        foreach($result as $i){
            $r[$i[$this->primary_key]] = $i['nombre'];
        }

        return $r;
    }
}
?>