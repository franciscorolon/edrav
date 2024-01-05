<?php

class API_CONTROLLER extends CI_Controller {

    //-----------------------------------------------------------------------------------------------------------------------------------------------------
    // GENÉRICAS
    //-----------------------------------------------------------------------------------------------------------------------------------------------------

    public function get($modelo, $id = NULL){
        $this->load->model($modelo);
        if ($id != NULL) {
            $result = $this->$modelo->get($id);
        } else {
            $result = $this->$modelo->get();
        }
        $this->output->set_output(json_encode($result));
        return false;
    }

    //-----------------------------------------------------------------------------------------------------------------------------------------------------

    public function get_sorted($modelo, $id = NULL) {
        $this->load->model($modelo);
        if ($id != NULL) {
            $result = $this->$modelo->get($id);
        } else {
            if ($this->input->post('q')) {
                $queries = json_decode($this->input->post('q'), true);
                foreach ($queries as $i => $v) {
                    $this->db->where($i, $v);
                }
            }
            $result = $this->$modelo->get(array('eliminado' => 0), 'orden');
        }
        $this->output->set_output(json_encode($result));
        return false;
    }

    // ---------------------------------------------------------------------------------------------------------------------------------------

    public function update_activo($modelo, $id) {
        $this->load->model($modelo);
        $this->$modelo->update(array(
            'activo' => (int) $this->input->post('activo')
                ), $id);
        $this->output->set_output(json_encode(array(
            'result' => 1
        )));
        return false;
    }

    // ---------------------------------------------------------------------------------------------------------------------------------------

    public function sort($modelo) {
        $this->load->model($modelo);
        foreach ($this->input->post('sort') as $index => $value) {
            $this->$modelo->update(array('orden' => $index), $value);
        }
        $this->output->set_output(json_encode(array(
            'result' => 1
        )));
        return false;
    }

    //-----------------------------------------------------------------------------------------------------------------------------------------------------

    public function delete($modelo, $id) {
        $this->load->model($modelo);
        $this->$modelo->update(array(
            'eliminado' => 1,
                ), $id);
        $this->output->set_output(json_encode(array(
            'result' => 1
        )));
    }

    //-----------------------------------------------------------------------------------------------------------------------------------------------------

    public function update_textfield($modelo, $id, $campo) {
        //$this->form_validation->set_rules('valor', $campo, 'trim|xss_clean');

        $this->load->model($modelo);
        $this->$modelo->update(array(
            $campo => $this->input->post('valor'),
                ), $id);
        $this->output->set_output(json_encode(array(
            'result' => 1,
            'valor' => $this->input->post('valor'),
            'id' => $id
        )));
    }

}

class ADMIN_Controller extends API_Controller {

    // ---------------------------------------------------------------------------------------------------------------------------------------
    public $TIPOS_DE_USUARIO;
    public $usuario_actual;

    function __construct() {
        parent::__construct();

        $this->load->model(['grupos_model']);

        if (!$this->session->userdata('id_usuario') ||
        ( $this->session->userdata('id_grupo') != SUPER_ADMINISTRADOR &&
        $this->session->userdata('id_grupo') != ADMINISTRADOR &&
        $this->session->userdata('id_grupo') != VALUACION &&
        $this->session->userdata('id_grupo') != CLIENTES_AVANZADO &&
        $this->session->userdata('id_grupo') != CLIENTES_BASICO &&
        $this->session->userdata('id_grupo') != PROCESOS &&
        $this->session->userdata('id_grupo') != REFACCIONES &&
        $this->session->userdata('id_grupo') != OPERADORES &&
        $this->session->userdata('id_grupo') != CVP2 &&
        $this->session->userdata('id_grupo') != PROVEEDOR )
        ){
            //echo $this->session->userdata('id_usuario');
            redirect(base_url('admin'),'refresh');
        }
        $this->usuario_actual = $this->session->userdata('id_usuario');

        $usuarios                = $this->grupos_model->get();
         $this->TIPOS_DE_USUARIO = [];
        foreach($usuarios as $u){
            $this->TIPOS_DE_USUARIO[] = ['id' => $u['id_grupo'], 'label' => $u['descripcion'] ];
        }
    }

    // ---------------------------------------------------------------------------------------------------------------------------------------
}

