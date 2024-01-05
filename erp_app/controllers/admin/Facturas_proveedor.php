<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Facturas_proveedor extends ADMIN_Controller {

    //-----------------------------------------------------------------------------------------------------------
    protected $estado_labels           = [
        //'PENDIENTE'     => '',
        'PENDIENTE'     => '<span class="label label-important">Pendiente</span>',
        'VALIDACION'    => '<span class="label label-warning">Validación</span>',
        'BANCO'     	=> '<span class="label label-success">Banco</span>',
        'PAGADO'     	=> '<span class="label label-success">Pago Programado</span>',
    ];

    public function index() {
        $perfiles = [SUPER_ADMINISTRADOR, ADMINISTRADOR, CLIENTES_AVANZADO];
	    if(!in_array($this->session->userdata('id_grupo'), $perfiles) ){
            redirect(base_url('admin/inicio'));
        }

		$this->hdata = [
            'title' => 'Facturas',
            'breadcumb' => [
                [
                    'url'   => base_url('admin/facturas-proveedor'),
                    'label' => 'Inicio'
                ],
                [
                    'label' => 'Facturas Proveedor'
                ]
            ],
        ];

        $this->data = [
            'url_agregar'   => base_url('admin/facturas/nueva'),
            'header'        => 'Facturas',
        ];

        $columns  = '"columns" : [';
		$columns .= '{ className : "v-align-middle text-center" },';
		$columns .= '{ className : "v-align-middle text-center" },';
		$columns .= '{ className : "v-align-middle text-center" },';
		$columns .= '{ className : "v-align-middle text-right" },';
		$columns .= '{ className : "v-align-middle text-center" },';
		$columns .= '{ className : "v-align-middle text-center" },';
		$columns .= '{ className : "v-align-middle text-center" },';
        $columns .= '{ className : "v-align-middle text-center" }';
		$columns .= '],';

		$this->js    = [
		    'items'		=> base_url('admin/facturas/get_datatable'),
		    'columns'   => $columns,
		];

		$javascript  =  $this->load->view('admin/assets/js/datatable', $this->js, true);
		$javascript .=  $this->load->view('admin/assets/js/facturas', '',true);

		$this->fdata = [
		    'js'            => $javascript,
		    'link_active'   => ['liFacturas'],
		];

        $this->load->view('admin/common/header_view', $this->hdata);
        $this->load->view('admin/facturas_proveedor/index_view', $this->data);
        $this->load->view('admin/common/footer_view', $this->fdata);
    }

    //-----------------------------------------------------------------------------------------------------------
    public function nueva(){
        $this->load->model(['facturas_proveedores_model']);
        $this->hdata = [
            'title' => 'Facturas',
            'breadcumb' => [
                [
                    'url'   => base_url('admin/inicio'),
                    'label' => 'Inicio'
                ],
                [
                    'url'   => base_url('admin/facturas'),
                    'label' => 'Facturas'
                ],
                [
                    'label' => 'Nueva Factura'
                ]
            ],
			'css'   => $this->load->view('admin/assets/css/factura', '', true),
        ];

        $this->data = [
            'url_nueva'     => base_url('apis/admin_api/insert_factura'),
            'no_factura'    => $this->facturas_proveedores_model->get_no_factura(),
            'metodos'      	=> $this->getMetodos(),

        ];

        $this->fdata = [
            'js'            => $this->load->view('admin/assets/js/factura', '', true),
            'link_active'   => ['liFacturas'],
        ];

        $this->load->view('admin/common/header_view', $this->hdata);
        $this->load->view('admin/facturas/nueva_view', $this->data);
        $this->load->view('admin/common/footer_view', $this->fdata);
    }

    //-----------------------------------------------------------------------------------------------------------
    public function getMetodos(){
        $modelo = 'metodos_pago_model';
        $this->load->model($modelo);
        $result = $this->$modelo->get([
            'activo'    => '1'
        ]);

        $data   = [];

        $data['-1'] = '-- seleccione --';
        foreach($result as $r){
            $data[$r['id_metodo_pago']] = $r['nombre'];
        }

        return $data;
    }
    
    public function descargas($idDescarga,$file){
        $this->load->helper('download');
        $filename = FACTURAS_PATH.sha1($idDescarga).'/'.$file;
        force_download($filename, NULL);
    }

	//-----------------------------------------------------------------------------------------------------------
    public function logout(){
        $this->session->sess_destroy();
        redirect(base_url('admin'));
    }

    //-----------------------------------------------------------------------------------------------------------
    public function get_datatable($estado_dt = null){
        $modelo = 'facturas_proveedores_model';
        $this->load->model(['facturas_proveedores_model', 'facturas_proveedor_estados_model']);

        // Datatables Variables
        $draw   = intval($this->input->get("draw"));

        $id_proveedor = $this->session->userdata('id_usuario');

        /*if(!is_null($estado_dt)){
            $result = $this->$modelo->busqueda(null, [], $estado_dt);
        }else{*/
            $result = $this->$modelo->get(['id_proveedor' => $id_proveedor]);
        //}

        $data   = [];

        if($result != false){
            foreach($result as $r) {
                $operaciones      = anchor(base_url('admin/facturas/descargas/'.$r['id_factura_proveedor'].'/'.$r['pdf']), '<i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i>', [ 'class' => 'mr-3']);
                $operaciones 	 .= '  '.anchor(base_url('admin/facturas/descargas/'.$r['id_factura_proveedor'].'/'.$r['xml']), '<i class="fa fa-file-text-o fa-2x" aria-hidden="true"></i>');
                $pagado           = is_null($r['fecha_pago']) ? '<span class="label label-important">No pagado</span>':'<span class="label label-inverse">Pagado</span>';
                $data[] = [
                    anchor(base_url('admin/facturas/'.$r['id_factura_proveedor']), $r['no_factura'], ['title' => 'Ver detalle Factura', 'class' => 'show-modal']),
                    $r['metodo_pago'],
                    $r['folio'],
                    '<b>$ '.number_format($r['monto'],2,'.',',').'</b>',
                    date('d-m-Y', strtotime($r['fecha'])),
                    $pagado,
                    $this->estado_labels[$r['status']],
                    $operaciones,
                ];

                //var_dump($data);die;
            }
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
?>