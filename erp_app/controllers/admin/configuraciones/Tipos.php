<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tipos extends ADMIN_Controller {

    //-----------------------------------------------------------------------------------------------------------
    public function index() {
        $this->hdata = [
            'title' => 'Tipos de Pintura',
            'breadcumb' => [
                [
                    'url'   => base_url('admin'),
                    'label' => 'Inicio'
                ],
                [
                    'label' => 'Configuraciones'
                ],
                [
                    'label' => 'Tipos de Pintura'
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
            'items'     => base_url('admin/configuraciones/tipos/get_datatable'),
            'columns'   => $columns,
        ];

        $js  = $this->load->view('admin/assets/js/datatable', $this->js, true);
        //$js .= $this->load->view('admin/assets/js/maserviciosrcas', '', true);

        $this->fdata = [
            'js'            => $js,
            'link_active' => ['liConfiguracion', 'lkTipoPintura'],
        ];

        $this->data = [
            'url_agregar'   => base_url('admin/configuraciones/tipos/mostrar_form'),
            'header'        => 'Tipos de Pintura',
        ];

        $this->load->view('admin/common/header_view', $this->hdata);
        $this->load->view('admin/configuraciones/tipos/index_view', $this->data);
        $this->load->view('admin/common/footer_view', $this->fdata);
    }

    //-----------------------------------------------------------------------------------------------------------
    public function mostrar_form($id = NULL){
        if (!is_null($id)) {
            $modelo = 'tipos_model';
            $this->load->model($modelo);
            $data['HEADER_MODAL']   = 'Editar Tipo de Pintura';
            $data['URL_FORM']       = base_url('apis/admin_api/update_tipo');
            $data['item']           = $this->$modelo->get($id);
        } else {
            $data['HEADER_MODAL']   = 'Agregar Tipo de Pintura';
            $data['URL_FORM']       = base_url('apis/admin_api/insert_tipo');
        }

        $this->load->view('admin/configuraciones/tipos/form_view', $data);
    }

    //-----------------------------------------------------------------------------------------------------------
    public function get_datatable(){
        $modelo = 'tipos_model';
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
            $checkbox        = form_checkbox('active', 'active', $r['activo'], ['data-url' => base_url('apis/admin_api/update_activo/'.$modelo.'/'.$r['id_tipo_pintura']) , 'class'=> 'chk-update-activo']);
            $operaciones     = '<a class="btn btn-info btn-xs m-b-10 show-modal" href="'.base_url('admin/configuraciones/tipos/mostrar_form/'.$r['id_tipo_pintura']).'"><i class="fa fa-pencil"></i> Editar</a> ';
            $operaciones    .= '<a class="btn btn-info btn-xs m-b-10 delete" data-text="tipo" href="'.base_url('apis/admin_api/delete_tipo/'.$r['id_tipo_pintura']).'"><i class="fa fa-trash"></i> Eliminar</a>';

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
