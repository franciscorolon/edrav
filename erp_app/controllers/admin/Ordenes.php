<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ordenes extends ADMIN_Controller {

    //-----------------------------------------------------------------------------------------------------------
    public function index() {
        $this->hdata = [
            'title' => 'Ordenes',
            'breadcumb' => [
                [
                    'url'   => base_url('admin/inicio'),
                    'label' => 'Inicio'
                ],
                [
                    'label' => 'Ordenes'
                ]
            ],
        ];

        $this->data = [
            'url_agregar'   => base_url('admin/ordenes/nueva'),
            'header'        => 'Ordenes',
        ];

        $columns  = '"columns" : [';
        $columns .= '{ className : "v-align-middle text-center" },';
        $columns .= '{ className : "v-align-middle text-center" },';
        $columns .= '{ className : "v-align-middle text-left" },';
        $columns .= '{ className : "v-align-middle text-left" },';
        $columns .= '{ className : "v-align-middle text-center" },';
        $columns .= '{ className : "v-align-middle text-center" },';
        $columns .= '{ className : "v-align-middle text-center"},';
        $columns .= '],';

        $this->js    = [
            'items'             => base_url('admin/ordenes/get_datatable'),
            'items_valuacion'   => base_url('admin/ordenes/get_datatable/VALUACION'),
            'items_reparacion'  => base_url('admin/ordenes/get_datatable/REPARACION'),
            'items_resguardo'   => base_url('admin/ordenes/get_datatable/RESGUARDO'),
            'items_transito'    => base_url('admin/ordenes/get_datatable/TRANSITO'),
            'items_entregado'   => base_url('admin/ordenes/get_datatable/ENTREGADO'),
            'items_facturado'   => base_url('admin/ordenes/get_datatable/FACTURADO'),
            'items_archivado'   => base_url('admin/ordenes/get_datatable/ARCHIVADO'),
            'items_perdidas'    => base_url('admin/ordenes/get_datatable/PERDIDAS'),
            'items_danos'       => base_url('admin/ordenes/get_datatable/DANOS'),
            'columns'   => $columns,
        ];

        $js =   $this->load->view('admin/assets/js/datatable', $this->js, true);
        $js .=  $this->load->view('admin/assets/js/ordenes', '',true);

        $this->fdata = [
            'js'            => $js,
            'link_active'   => ['liOrdenes'],
        ];

        $this->load->view('admin/common/header_view', $this->hdata);
        $this->load->view('admin/ordenes/index_view', $this->data);
        $this->load->view('admin/common/footer_view', $this->fdata);
    }

    //-----------------------------------------------------------------------------------------------------------
    public function nueva(){
        $this->load->model(['ordenes_model']);
        $this->hdata = [
            'title' => 'Ordenes',
            'breadcumb' => [
                [
                    'url'   => base_url('admin/inicio'),
                    'label' => 'Inicio'
                ],
                [
                    'url'   => base_url('admin/ordenes'),
                    'label' => 'Ordenes'
                ],
                [
                    'label' => 'Nueva Orden'
                ]
            ],
            'css'   => $this->load->view('admin/assets/css/orden', '', true),
        ];

        $this->data = [
            'url_nueva'     => base_url('apis/admin_api/insert_orden'),
            'no_orden'      => $this->ordenes_model->get_no_orden(),
            'asesores'      => $this->get_asesores(),
            'aseguradoras'  => $this->get_aseguradoras(),
            'clientes'      => $this->get_clientes(),

        ];

        $this->fdata = [
            'js'            => $this->load->view('admin/assets/js/orden', '', true),
            'link_active'   => ['liOrdenes'],
        ];

        $this->load->view('admin/common/header_view', $this->hdata);
        $this->load->view('admin/ordenes/nueva_view', $this->data);
        $this->load->view('admin/common/footer_view', $this->fdata);
    }


    public function mostrar($id){
        $this->load->model(['ordenes_model','orden_incidencias_model', 'clientes_model', 'aseguradoras_model', 'usuarios_model', 'ajustadores_model', 'orden_recibos_model', 'orden_expediente_model', 'aseguradora_documentos_model', 'ordenes_has_aseguradora_documentos_model']);

        $this->hdata = [
            'title' => 'Ordenes',
            'breadcumb' => [
                [
                    'url'   => base_url('admin/inicio'),
                    'label' => 'Inicio'
                ],
                [
                    'url'   => base_url('admin/ordenes'),
                    'label' => 'Ordenes'
                ]
            ],
            'css'   => $this->load->view('admin/assets/css/orden', '', true),
        ];

        $incidencias = $this->orden_incidencias_model->get([
            'orden_incidencias.id_orden'  => $id,
            'orden_incidencias.activo'    => '1',
            'orden_incidencias.eliminado' => '0'
        ], 'fecha_incidencia DESC');

        $orden          = $this->ordenes_model->get(['id_orden' => $id]);
        $cliente        = $this->clientes_model->get(['id_cliente' => $orden[0]['id_cliente'] ]);
        $aseguradora    = $this->aseguradoras_model->get(['id_aseguradora' => $orden[0]['id_aseguradora'] ]);
        $asesor         = $this->usuarios_model->get(['id_usuario' => $orden[0]['id_asesor'] ]);
        $ajustador      = $this->ajustadores_model->get(['id_ajustador' => $orden[0]['id_ajustador'] ]);
        $recibos        = $this->orden_recibos_model->get(['orden_recibos.id_orden' => $id]);
        $expedientes    = $this->orden_expediente_model->get(['id_orden' => $id, 'eliminado' => '0']);
        $docs           = $this->aseguradora_documentos_model->get(['id_aseguradora' => $orden[0]['id_aseguradora'], 'eliminado' => '0' ]);
        $docs_orden     = [];
        if(!empty($docs)){
            foreach($docs as $d){
                $tmp = $this->ordenes_has_aseguradora_documentos_model->get(['id_documento' => $d['id_documento'], 'id_orden' => $id ,'eliminado' => '0']);

                if(!empty($tmp)){
                    $docs_orden[] = $tmp[0];
                }
            }
        }

        $this->data = [
            'url_form'          => base_url('apis/admin_api/update_orden'),
            'incidencias'       => $incidencias,
            'orden'             => $orden[0],
            'asesor'            => $asesor[0],
            'asesores'          => $this->get_asesores(),
            'aseguradora'       => $aseguradora[0],
            'aseguradoras'      => $this->get_aseguradoras(),
            'cliente'           => $cliente[0],
            'clientes'          => $this->get_clientes(),
            'ajustador'         => $ajustador[0],
            'ajustadores'       => $this->get_ajustadores($aseguradora[0]['id_aseguradora']),
            'recibos'           => $recibos,
            'url_expediente'    => base_url('apis/admin_api/upload_expediente/'.$orden[0]['id_orden']),
            'expediente'        => $expedientes,
            'docs'              => $docs,
            'docs_orden'        => $docs_orden,
        ];

        $this->fdata = [
            'js'            => $this->load->view('admin/assets/js/orden', '', true),
            'link_active'   => ['liOrdenes'],
        ];

        $this->load->view('admin/common/header_view', $this->hdata);
        $this->load->view('admin/ordenes/edit_view', $this->data);
        $this->load->view('admin/common/footer_view', $this->fdata);
    }

    public function status($id_orden){
        $data['estados']           = [
            'VALUACION'     => 'En Valuación',
            'REPARACION'    => 'En Reparación',
            'RESGUARDO'     => 'En CVP2',
            'TRANSITO'      => 'En Tránsito',
            'ENTREGADO'     => 'Entregado',
            'FACTURADO'     => 'Facturado',
            'ARCHIVADO'     => 'Archivado',
            'PERDIDAS'      => 'Perdidas Totales',
            'DANOS'         => 'Pago de daños',
        ];
        $modelo = 'ordenes_model';
        $this->load->model($modelo);
        $data['HEADER_MODAL']   = 'Cambiar Estado';
        $data['URL_FORM']       = base_url('apis/admin_api/update_estado_orden');
        $data['item']           = $this->$modelo->get($id_orden);

        $this->load->view('admin/ordenes/status_view', $data);
    }

    //-----------------------------------------------------------------------------------------------------------
    public function buscar(){
        $modelo = 'ordenes_model';
        $this->load->model($modelo);

        $busqueda                 = $this->input->post('busqueda');
        $buscar['no_orden']       = $this->input->post('search_no_orden');
        $buscar['no_placas']      = $this->input->post('search_no_placas');
        $buscar['no_cliente']     = $this->input->post('search_no_cliente');
        $buscar['cliente']        = $this->input->post('search_cliente');
        $buscar['no_siniestro']   = $this->input->post('search_no_siniestro');
        $buscar['no_serie']       = $this->input->post('search_no_serie');

        $results = $this->$modelo->busqueda($busqueda, $buscar);

        $res = '';
        if($results != false){
            foreach($results as $r){
                $res .= '<a href="#" data-id="'.$r->id_orden.'" class="list-group-item list-group-item-action flex-column align-items-start"><div class="d-flex w-100 justify-content-between"><h5 class="mb-1">Orden #'.$r->no_orden.'</h5><small>'.date('F j, Y').'</small></div><p class="mb-1">Status: <span class="bold pull-right">'.$r->status.'</span></p><p class="mb-1">Cliente: '.$r->cliente.'</p><p class="mb-1">Teléfono: '.$r->celular.'</p><p class="mb-1">Tipo: '.$r->tipo.'</p><div class="btn-group"><a class="btn btn-success detalle-orden text-white" data-id="'.$r->id_orden.'" alt="Detalle de Orden"><i class="fa fa-eye"></i></a><a class="btn btn-success mostrar-inventario text-white" alt="Inventario"><i class="fa fa-archive"></i></a><a class="btn btn-success show-modal-lg" href="'.base_url('admin/ordenes/imprimir/'.$r->id_orden).'" alt="Imprimir Orden"><i class="fa fa-print"></i></a><a class="btn btn-success text-white" alt=""><i class="fa fa-trash-o"></i></a></div></a>';
            }
        }else{
            $res = '<a href="#" class="list-group-item list-group-item-action flex-column align-items-start">No se encontraron resultados para la busqueda</a>';
        }

        $output = [
            'resultados' => $res,
        ];

        $this->output->set_output(json_encode($output));
        return false;
    }

    public function imprimir($id = NULL){
        if (!is_null($id)) {
            $modelo = 'aseguradoras_model';
            $this->load->model($modelo);
            $data['HEADER_MODAL']   = 'Editar Aseguradora';
            $data['URL_FORM']       = base_url('apis/admin_api/update_aseguradora');
            $data['item']           = $this->$modelo->get($id);
            $this->load->view('admin/ordenes/imprimir_view', $data);
        } else {
            return false;
        }
    }

    public function get_datatable($estado_dt = null){
        $modelo = 'ordenes_model';
        $this->load->model($modelo);

        // Datatables Variables
        $draw   = intval($this->input->get("draw"));
        $start  = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        if(!is_null($estado_dt)){
            $result = $this->$modelo->busqueda(null, [], $estado_dt);
        }else{
            $result = $this->$modelo->busqueda();
        }

        $data   = [];
        $cp     = '';

        if($result != false){
            foreach($result as $r) {
                //var_dump($r);die;
                $st               = is_null($estado_dt)? '': $estado_dt;
                $checkbox         = '';
                $operaciones      = '';
                $estado           = [
                    'VALUACION'     => '<span class="label label-important">En Valuación</span>',
                    'REPARACION'    => '<span class="label label-info">En Reparación</span>',
                    'RESGUARDO'     => '<span class="label label-info">En CVP2</span>',
                    'TRANSITO'      => '<span class="label label-warning">En Tránsito</span>',
                    'ENTREGADO'     => '<span class="label label-success">Entregado</span>',
                    'FACTURADO'     => '<span class="label label-inverse">Facturado</span>',
                    'ARCHIVADO'     => '<span class="label">Archivado</span>',
                    'PERDIDAS'      => '<span class="label">Perdidas Totales</span>',
                    'DANOS'         => '<span class="label">Pago de daños</span>',
                ];

                if (!$this->session->userdata('id_usuario') || ($this->session->userdata('id_grupo') == SUPER_ADMINISTRADOR || $this->session->userdata('id_grupo') == ADMINISTRADOR  || $this->session->userdata('id_grupo') == CLIENTES_AVANZADO) ){
                    $checkbox         = form_checkbox('active', 'active', $r['activo'], ['data-url' => base_url('apis/admin_api/update_activo/'.$modelo.'/'.$r['id_orden']) , 'class'=> 'chk-update-activo']);
                }
                if (!$this->session->userdata('id_usuario') || ($this->session->userdata('id_grupo') == SUPER_ADMINISTRADOR || $this->session->userdata('id_grupo') == ADMINISTRADOR) ){
                    $operaciones     .= '<a class="btn btn-info btn-xs m-b-10 delete-item data-table="'.$st.'" data-text="orden" href="'.base_url('apis/admin_api/delete_orden/'.$r['id_orden']).'"><i class="fa fa-trash"></i> Eliminar</a>';
                }

                $info   = '<div class="row"><div class="col">'.$r['cliente'].'</div></div>';
                $info  .= '<div class="row"><div class="col small"><b>Placas:</b>'.$r['no_placas'].'</div><div class="col small"><b>Marca:</b>'.$r['marca'].'</div></div>';
                $info  .= '<div class="row"><div class="col small"><b>No. Siniestro:</b>'.$r['no_siniestro'].'</div><div class="col small"><b>Tipo:</b>'.$r['tipo'].'</div></div>';

                $data[] = [
                    $checkbox,
                    anchor(base_url('admin/ordenes/'.$r['id_orden']), $r['no_orden']),
                    $r['fecha_recepcion'],
                    $info,
                    $r['celular'],
                    $estado[$r['status']],
                    $operaciones,
                ];
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

    //-----------------------------------------------------------------------------------------------------------
    public function get_asesores(){
        $modelo = 'usuarios_model';
        $this->load->model($modelo);
        $result = $this->$modelo->get([
            'activo'    => '1',
            'eliminado' => '0'
        ]);

        $data   = [];

        $data['-1'] = '-- seleccione --';
        foreach($result as $r){
            $data[$r['id_usuario']] = $r['nombre'].' '.$r['paterno'].' '.$r['materno'];
        }

        return $data;
    }

    //-----------------------------------------------------------------------------------------------------------
    public function get_aseguradoras(){
        $modelo = 'aseguradoras_model';
        $this->load->model($modelo);
        $result = $this->$modelo->get([
            'eliminado' => '0'
        ]);

        $data   = [];

        $data['-1'] = '-- seleccione --';
        foreach($result as $r){
            $data[$r['id_aseguradora']] = $r['nombre'];
        }

        return $data;
    }

    //-----------------------------------------------------------------------------------------------------------
    public function get_clientes(){
        $modelo = 'clientes_model';
        $this->load->model($modelo);
        $result = $this->$modelo->get([
            'eliminado' => '0'
        ]);

        $data   = [];

        $data['-1'] = '-- seleccione --';
        foreach($result as $r){
            $data[$r['id_cliente']] = $r['nombre'] .' '. $r['paterno'] .' '. $r['materno'];
        }

        return $data;
    }

    public function get_ajustadores($id_aseguradora){
        $modelo = 'ajustadores_model';
        $this->load->model($modelo);
        $result = $this->$modelo->get([
            'id_aseguradora' => $id_aseguradora,
            'eliminado' => '0'
        ]);


        $data   = [];

        $data['-1'] = '-- seleccione --';
        foreach($result as $r){
            $data[$r['id_ajustador']] = $r['nombre'] .' '. $r['paterno'] .' '. $r['materno'];
        }

        return $data;
    }

    public function get_incidencias(){
        $modelo = 'orden_incidencias_model';
        $this->load->model($modelo);
        $id_orden = $this->input->post('id_orden');

        $result = $this->$modelo->get([
            'orden_incidencias.id_orden' => $id_orden,
            'orden_incidencias.activo'    => '1',
            'orden_incidencias.eliminado' => '0'
        ], 'fecha_incidencia DESC');

        $data   = '';
        foreach($result as $r){
            if(!empty($r['status']) ){
                $data .= '<div class="timeline-block"> <div class="timeline-point success"><i class="pg-settings_small"></i></div><div class="timeline-content"><div class="card social-card share full-width"><div class="card-description"><p class="bold">'.'#'.$r['no_sucesivo'].'<br>'.$r['incidencia'].'</p><div class="via">'.$r['generado_por'].'</div></div></div><div class="event-date"><h6>'.$r['status'].'</h6><small class="fs-12 hint-text">'.$this->functions->fecha_incidencia($r['fecha_incidencia']).'</small></div></div></div>';
            }else{
                $data .= '<div class="timeline-block">';
                if($r['llamada']){
                    $data .= '<div class="timeline-point warning"><i class="pg-telephone"></i></div>';
                }else{
                    $data .= '<div class="timeline-point small"></div>';
                }

                $data .= '<div class="timeline-content"><div class="card social-card share full-width"><div class="card-description"><p class="bold">'.'#'.$r['no_sucesivo'].'<br>'.$r['incidencia'].'</p><div class="via">'.$r['generado_por'].'</div></div></div><div class="event-date">';

                if(!empty($r['status'])){
                    $data .= '<h6>'.$r['status'].'</h6>';
                }

                $data .= '<small class="fs-12 hint-text">'.$this->functions->fecha_incidencia($r['fecha_incidencia']).'</small></div></div></div>';
            }
        }

        $this->output->set_output(json_encode($data));
    }

    public function get_recibos(){
        $modelo = 'orden_recibos_model';
        $this->load->model($modelo);
        $id_orden = $this->input->post('id_orden');

        $result = $this->$modelo->get([
            'orden_recibos.id_orden' => $id_orden,
            'orden_recibos.eliminado' => '0'
        ], 'no_recibo DESC');

        $data   = '<div class="row"><div class="col-6 text-center"><b>No.Recibo</b></div><div class="col-6 text-center"><b>Cantidad</b></div></div>';
        foreach($result as $r){
			$data 	.= '<div class="row">';
	        $data 	.= '<div class="col-6 text-center"><a href="'.base_url('admin/ordenes/mostrar_recibo'.$r['id_recibo']).'">'.$r['no_recibo'].'</a></div>';
	        $data  	.= '<div class="col-6 text-right">$ '.number_format($r['cantidad'], 2).'</div>';
	        $data 	.= '</div>';
        }

        $this->output->set_output(json_encode($data));
    }

    public function mostrar_recibo($id){
        if (!is_null($id)) {
            $modelo = 'orden_recibos_model';
            $this->load->model($modelo);
            $data 	= $this->$modelo->get($id);
            $item   = $data[0];
            $tmp = "tmp/".$item['no_orden'].".pdf";
            if (!file_exists('/'.$tmp)) {
                $this->generar_recibo($item, $tmp);
            }
            $this->load->view('admin/ordenes/mostrar_recibo_view', ['pdf' => '/'.$tmp]);
        }
    }

    public function nuevo_recibo($id_orden){
        $this->load->model(['orden_recibos_model', 'ordenes_model', 'clientes_model']);
        $orden                  = $this->ordenes_model->get(['id_orden' => $id_orden]);
        $cliente                = $this->clientes_model->get(['id_cliente' => $orden[0]['id_cliente']]);
        $data['orden']          = $orden[0];
        $data['cliente']        = $cliente[0];
        $data['no_recibo']      = $this->orden_recibos_model->get_no_recibo();
        $data['HEADER_MODAL']   = 'Nuevo Recibo';
        $data['URL_FORM']       = base_url('apis/admin_api/insert_recibo');
        $this->load->view('admin/ordenes/recibo_view', $data);
    }

    public function mostrar_correos(){
		$modelo = 'correos_model';
        $this->load->model($modelo);
        $data['HEADER_MODAL']   = 'Cuentas de Correo';
        $data['URL_FORM']		= base_url('admin/ordenes/enviar_correo');
        $data['items']			= $this->$modelo->get(['activo' => '1' , 'eliminado' => '0']);
        $data['id_orden']		= $this->input->post('id_orden');
        $this->load->view('admin/ordenes/mostrar_correos_view', $data);
    }

    public function mostrar_comentario($id){
        if (!is_null($id)) {
            $modelo = 'orden_documentos_model';
            $this->load->model($modelo);
            $data['HEADER_MODAL']   = 'Editar Comentario';
            $data['URL_FORM']       = BASE_URL('apis/admin_api/update_documento');
            $data['item']           = $this->$modelo->get($id);
            $this->load->view('admin/ordenes/form_comentario_view', $data);
        }
    }

    public function get_expediente(){
        $modelo = 'orden_expediente_model';
        $this->load->model($modelo);

	    $id_orden 	= $this->input->post('id_orden');

	    $result = $this->$modelo->get([
		    'id_orden'	=> $id_orden,
		    'eliminado' => '0'
	    ], 'fecha_creacion ASC');

	    $exp = '';

	    foreach($result as $r){
    	    $exp .= "<li class='list-group-item'>";
    	    $exp .= "<div class='col-11'>".anchor(base_url(ORDENES_PATH.sha1($r['id_orden']).'/expediente/'.$r['nombre']), $r['nombre'], ['target' => '_blank'])."</div>";
    	    $exp .= "<div class='col-1'>";
    	    $exp .= "<a class='delete-expediente' href='".base_url('apis/admin_api/delete_expediente/'.$r['id_expediente'])."' data-text='".$r['nombre']."' data-id='".$r['id_orden']."'><i class='fa fa-trash' aria-hidden='true'></i></a>";
            $exp .= "</div>";
            $exp .= "</li>";
		}

        $this->output->set_output(json_encode($exp));
        return false;
    }

    public function enviar_correo(){
	   	$correos 	= [];
	    $post 		= $this->input->post(NULL);
	    $id_orden	= $this->input->post('id_orden');
	    $chk_otro   = $this->input->post('chk_otro');
	    if($chk_otro == 'on'){
            $otros = explode(',', trim($this->input->post('otro'),' '));
            foreach($otros as $o){
                $correos[] = $o;
            }
	    }
	    $this->load->model(['correos_model', 'ordenes_model', 'orden_incidencias_model']);
	    $max_i 		= $this->orden_incidencias_model->max(['id_orden'=> $id_orden]);
	    $incidencia = $this->orden_incidencias_model->get($max_i->id_orden_incidencia);


	    foreach($post as $index=>$item){
		    if(substr($index,0, 7) == 'correo_'){
			    $i 			= str_replace('correo_', '', $index);
			    $res 		= $this->correos_model->get(['id_correo' => $i]);
			    $correos[] 	= $res[0]['email'];
		    }
	    }

		$this->load->library('email');

	    $config['protocol']		= 'smtp';
	    $config['smtp_host'] 	= 'smtp.edrav.com.mx';
	    $config['smtp_user']	= 'incidencias@edrav.com.mx';
	    $config['smtp_pass']	= 'inci2018clie--**//';
	    $config['smtp_port']	= '587';
		$config['smtp_timeout'] = 10;
		$config['wordwrap'] 	= TRUE;
		$config['wrapchars'] 	= 76;
		$config['mailtype'] 	= 'html';
		$config['charset'] 		= 'utf-8';
       	$config['validate'] 	= FALSE;
	   	$config['priority'] 	= 3;
	   	$config['crlf'] 		= "\r\n";
	   	$config['newline'] 		= "\r\n";
	    $this->email->initialize($config);

        $this->email->from('incidencias@edrav.com.mx', 'Notificaciones EDRAV');
        //$this->email->bcc('franciscorolon@gmail.com');
        $this->email->cc($correos);

		$this->email->subject('incidencia');
		$this->email->message($this->load->view('admin/emails/incidencias', ['incidencia' => $incidencia[0]], true));

		if ( ! $this->email->send())
		{
			$this->output->set_output(json_encode(array(
                'result' => 0,
                'error' => $this->email->print_debugger()
                //'error' => 'No se pudo enviar el correo electrónico'
            )));
	        return false;
		}

		$this->output->set_output(json_encode(array(
            'result' => 1,
        )));
        return false;
    }

    private function generar_recibo($item, $file){
        $this->load->library('pdf');

        $pdf = new FPDF();
        $pdf->AddFont('Montserrat','','Montserrat-Regular.php');
        $pdf->AddFont('Montserrat','B','Montserrat-Bold.php');
        $pdf->AddPage();
        /* Start Header */
        $pdf->Ln(10);
        $pdf->Image(base_url('assets/img/edrav/logo_documentos.png'), 10 ,18, 50, 0 , "PNG");
        $pdf->Cell(80);
        $pdf->SetFont('Montserrat','B',13);
        $pdf->SetTextColor('122', '137', '148');
        $pdf->Cell(80,10,'RECIBO NO:',0,0,'R');
        $pdf->SetFont('Montserrat','',13);
        $pdf->SetTextColor('255', '0', '0');
        $pdf->Cell(0,10,$item['no_recibo'],0,0,'R');
        $pdf->Ln(10);
        $pdf->Cell(80);
        $pdf->SetFont('Montserrat','B',13);
        $pdf->SetTextColor('122', '137', '148');
        $pdf->Cell(80,10,'FECHA:',0,0,'R');
        $pdf->SetFont('Montserrat','',13);
        $pdf->SetTextColor('122', '137', '148');
        $pdf->Cell(0,10,date('d-m-Y', strtotime($item['fecha'])),0,0,'R');
        if(!is_null($item['no_orden'])){
            $pdf->Ln(10);
            $pdf->Cell(80);
            $pdf->SetFont('Montserrat','B',13);
            $pdf->SetTextColor('122', '137', '148');
            $pdf->Cell(80,10,'NO.ORDEN:',0,0,'R');
            $pdf->SetFont('Montserrat','',13);
            $pdf->SetTextColor('255', '0', '0');
            $pdf->Cell(0,10,$item['no_orden'],0,0,'R');
        }
        /*End Header */
        $pdf->Ln(25);
        $pdf->Cell(10);
        $pdf->SetFont('Montserrat','B',13);
        $pdf->SetTextColor('122', '137', '148');
        $pdf->Cell(50,10,'PLACAS:',0,0,'R');
        $pdf->Cell(5);
        $pdf->SetFont('Montserrat','',13);
        $pdf->SetTextColor('122', '137', '148');
        $pdf->Cell(0,10,(!is_null($item['no_orden']))?$item['no_placas']:' - ',0,0,'L');
        //
        $pdf->Ln(12);
        $pdf->Cell(10);
        $pdf->SetFont('Montserrat','B',13);
        $pdf->SetTextColor('122', '137', '148');
        $pdf->Cell(50,10,'AUTO:',0,0,'R');
        $pdf->Cell(5);
        $pdf->SetFont('Montserrat','',13);
        $pdf->SetTextColor('122', '137', '148');
        $pdf->Cell(0,10,(!is_null($item['no_orden']))?$item['marca'].' - '.$item['tipo']:' - ',0,0,'L');
        $pdf->SetLineWidth('0.1');
        $pdf->setDrawColor('234', '236', '238');
        $pdf->Line(20, 95, 180, 95);
        //
        $pdf->Ln(25);
        $pdf->Cell(10);
        $pdf->SetFont('Montserrat','B',13);
        $pdf->SetTextColor('122', '137', '148');
        $pdf->Cell(50,10,'RECIBIMOS DE:',0,0,'R');
        $pdf->Cell(5);
        $pdf->SetFont('Montserrat','',13);
        $pdf->SetTextColor('122', '137', '148');
        $pdf->Cell(0,10,$item['recibimos_de'],0,0,'L');
        //
        $pdf->Ln(12);
        $pdf->Cell(10);
        $pdf->SetFont('Montserrat','B',13);
        $pdf->SetTextColor('122', '137', '148');
        $pdf->Cell(50,10,'LA CANTIDAD DE:',0,0,'R');
        $pdf->Cell(5);
        $pdf->SetFont('Montserrat','',13);
        $pdf->SetTextColor('122', '137', '148');
        $pdf->Cell(0,10,number_format($item['cantidad'],2).'  ('.NumeroALetras::convertir($item['cantidad'], 'PESOS', 'CENTAVOS', TRUE).')',0,0,'L');
        $pdf->SetLineWidth('0.1');
        $pdf->setDrawColor('234', '236', '238');
        $pdf->Line(20, 130, 180, 130);
        //
        $pdf->Ln(25);
        $pdf->Cell(10);
        $pdf->SetFont('Montserrat','B',13);
        $pdf->SetTextColor('122', '137', '148');
        $pdf->Cell(50,10,'POR CONCEPTO DE:',0,0,'R');
        $pdf->Cell(5);
        $pdf->SetFont('Montserrat','',13);
        $pdf->SetTextColor('122', '137', '148');
        $pdf->Cell(0,10,$item['concepto'],0,0,'L');
        $pdf->SetLineWidth('0.1');
        $pdf->setDrawColor('234', '236', '238');
        $pdf->Line(20, 155, 180, 155);
        //
        $pdf->Ln(25);
        $pdf->Cell(10);
        $pdf->SetFont('Montserrat','B',13);
        $pdf->SetTextColor('122', '137', '148');
        $pdf->Cell(50,10,'FORMA DE PAGO:',0,0,'R');
        $pdf->Cell(5);
        $pdf->SetFont('Montserrat','',13);
        $pdf->SetTextColor('122', '137', '148');
        $pdf->Cell(0,10,$item['forma_pago'],0,0,'L');
        //
        $pdf->Ln(12);
        $pdf->Cell(10);
        $pdf->SetFont('Montserrat','B',13);
        $pdf->SetTextColor('122', '137', '148');
        $pdf->Cell(50,10,'FACTURA:',0,0,'R');
        $pdf->Cell(5);
        $pdf->SetFont('Montserrat','',13);
        $pdf->SetTextColor('122', '137', '148');
        $pdf->Cell(0,10,($item['factura'])?'SI':'NO',0,0,'L');
        $pdf->SetLineWidth('0.1');
        $pdf->setDrawColor('234', '236', '238');
        $pdf->Line(20, 190, 180, 190);

        $pdf->Ln(40);
        $pdf->Cell(70);
        $pdf->SetFont('Montserrat','B',13);
        $pdf->SetTextColor('122', '137', '148');
        $pdf->Cell(50,10,'RECIBE',0,0,'C');
        $pdf->Ln(25);

        $pdf->Cell(70);
        $pdf->SetFont('Montserrat','B',13);
        $pdf->SetTextColor('122', '137', '148');
        $pdf->Cell(50,10,'Servicios Automotrices Edrav S.A. de C.V.',0,0,'C');
        //End Recibo
        $pdf->Output($file, "F");
    }
}
?>