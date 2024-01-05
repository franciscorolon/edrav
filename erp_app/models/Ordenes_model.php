<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ordenes_model extends MY_model {

    protected $table = 'ordenes';
    protected $primary_key = 'id_orden';

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

        $this->db->select($this->table.'.*, CONCAT_WS(" ", clientes.nombre, clientes.paterno, clientes.materno) AS cliente, clientes.id_cliente, clientes.celular, aseguradoras.nombre as aseguradora');
        $this->db->from($this->table);
        $this->db->join('clientes', $this->table.'.id_cliente=clientes.id_cliente');
        $this->db->join('aseguradoras', $this->table.'.id_aseguradora=aseguradoras.id_aseguradora');
        $q = $this->db->get();
        return $q->result_array();
    }

    public function get_no_orden(){
       $this->db->select_max('no_orden');
       $query = $this->db->get($this->table);
        $row = $query->row();
        $no_orden = 18691;
        if(!is_null($row->no_orden)){
            $no_orden = intval($row->no_orden);
            $no_orden = $no_orden+1;
        }
        return $no_orden;
    }

    /*
    / Búsqueda
    */
    public function busqueda($busqueda = null, $campo = null, $status = null){
        if(is_null($busqueda) && is_null($campo) && is_null($status) ){
            return $this->get(['ordenes.eliminado' => '0'], ['no_orden DESC', 'fecha_creacion DESC'], null, null);
        }

        $this->db->where('ordenes.eliminado', '0');

        if(!is_null($status)){
            $this->db->where('status', $status);
        }

        if(!is_null($busqueda) && $campo == 'todos'){
            $this->db->or_like('no_orden', $busqueda);
            $this->db->or_like('no_placas', $busqueda);
            $this->db->or_like('clientes.no_cliente', $busqueda);
            $this->db->or_like('clientes.nombre', $busqueda);
            $this->db->or_like('clientes.paterno', $busqueda);
            $this->db->or_like('clientes.materno', $busqueda);
            $this->db->or_like('no_siniestro', $busqueda);
            $this->db->or_like('no_serie', $busqueda);
            $this->db->select($this->table.'.*, CONCAT_WS(" ", clientes.nombre,clientes.paterno, clientes.materno) AS cliente, clientes.id_cliente, clientes.celular');
            $this->db->from($this->table);
            $this->db->join('clientes', $this->table.'.id_cliente=clientes.id_cliente');
            $query = $this->db->get();
            return $query->result_array();
        }

        if(!is_null($campo) && $campo ==  'no_orden'){
            $this->db->or_where('no_orden', $busqueda);
        }

        if(!is_null($campo) && $campo == 'no_placas'){
            $this->db->or_where('no_placas', $busqueda);
        }

        if(!is_null($campo) && $campo == 'no_cliente'){
            $this->db->or_where('clientes.no_cliente', $busqueda);
        }

        if(!is_null($campo) && $campo == 'cliente'){
            $this->db->or_like('clientes.nombre', $busqueda);
            $this->db->or_like('clientes.paterno', $busqueda);
            $this->db->or_like('clientes.materno', $busqueda);
        }

        if(!is_null($campo) && $campo == 'no_siniestro'){
            $this->db->or_where('no_siniestro', $busqueda);
        }

        if(!is_null($campo) && $campo == 'no_serie'){
            $this->db->or_where('no_serie', $busqueda);
        }

        $this->db->select($this->table.'.*, CONCAT_WS(" ", clientes.nombre, clientes.paterno, clientes.materno) AS cliente, clientes.id_cliente, clientes.celular');
        $this->db->from($this->table);
        $this->db->join('clientes', $this->table.'.id_cliente=clientes.id_cliente');
        $this->db->order_by('no_orden DESC, fecha_creacion DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
}
?>