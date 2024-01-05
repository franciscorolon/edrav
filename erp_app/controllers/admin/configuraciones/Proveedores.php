<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Proveedores extends ADMIN_Controller {

    //-----------------------------------------------------------------------------------------------------------

    public function index() {
        $this->hdata = [
            'title' => 'Proveedores',
            'breadcumb' => [
                [
                    'url'   => base_url('admin'),
                    'label' => 'Inicio'
                ],
                [
                    'label' => 'Configuraciones'
                ],
                [
                    'label' => 'Proveedores'
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
            'items'     => base_url('admin/configuraciones/proveedores/get_datatable'),
            'columns'   => $columns,
        ];

        $this->fdata = [
            'js'            => $this->load->view('admin/assets/js/datatable', $this->js, true),
            'link_active' => ['liConfiguracion', 'lkProveedores'],
        ];

        $this->data = [
            'text_agregar'  => '<i class="fa fa-plus"></i> Agregar Proveedor',
            'url_agregar'   => base_url('admin/configuraciones/proveedores/mostrar_form'),
            'header'        => 'Proveedores',
        ];

        $this->load->view('admin/common/header_view', $this->hdata);
        $this->load->view('admin/configuraciones/proveedores/index_view', $this->data);
        $this->load->view('admin/common/footer_view', $this->fdata);
    }

    public function mostrar_form($id = NULL){
        if (!is_null($id)) {
            $modelo = 'proveedores_model';
            $this->load->model($modelo);
            $data['HEADER_MODAL']   = 'Editar Proveedor';
            $data['URL_FORM']       = base_url('apis/admin_api/update_proveedor');
            $data['item']           = $this->$modelo->get($id);
        } else {
            $data['HEADER_MODAL']   = 'Agregar Proveedor';
            $data['URL_FORM']       = base_url('apis/admin_api/insert_proveedor');
        }

        $this->load->view('admin/configuraciones/proveedores/form_view', $data);
    }

    //-----------------------------------------------------------------------------------------------------------

    public function get_datatable(){
        $modelo = 'proveedores_model';
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
            $checkbox        = form_checkbox('active', 'active', $r['activo'], ['data-url' => base_url('apis/admin_api/update_activo/'.$modelo.'/'.$r['id_proveedor']) , 'class'=> 'chk-update-activo']);

            $operaciones     = '<a class="btn btn-info btn-xs m-b-10 show-modal" href="'.base_url('admin/configuraciones/proveedores/mostrar_form/'.$r['id_proveedor']).'"><i class="fa fa-pencil"></i> Editar</a> ';
            $operaciones    .= '<a class="btn btn-info btn-xs m-b-10 delete" data-text="proveedor" href="'.base_url('apis/admin_api/delete_proveedor/'.$r['id_proveedor']).'"><i class="fa fa-trash"></i> Eliminar</a>';

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