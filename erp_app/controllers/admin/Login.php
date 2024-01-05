<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
    //-----------------------------------------------------------------------------------------------------------
    public function index() {
        $this->load->view('admin/login_view',[
            'URL_FORM' => base_url('apis/public_api/login_admin')
        ]);
    }
}
?>