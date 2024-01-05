<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Usuarios extends ADMIN_Controller {

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
                    'label' => 'Usuarios'
                ]
            ],
        ];

        $columns  = '"columns" : [';
        $columns .= '{ className : "v-align-middle text-center" },';
        $columns .= '{ className : "v-align-middle" },';
        $columns .= '{ className : "v-align-middle" },';
        $columns .= '{ className : "v-align-middle" },';
        $columns .= '{ className : "v-align-middle" },';
        $columns .= '{ className : "v-align-middle text-center"},';
        $columns .= '],';

        $this->data = [
            'url_agregar'   => base_url('admin/configuraciones/usuarios/mostrar_form'),
            'header'        => 'Usuarios',
        ];

        $this->js    = [
            'items'     => base_url('admin/configuraciones/usuarios/get_datatable'),
            'columns'   => $columns,
        ];

        $this->fdata = [
            'js'            => $this->load->view('admin/assets/js/datatable', $this->js, true),
            'link_active' => ['liConfiguracion', 'lkUsuarios'],
        ];

        $this->load->view('admin/common/header_view', $this->hdata);
        $this->load->view('admin/configuraciones/usuarios/index_view', $this->data);
        $this->load->view('admin/common/footer_view', $this->fdata);
    }

    //-----------------------------------------------------------------------------------------------------------

    public function mostrar_form($id = NULL){
        $data['grupos'] = $this->get_grupos();

        if (!is_null($id)) {
            $modelo = 'usuarios_model';
            $this->load->model($modelo);
            $data['HEADER_MODAL']   = 'Editar Usuario';
            $data['URL_FORM']       = base_url('apis/admin_api/update_usuario');
            $data['item']           = $this->$modelo->get($id);
        } else {
            $data['HEADER_MODAL']   = 'Agregar Usuario';
            $data['URL_FORM']       = base_url('apis/admin_api/insert_usuario');
        }

        $this->load->view('admin/configuraciones/usuarios/form_view', $data);
    }

    //-----------------------------------------------------------------------------------------------------------

    public function get_datatable(){
        $modelo = 'usuarios_model';
        $this->load->model($modelo);

        // Datatables Variables
        $draw   = intval($this->input->get("draw"));
        $start  = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $result = $this->$modelo->get();
        $data   = [];

        foreach($result as $r) {
            $checkbox         = form_checkbox('active', 'active', $r['activo'], ['data-url' => base_url('apis/admin_api/update_activo/'.$modelo.'/'.$r['id_usuario']) , 'class'=> 'chk-update-activo']);

            $operaciones     = '<a class="btn btn-info btn-xs m-b-10 show-modal-lg" href="'.base_url('admin/configuraciones/usuarios/mostrar_form/'.$r['id_usuario']).'"><i class="fa fa-pencil"></i> Editar</a> ';
            /*$operaciones    .= '<a class="btn btn-info btn-xs m-b-10 delete-item" data-text="sucursal" href="'.base_url('apis/admin_api/delete_usuario/'.$r['id_usuario']).'"><i class="fa fa-trash"></i> Eliminar</a>';*/

            $data[] = [
                $checkbox,
                $r['nombre'].' '.$r['paterno'].' '.$r['materno'],
                $r['usuario'],
                $r['sexo'],
                $r['correo'],
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
        $modelo = 'usuarios_model';
        $this->load->model($modelo);
        $result = $this->$modelo->get([
            'activo'    => '1',
            'eliminado' => '0'
        ]);

        $data   = [];

        foreach($result as $r){
            $data[$r['id_usuario']] = $r['nombre'].' '.$r['paterno'].' '.$r['materno'];
        }

        $output = [
            "data" => $data,
        ];

        $this->output->set_output(json_encode($output));
        return false;
    }

    //-----------------------------------------------------------------------------------------------------------

    public function get_grupos(){
        $modelo = 'grupos_model';
        $this->load->model($modelo);
        $result = $this->$modelo->get([
            'activo'    => '1',
            'eliminado' => '0'
        ]);

        $data   = [];

        foreach($result as $r){
            $data[$r['id_grupo']] = $r['descripcion'];
        }

        return $data;
    }
}
?>