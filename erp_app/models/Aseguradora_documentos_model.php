<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Aseguradora_documentos_model extends MY_model {

    protected $table = 'aseguradora_documentos';
    protected $primary_key = 'id_documento';

    public function __construct() {
        parent::__construct();
    }
}
?>