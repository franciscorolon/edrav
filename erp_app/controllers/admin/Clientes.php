<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Clientes extends ADMIN_Controller {

    //-----------------------------------------------------------------------------------------------------------

    public function index() {
        $this->hdata = [
            'title' => 'Clientes',
            'breadcumb' => [
                [
                    'url'   => base_url('admin'),
                    'label' => 'Inicio'
                ],
                [
                    'label' => 'Clientes'
                ]
            ],
            'css' => $this->load->view('admin/assets/css/clientes', '', true),
        ];

        $columns  = '"columns" : [';
        $columns .= '{ className : "v-align-middle text-center" },';
        $columns .= '{ className : "v-align-middle text-center" },';
        $columns .= '{ className : "v-align-middle text-left" },';
        $columns .= '{ className : "v-align-middle text-left" },';
        $columns .= '{ className : "v-align-middle text-left" },';
        $columns .= '{ className : "v-align-middle text-center"},';
        $columns .= '],';

        $this->js    = [
            'items'     => base_url('admin/clientes/get_datatable'),
            'columns'   => $columns,
        ];

        $js      = $this->load->view('admin/assets/js/datatable', $this->js, true);
        $js     .= $this->load->view('admin/assets/js/clientes', '', true);

        $this->fdata = [
            'js'            => $js,
            'link_active' => ['liClientes'],
        ];

        $this->data = [
            'url_agregar'   => base_url('admin/clientes/mostrar_form'),
            'header'        => 'Clientes',
        ];

        $this->load->view('admin/common/header_view', $this->hdata);
        $this->load->view('admin/clientes/index_view', $this->data);
        $this->load->view('admin/common/footer_view', $this->fdata);
    }

    public function mostrar_form($id = NULL){
        if (!is_null($id)) {
            $modelo = 'clientes_model';
            $this->load->model($modelo);
            $data['HEADER_MODAL']   = 'Editar Cliente';
            $data['URL_FORM']       = base_url('apis/admin_api/update_cliente');
            $data['item']           = $this->$modelo->get($id);
        } else {
            $data['HEADER_MODAL']   = 'Agregar Cliente';
            $data['URL_FORM']       = base_url('apis/admin_api/insert_cliente');
        }

        $this->load->view('admin/clientes/form_view', $data);
    }

    //-----------------------------------------------------------------------------------------------------------

    public function get_datatable(){
        $modelo = 'clientes_model';
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
            $nombre         = $r['nombre'].' '.$r['paterno'].' '.$r['materno'];

            $checkbox         =  '<div class="checkbox check-success text-center">';
            $checkbox        .= form_checkbox('active', 'active', $r['activo'], ['data-url' => base_url('apis/admin_api/update_activo/'.$modelo.'/'.$r['id_cliente']) , 'class'=> 'chk-update-activo']);
            $checkbox        .= form_label('', 'active', ['class' => 'no-padding no-margin']);
            $checkbox        .= '</div>';

            $operaciones     = '<a class="btn btn-info btn-xs m-b-10 show-modal" href="'.base_url('admin/clientes/mostrar_form/'.$r['id_cliente']).'"><i class="fa fa-pencil"></i> Editar</a> ';
            $operaciones    .= '<a class="btn btn-info btn-xs m-b-10 delete" data-text="cliente" href="'.base_url('apis/admin_api/delete_cliente/'.$r['id_cliente']).'"><i class="fa fa-trash"></i> Eliminar</a>';

            $data[] = [
                $checkbox,
                $r['no_cliente'],
                $nombre,
                $r['celular'],
                $r['email'],
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

    public function get_items(){
        $modelo = 'clientes_model';
        $this->load->model($modelo);
        $result = $this->$modelo->get([
            'eliminado' => '0'
        ]);

        $data   = [];

        foreach($result as $r){
            $data[$r['id_cliente']] = $r['nombre'] .' '. $r['paterno'] .' '. $r['materno'];
        }

        $output = [
            "data" => $data,
        ];

        $this->output->set_output(json_encode($output));
        return false;
    }

    //-----------------------------------------------------------------------------------------------------------

}
?>