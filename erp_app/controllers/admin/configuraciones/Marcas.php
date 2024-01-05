<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Marcas extends ADMIN_Controller {

    //-----------------------------------------------------------------------------------------------------------
    public function index() {
        $this->hdata = [
            'title' => 'Marcas',
            'breadcumb' => [
                [
                    'url'   => base_url('admin'),
                    'label' => 'Inicio'
                ],
                [
                    'label' => 'Configuraciones'
                ],
                [
                    'label' => 'Marcas'
                ]
            ],
        ];

        $columns  = '"columns" : [';
        $columns .= '{ className : "v-align-middle text-center" },';
        $columns .= '{ className : "v-align-middle text-center" },';
        $columns .= '{ className : "v-align-middle" },';
        $columns .= '{ className : "v-align-middle" },';
        $columns .= '{ className : "v-align-middle text-center" },';
        $columns .= '],';

        $this->js    = [
            'items'     => base_url('admin/configuraciones/marcas/get_datatable'),
            'columns'   => $columns,
        ];

        $js  = $this->load->view('admin/assets/js/datatable', $this->js, true);
        $js .= $this->load->view('admin/assets/js/marcas', '', true);

        $this->fdata = [
            'js'            => $js,
            'link_active' => ['liConfiguracion', 'lkMarcas'],
        ];

        $this->data = [
            'url_agregar'   => base_url('admin/configuraciones/marcas/mostrar_form'),
            'header'        => 'Marcas',
        ];

        $this->load->view('admin/common/header_view', $this->hdata);
        $this->load->view('admin/configuraciones/marcas/index_view', $this->data);
        $this->load->view('admin/common/footer_view', $this->fdata);
    }

    //-----------------------------------------------------------------------------------------------------------
    public function mostrar_modelos($id = NULL){
        $modelo = 'modelos_model';
        $this->load->model([$modelo, 'marcas_model']);
        $marca = $this->marcas_model->get($id);
        $data['HEADER_MODAL']   = ' Modelos de la Marca <b>'.$marca[0]['nombre'].'</b>';
        $data['URL_FORM']       = base_url('apis/admin_api/insert_modelo');
        $data['URL_ITEMS']      = base_url('admin/configuraciones/marcas/get_datatable_modelos/'.$marca[0]['id_marca']);
        $data['id_marca']       = $marca[0]['id_marca'];
        $this->load->view('admin/configuraciones/marcas/modelos_view', $data);
    }

    //-----------------------------------------------------------------------------------------------------------
    public function mostrar_form($id = NULL){
        if (!is_null($id)) {
            $modelo = 'marcas_model';
            $this->load->model($modelo);
            $data['HEADER_MODAL']   = 'Editar Marca';
            $data['URL_FORM']       = base_url('apis/admin_api/update_marca');
            $data['item']           = $this->$modelo->get($id);
        } else {
            $data['HEADER_MODAL']   = 'Agregar Marca';
            $data['URL_FORM']       = base_url('apis/admin_api/insert_marca');
        }

        $this->load->view('admin/configuraciones/marcas/form_view', $data);
    }

    //-----------------------------------------------------------------------------------------------------------
    public function get_datatable(){
        $modelo = 'marcas_model';
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
            $tmp_l           = explode('.', $r['logo']);
            $checkbox        = form_checkbox('active', 'active', $r['activo'], ['data-url' => base_url('apis/admin_api/update_activo/'.$modelo.'/'.$r['id_marca']) , 'class'=> 'chk-update-activo']);
            $logo            = '<img src="'.base_url(MARCAS_FOLDER.$tmp_l[0].'_thumb.'.$tmp_l[1]).'" class="img-fluid" />';
            $modelos         = '<a class="btn btn-info btn-xs m-b-10 show-modal-lg" href="'.base_url('admin/configuraciones/marcas/mostrar_modelos/'.$r['id_marca']).'"><i class="fa fa-car"></i> Modelos</a> ';
            $operaciones     = '<a class="btn btn-info btn-xs m-b-10 show-modal" href="'.base_url('admin/configuraciones/marcas/mostrar_form/'.$r['id_marca']).'"><i class="fa fa-pencil"></i> Editar</a> ';
            $operaciones    .= '<a class="btn btn-info btn-xs m-b-10 delete" data-text="marca" href="'.base_url('apis/admin_api/delete_marca/'.$r['id_marca']).'"><i class="fa fa-trash"></i> Eliminar</a>';

            $data[] = [
                $checkbox,
                $logo,
                $r['nombre'],
                $r['descripcion'],
                $modelos.''.$operaciones,
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

    public function get_datatable_modelos($id_marca){
        $modelo = 'modelos_model';
        $this->load->model($modelo);

        // Datatables Variables
        $draw   = intval($this->input->get("draw"));
        $start  = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $result = $this->$modelo->get([
            'id_marca'  => $id_marca,
            'eliminado' => '0'
        ]);
        $data   = [];
        $cp     = '';

        $estilo = [
            'BUS'           => 'Bus',
            'CAMION'        => 'Camión',
            'DEPORTIVO'     => 'Deportivo',
            'ECO'           => 'Eco',
            'FURGONETA'     => 'Furgoneta',
            'HATCHBACK'     => 'Hatchback',
            'MAQUINARIA'    => 'Maquinaria Pesada',
            'MINIVAN'       => 'Minivan',
            'PICKUP'        => 'Pick Up',
            'SEDAN'         => 'Sedán',
            '4X2'           => 'Todo Terreno 4x2',
            '4X4'           => 'Todo Terreno 4x4',
            'TRAILER'       => 'Trailer',
        ];

        foreach($result as $r) {
            $checkbox        = form_checkbox('active', 'active', $r['activo'], ['data-url' => base_url('apis/admin_api/update_activo/'.$modelo.'/'.$r['id_modelo']) , 'class'=> 'chk-update-activo']);
            //$operaciones     = '<a class="btn btn-info btn-xs m-b-10 show-modal" href="'.base_url('admin/configuraciones/marcas/mostrar_form/'.$r['id_marca']).'"><i class="fa fa-pencil"></i> Editar</a> ';
            $operaciones     = '<a class="btn btn-info btn-xs m-b-10 delete" data-text="marca" href="'.base_url('apis/admin_api/delete_modelo/'.$r['id_marca']).'"><i class="fa fa-trash"></i> Eliminar</a>';

            $data[] = [
                $checkbox,
                $r['modelo'],
                $estilo[$r['estilo']],
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