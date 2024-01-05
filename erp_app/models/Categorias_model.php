<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Categorias_model extends MY_model {

    protected $table = 'categorias_partes';
    protected $primary_key = 'id_categoria_parte';

    public function __construct() {
        parent::__construct();
    }

    public function get_dropdown() {
        $this->db->where('activo', 1);
        $this->db->where('eliminado',0);
        $this->db->order_by('nombre');
        $q      = $this->db->get($this->table);
        $result = $q->result_array();
        $r      = [];
        if($result === FALSE){
            return false;
        }

        $r['-1'] = '- Seleccione una parte -';
        foreach($result as $i){
            $r[$i['id_categoria_parte']] = $i['nombre'];
        }

        return $r;
    }
}
?>