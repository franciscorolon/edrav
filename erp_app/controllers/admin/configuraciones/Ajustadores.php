<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ajustadores extends ADMIN_Controller {

    //-----------------------------------------------------------------------------------------------------------

    public function index($id_aseguradora) {
        $this->load->model('aseguradoras_model');
        $this->hdata = [
            'title' => 'Ajustadores',
            'breadcumb' => [
                [
                    'url'   => base_url('admin'),
                    'label' => 'Inicio'
                ],
                [
                    'label' => 'Configuraciones'
                ],
                [
                    'url'   => base_url('admin/configuraciones/aseguradoras'),
                    'label' => 'Aseguradoras',
                ],
                [
                    'label' => 'Ajustadores'
                ]
            ],
        ];

        $columns  = '"columns" : [';
        $columns .= '{ className : "v-align-middle text-center" },';
        $columns .= '{ className : "v-align-middle text-left" },';
        $columns .= '{ className : "v-align-middle text-left" },';
        $columns .= '{ className : "v-align-middle text-left" },';
        $columns .= '{ className : "v-align-middle text-center"},';
        $columns .= '],';

        $this->js    = [
            'items'     => base_url('admin/configuraciones/ajustadores/get_datatable/'.$id_aseguradora),
            'columns'   => $columns,
        ];

        $seguro = $this->aseguradoras_model->get($id_aseguradora);

        $this->fdata = [
            'js'            => $this->load->view('admin/assets/js/datatable', $this->js, true),
            'link_active' => ['liConfiguracion', 'lkAseguradoras'],
        ];

        $this->data = [
            'url_agregar'   => base_url('admin/configuraciones/aseguradoras/'.$seguro[0]['id_aseguradora'].'/ajustadores/mostrar_form'),
            'header'        => 'Ajustadores de '.$seguro[0]['nombre'],
        ];

        $this->load->view('admin/common/header_view', $this->hdata);
        $this->load->view('admin/configuraciones/aseguradoras/ajustadores/index_view', $this->data);
        $this->load->view('admin/common/footer_view', $this->fdata);
    }

    public function mostrar_form($id_aseguradora, $id = NULL){
        $data['id_aseguradora'] = $id_aseguradora;
        if (!is_null($id)) {
            $modelo = 'ajustadores_model';
            $this->load->model($modelo);
            $data['HEADER_MODAL']   = 'Editar Ajustador';
            $data['URL_FORM']       = base_url('apis/admin_api/update_ajustador');
            $data['item']           = $this->$modelo->get($id);
        } else {
            $data['HEADER_MODAL']   = 'Agregar Ajustador';
            $data['URL_FORM']       = base_url('apis/admin_api/insert_ajustador');
        }

        $this->load->view('admin/configuraciones/aseguradoras/ajustadores/form_view', $data);
    }

    //-----------------------------------------------------------------------------------------------------------

    public function get_datatable($id_aseguradora = NULL){
        $modelo = 'ajustadores_model';
        $this->load->model($modelo);

        // Datatables Variables
        $draw   = intval($this->input->get("draw"));
        $start  = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $id_aseguradora = (!is_null($id_aseguradora))?$id_aseguradora:$this->input->post('id_aseguradora');

        $result = $this->$modelo->get([
            'id_aseguradora' => $id_aseguradora,
            'eliminado' => '0'
        ]);

        $data   = [];
        $cp     = '';

        foreach($result as $r) {
            $checkbox        = form_checkbox('active', 'active', $r['activo'], ['data-url' => base_url('apis/admin_api/update_activo/'.$modelo.'/'.$r['id_ajustador']) , 'class'=> 'chk-update-activo']);

            $operaciones     = '<a class="btn btn-info btn-xs m-b-10 show-modal" href="'.base_url('admin/configuraciones/aseguradoras/'.$r['id_aseguradora'].'/ajustadores/mostrar_form/'.$r['id_ajustador']).'"><i class="fa fa-pencil"></i> Editar</a> ';
            $operaciones    .= '<a class="btn btn-info btn-xs m-b-10 delete" data-text="ajustador" href="'.base_url('apis/admin_api/delete_ajustador/'.$r['id_ajustador']).'"><i class="fa fa-trash"></i> Eliminar</a>';

            $data[] = [
                $checkbox,
                $r['nombre'].' '.$r['paterno'].' '.$r['materno'],
                $r['telefono'],
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

    //-----------------------------------------------------------------------------------------------------------
    public function get_items($id_aseguradora){
        $modelo = 'ajustadores_model';
        $this->load->model($modelo);
        $result = $this->$modelo->get([
            'id_aseguradora' => $id_aseguradora,
            'eliminado' => '0'
        ]);

        $data   = [];

        foreach($result as $r){
            $data[$r['id_ajustador']] = $r['nombre'] .' '. $r['paterno'] .' '. $r['materno'];
        }

        $output = [
            "data" => $data,
        ];

        $this->output->set_output(json_encode($output));
        return false;
    }



}
?>