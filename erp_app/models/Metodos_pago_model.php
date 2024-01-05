<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Metodos_pago_model extends MY_model {

    protected $table = 'metodos_pago';
    protected $primary_key = 'id_metodo';

    public function __construct() {
        parent::__construct();
    }

    public function get_dropdown() {
        $this->db->where('activo', 1);
        $this->db->where('eliminado',0);
        $this->db->order_by('id_metodo_pago', 'ASC');
        $q      = $this->db->get($this->table);
        $result = $q->result_array();
        $r      = [];
        if($result === FALSE){
            return false;
        }

        $r['-1'] = '- Seleccione una opción -';
        foreach($result as $i){
            $r[$i[$this->primary_key]] = $i['nombre'];
        }

        return $r;
    }
}
?>