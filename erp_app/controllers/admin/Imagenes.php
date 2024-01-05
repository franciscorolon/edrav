<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Imagenes extends ADMIN_Controller {

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
        $columns .= '{ className : "v-align-middle text-left" },';
        $columns .= '{ className : "v-align-middle text-left" },';
        $columns .= '{ className : "v-align-middle text-right" },';
        $columns .= '{ className : "v-align-middle text-center"},';
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
            'header'        => 'Recibos',
        ];

        $this->load->view('admin/common/header_view', $this->hdata);
        $this->load->view('admin/recibos/index_view', $this->data);
        $this->load->view('admin/common/footer_view', $this->fdata);
    }

    public function mostrar_form($id, $folder){
        if (!is_null($id)) {
            $modelo = 'orden_documentos_model';
            $this->load->model($modelo);
            $data['URL_FORM']        = base_url('apis/admin_api/upload_images/'.$folder.'/'.$id);
            $data['items']           = $this->$modelo->get(['id_orden'=>$id, 'carpeta'=>$folder, 'eliminado' => '0'], 'orden ASC');
			$this->load->view('admin/imagenes/folder_view', $data);
		}
		return false;
    }

    public function get_grid(){
	    $modelo = 'orden_documentos_model';
        $this->load->model($modelo);

	    $id_orden 	= $this->input->post('id_orden');
	    $folder		= $this->input->post('folder');

	    $result = $this->$modelo->get([
		    'id_orden'	=> $id_orden,
		    'carpeta'	=> $folder,
		    'eliminado' => '0'
	    ], 'orden ASC');

	    $img = '';

	    $chunk = array_chunk($result,6);

	    foreach($chunk as $c){
            $img .= "<div class='row m-b-20'>";
            foreach($c as $i){
                $img .= "<div class='col-2 image'>";
                $img .= "<a class='select-image'>";
                $img .= "<img class='img-fluid mx-auto d-block' src='".base_url(ORDENES_PATH.sha1($i['id_orden']).'/imagenes/'.$i['carpeta'].'/'.$i['nombre'])."' />";
                $img .= "<div class='select-image-wrap' data-id='".$i['id_documento']."'><img class='img-fluid' src='".base_url('assets/img/icons/blue_check_32.png')."' /></div>";
                $img .= "</a>";
                $img .= "<a class='fancy-image' data-fancybox='gallery' href='".base_url(ORDENES_PATH.sha1($i['id_orden']).'/imagenes/'.$i['carpeta'].'/'.$i['nombre'])."' data-caption='".$i['comentario']."' data-id='".$i['id_documento']."'>";
                $img .= "<img class='img-fluid mx-auto d-block' src='".base_url(ORDENES_PATH.sha1($i['id_orden']).'/imagenes/'.$i['carpeta'].'/'.$i['nombre'])."' />";
                $img .= "</a>";
                $img .="</div>";
            }
            $img .= "</div>";
        }

        $this->output->set_output(json_encode($img));
        return false;

    }

    //-----------------------------------------------------------------------------------------------------------

}
?>