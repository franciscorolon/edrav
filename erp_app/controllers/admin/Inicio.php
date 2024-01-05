<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Inicio extends ADMIN_Controller {

    //-----------------------------------------------------------------------------------------------------------

    public function index() {
        $this->load->view('admin/common/header_view');
        $this->load->view('admin/inicio_view');
        $this->load->view('admin/common/footer_view');
    }

    //-----------------------------------------------------------------------------------------------------------

    public function logout(){
        $this->session->sess_destroy();
        redirect(base_url('admin'));
    }

    //-----------------------------------------------------------------------------------------------------------

}
?>