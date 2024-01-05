<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Colores extends ADMIN_Controller {

    //-----------------------------------------------------------------------------------------------------------
    public function index() {
        $this->hdata = [
            'title' => 'Colores',
            'breadcumb' => [
                [
                    'url'   => base_url('admin'),
                    'label' => 'Inicio'
                ],
                [
                    'label' => 'Configuraciones'
                ],
                [
                    'label' => 'Colores'
                ]
            ],
            'css' => $this->load->view('admin/assets/css/colores', '', true),
        ];

        $columns  = '"columns" : [';
        $columns .= '{ className : "v-align-middle text-center" },';
        $columns .= '{ className : "v-align-middle text-center" },';
        $columns .= '{ className : "v-align-middle" },';
        $columns .= '{ className : "v-align-middle text-center"},';
        $columns .= '],';

        $this->js    = [
            'items'     => base_url('admin/configuraciones/colores/get_datatable'),
            'columns'   => $columns,
        ];

        $js  = $this->load->view('admin/assets/js/datatable', $this->js, true);
        $js .= $this->load->view('admin/assets/js/colores', '', true);

        $this->fdata = [
            'js'            => $js,
            'link_active' => ['liConfiguracion', 'lkColores'],
        ];

        $this->data = [
            'url_agregar'   => base_url('admin/configuraciones/colores/mostrar_form'),
            'header'        => 'Colores',
        ];

        $this->load->view('admin/common/header_view', $this->hdata);
        $this->load->view('admin/configuraciones/colores/index_view', $this->data);
        $this->load->view('admin/common/footer_view', $this->fdata);
    }

    public function mostrar_form($id = NULL){
        if (!is_null($id)) {
            $modelo = 'colores_model';
            $this->load->model($modelo);
            $data['HEADER_MODAL']   = 'Editar Color';
            $data['URL_FORM']       = base_url('apis/admin_api/update_color');
            $data['item']           = $this->$modelo->get($id);
        } else {
            $data['HEADER_MODAL']   = 'Agregar Color';
            $data['URL_FORM']       = base_url('apis/admin_api/insert_color');
        }

        $this->load->view('admin/configuraciones/colores/form_view', $data);
    }

    //-----------------------------------------------------------------------------------------------------------

    public function get_datatable(){
        $modelo = 'colores_model';
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
            $checkbox        = form_checkbox('active', 'active', $r['activo'], ['data-url' => base_url('apis/admin_api/update_activo/'.$modelo.'/'.$r['id_color']) , 'class'=> 'chk-update-activo']);

            $operaciones     = '<a class="btn btn-info btn-xs m-b-10 show-modal" href="'.base_url('admin/configuraciones/colores/mostrar_form/'.$r['id_color']).'"><i class="fa fa-pencil"></i> Editar</a> ';
            $operaciones    .= '<a class="btn btn-info btn-xs m-b-10 delete" data-text="color" href="'.base_url('apis/admin_api/delete_color/'.$r['id_color']).'"><i class="fa fa-trash"></i> Eliminar</a>';

            $data[] = [
                //'id_plant'  => $r->id_plant,
                $checkbox,
                '<div class="b-a b-grey" style="background-color:#'.$r['color'].'"><div class="bg-white m-t-45 text-master"></div></div>',
                $r['nombre'],
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