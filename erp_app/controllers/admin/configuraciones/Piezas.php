<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Piezas extends ADMIN_Controller {

    //-----------------------------------------------------------------------------------------------------------

    public function index() {
        $this->hdata = [
            'title' => 'Piezas de Automóvil',
            'breadcumb' => [
                [
                    'url'   => base_url('admin'),
                    'label' => 'Inicio'
                ],
                [
                    'label' => 'Configuraciones'
                ],
                [
                    'label' => 'Piezas de Automóvil'
                ]
            ],
        ];

        $columns  = '"columns" : [';
        $columns .= '{ className : "v-align-middle" },';
        $columns .= '{ className : "v-align-middle" },';
        $columns .= '{ className : "v-align-middle" },';
        $columns .= '{ className : "v-align-middle text-center" },';
        $columns .= '{ className : "v-align-middle text-right" },';
        $columns .= '{ className : "v-align-middle text-center"},';
        $columns .= '],';

        $this->js    = [
            'items'     => base_url('admin/configuraciones/piezas/get_datatable'),
            'columns'   => $columns,
        ];

        $js      = $this->load->view('admin/assets/js/datatable', $this->js, true);
        $js     .= $this->load->view('admin/assets/js/piezas', '',true);

        $this->fdata = [
            'js'            => $js,
            'link_active' => ['liConfiguracion', 'lkPiezas'],
        ];

        $this->data = [
            'url_agregar'   => base_url('admin/configuraciones/piezas/mostrar_form'),
            'header'        => 'Piezas de Automóvil',
        ];

        $this->load->view('admin/common/header_view', $this->hdata);
        $this->load->view('admin/configuraciones/piezas/index_view', $this->data);
        $this->load->view('admin/common/footer_view', $this->fdata);
    }

    public function mostrar_form($id = NULL){
        $modelo = 'piezas_model';
        $this->load->model([$modelo, 'categorias_model']);
        $data['partes']         = $this->categorias_model->get_dropdown();

        if (!is_null($id)) {
            $data['HEADER_MODAL']   = 'Editar Piezas del Automóvil';
            $data['URL_FORM']       = base_url('apis/admin_api/update_pieza');
            $data['item']           = $this->$modelo->get($id);

        } else {
            $data['HEADER_MODAL']   = 'Agregar Piezas del Automóvil';
            $data['URL_FORM']       = base_url('apis/admin_api/insert_pieza');
        }

        $this->load->view('admin/configuraciones/piezas/form_view', $data);
    }

    //-----------------------------------------------------------------------------------------------------------
    public function get_datatable(){
        $modelo = 'piezas_model';
        $this->load->model([$modelo, 'categorias_model']);

        // Datatables Variables
        $draw   = intval($this->input->get("draw"));
        $start  = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $result = $this->$modelo->get([
            'partes_coche.eliminado' => '0'
        ], 'partes_coche.nombre');
        $data   = [];
        $cp     = '';

        foreach($result as $r) {

            $checkbox        = form_checkbox('active', 'active', $r['activo'], ['data-url' => base_url('apis/admin_api/update_activo/'.$modelo.'/'.$r['id_parte_coche']) , 'class'=> 'chk-update-activo']);

            $operaciones     = '<a class="btn btn-info btn-xs m-b-10 show-modal" href="'.base_url('admin/configuraciones/piezas/mostrar_form/'.$r['id_parte_coche']).'"><i class="fa fa-pencil"></i> Editar</a> ';
            $operaciones    .= '<a class="btn btn-info btn-xs m-b-10 delete" data-text="parte de automóvil" href="'.base_url('apis/admin_api/delete_pieza/'.$r['id_parte_coche']).'"><i class="fa fa-trash"></i> Eliminar</a>';

            $data[] = [
                //'id_plant'  => $r->id_plant,
                $checkbox,
                $r['nombre'],
                $r['nombre_comercial'],
                $r['parte_automovil'],
                $r['tiempo_promedio'],
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