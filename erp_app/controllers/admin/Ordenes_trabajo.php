<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ordenes_trabajo extends ADMIN_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->hdata = [
            'title' => 'Órdenes de Trabajo',
            'breadcumb' => [
                [
                    'url'   => base_url('admin'),
                    'label' => 'Inicio'
                ],
                [
                    'label' => 'Órdenes de Trabajo'
                ]
            ],
            'css' => $this->load->view('admin/assets/css/clientes', '', true),
        ];

        $columns  = '"columns" : [';
        $columns .= '{ className : "v-align-middle text-center" },';
        $columns .= '{ className : "v-align-middle text-center" },';
        $columns .= '{ className : "v-align-middle text-center" },';
        $columns .= '{ className : "v-align-middle text-left" },';
        $columns .= '{ className : "v-align-middle text-left" },';
        $columns .= '{ className : "v-align-middle text-center"},';
        $columns .= '{ className : "v-align-middle text-center"},';
        $columns .= '],';

        $this->js    = [
            'items'     => base_url('admin/ordenes-trabajo/get_datatable'),
            'columns'   => $columns,
        ];

        $js      = $this->load->view('admin/assets/js/datatable', $this->js, true);
        $js     .= $this->load->view('admin/assets/js/clientes', '', true);

        $this->fdata = [
            'js'            => $js,
            'link_active' => ['liOrdenesTrabajo', 'lkOrdenesTrabajo'],
        ];

        $this->data = [
            'txt_agregar'       => 'Nueva Orden de Trabajo',
            'url_agregar'       => base_url('admin/ordenes-trabajo/nueva'),
            'header'            => 'Órdenes de Trabajo',
        ];

        $this->load->view('admin/common/header_view', $this->hdata);
        $this->load->view('admin/ordenes_trabajo/index_view', $this->data);
        $this->load->view('admin/common/footer_view', $this->fdata);
    }

    public function nueva(){
        $this->load->model(['ordenes_model', 'ordenes_trabajo_model', 'servicios_model', 'piezas_model', 'areas_model', 'tipos_model', 'materiales_model']);
        $this->hdata = [
            'title' => 'Órdenes de Trabajo',
            'breadcumb' => [
                [
                    'url'   => base_url('admin/inicio'),
                    'label' => 'Inicio'
                ],
                [
                    'url'   => base_url('admin/ordenes-trabajo'),
                    'label' => 'Ordenes de Trabajo'
                ],
                [
                    'label' => 'Nueva Orden de Trabajo'
                ]
            ],
            'css'   => $this->load->view('admin/assets/css/orden', '', true),
        ];

        $this->data = [
            'url_nueva'         => base_url('apis/admin_api/insert_orden_trabajo'),
            'ordenes'           => $this->get_ordenes(),
            'areas'             => $this->areas_model->get(['activo' => '1', 'eliminado' => '0']),
            'servicios'         => $this->servicios_model->get_dropdown(),
            'piezas'            => $this->piezas_model->get_dropdown(),
            'no_orden_trabajo'  => $this->ordenes_trabajo_model->get_no_orden(),
            'titulo'            => 'Nueva Orden de Trabajo',
        ];

        $this->fdata = [
            'js'            => $this->load->view('admin/assets/js/orden_trabajo', '', true),
            'link_active'   => ['liOrdenesTrabajo'],
        ];

        $this->load->view('admin/common/header_view', $this->hdata);
        $this->load->view('admin/ordenes_trabajo/nueva_view', $this->data);
        $this->load->view('admin/common/footer_view', $this->fdata);
    }

    public function detalle_form(){
        $this->load->model(['servicios_model','categorias_model', 'areas_model', 'tipos_model', 'materiales_model']);
        $data['HEADER_MODAL']       = 'Agregar Detalle';
        $data['URL_FORM']           = base_url('admin/ordenes-trabajo/get_item');
        $data['servicios']          = $this->servicios_model->get_dropdown();
        $data['areas']              = $this->areas_model->get(['activo' => '1', 'eliminado' => '0']);
        $data['categorias']         = $this->categorias_model->get_dropdown();
        $data['tipo_pinturas']      = $this->tipos_model->get_dropdown();
        $data['materiales']         = $this->materiales_model->get_dropdown();
        $this->load->view('admin/ordenes_trabajo/detalle_view', $data);
    }

    public function editar($id){
        $this->load->model(['ordenes_trabajo_model','ordenes_model', 'ordenes_trabajo_detalle_model', 'areas_model', 'detalles_has_areas_model', 'servicios_model', 'piezas_model']);

        $res = $this->ordenes_trabajo_model->get($id);
        $orden_trabajo = $res[0];
        $this->hdata = [
            'title' => 'Ordenes',
            'breadcumb' => [
                [
                    'url'   => base_url('admin/inicio'),
                    'label' => 'Inicio'
                ],
                [
                    'url'   => base_url('admin/ordenes-trabajo'),
                    'label' => 'Ordenes de Trabajo'
                ],
                [
                    'label' => 'Editar Orden de Trabajo'
                ],
                [
                    'label' => '#'.$orden_trabajo['no_orden_trabajo']
                ]

            ],
            'css'   => $this->load->view('admin/assets/css/orden', '', true),
        ];

        $detalles   = $this->ordenes_trabajo_detalle_model->get(['id_orden_trabajo'=>$id]);
        foreach($detalles as &$i){
            $i['areas_detalles']  = $this->detalles_has_areas_model->get(['id_detalle' => $i['id_detalle']]);
        }

        $this->data = [
            'url_nueva'         => base_url('apis/admin_api/insert_orden_trabajo'),
            'ordenes'           => $this->get_ordenes(),
            'servicios'         => $this->servicios_model->get_dropdown(),
            'piezas'            => $this->piezas_model->get_dropdown(),
            'no_orden_trabajo'  => $orden_trabajo['no_orden_trabajo'],
            'titulo'            => 'Editar Orden de Trabajo',
            'orden'             => $this->ordenes_model->get($orden_trabajo['id_orden']),
            'orden_trabajo'     => $orden_trabajo,
            'areas'             => $this->areas_model->get(['activo' => '1', 'eliminado' => '0']),
            'detalles'          => $detalles,
        ];

        $this->fdata = [
            'js'            => $this->load->view('admin/assets/js/orden_trabajo', '', true),
            'link_active'   => ['liOrdenesTrabajo', 'lkOrdenesTrabajo'],
        ];

        $this->load->view('admin/common/header_view', $this->hdata);
        $this->load->view('admin/ordenes_trabajo/editar_view', $this->data);
        $this->load->view('admin/common/footer_view', $this->fdata);
    }

    //-----------------------------------------------------------------------------------------------------------
    public function get_datatable(){
        $modelo = 'ordenes_trabajo_model';
        $this->load->model([$modelo, 'ordenes_model', 'tickets_model']);

        // Datatables Variables
        $draw   = intval($this->input->get("draw"));
        $start  = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $result = $this->$modelo->get([
            'ot.eliminado' => '0'
        ], 'no_orden_trabajo DESC');
        $data   = [];
        $cp     = '';

        foreach($result as $r) {
            $fecha_inicio    = is_null($r['fecha_inicio'])?'-':$r['fecha_inicio'];
            $tcks            = $this->tickets_model->get(['id_orden_trabajo' => $r['id_orden_trabajo']]);
            $checkbox        = form_checkbox('active', 'active', $r['activo'], ['data-url' => base_url('apis/admin_api/update_activo/'.$modelo.'/'.$r['id_orden_trabajo']) , 'class'=> 'chk-update-activo']);

            $operaciones     = '<a class="btn btn-info btn-xs m-b-10" href="'.base_url('admin/ordenes-trabajo/cotizacion/'.$r['id_orden_trabajo']).'"><i class="fa fa-file-text-o"></i> Cotizaciones</a>&nbsp;';
            if(count($tcks) == 0){
                $operaciones    .= '<a class="btn btn-primary btn-xs m-b-10" href="'.base_url('admin/ordenes-trabajo/editar/'.$r['id_orden_trabajo']).'"><i class="fa fa-pencil"></i> Editar</a> ';
            }
            $tickets            = '<a class="btn btn-complete btn-xs m-b-10" href="'.base_url('admin/ordenes-trabajo/tickets/'.$r['id_orden_trabajo']).'"><i class="fa fa-ticket"></i> Tickets</a>';
            $tickets_material   = '<a class="btn btn-warning btn-xs m-b-10" href="'.base_url('admin/ordenes-trabajo/tickets-material/'.$r['id_orden_trabajo']).'"><i class="fa fa-ticket"></i> Tickets Material</a>';
            $data[] = [
                //'id_plant'  => $r->id_plant,
                $checkbox,
                anchor(base_url('admin/ordenes_trabajo/detalle/'.$r['id_orden_trabajo']), $r['no_orden_trabajo'], ['title' => 'Trabajo No.'.$r['no_orden_trabajo'], 'class' => 'btn btn-default btn-xs show-modal-lg']),
                $r['no_orden'],
                $this->functions->fecha_es($r['fecha_creacion']),
                //is_null($r['fecha_modificacion'])?'Sin modificaciones':$r['fecha_modificacion'],
                $tickets,
                $tickets_material,
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

    public function cotizacion($id){
        $this->load->model(['ordenes_model', 'ordenes_trabajo_model', 'proveedores_model', 'ordenes_trabajo_detalle_model']);
        $this->hdata = [
            'title' => 'Órdenes de Trabajo',
            'breadcumb' => [
                [
                    'url'   => base_url('admin/inicio'),
                    'label' => 'Inicio'
                ],
                [
                    'url'   => base_url('admin/ordenes-trabajo'),
                    'label' => 'Ordenes de Trabajo'
                ],
                [
                    'label' => 'Nueva Cotización'
                ]
            ],
            'css'   => $this->load->view('admin/assets/css/orden', '', true),
        ];

        $orden_trabajo = $this->ordenes_trabajo_model->get($id)[0];

        $this->data = [
            'url_nueva'         => base_url('apis/admin_api/insert_cotizacion'),
            'orden_trabajo'     => $orden_trabajo,
            'orden'             => $this->ordenes_model->get($orden_trabajo['id_orden'])[0],
            'detalles_orden'    => $this->ordenes_trabajo_detalle_model->get(['id_orden_trabajo'=>$orden_trabajo['id_orden_trabajo']]),
            'titulo'            => 'Nueva Cotización',
        ];

        $this->fdata = [
            'js'            => $this->load->view('admin/assets/js/orden_trabajo', '', true),
            'link_active'   => ['liOrdenesTrabajo', 'lkOrdenesTrabajo'],
        ];

        $this->load->view('admin/common/header_view', $this->hdata);
        $this->load->view('admin/ordenes_trabajo/cotizaciones/nueva_view', $this->data);
        $this->load->view('admin/common/footer_view', $this->fdata);

    }

    public function tickets($id){
        $this->load->model(['ordenes_model', 'ordenes_trabajo_model', 'proveedores_model', 'ordenes_trabajo_detalle_model', 'areas_model', 'detalles_has_areas_model', 'tickets_model', 'usuarios_model', 'detalles_ticket_model']);
        $this->hdata = [
            'title' => 'Órdenes de Trabajo',
            'breadcumb' => [
                [
                    'url'   => base_url('admin/inicio'),
                    'label' => 'Inicio'
                ],
                [
                    'url'   => base_url('admin/ordenes-trabajo'),
                    'label' => 'Ordenes de Trabajo'
                ],

                [
                    'label' => 'Tickets'
                ]
            ],
            'css'   => $this->load->view('admin/assets/css/orden', '', true),
        ];

        $orden_trabajo  = $this->ordenes_trabajo_model->get($id)[0];
        $areas          = $this->areas_model->get(['activo' => '1']);
        $tickets        = $this->tickets_model->get(['id_orden_trabajo'=>$orden_trabajo['id_orden_trabajo'], 'id_area is NOT NULL']);
        $tickets_ot     = $this->tickets_model->get(['id_orden_trabajo'=>$orden_trabajo['id_orden_trabajo'], 'id_area IS NULL' => NULL]);

        if(count($tickets_ot) == 0){
            $id_ticket = $this->tickets_model->insert([
                'no_ticket'         => $this->tickets_model->get_no_ticket(),
                'tipo_golpe'        => $orden_trabajo['tipo_golpe'],
                'id_area'           => NULL,
                'titulo'            => 'ORDEN DE TRABAJO',
                'id_orden_trabajo'  => $orden_trabajo['id_orden_trabajo'],
                'fecha_inicio'      => NULL,
                'fecha_creacion'    => $this->functions->fecha_actual(),
            ]);

            foreach($areas as $a){
                $detalles = $this->detalles_has_areas_model->get_by_area([['id_area' => $a['id_area']]], $orden_trabajo['id_orden_trabajo']);

                foreach($detalles[$a['id_area']] as $d){
                    $res = $this->detalles_ticket_model->insert([
                        'id_ticket'             => $id_ticket,
                        'aplica_trabajo'        => ($a['tiene_opciones'])?0:1,
                        'trabajo'               => ($a['tiene_opciones'])?NULL:$d['trabajo'],
                        'descripcion'           => $d['pieza_automovil'],
                        'cobertura_pintura'     => ($a['tiene_opciones'])?$d['cobertura_pintura']:NULL,
                        'materiales_especiales' => ($a['tiene_opciones'])?$d['materiales_especiales']:NULL,
                        'comentarios'           => $d['comentarios']
                    ]);
                }
            }

            $id_ticket = $this->tickets_model->insert([
                'no_ticket'         => $this->tickets_model->get_no_ticket(),
                'tipo_golpe'        => $orden_trabajo['tipo_golpe'],
                'id_area'           => NULL,
                'titulo'            => 'ORDEN DE PINTURA',
                'id_orden_trabajo'  => $orden_trabajo['id_orden_trabajo'],
                'fecha_inicio'      => NULL,
                'fecha_creacion'    => $this->functions->fecha_actual(),
            ]);

            foreach($areas as $a){
                $detalles = $this->detalles_has_areas_model->get_by_area([['id_area' => $a['id_area']]], $orden_trabajo['id_orden_trabajo']);

                foreach($detalles[$a['id_area']] as $d){
                    $res = $this->detalles_ticket_model->insert([
                        'id_ticket'             => $id_ticket,
                        'aplica_trabajo'        => ($a['tiene_opciones'])?0:1,
                        'trabajo'               => ($a['tiene_opciones'])?NULL:$d['trabajo'],
                        'descripcion'           => $d['pieza_automovil'],
                        'cobertura_pintura'     => ($a['tiene_opciones'])?$d['cobertura_pintura']:NULL,
                        'materiales_especiales' => ($a['tiene_opciones'])?$d['materiales_especiales']:NULL,
                        'comentarios'           => $d['comentarios']
                    ]);
                }
            }

        }

        $this->data = [
            'areas'             => $areas,
            'orden_trabajo'     => $orden_trabajo,
            'orden'             => $this->ordenes_model->get($orden_trabajo['id_orden'])[0],
            'detalles_by_area'  => $this->detalles_has_areas_model->get_by_area($areas, $orden_trabajo['id_orden_trabajo']),
            'detalles_orden'    => $this->ordenes_trabajo_detalle_model->get(['id_orden_trabajo'=>$orden_trabajo['id_orden_trabajo']]),
            'tickets'           => $this->tickets_model->get(['id_orden_trabajo'=>$orden_trabajo['id_orden_trabajo']]),
            'tickets_ot'        => $tickets_ot,
            'titulo'            => 'Tickets',
        ];

        $this->fdata = [
            'js'            => $this->load->view('admin/assets/js/tickets', '', true),
            'link_active'   => ['liOrdenesTrabajo', 'lkOrdenesTrabajo'],
        ];

        $this->load->view('admin/common/header_view', $this->hdata);
        $this->load->view('admin/ordenes_trabajo/tickets/index_view', $this->data);
        $this->load->view('admin/common/footer_view', $this->fdata);

    }

    public function imprimir_ticket($id){
        if (!is_null($id)) {
            $modelo = 'tickets_model';
            $this->load->model([$modelo, 'detalles_ticket_model', 'ordenes_trabajo_model', 'ordenes_model', 'areas_model', 'usuarios_model', 'aseguradoras_model']);
            $data 	= $this->$modelo->get($id);
            $item   = $data[0];
            $ot     = $this->ordenes_trabajo_model->get($item['id_orden_trabajo']);
            $o      = $this->ordenes_model->get($ot[0]['id_orden']);
            $a                      = $this->areas_model->get($item['id_area']);
            $tecnico                = $this->usuarios_model->get($item['id_tecnico']);
            $guardia                = $this->usuarios_model->get($item['id_guardia']);
            $aseguradora            = $this->aseguradoras_model->get($o[0]['id_aseguradora']);
            $item['orden_trabajo']  = $ot[0];
            $item['orden']          = $o[0];
            $item['area']           = $a[0];
            $item['detalles']       = $this->detalles_ticket_model->get(['id_ticket' => $id]);
            $item['tecnico']        = $tecnico[0];
            $item['guardia']        = $guardia[0];
            $item['aseguradora']    = $aseguradora[0];
            $tmp = "tmp/t_".$item['no_ticket'].".pdf";
            if (!file_exists('/'.$tmp)) {
                $this->generar_ticket($item, $tmp);
            }
            $this->load->view('admin/recibos/mostrar_recibo_view', ['pdf' => '/'.$tmp]);
        }
    }

    public function get_piezas($id){
        $this->load->model('piezas_model');
        $result           = $this->piezas_model->get(['partes_coche.id_categoria_parte'=> $id,'partes_coche.activo'=>1, 'partes_coche.eliminado'=>0]);
        $piezas          = [];
        $piezas['-1']    = '-- Seleccione una Pieza --';
        foreach($result as $o){
            $piezas[$o['id_parte_coche']] = $o['nombre'];
        }

        $output = [
            "items"              => $piezas,
        ];

        $this->output->set_output(json_encode($output));
    }

    public function get_item(){
        $this->load->model(['servicios_model', 'piezas_model', 'tipos_model', 'materiales_model', 'areas_model']);

        $id_trabajo             = $this->input->post('id_trabajo');
        $id_parte_coche         = $this->input->post('id_parte_coche');
        $id_tipo_pintura        = $this->input->post('id_tipo_pintura');
        $id_material_especial   = $this->input->post('id_material_especial');

        if($id_trabajo > 0 && $id_parte_coche > 0){
            $areas = $this->areas_model->get(['activo' => '1', 'eliminado' => '0']);

            /* Validamos si aplica el tipo de pintura */
            if($this->input->post('id_tipo_pintura') == '-1'){
                $tipo_pintura    = form_hidden('id_tipo_pintura[]', NULL).'No Aplica';
            }else{
                $item            = $this->tipos_model->get($id_tipo_pintura);
                $tipo_pintura    = form_hidden('id_tipo_pintura[]', $id_tipo_pintura).''.$item[0]['nombre'];
            }

            /* Validamos si aplica el material Especial */
            if($this->input->post('id_material_especial') == '-1'){
                $material    = form_hidden('id_material_especial[]', NULL).'No Aplica';
            }else{
                $item        = $this->materiales_model->get($id_material_especial);
                $material    = form_hidden('id_material_especial[]', $id_material_especial).''.$item[0]['nombre'];
            }
            $trabajo                        = $this->servicios_model->get($id_trabajo);
            $row['trabajo']                 = form_hidden('id_trabajo[]', $id_trabajo).''.$trabajo[0]['nombre'];
            $parte_auto                     = $this->piezas_model->get($id_parte_coche);
            $row['parte_automovil']        = form_hidden('id_parte_automovil[]', $id_parte_coche).''.$parte_auto[0]['nombre'];
            $aplica_area                    = $this->input->post('area');
            foreach($areas as $a){
                if(array_search($a['id_area'],$aplica_area) !== FALSE){
                    $row[$a['nombre']]  = form_hidden('id_area['.$a['id_area'].'][]', 'TRUE').'<i class="fa fa-check text-primary" aria-hidden="true"></i>';
                }else{
                    $row[$a['nombre']]  = form_hidden('id_area['.$a['id_area'].'][]', 'FALSE').'<i class="fa fa-times text-danger" aria-hidden="true"></i>';
                }
            }
            $row['tipo_pintura']            = $tipo_pintura;
            $row['material_especial']       = $material;
            $row['comentarios']             = $this->input->post('comentarios');
            $row['button']                  = anchor('#', '<i class="fa fa-trash-o" aria-hidden="true"></i>', ['class' => 'btn btn-danger eliminarSimpleRow', 'title'=> '¿Desea realmente eliminar este detalle?']);
            $output = [
                'result'    => 1,
                "items"     => $row,
            ];

            $this->output->set_output(json_encode($output));
        }else{
            $output = [
                'result'    => 0,
                'message'   => 'Se deben complear todos los campos requeridos.'
            ];

            $this->output->set_output(json_encode($output));
        }
    }

    public function detalle($id){
        $this->load->model(['ordenes_trabajo_model','ordenes_model', 'ordenes_trabajo_detalle_model', 'areas_model', 'detalles_has_areas_model']);
        $data['HEADER_MODAL']   = 'Detalle de Orden de Trabajo';
        $data['orden_trabajo']  = $this->ordenes_trabajo_model->get($id);
        $data['orden']          = $this->ordenes_model->get($data['orden_trabajo'][0]['id_orden']);
        $data['areas']          = $this->areas_model->get(['activo' => '1', 'eliminado' => '0']);
        $data['detalles']       = $this->ordenes_trabajo_detalle_model->get(['id_orden_trabajo'=>$id]);
        foreach($data['detalles'] as &$i){
            $i['areas_detalles']  = $this->detalles_has_areas_model->get(['id_detalle' => $i['id_detalle']]);
        }
        $this->load->view('admin/ordenes_trabajo/show_view', $data);
    }

    public function mostrar_detalle_cotizacion($id){
        $data['HEADER_MODAL']   = 'Agregar Detalle';
        $data['URL_FORM']       = base_url('admin/ordenes-trabajo/agregar_detalle');
        $this->load->view('admin/ordenes_trabajo/cotizaciones/form_view', $data);
    }

    public function asignar_ticket($id_orden_trabajo, $id_area){
        $this->load->model(['usuarios_model', 'ordenes_trabajo_model']);
        $orden_trabajo              = $this->ordenes_trabajo_model->get($id_orden_trabajo);
        $data['HEADER_MODAL']       = 'Asignar Ticket';
        $data['URL_FORM']           = base_url('apis/admin_api/insertar_ticket');
        $data['id_orden_trabajo']   = $id_orden_trabajo;
        $data['id_area']            = $id_area;
        $data['tipo_golpe']         = $orden_trabajo[0]['tipo_golpe'];
        $data['tecnicos']           = $this->usuarios_model->get_by_group('11');
        $data['guardias']           = $this->usuarios_model->get_by_group('10');
        $this->load->view('admin/ordenes_trabajo/tickets/form_view', $data);
    }

    public function cerrar_ticket($id_ticket){
        $this->load->model(['tickets_model']);
        $data['HEADER_MODAL']   = 'Cerrar Ticket';
        $data['URL_FORM']       = base_url('apis/admin_api/editar_ticket');
        $data['item']           = $this->tickets_model->get($id_ticket);
        $this->load->view('admin/ordenes_trabajo/tickets/cerrar_view', $data);
    }

    public function get_ticket($id_ticket){
        $this->load->model(['areas_model','tickets_model', 'usuarios_model', 'detalles_ticket_model']);

        $ticket = $this->tickets_model->get($id_ticket);
        $area   = $this->areas_model->get($ticket[0]['id_area']);
        $tmp_g          = $this->usuarios_model->get($ticket[0]['id_guardia']);
        $tmp_t          = $this->usuarios_model->get($ticket[0]['id_tecnico']);
        $s_ticket = '<div class="card-body"><div class="row"><div class="col-md-5"><h3>'.$area[0]['nombre'].'</h3></div><div class="col-md-7 text-right">';
        if(!empty($ticket[0]['fecha_fin'])){
            $s_ticket .= '<div class="m-t-20"><span class="label label-inverse">Ticket Finalizado</span></div>';
        }else{
            $s_ticket .= '<a href="'.base_url('admin/ordenes-trabajo/cerrar_ticket/'.$ticket[0]['id_ticket']).'" class="btn btn-danger btn-xs m-t-10 show-modal"><i class="fa fa-times-circle" aria-hidden="true"></i> Cerrar Ticket</a>';
            $s_ticket .= ' <a href="'.base_url('admin/ordenes-trabajo/imprimir_ticket/'.$ticket[0]['id_ticket']).'" class="btn btn-primary btn-xs m-t-10 show-modal-lg"><i class="fa fa-print" aria-hidden="true"></i> Imprimir Ticket</a>';
        }
        $s_ticket .= '</div></div>';
        $s_ticket .= '<div class="row"><div class="col-md-5"><strong>No.Ticket</strong></div><div class="col-md-7 text-right">'.$ticket[0]['no_ticket'].'</div></div>';
        $s_ticket .= '<div class="row"><div class="col-md-5"><strong>Tipo de Golpe</strong></div><div class="col-md-7 text-right">'.$ticket[0]['tipo_golpe'].'</div></div>';
        $s_ticket .= '<div class="row"><div class="col-md-5"><strong>Guardia</strong></div><div class="col-md-7 text-right">'.$tmp_g[0]['nombre'].' '.$tmp_g[0]['paterno'].' '.$tmp_g[0]['materno'].'</div></div>';
        $s_ticket .= '<div class="row"><div class="col-md-5"><strong>Técnico</strong></div><div class="col-md-7 text-right">'.$tmp_t[0]['nombre'].' '.$tmp_t[0]['paterno'].' '.$tmp_t[0]['materno'].'</div></div>';
        $s_ticket .= '<div class="row"><div class="col-md-5"><strong>Fecha de Inicio</strong></div><div class="col-md-7 text-right">';
        if(!empty($ticket[0]['fecha_inicio'])){
            $s_ticket .= $this->functions->fecha_es($ticket[0]['fecha_inicio']);
        }else{
            $s_ticket .= '- Sin Definir -';
        }
        $s_ticket .= '</div></div>';
        $s_ticket .= '<div class="row"><div class="col-md-5"><strong>Fecha Termino</strong></div><div class="col-md-7 text-right">';
        if(!empty($ticket[0]['fecha_fin'])){
            $s_ticket .= $this->functions->fecha_es($ticket[0]['fecha_fin']);
        }else{
            $s_ticket .= '- Sin Definir -';
        }
        $s_ticket .= '</div></div>';
        $s_ticket .= '<div class="row m-t-20">';
        if($area[0]['tiene_opciones']){
            $s_ticket .= '<div class="col-md-4"><strong>Descripción</strong></div>';
            $s_ticket .= '<div class="col-md-4 text-center"><strong>Cobertura Pintura</strong></div>';
            $s_ticket .= '<div class="col-md-4 text-center"><strong>Materiales Especiales</strong></div>';
        }else{
            $s_ticket .= '<div class="col-md-5"><strong>Trabajo</strong></div>';
            $s_ticket .= '<div class="col-md-7"><strong>Descripción</strong></div>';
        }
        $s_ticket .= '</div>';

        $detalles_ticket = $this->detalles_ticket_model->get(['id_ticket' => $ticket[0]['id_ticket']]);
        foreach($detalles_ticket as $dt){
            $s_ticket .= '<div class="row">';
            if($dt['aplica_trabajo']){
                $s_ticket .= '<div class="col-md-5">'.$dt['trabajo'].'</div>';
                $s_ticket .= '<div class="col-md-7">'.$dt['descripcion'].'</div>';
            }else{
                $s_ticket .= '<div class="col-md-4">'.$dt['descripcion'].'</div>';
                $s_ticket .= '<div class="col-md-4 text-center">'.$dt['cobertura_pintura'].'</div>';
                $s_ticket .= '<div class="col-md-4">'.$dt['materiales_especiales'].'</div>';
            }
        }
        $s_ticket .= '</div></div>';

        $output = [
            'result'        => 1,
            'id_area'       => $area[0]['id_area'],
            "string_ticket" => $s_ticket,
        ];

        $this->output->set_output(json_encode($output));
    }

    /* Mejorar y ordenar por no_orden*/
    private function get_ordenes(){
        $this->load->model('ordenes_model');
        $result           = $this->ordenes_model->get(['ordenes.activo'=>1, 'ordenes.eliminado'=>0]);
        $ordenes          = [];
        $ordenes['-1']    = '-- Seleccione una Orden --';
        foreach($result as $o){
            $ordenes[$o['id_orden']] = '#'.$o['no_orden'];
        }

        return $ordenes;
    }


    private function generar_ticket($item, $file){
        $this->load->library('pdf');

        $pdf = new FPDF($orientation='P',$unit='mm', array(80,350)); //45,350
        $pdf->AddFont('Montserrat','','Montserrat-Regular.php');
        $pdf->AddFont('Montserrat','B','Montserrat-Bold.php');
        $pdf->AddPage();
        /* Start Header */
        $pdf->Ln(10);
        $pdf->Image(base_url('assets/img/edrav/logo_documentos.png'), 22 ,2, 40, 0 , "PNG");
        $pdf->SetFont('Montserrat','B',13);
        //$pdf->SetTextColor('122', '137', '148');
        $pdf->Cell(0,10,'ORDEN',0,0,'C');
        $pdf->SetFont('Montserrat','',13);
        //$pdf->SetTextColor('255', '0', '0');
        $pdf->Ln(5);
        $pdf->Cell(0,10,$item['orden']['no_orden'],0,0,'C');
        $pdf->Ln(10);
        //Logo aseguradora
        if($item['aseguradora']['id_aseguradora'] != '8'){
            $img = $item['aseguradora']['logo'];
            $ext = explode('.',$img);
        $pdf->Image(base_url(ASEGURADORAS_FOLDER.$img), 22 ,32, 40, 0 , $ext[1]);
        $pdf->Ln(14);
        }
        $pdf->SetFont('Montserrat','B',8);
        $pdf->Cell(0,10,$item['orden']['marca'],0,0,'C');
        $pdf->Ln(3);
        $pdf->SetFont('Montserrat','',8);
        $pdf->Cell(0,10,$item['orden']['tipo'],0,0,'C');
        $pdf->Ln(3);
        $pdf->SetFont('Montserrat','',8);
        $pdf->Cell(0,10,$item['orden']['modelo'],0,0,'C');
        $pdf->Ln(3);
        $pdf->SetFont('Montserrat','',8);
        $pdf->Cell(0,10,$item['orden']['color'],0,0,'C');
        $pdf->Ln(3);
        $pdf->SetFont('Montserrat','',8);
        $pdf->Cell(0,10,$item['orden']['no_placas'],0,0,'C');
        $pdf->Ln(3);
        $pdf->SetFont('Montserrat','',8);
        $pdf->Cell(0,10,$item['orden']['no_serie'],0,0,'C');
        /*End Header */
        /* Start Body */
        $pdf->Ln(6);
        $pdf->SetFont('Montserrat','',10);
        $pdf->Cell(0,10,'ORDEN DE TRABAJO',0,0,'C');
        $pdf->SetFont('Montserrat','',10);
        $pdf->Ln(4);
        $pdf->Cell(0,10,$item['orden_trabajo']['no_orden_trabajo'],0,0,'C');

        $pdf->Ln(8);
        $pdf->SetFont('Montserrat','',8);
        $pdf->Cell(30,4,'TIPO DE GOLPE',0,0,'L');
        $pdf->SetFont('Montserrat','B',8);
        $pdf->Cell(30,4,$item['tipo_golpe'],0,0,'R');
        $pdf->Ln(5);
        $pdf->SetFont('Montserrat','',8);
        $pdf->Cell(30,4,'AREA',0,0,'L');
        $pdf->SetFont('Montserrat','B',8);
        $pdf->Cell(30,4,$item['area']['nombre'],0,0,'R');
        $pdf->Ln(5);
        $pdf->SetFont('Montserrat','',8);
        $pdf->Cell(30,4,'TECNICO',0,0,'L');
        $pdf->SetFont('Montserrat','B',8);
        $pdf->Cell(30,4, $item['tecnico']['materno'],0,0,'R');


        $pdf->Ln(5);
        $pdf->SetFont('Montserrat','',8);
        $pdf->Cell(30,4,'FECHA DE INICIO',0,0,'L');
        $pdf->SetFont('Montserrat','B',8);
        $pdf->Cell(30,4,$item['fecha_inicio'],0,0,'R');
        //
        $pdf->Ln(8);
        $pdf->SetFont('Montserrat','',8);
        $pdf->Cell(0,4, strtoupper($this->functions->sanear_string($item['area']['nombre'])),'TB',0,'C');
        /* End Body*/



        /* Start Footer */
        $pdf->Ln(40);
        $pdf->SetFont('Montserrat','B',8);
        $pdf->Cell(0,10,'FIRMA DEL SUPERVISOR','T',0,'C');

        $pdf->Ln(10);
        $pdf->SetFont('Montserrat','B',8);
        $pdf->SetTextColor('122', '137', '148');
        $pdf->Cell(0,10,'Servicios Automotrices Edrav S.A. de C.V.',0,0,'C');
        //End Recibo
        $pdf->Output($file, "F");
    }

}

?>
