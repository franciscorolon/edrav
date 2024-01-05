<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios_model extends MY_model {

    protected $table = 'usuarios';
    protected $primary_key = 'id_usuario';

    public function __construct() {
        parent::__construct();
    }

    public function get_by_group($id_grupo){
        $this->db->from('usuarios');
        $this->db->where('id_grupo', $id_grupo);
        $query = $this->db->get();
        if($query->result_array() == FALSE){
            return false;
        }

        $dropdown = [];
        $dropdown['-1'] = '-- Seleccione una opción --';
        foreach($query->result_array() as $i){
            $dropdown[$i['id_usuario']] = $i['nombre'].' '.$i['paterno'].' '.$i['materno'];
        }
        return $dropdown;
    }
}
?>