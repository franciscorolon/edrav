<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Reportes extends ADMIN_Controller {

    //-----------------------------------------------------------------------------------------------------------
    public function automoviles() {
		$this->hdata = [
			'title' => 'Reporte de Automóviles',
			'css' => $this->load->view('admin/assets/css/reportes', '', true),
		];

		$this->data = [
			'aseguradoras' => $this->get_aseguradoras(),
			'url_form'	   => base_url('admin/reportes/get_automoviles'),
		];

        $this->fdata = [
            'js'            => $this->load->view('admin/assets/js/reportes', '', true),
            'link_active' => ['liReportes', 'lkAutomoviles'],
        ];

		$this->load->view('admin/common/header_view', $this->hdata);
        $this->load->view('admin/reportes/automoviles_view', $this->data);
        $this->load->view('admin/common/footer_view', $this->fdata);
    }

	//-----------------------------------------------------------------------------------------------------------
    public function recibos() {
        $this->hdata = [
            'title' => 'Reporte de Recibos',
            'css' 	=> $this->load->view('admin/assets/css/reportes', '', true),
        ];

        $this->data = [
            'url_form'	   => base_url('admin/reportes/get_recibos'),
        ];

        $this->fdata = [
            'js'          => $this->load->view('admin/assets/js/reportes', '', true),
            'link_active' => ['liReportes', 'lkRecibos'],
        ];

        $this->load->view('admin/common/header_view', $this->hdata);
        $this->load->view('admin/reportes/recibos_view', $this->data);
        $this->load->view('admin/common/footer_view', $this->fdata);
    }

    public function vales_refacciones(){
        $this->hdata = [
            'title' => 'Reporte de Vales de Refacciones Expedidos',
            'css' 	=> $this->load->view('admin/assets/css/reportes', '', true),
        ];

        $this->data = [
            'url_form'	   => base_url('admin/reportes/get_vales'),
        ];

        $this->fdata = [
            'js'          => $this->load->view('admin/assets/js/reportes', '', true),
            'link_active' => ['liReportes', 'lkVales'],
        ];

        $this->load->view('admin/common/header_view', $this->hdata);
        $this->load->view('admin/reportes/vales_view', $this->data);
        $this->load->view('admin/common/footer_view', $this->fdata);
    }

    //-----------------------------------------------------------------------------------------------------------
    public function get_automoviles(){
        $modelo = 'ordenes_model';
        $this->load->model($modelo);

        // Datatables Variables
        $aseguradora   	= $this->input->post("id_aseguradora");
        $status  		= $this->input->post("status");
        $rango 			= $this->input->post("rango");
        $tmp_rango		= explode('-', $rango);
        $t_start		= explode('/', trim($tmp_rango[0]));
        $t_end			= explode('/', trim($tmp_rango[1]));

        if($aseguradora != '0'){
        	$busqueda['ordenes.id_aseguradora'] = $aseguradora;
        }
        if($status != '0'){
	    	$busqueda['status'] = $status;
	    }

		$busqueda["DATE(`fecha_recepcion`) >="] = date("Y-m-d", strtotime($t_start[2].'-'.$t_start[1].'-'.$t_start[0]));
		$busqueda["DATE(`fecha_recepcion`) <="] = date("Y-m-d", strtotime($t_end[2].'-'.$t_end[1].'-'.$t_end[0]));
        $busqueda['ordenes.eliminado']	= '0';

        $result = $this->$modelo->get($busqueda, 'no_orden');

        $data   = [];

        $estado           = [
            'VALUACION'     => 'En Valuación',
            'REPARACION'    => 'En Reparación',
            'RESGUARDO'     => 'En CVP2',
            'TRANSITO'      => 'En Tránsito',
            'ENTREGADO'     => 'Entregado',
            'FACTURADO'     => 'Facturado',
            'ARCHIVADO'     => 'Archivado',
            'PERDIDAS'      => 'Perdidas Totales',
            'DANOS'         => 'Pago de Daños',
        ];

        foreach($result as $r) {
            $resul['no_orden'] 			= $r['no_orden'];
            $resul['status']			= $estado[$r['status']];
            $resul['no_placas'] 		= $r['no_placas'];
            $resul['marca'] 			= $r['marca'];
            $resul['tipo'] 				= $r['tipo'];
            $resul['aseguradora'] 		= $r['aseguradora'];
            $resul['fecha_recepcion'] 	= $r['fecha_recepcion'];

            if($status != 0 && $status == 'ENTREGADO'){
	            $resul['fecha_entrega']	= $r['fecha_entrega'];
            }else{
	            $resul['fecha_entrega']	= $r['fecha_promesa'];
            }

            $data[] = $resul;
        }

        $output = [
	        "result" 	=> 1,
            "total" 	=> count($result),
            "data"		=> $data,
        ];

        $this->output->set_output(json_encode($output));
        return false;
    }

	public function get_recibos(){
        $modelo = 'orden_recibos_model';
        $this->load->model($modelo);
		$forma			= $this->input->post("forma");
        $start	 		= $this->input->post("start");
        $end			= $this->input->post("end");

        $t_start		= explode('/', $start);
        $t_end			= explode('/', $end);

        if($forma != '0'){
	        $busqueda['forma_pago'] = $forma;
        }

		$busqueda["fecha >="] = date('Y-m-d', strtotime($t_start[2].'-'.$t_start[1].'-'.$t_start[0]));
		$busqueda["fecha <="] = date('Y-m-d', strtotime($t_end[2].'-'.$t_end[1].'-'.$t_end[0]));
        $busqueda['orden_recibos.eliminado']	= '0';

        $result = $this->$modelo->get($busqueda);

        $data   = [];

        foreach($result as $r) {
	        $resul['no_recibo']			= $r['no_recibo'];
            $resul['no_orden'] 			= $r['no_orden'];
            $resul['fecha']				= date('m-d-Y', strtotime($r['fecha']));
            $resul['forma_pago'] 		= $r['forma_pago'];
            $resul['cantidad'] 			= '$ '.number_format($r['cantidad'],2);
            $resul['factura'] 			= ($r['factura'] == '1')?'Si':'No';
            $data[] = $resul;
        }

        $output = [
	        "result" 	=> 1,
            "total" 	=> count($result),
            "data"		=> $data,
        ];

        $this->output->set_output(json_encode($output));
        return false;
    }

    public function get_vales(){
    }

    //-----------------------------------------------------------------------------------------------------------
    private function get_aseguradoras(){
        $modelo = 'aseguradoras_model';
        $this->load->model($modelo);
        $result = $this->$modelo->get([
            'eliminado' => '0'
        ]);

        $data   = [];

        $data['0'] = '-- Todas --';
        foreach($result as $r){
            $data[$r['id_aseguradora']] = $r['nombre'];
        }

        return $data;
    }
}
?>