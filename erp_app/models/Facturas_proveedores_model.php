<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Facturas_proveedores_model extends MY_model {

    protected $table = 'facturas_proveedores';
    protected $primary_key = 'id_factura_proveedor';

    public function __construct() {
        parent::__construct();
    }

    public function getFacturasByProveedor($idProveedor){
	    $this->db->from($this->table);
        $this->db->where($this->primary_key, $idProveedor);
	    $this->db->get();
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

        $this->db->select($this->table.'.*, metodos_pago.nombre as metodo_pago, facturas_proveedor_estados.status, facturas_proveedor_estados.fecha_estado, facturas_proveedor_estados.usuario_cambio_estado');
        $this->db->from($this->table);
        $this->db->join('metodos_pago', 'metodos_pago.activo="1" AND '.$this->table.'.id_metodo_pago=metodos_pago.id_metodo_pago');
        $this->db->join('facturas_proveedor_estados', 'facturas_proveedor_estados.activo="1" AND '.$this->table.'.id_factura_proveedor=facturas_proveedor_estados.id_factura_proveedor');
        $result = $this->db->get();
        return $result->result_array();
    }

    public function get_no_factura(){
		$this->db->select_max('no_factura');
		$query 		= $this->db->get($this->table);
		$row 		= $query->row();
		$noFactura = 1;
        if(!is_null($row->no_factura)){
            $noFactura = intval($row->no_factura);
            $noFactura = $noFactura+1;
        }
        return $noFactura;
    }
}
?>