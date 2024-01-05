<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Materiales extends ADMIN_Controller {

    //-----------------------------------------------------------------------------------------------------------
    public function index() {
        $this->hdata = [
            'title' => 'Materiales Especiales',
            'breadcumb' => [
                [
                    'url'   => base_url('admin'),
                    'label' => 'Inicio'
                ],
                [
                    'label' => 'Configuraciones'
                ],
                [
                    'label' => 'Materiales Especiales'
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
            'items'     => base_url('admin/configuraciones/materiales/get_datatable'),
            'columns'   => $columns,
        ];

        $js  = $this->load->view('admin/assets/js/datatable', $this->js, true);
        //$js .= $this->load->view('admin/assets/js/maserviciosrcas', '', true);

        $this->fdata = [
            'js'            => $js,
            'link_active' => ['liConfiguracion', 'lkMateriales'],
        ];

        $this->data = [
            'url_agregar'   => base_url('admin/configuraciones/materiales/mostrar_form'),
            'header'        => 'Materiales Especiales',
        ];

        $this->load->view('admin/common/header_view', $this->hdata);
        $this->load->view('admin/configuraciones/materiales/index_view', $this->data);
        $this->load->view('admin/common/footer_view', $this->fdata);
    }

    //-----------------------------------------------------------------------------------------------------------
    public function mostrar_form($id = NULL){
        if (!is_null($id)) {
            $modelo = 'materiales_model';
            $this->load->model($modelo);
            $data['HEADER_MODAL']   = 'Editar Material Especial';
            $data['URL_FORM']       = base_url('apis/admin_api/update_material');
            $data['item']           = $this->$modelo->get($id);
        } else {
            $data['HEADER_MODAL']   = 'Agregar Material Especial';
            $data['URL_FORM']       = base_url('apis/admin_api/insert_material');
        }

        $this->load->view('admin/configuraciones/materiales/form_view', $data);
    }

    //-----------------------------------------------------------------------------------------------------------
    public function get_datatable(){
        $modelo = 'materiales_model';
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
            $checkbox        = form_checkbox('active', 'active', $r['activo'], ['data-url' => base_url('apis/admin_api/update_activo/'.$modelo.'/'.$r['id_material_especial']) , 'class'=> 'chk-update-activo']);
            $operaciones     = '<a class="btn btn-info btn-xs m-b-10 show-modal" href="'.base_url('admin/configuraciones/materiales/mostrar_form/'.$r['id_material_especial']).'"><i class="fa fa-pencil"></i> Editar</a> ';
            $operaciones    .= '<a class="btn btn-info btn-xs m-b-10 delete" data-text="material especial" href="'.base_url('apis/admin_api/delete_material/'.$r['id_material_especial']).'"><i class="fa fa-trash"></i> Eliminar</a>';

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
