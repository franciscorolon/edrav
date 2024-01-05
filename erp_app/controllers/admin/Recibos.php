<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Recibos extends ADMIN_Controller {

    //-----------------------------------------------------------------------------------------------------------
    public function index() {
        $this->hdata = [
            'title' => 'Recibos',
            'breadcumb' => [
                [
                    'url'   => base_url('admin'),
                    'label' => 'Inicio'
                ],
                [
                    'label' => 'Recibos'
                ]
            ],
            //'css' => $this->load->view('admin/assets/css/clientes', '', true),
        ];

        $columns  = '"columns" : [';
        $columns .= '{ className : "v-align-middle text-center" },';
        $columns .= '{ className : "v-align-middle text-center" },';
        $columns .= '{ className : "v-align-middle text-center" },';
        $columns .= '{ className : "v-align-middle text-left" },';
        $columns .= '{ className : "v-align-middle text-left" },';
        $columns .= '{ className : "v-align-middle text-right" },';
        $columns .= '{ className : "v-align-middle text-center"},';
        if (!$this->session->userdata('id_usuario') || ($this->session->userdata('id_grupo') == SUPER_ADMINISTRADOR) ){
        $columns .= '{ className : "v-align-middle text-center"},';
        }
        $columns .= '],';

        $this->js    = [
            'items'     => base_url('admin/recibos/get_datatable'),
            'columns'   => $columns,
        ];

        $js      = $this->load->view('admin/assets/js/datatable', $this->js, true);
        $js     .= $this->load->view('admin/assets/js/recibos', '', true);

        $this->fdata = [
            'js'            => $js,
            'link_active' => ['liRecibos'],
        ];

        $this->data = [
            'url_agregar'   => base_url('admin/recibos/mostrar_form'),
            'header'        => 'Recibos',
        ];

        $this->load->view('admin/common/header_view', $this->hdata);
        $this->load->view('admin/recibos/index_view', $this->data);
        $this->load->view('admin/common/footer_view', $this->fdata);
    }

    public function mostrar_form(){
        $this->load->model(['orden_recibos_model']);
        $data['no_recibo']      = $this->orden_recibos_model->get_no_recibo();
        $data['HEADER_MODAL']   = 'Nuevo Recibo';
        $data['ordenes']        = $this->get_ordenes();
        $data['URL_FORM']       = base_url('apis/admin_api/insert_recibo');
        $this->load->view('admin/recibos/form_view', $data);
    }

    //-----------------------------------------------------------------------------------------------------------

    public function get_datatable(){
        $modelo = 'orden_recibos_model';
        $this->load->model($modelo);

        // Datatables Variables
        $draw   = intval($this->input->get("draw"));
        $start  = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $result = $this->$modelo->get([
            'orden_recibos.eliminado' => '0'
        ], 'no_recibo ASC');

        $data   = [];
        $cp     = '';

        foreach($result as $r) {
            $data[] = [
                ($r['cancelado'])?'<i class="fa fa-ban"></i>':'',
                anchor(base_url('admin/recibos/mostrar_recibo/'.$r['id_recibo']), $r['no_recibo'], ['class' => 'show-modal-lg']),
                is_null($r['no_orden'])?'-':$r['no_orden'],
                date('d-m-Y', strtotime($r['fecha'])),
                $r['forma_pago'],
                '$ '.number_format($r['cantidad'],2),
                ($r['factura'])?'Si':'No',
                (!$this->session->userdata('id_usuario') || ($this->session->userdata('id_grupo') == SUPER_ADMINISTRADOR) )?
                ($r['cancelado'])?'':anchor(base_url('apis/admin_api/cancel_recibo/'.$r['id_recibo']), '<i class="fa fa-ban"></i> Cancelar', ['class' => 'btn btn-info btn-xs m-b-10 cancel','data-text' => 'recibo']):'',
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
            $this->load->view('admin/recibos/mostrar_recibo_view', ['pdf' => '/'.$tmp]);
        }
    }

    //-----------------------------------------------------------------------------------------------------------
    public function get_items(){
        $modelo = 'clientes_model';
        $this->load->model($modelo);
        $result = $this->$modelo->get([
            'eliminado' => '0'
        ]);

        $data   = [];

        foreach($result as $r){
            $data[$r['id_cliente']] = $r['nombre'] .' '. $r['paterno'] .' '. $r['materno'];
        }

        $output = [
            "data" => $data,
        ];

        $this->output->set_output(json_encode($output));
        return false;
    }


    //-----------------------------------------------------------------------------------------------------------
    public function get_ordenes(){
        $modelo = 'ordenes_model';
        $this->load->model($modelo);
        $result = $this->$modelo->get([
            'ordenes.eliminado' => '0'
        ], 'ordenes.no_orden');

        $data   = [];

        $data['-1'] = 'Sin orden';
        foreach($result as $r){
            $data[$r['id_orden']] = $r['no_orden'];
        }

        return $data;
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