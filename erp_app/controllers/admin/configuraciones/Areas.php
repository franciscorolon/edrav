<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Areas extends ADMIN_Controller {

    //-----------------------------------------------------------------------------------------------------------
    public function index() {
        $this->hdata = [
            'title' => 'Áreas',
            'breadcumb' => [
                [
                    'url'   => base_url('admin'),
                    'label' => 'Inicio'
                ],
                [
                    'label' => 'Configuraciones'
                ],
                [
                    'label' => 'Áreas'
                ]
            ],
        ];

        $columns  = '"columns" : [';
        $columns .= '{ className : "v-align-middle text-center" },';
        $columns .= '{ className : "v-align-middle" },';
        $columns .= '{ className : "v-align-middle" },';
        $columns .= '{ className : "v-align-middle text-center" },';
        $columns .= '],';

        $this->js    = [
            'items'     => base_url('admin/configuraciones/areas/get_datatable'),
            'columns'   => $columns,
        ];

        $js  = $this->load->view('admin/assets/js/datatable', $this->js, true);
        //$js .= $this->load->view('admin/assets/js/maserviciosrcas', '', true);

        $this->fdata = [
            'js'            => $js,
            'link_active' => ['liConfiguracion', 'lkAreas'],
        ];

        $this->data = [
            'url_agregar'   => base_url('admin/configuraciones/areas/mostrar_form'),
            'header'        => 'Áreas',
        ];

        $this->load->view('admin/common/header_view', $this->hdata);
        $this->load->view('admin/configuraciones/areas/index_view', $this->data);
        $this->load->view('admin/common/footer_view', $this->fdata);
    }

    //-----------------------------------------------------------------------------------------------------------
    public function mostrar_form($id = NULL){
        if (!is_null($id)) {
            $modelo = 'areas_model';
            $this->load->model($modelo);
            $data['HEADER_MODAL']   = 'Editar Área';
            $data['URL_FORM']       = base_url('apis/admin_api/update_area');
            $data['item']           = $this->$modelo->get($id);
        } else {
            $data['HEADER_MODAL']   = 'Agregar Área';
            $data['URL_FORM']       = base_url('apis/admin_api/insert_area');
        }

        $this->load->view('admin/configuraciones/areas/form_view', $data);
    }

    //-----------------------------------------------------------------------------------------------------------
    public function get_datatable(){
        $modelo = 'areas_model';
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
            $checkbox        = form_checkbox('active', 'active', $r['activo'], ['data-url' => base_url('apis/admin_api/update_activo/'.$modelo.'/'.$r['id_area']) , 'class'=> 'chk-update-activo']);
            $operaciones     = '<a class="btn btn-info btn-xs m-b-10 show-modal" href="'.base_url('admin/configuraciones/areas/mostrar_form/'.$r['id_area']).'"><i class="fa fa-pencil"></i> Editar</a> ';
            $operaciones    .= '<a class="btn btn-info btn-xs m-b-10 delete" data-text="área" href="'.base_url('apis/admin_api/delete_area/'.$r['id_area']).'"><i class="fa fa-trash"></i> Eliminar</a>';

            $data[] = [
                $checkbox,
                $r['nombre'],
                $r['descripcion'],
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
}
