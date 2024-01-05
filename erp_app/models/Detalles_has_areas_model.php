<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Detalles_has_areas_model extends MY_model {

    protected $table = 'detalles_has_areas';
    protected $primary_key = 'id_detalle_has_areas';

    public function __construct() {
        parent::__construct();
    }

    public function get_by_area($areas, $id_orden_trabajo){
        $by_area = [];
        foreach($areas as $a){
            $this->db->from('detalles_has_areas as dha');
            $this->db->join('orden_trabajo_detalles as otd', 'dha.id_detalle=otd.id_detalle');
            $this->db->where('otd.id_orden_trabajo', $id_orden_trabajo);
            $this->db->where('dha.id_area', $a['id_area']);
            $this->db->where('dha.valor', '1');

            $query = $this->db->get();
            $by_area[$a['id_area']] = $query->result_array();
        }

        return $by_area;
    }
}
?>
