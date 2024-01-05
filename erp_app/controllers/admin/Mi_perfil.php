<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mi_perfil extends ADMIN_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('usuarios_model');
    }

    //-----------------------------------------------------------------------------------------------------------

    public function index() {
        $headerData = array(
            'title' => 'Mi Perfil',
            'header' => 'Mi Perfil ',
            'breadcumb' => [
                [
                    'label' => 'Inicio',
                    'url' => base_url('admin/inicio')
                ],
                [
                    'label' => 'Mi Perfil'
                ]
            ],
        );

        $this->load->model('usuarios_model');
        $usuario = $this->usuarios_model->get([
            'eliminado'     => 0,
            'id_usuario'    => $this->usuario_actual
        ]);


        $data = array(
            'URL_ACTION' => base_url('apis/admin_api/update_usuario'),
            'URL_SUCCESS' => base_url('admin/inicio'),
            'URL_CANCELAR' => base_url('admin/inicio'),
        );

        $this->fdata = [
            'active' => 'liInicio',
        ];

        if (count($usuario) > 0) {
            $data['USUARIO'] = $usuario;
        } else {
            redirect('admin/salir');
        }

        $data['TIPOS_USUARIO'] = $this->TIPOS_DE_USUARIO;

        $this->load->view('admin/common/header_view', $headerData);
        $this->load->view('admin/perfil_usuario_view', $data);
        $this->load->view('admin/common/footer_view', $this->fdata);
    }

    //-----------------------------------------------------------------------------------------------------------
}

?>