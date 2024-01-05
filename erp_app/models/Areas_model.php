<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Areas_model extends MY_model {

    protected $table = 'areas';
    protected $primary_key = 'id_area';

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

        foreach($result as $i){
            $r[$i[$this->primary_key]] = $i['nombre'];
        }

        return $r;
    }
}
?>
