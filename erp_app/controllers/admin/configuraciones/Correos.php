<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Correos extends ADMIN_Controller {

    //-----------------------------------------------------------------------------------------------------------
    public function index() {
        $this->hdata = [
            'title' => 'Listado de Correos',
            'breadcumb' => [
                [
                    'url'   => base_url('admin'),
                    'label' => 'Inicio'
                ],
                [
                    'label' => 'Configuraciones'
                ],
                [
                    'label' => 'Correos Electrónicos'
                ]
            ],
        ];

        $columns  = '"columns" : [';
        $columns .= '{ className : "v-align-middle text-center"},';
        $columns .= '{ className : "v-align-middle" },';
        $columns .= '{ className : "v-align-middle" },';
        $columns .= '{ className : "v-align-middle text-center"},';
        $columns .= '],';

        $this->js    = [
            'items'     => base_url('admin/configuraciones/correos/get_datatable'),
            'columns'   => $columns,
        ];

        $this->fdata = [
            'js'            => $this->load->view('admin/assets/js/datatable', $this->js, true),
            'link_active' => ['liConfiguracion', 'lkCorreos'],
        ];

        $this->data = [
            'url_agregar'   => base_url('admin/configuraciones/correos/mostrar_form'),
            'header'        => 'Correos Electrónicos',
        ];

        $this->load->view('admin/common/header_view', $this->hdata);
        $this->load->view('admin/configuraciones/correos/index_view', $this->data);
        $this->load->view('admin/common/footer_view', $this->fdata);
    }

    //-----------------------------------------------------------------------------------------------------------

    public function mostrar_form($id = NULL){
        if (!is_null($id)) {
            $modelo = 'correos_model';
            $this->load->model($modelo);
            $data['HEADER_MODAL']   = 'Editar Correo Electrónico';
            $data['URL_FORM']       = base_url('apis/admin_api/update_correo');
            $data['item']           = $this->$modelo->get($id);
        } else {
            $data['HEADER_MODAL']   = 'Agregar Correo Electrónico';
            $data['URL_FORM']       = base_url('apis/admin_api/insert_correo');
        }

        $this->load->view('admin/configuraciones/correos/form_view', $data);
    }

    //-----------------------------------------------------------------------------------------------------------

    public function get_datatable(){
        $modelo = 'correos_model';
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
            /*$ext_num        = !is_null($r['num_ext']) && !empty($r['num_ext']) ?' No.Ext.'.$r['num_ext']:'';
            $int_num        = !is_null($r['num_int']) && !empty($r['num_int']) ? ' No.Int.'.$r['num_int']:'';
            $colony         = !is_null($r['colonia']) && !empty($r['colonia']) ?' Col.'.$r['colonia']:'';
            $cp             = !is_null($r['cp']) && !empty($r['cp']) ?'C.P.'.$r['cp']:'';
            $municipality   = !is_null($r['municipio']) && !empty($r['municipio']) ?$r['municipio']:'';
            $state          = !is_null($r['estado']) && !empty($r['estado']) ?$r['estado']:'';*/


            $checkbox       = form_checkbox('active', 'active', $r['activo'], ['data-url' => base_url('apis/admin_api/update_activo/'.$modelo.'/'.$r['id_correo']) , 'class'=> 'chk-update-activo']);
            $operaciones    = '<a class="btn btn-info btn-xs m-b-10 show-modal" href="'.base_url('admin/configuraciones/correos/mostrar_form/'.$r['id_correo']).'"><i class="fa fa-pencil"></i></a> ';

            $data[] = [
                $checkbox,
                $r['nombre'],
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

    public function get_items(){
        $modelo = 'correos_model';
        $this->load->model($modelo);
        $result = $this->$modelo->get([
            'eliminado' => '0'
        ]);

        $data   = [];

        foreach($result as $r){
            $data[$r['id_correo']] = $r['nombre'];
        }

        $output = [
            "data" => $data,
        ];

        $this->output->set_output(json_encode($output));
        return false;
    }
}
?>