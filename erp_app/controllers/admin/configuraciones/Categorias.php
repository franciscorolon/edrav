<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Categorias extends ADMIN_Controller {

    //-----------------------------------------------------------------------------------------------------------

    public function index() {
        $this->hdata = [
            'title' => 'Partes del Automóvil',
            'breadcumb' => [
                [
                    'url'   => base_url('admin'),
                    'label' => 'Inicio'
                ],
                [
                    'label' => 'Configuraciones'
                ],
                [
                    'label' => 'Partes del Automóvil'
                ]
            ],
        ];

        $columns  = '"columns" : [';
        $columns .= '{ className : "v-align-middle" },';
        $columns .= '{ className : "v-align-middle" },';
        $columns .= '{ className : "v-align-middle" },';
        $columns .= '{ className : "v-align-middle text-center"},';
        $columns .= '],';

        $this->js    = [
            'items'     => base_url('admin/configuraciones/categorias/get_datatable'),
            'columns'   => $columns,
        ];

        $this->fdata = [
            'js'            => $this->load->view('admin/assets/js/datatable', $this->js, true),
            'link_active' => ['liConfiguracion', 'lkPartes', 'llCategorias'],
        ];

        $this->data = [
            'text_agregar'  => '<i class="fa fa-plus"></i> Agregar Parte',
            'url_agregar'   => base_url('admin/configuraciones/categorias/mostrar_form'),
            'header'        => 'Partes del Automóvil',
        ];

        $this->load->view('admin/common/header_view', $this->hdata);
        $this->load->view('admin/configuraciones/categorias/index_view', $this->data);
        $this->load->view('admin/common/footer_view', $this->fdata);
    }

    public function mostrar_form($id = NULL){
        if (!is_null($id)) {
            $modelo = 'categorias_model';
            $this->load->model($modelo);
            $data['HEADER_MODAL']   = 'Editar Parte del Automóvil';
            $data['URL_FORM']       = base_url('apis/admin_api/update_categoria');
            $data['item']           = $this->$modelo->get($id);
        } else {
            $data['HEADER_MODAL']   = 'Agregar Parte del Automóvil';
            $data['URL_FORM']       = base_url('apis/admin_api/insert_categoria');
        }

        $this->load->view('admin/configuraciones/categorias/form_view', $data);
    }

    //-----------------------------------------------------------------------------------------------------------

    public function get_datatable(){
        $modelo = 'categorias_model';
        $this->load->model($modelo);

        // Datatables Variables
        $draw   = intval($this->input->get("draw"));
        $start  = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $result = $this->$modelo->get([
            'eliminado' => '0'
        ], 'nombre');
        $data   = [];
        $cp     = '';

        foreach($result as $r) {
            $checkbox        = form_checkbox('active', 'active', $r['activo'], ['data-url' => base_url('apis/admin_api/update_activo/'.$modelo.'/'.$r['id_categoria_parte']) , 'class'=> 'chk-update-activo']);

            $operaciones     = '<a class="btn btn-info btn-xs m-b-10 show-modal" href="'.base_url('admin/configuraciones/categorias/mostrar_form/'.$r['id_categoria_parte']).'"><i class="fa fa-pencil"></i> Editar</a> ';
            $operaciones    .= '<a class="btn btn-info btn-xs m-b-10 delete" data-text="categoría" href="'.base_url('apis/admin_api/delete_categoria/'.$r['id_categoria_parte']).'"><i class="fa fa-trash"></i> Eliminar</a>';

            $data[] = [
                //'id_plant'  => $r->id_plant,
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

    //-----------------------------------------------------------------------------------------------------------

}
?>