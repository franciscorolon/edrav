<?php

class Public_api extends CI_Controller {

    function __construct() {
        parent::__construct();
        if( ! ini_get('date.timezone') )
        {
           date_default_timezone_set('America/Mexico_City');
        }
    }

    //------------------------------------------------------------------------------
    public function login_admin() {
        error_reporting(-1);
        $this->form_validation->set_rules('usuario', 'Usuario', 'trim|required');
        $this->form_validation->set_rules('password', 'Contraseña', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->output->set_output(json_encode(array(
                'result' => 0,
                'error' => $this->form_validation->error_array()
            )));
            return false;
        }

        $this->load->model(['usuarios_model', 'grupos_model']);
        $where = [
            'usuario'   => $this->input->post('usuario'),
            'password'  => sha1($this->input->post('password')),
            'eliminado' => 0
        ];
        $usuario = $this->usuarios_model->get($where);

        if (count($usuario) == 0) {
            $this->output->set_output(json_encode(array(
                'result'    => 0,
                'error'     => 'Usuario y/o contraseña incorrectos'
            )));
            return false;
        }

        if($usuario[0]['activo'] == '0'){
            $this->output->set_output(json_encode(array(
                'result'    => 0,
                'error'     => 'El usuario se encuentra <b>inactivo</b>, contacte al administrador'
            )));
            return false;
        }

        $session = array(
            'id_usuario'    => $usuario[0]['id_usuario'],
            'nombre'        => $usuario[0]['nombre'],
            'paterno'       => $usuario[0]['paterno'],
            'materno'       => $usuario[0]['materno'],
            'usuario'       => $usuario[0]['usuario'],
            'sexo'          => $usuario[0]['sexo'],
            'id_grupo'      => $usuario[0]['id_grupo'],
            'grupo'         => $this->grupos_model->get([
                'id_grupo'  => $usuario[0]['id_grupo'],
                'eliminado' => 0
            ]),
        );
        $this->session->set_userdata($session);

        $this->output->set_output(json_encode(array(
            'result' => 1,
        )));
    }

    //------------------------------------------------------------------------------------------------------------------------------------
    public function contacto(){
        if (!$this->input->is_ajax_request()) {
           exit('No direct script access allowed');
        }

        $this->form_validation->set_rules('name', 'Nombre', 'trim|required');
        $this->form_validation->set_rules('lastname', 'Apellidos', 'trim|required');
        $this->form_validation->set_rules('email', 'Correo', 'trim|required|valid_email');
        $this->form_validation->set_rules('phone', 'Teléfono', 'trim|required');
        $this->form_validation->set_rules('message', 'Mensaje', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->output->set_output(json_encode(array(
                'result' => 0,
                'error' => $this->form_validation->error_array()
            )));
            return false;
        }

        $nombre     = $this->input->post('name');
        $apellidos  = $this->input->post('lastname');
        $email      = $this->input->post('email');
        $telefono   = $this->input->post('phone');
        $mensaje    = $this->input->post('message');

        $Subject = 'Nuevo mensaje de contacto de ' . $nombre.' '.$apellidos;
        $Message = '<html><body><h2>Se ha recibido un nuevo mensaje de Contacto</h2>' .
                '<ul><li><b>Nombre:' .$nombre. ' '. $apellidos. '</b></li>' .
                '<li><b>Mail:' . $email . '</b></li>' .
                '<li><b>Teléfono:' . $telefono . '</b></li>' .
                '<li><b>Mensaje:' . $mensaje . '</b></li>'.
                '</ul></body></html>';

        $AltMessage = 'Se ha recibido un nuevo mensaje de contacto' . "\n" .
                'Nombre:' . $nombre. ' '. $apellidos. "\n" .
                'Mail:' . $email . "\n" .
                'Teléfono:' . $telefono . "\n" .
                'Mensaje:' . $mensaje . "\n";

        $this->load->library('email');
        //Envío a agente
        $this->email->clear();
        $config['mailtype'] = 'html';
        $this->email->initialize($config);


        $this->email->from('contacto@intimexico.com', 'Contacto');
        $this->email->to(['aleks.delara@gmail.com', 'contacto@intimexico.com', 'franciscorolon@gmail.com']);
        $this->email->subject($Subject);
        $this->email->message($Message);
        $this->email->set_alt_message($AltMessage);

        if ($this->email->send()) {

            $this->output->set_output(json_encode(array(
                'result' => 1,
                'message' => 'Hemos recibido tu solicitud de contacto, en breve nos pondremos en contacto contigo.'
            )));
            return false;
        }

        $this->output->set_output(json_encode(array(
                'result' => 0,
                'message' => 'No se pudo enviar tu solicitud de contacto.'
        )));
        return false;
    }

}
