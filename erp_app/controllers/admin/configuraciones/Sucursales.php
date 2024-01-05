<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sucursales extends ADMIN_Controller {

    //-----------------------------------------------------------------------------------------------------------

    public function index() {
        $this->hdata = [
            'title' => 'Sucursales',
            'breadcumb' => [
                [
                    'url'   => base_url('admin'),
                    'label' => 'Inicio'
                ],
                [
                    'label' => 'Configuraciones'
                ],
                [
                    'label' => 'Sucursales'
                ]
            ],
        ];

        $columns  = '"columns" : [';
        $columns .= '{ className : "v-align-middle" },';
        $columns .= '{ className : "v-align-middle" },';
        $columns .= '{ className : "v-align-middle" },';
        $columns .= '{ className : "v-align-middle" },';
        $columns .= '{ className : "v-align-middle" },';
        $columns .= '{ className : "v-align-middle text-center"},';
        $columns .= '],';

        $this->js    = [
            'items'     => base_url('admin/configuraciones/sucursales/get_datatable'),
            'columns'   => $columns,
        ];

        $this->fdata = [
            'js'            => $this->load->view('admin/assets/js/datatable', $this->js, true),
            'link_active' => ['liConfiguracion', 'lkSucursales'],
        ];

        $this->data = [
            'url_agregar'   => base_url('admin/configuraciones/sucursales/mostrar_form'),
            'header'        => 'Sucursales',
        ];

        $this->load->view('admin/common/header_view', $this->hdata);
        $this->load->view('admin/configuraciones/sucursales/index_view', $this->data);
        $this->load->view('admin/common/footer_view', $this->fdata);
    }

    public function mostrar_form($id = NULL){
        if (!is_null($id)) {
            $modelo = 'sucursales_model';
            $this->load->model($modelo);
            $data['HEADER_MODAL']   = 'Editar Sucursal';
            $data['URL_FORM']       = base_url('apis/admin_api/update_sucursal');
            $data['item']           = $this->$modelo->get($id);
        } else {
            $data['HEADER_MODAL']   = 'Agregar Sucursal';
            $data['URL_FORM']       = base_url('apis/admin_api/insert_sucursal');
        }

        $this->load->view('admin/configuraciones/sucursales/form_view', $data);
    }

    //-----------------------------------------------------------------------------------------------------------

    public function get_datatable(){
        $modelo = 'sucursales_model';
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
            $ext_num        = !is_null($r['no_ext']) && !empty($r['no_ext']) ?' No.Ext.'.$r['no_ext']:'';
            $int_num        = !is_null($r['no_int']) && !empty($r['no_int']) ? ' No.Int.'.$r['no_int']:'';
            $colony         = !is_null($r['colonia']) && !empty($r['colonia']) ?' Col.'.$r['colonia']:'';
            $cp             = !is_null($r['cp']) && !empty($r['cp']) ?'C.P.'.$r['cp']:'';
            $municipality   = !is_null($r['municipio']) && !empty($r['municipio']) ?$r['municipio']:'';
            $state          = !is_null($r['estado']) && !empty($r['estado']) ?$r['estado']:'';

            $checkbox        = form_checkbox('active', 'active', $r['activo'], ['data-url' => base_url('apis/admin_api/update_activo/'.$modelo.'/'.$r['id_sucursal']) , 'class'=> 'chk-update-activo']);

            $operaciones     = '<a class="btn btn-info btn-xs m-b-10 show-modal" href="'.base_url('admin/configuraciones/sucursales/mostrar_form/'.$r['id_sucursal']).'"><i class="fa fa-pencil"></i> Editar</a> ';
            $operaciones    .= '<a class="btn btn-info btn-xs m-b-10 delete" data-text="sucursal" href="'.base_url('apis/admin_api/delete_sucursal/'.$r['id_sucursal']).'"><i class="fa fa-trash"></i> Eliminar</a>';

            $data[] = [
                //'id_plant'  => $r->id_plant,
                $checkbox,
                $r['nombre'],
                $r['descripcion'],
                $r['calle'].' '.$ext_num.' '.$int_num.' '.$colony.' '.$cp.' '.$municipality.' '.$state,
                $r['telefono'],
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