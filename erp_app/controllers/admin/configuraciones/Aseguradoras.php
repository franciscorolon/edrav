<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Aseguradoras extends ADMIN_Controller {

    //-----------------------------------------------------------------------------------------------------------

    public function index() {
        $this->hdata = [
            'title' => 'Aseguradoras',
            'breadcumb' => [
                [
                    'url'   => base_url('admin'),
                    'label' => 'Inicio'
                ],
                [
                    'label' => 'Configuraciones'
                ],
                [
                    'label' => 'Aseguradoras'
                ]
            ],
        ];

        $columns  = '"columns" : [';
        $columns .= '{ className : "v-align-middle text-center"},';
        $columns .= '{ className : "v-align-middle" },';
        $columns .= '{ className : "v-align-middle" },';
        $columns .= '{ className : "v-align-middle" },';
        $columns .= '{ className : "v-align-middle" },';
        $columns .= '{ className : "v-align-middle" },';
        $columns .= '{ className : "v-align-middle" },';
        $columns .= '{ className : "v-align-middle text-center"},';
        $columns .= '],';

        $this->js    = [
            'items'     => base_url('admin/configuraciones/aseguradoras/get_datatable'),
            'columns'   => $columns,
        ];

        $js  = $this->load->view('admin/assets/js/datatable', $this->js, true);
        $js .= $this->load->view('admin/assets/js/aseguradoras', '', true);

        $this->fdata = [
            'js'            => $js,
            'link_active' => ['liConfiguracion', 'lkAseguradoras'],
        ];

        $this->data = [
            'url_agregar'   => base_url('admin/configuraciones/aseguradoras/mostrar_form'),
            'header'        => 'Aseguradoras',
        ];

        $this->load->view('admin/common/header_view', $this->hdata);
        $this->load->view('admin/configuraciones/aseguradoras/index_view', $this->data);
        $this->load->view('admin/common/footer_view', $this->fdata);
    }

    //-----------------------------------------------------------------------------------------------------------

    public function mostrar_form($id = NULL){
        if (!is_null($id)) {
            $modelo = 'aseguradoras_model';
            $this->load->model($modelo);
            $data['HEADER_MODAL']   = 'Editar Aseguradora';
            $data['URL_FORM']       = base_url('apis/admin_api/update_aseguradora');
            $data['item']           = $this->$modelo->get($id);
        } else {
            $data['HEADER_MODAL']   = 'Agregar Aseguradora';
            $data['URL_FORM']       = base_url('apis/admin_api/insert_aseguradora');
        }

        $this->load->view('admin/configuraciones/aseguradoras/form_view', $data);
    }

    //-----------------------------------------------------------------------------------------------------------

    public function get_datatable(){
        $modelo = 'aseguradoras_model';
        $this->load->model($modelo);

        // Datatables Variables
        $draw   = intval($this->input->get("draw"));
        $start  = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $result = $this->$modelo->get([
            'eliminado' => '0'
        ]);
        $data   = [];
        $cp     = '';

        foreach($result as $r) {
            $tmp_l           = (is_null($r['logo']) || empty($r['logo']))?'':explode('.', $r['logo']);
            $checkbox         = form_checkbox('active', 'active', $r['activo'], ['data-url' => base_url('apis/admin_api/update_activo/'.$modelo.'/'.$r['id_aseguradora']) , 'class'=> 'chk-update-activo']);
            $logo            = (is_null($r['logo']) || empty($r['logo']))?'<img id="img_image" class="img-responsive img-thumbnail" src="http://placehold.it/160x90" />':'<img src="'.base_url(ASEGURADORAS_FOLDER.$tmp_l[0].'.'.$tmp_l[1]).'" class="img-fluid" />';
            $operaciones     = '<a class="btn btn-info btn-xs m-b-10" href="'.base_url('admin/configuraciones/aseguradoras/'.$r['id_aseguradora'].'/ajustadores').'"><i class="fa fa-user"></i></a>';
            $operaciones    .= '<a class="btn btn-info btn-xs m-b-10 show-modal" href="'.base_url('admin/configuraciones/aseguradoras/mostrar_form/'.$r['id_aseguradora']).'"><i class="fa fa-pencil"></i></a> ';
            $operaciones    .= '<a class="btn btn-info btn-xs m-b-10 delete" data-text="aseguradora" href="'.base_url('apis/admin_api/delete_aseguradora/'.$r['id_aseguradora']).'"><i class="fa fa-trash"></i></a>';

            $data[] = [
                $checkbox,
                $logo,
                $r['razon_social'],
                $r['nombre'],
                $r['rfc'],
                character_limiter($r['descripcion'],30),
                $r['telefono'],
                $operaciones,
            ];
        }

        $output = [
            "draw"              => $draw,
            "recordsTotal"      => count($result),
            "recordsFiltered"   => count($result),
            "data"              => $data,
        ];

        $this->output->set_output(json_encode($output));
        return false;
    }

    //-----------------------------------------------------------------------------------------------------------

    public function get_items(){
        $modelo = 'aseguradoras_model';
        $this->load->model($modelo);
        $result = $this->$modelo->get([
            'eliminado' => '0'
        ]);

        $data   = [];

        foreach($result as $r){
            $data[$r['id_aseguradora']] = $r['nombre'];
        }

        $output = [
            "data" => $data,
        ];

        $this->output->set_output(json_encode($output));
        return false;
    }
}
?>