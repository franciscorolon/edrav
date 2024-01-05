<?php

class Admin_api extends ADMIN_Controller {

	protected $archivos = [
        'volante'                   => 'volante',
        'poliza'                    => 'póliza',
        'identificacion'            => 'identificación',
        'tarjeta_circulacion'       => 'tarjeta de circulación',
        'valor_comercial'           => 'valor comercial',
        'diagnostico'               => 'diagnóstico',
        'preexistente'				=> 'preexistente',
        'vale'                      => 'vale',
        'vo_bo'                     => 'Vo.Bo. Reparación',
        'orden_trabajo'             => 'Orden de Trabajo',
        'orden_pintura'             => 'Orden de Pintura',
        'desglose_danos'            => 'Desglose de Daños',
        'valuacion_inicial'         => 'Valuación Inicial',
        'valuacion_autorizada'      => 'Valuación Autorizada',
        'piezas_autorizadas'        => 'Piezas Autorizadas',
        'cotizacion_particular'     => 'Cotización Particular',
        'inventario'				=> 'Inventario'
    ];

    protected $archivos_checklist = [
        'checklist_1' => 'Alineación Inicial',
        'checklist_2' => 'Alineación Final',
        'checklist_3' => 'Termino de laminación',
        'checklist_4' => 'Termino de pintura',
        'checklist_5' => 'Checklist Final',
    ];

    function __construct() {
        parent::__construct();
        if( ! ini_get('date.timezone') )
        {
           date_default_timezone_set('America/Mexico_City');
        }

        $this->load->model(['ordenes_model']);
    }

    //----------------------------------------------------------------------------------------------------------------------------
    // USUARIOS
    //----------------------------------------------------------------------------------------------------------------------------
    function insert_usuario() {
        //Validacion de Form
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');
        $this->form_validation->set_rules('paterno', 'Paterno', 'trim|required');
        $this->form_validation->set_rules('materno', 'Materno', 'trim|required');
        $this->form_validation->set_rules('usuario', 'Usuario', 'trim|required');
        $this->form_validation->set_rules('correo', 'Correo', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Contraseña', 'trim|required|matches[confirmar_password]');
        $this->form_validation->set_rules('confirmar_password', 'Confirmar contraseña', 'trim|required');
        $this->form_validation->set_rules('id_grupo', 'tipo', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->output->set_output(json_encode(array(
                'result' => 0,
                'error' => $this->form_validation->error_array()
            )));
            return false;
        }

        //Validación del usuario único
        $this->load->model('usuarios_model');
        $USUARIO = $this->usuarios_model->get(array(
            'usuario'   => $this->input->post('usuario'),
            'eliminado' => 0
        ));
        if ($USUARIO) {
            $this->output->set_output(json_encode(array(
                'result' => 0,
                'error' => 'Lo sentimos el nombre de usuario ya se encuentra registrado en el sistema'
            )));
            return false;
        }

        $result = $this->usuarios_model->insert(array(
            'usuario'           => $this->input->post('usuario'),
            'nombre'            => $this->input->post('nombre'),
            'paterno'           => $this->input->post('paterno'),
            'materno'           => $this->input->post('materno'),
            'correo'            => $this->input->post('correo'),
            'password'          => sha1($this->input->post('password')),
            'sexo'              => $this->input->post('sexo'),
            'id_grupo'          => $this->input->post('id_grupo'),
            'fecha_creacion'    => $this->functions->fecha_actual(),
            'creado_por'        => $this->usuario_actual
        ));
        if ($result) {
            $this->output->set_output(json_encode(array(
                'result' => 1
            )));
            return false;
        }
        $this->output->set_output(json_encode(array(
            'result' => 0,
            'error' => 'Lo sentimos el usuario ya tiene relacionada una cuenta'
        )));
        return false;
    }

    //---------------------------------------------------------------------------------------------------------------------------------
    function update_usuario() {

        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');
        $this->form_validation->set_rules('paterno', 'Paterno', 'trim|required');
        $this->form_validation->set_rules('materno', 'Materno', 'trim|required');
        $this->form_validation->set_rules('usuario', 'Usuario', 'trim|required');
        $this->form_validation->set_rules('correo', 'Correo', 'trim|required|valid_email');
        if(!is_null($this->input->post('password'))){
            $this->form_validation->set_rules('password', 'Contraseña', 'trim|matches[confirmar_password]');
            $this->form_validation->set_rules('confirmar_password', 'Confirmar contraseña', 'trim');
        }
        $this->form_validation->set_rules('id_grupo', 'Tipo de Usuario', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->output->set_output(json_encode(array(
                'result' => 0,
                'error' => $this->form_validation->error_array()
            )));
            return false;
        }

        //Validación del usuario único
        $this->load->model('usuarios_model');
        $usuario = $this->usuarios_model->get(array(
            'usuario'       => $this->input->post('usuario'),
            'id_usuario <>' => $this->input->post('id'),
            'eliminado'     => 0
        ));

        if (!empty($usuario)) {
            $this->output->set_output(json_encode(array(
                'result' => 0,
                'error' => 'Lo sentimos el nombre de usuario ya se encuentra registrado en el sistema'
            )));
            return false;
        }
        $sql = [
            'nombre'                => $this->input->post('nombre'),
            'paterno'               => $this->input->post('paterno'),
            'materno'               => $this->input->post('materno'),
            'usuario'               => $this->input->post('usuario'),
            'correo'                => $this->input->post('correo'),
            'id_grupo'              => $this->input->post('id_grupo'),
            'sexo'                  => $this->input->post('sexo'),
            'modificado_por'        => $this->usuario_actual,
            'fecha_modificacion'    => $this->functions->fecha_actual(),
        ];

        if(!is_null($this->input->post('password')) && !empty($this->input->post('password'))){
            $sql['password'] = sha1($this->input->post('password'));
        }

        $this->usuarios_model->update($sql, $this->input->post('id'));
        $this->output->set_output(json_encode(array(
            'result' => 1
        )));
    }

    //-----------------------------------------------------------------------------------------------------------------------------------
    // Sucursales
    //-----------------------------------------------------------------------------------------------------------------------------------
    function insert_sucursal(){
        //Validacion de Form
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');
        $this->form_validation->set_rules('calle', 'Calle', 'trim|required');
        $this->form_validation->set_rules('no_ext', 'No. Exterior', 'trim|required');
        $this->form_validation->set_rules('colonia', 'Colonia', 'trim|required');
        $this->form_validation->set_rules('municipio', 'Municipio', 'trim|required');
        $this->form_validation->set_rules('estado', 'estado', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->output->set_output(json_encode(array(
                'result' => 0,
                'error' => $this->form_validation->error_array()
            )));
            return false;
        }

        //Validación del correo único
        $this->load->model('sucursales_model');

        $result = $this->sucursales_model->insert(array(
            'nombre'            => $this->input->post('nombre'),
            'descripcion'       => $this->input->post('descripcion'),
            'telefono'          => $this->input->post('telefono'),
            'calle'             => $this->input->post('calle'),
            'no_ext'            => $this->input->post('no_ext'),
            'no_int'            => $this->input->post('no_int'),
            'colonia'           => $this->input->post('colonia'),
            'cp'                => $this->input->post('cp'),
            'municipio'         => $this->input->post('municipio'),
            'estado'            => $this->input->post('estado'),
            'fecha_creacion' => $this->functions->fecha_actual(),
            'creado_por' => $this->usuario_actual
        ));
        if ($result) {
            $this->output->set_output(json_encode(array(
                'result' => 1
            )));
            return false;
        }
        return false;
    }

    function update_sucursal(){
        //Validacion de Form
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');
        $this->form_validation->set_rules('calle', 'Calle', 'trim|required');
        $this->form_validation->set_rules('no_ext', 'No. Exterior', 'trim|required');
        $this->form_validation->set_rules('colonia', 'Colonia', 'trim|required');
        $this->form_validation->set_rules('municipio', 'Municipio', 'trim|required');
        $this->form_validation->set_rules('estado', 'estado', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->output->set_output(json_encode(array(
                'result' => 0,
                'error' => $this->form_validation->error_array()
            )));
            return false;
        }

        //Validación del correo único
        $this->load->model('sucursales_model');

        $data = [
            'nombre'            => $this->input->post('nombre'),
            'descripcion'       => $this->input->post('descripcion'),
            'telefono'          => $this->input->post('telefono'),
            'calle'             => $this->input->post('calle'),
            'no_ext'            => $this->input->post('no_ext'),
            'no_int'            => $this->input->post('no_int'),
            'colonia'           => $this->input->post('colonia'),
            'cp'                => $this->input->post('cp'),
            'municipio'         => $this->input->post('municipio'),
            'estado'            => $this->input->post('estado'),
            'modificado_por'    => $this->usuario_actual
        ];

        $this->sucursales_model->update($data, $this->input->post('id'));
        $this->output->set_output(json_encode(array(
            'result' => 1
        )));
    }

    function delete_sucursal($id = NULL){
        $this->load->model('sucursales_model');
        $data = [
            'eliminado'         => '1',
            'fecha_eliminacion' => $this->functions->fecha_actual(),
            'eliminado_por'     => $this->usuario_actual
        ];
        $this->sucursales_model->update($data, $id);
        $this->output->set_output(json_encode(array(
            'result' => 1
        )));
        return false;
    }

    //-----------------------------------------------------------------------------------------------------------------------------------
    // Clientes
    //-----------------------------------------------------------------------------------------------------------------------------------

    function insert_cliente(){
        //Validacion de Form
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');
        if(is_null($this->input->post('empresa'))){
            $this->form_validation->set_rules('paterno', 'Paterno', 'trim|required');
            $this->form_validation->set_rules('materno', 'Materno', 'trim|required');
        }
        $this->form_validation->set_rules('celular', 'Celular', 'trim|required');
        $this->form_validation->set_rules('email', 'Correo Electrónico', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->output->set_output(json_encode(array(
                'result' => 0,
                'error' => $this->form_validation->error_array()
            )));
            return false;
        }

        //Validación del correo único
        $this->load->model('clientes_model');
        $no_cliente = $this->clientes_model->get_no_cliente();
        $empresa    = !is_null($this->input->post('empresa'))?'1':'0';
        $paterno    = !is_null($this->input->post('paterno'))?$this->input->post('paterno'):'';
        $materno    = !is_null($this->input->post('materno'))?$this->input->post('materno'):'';
        $date        = explode('/',$this->input->post('fecha_nacimiento'));
        $fecha        = date('Y-m-d', strtotime($date[2].'-'.$date[1].'-'.$date[0]));

        $result = $this->clientes_model->insert(array(
            'empresa'            => $empresa,
            'nombre'            => $this->input->post('nombre'),
            'paterno'           => $paterno,
            'materno'           => $materno,
            'telefono_1'        => $this->input->post('telefono_1'),
            'telefono_2'        => $this->input->post('telefono_2'),
            'celular'           => $this->input->post('celular'),
            'email'             => $this->input->post('email'),
            'fecha_nacimiento'  => $fecha,
            'no_cliente'        => $no_cliente,
            'fecha_creacion'    => $this->functions->fecha_actual(),
            'creado_por'        => $this->usuario_actual
        ));
        if ($result) {
            $this->output->set_output(json_encode(array(
                'result' => 1
            )));
            return false;
        }
        return false;
    }


    function update_cliente(){
        //Validacion de Form
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');
        if(is_null($this->input->post('empresa'))){
            $this->form_validation->set_rules('paterno', 'Paterno', 'trim|required');
            $this->form_validation->set_rules('materno', 'Materno', 'trim|required');
        }
        $this->form_validation->set_rules('celular', 'Celular', 'trim|required');
        $this->form_validation->set_rules('email', 'Correo Electrónico', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->output->set_output(json_encode(array(
                'result' => 0,
                'error' => $this->form_validation->error_array()
            )));
            return false;
        }

        //Validación del correo único
        $this->load->model('clientes_model');

        $empresa    = !is_null($this->input->post('empresa'))?'1':'0';
        $paterno    = !is_null($this->input->post('paterno'))?$this->input->post('paterno'):'';
        $materno    = !is_null($this->input->post('materno'))?$this->input->post('materno'):'';
        $date        = explode('/',$this->input->post('fecha_nacimiento'));
        $fecha        = date('Y-m-d', strtotime($date[2].'-'.$date[1].'-'.$date[0]));

        $data = [
            'empresa'            => $empresa,
            'nombre'            => $this->input->post('nombre'),
            'paterno'           => $paterno,
            'materno'           => $materno,
            'telefono_1'        => $this->input->post('telefono_1'),
            'telefono_2'        => $this->input->post('telefono_2'),
            'celular'           => $this->input->post('celular'),
            'email'             => $this->input->post('email'),
            'fecha_nacimiento'  => $fecha,
            'modificado_por'    => $this->usuario_actual
        ];

        $this->clientes_model->update($data, $this->input->post('id'));
        $this->output->set_output(json_encode(array(
            'result' => 1
        )));
    }

    function delete_cliente($id = NULL){
        $this->load->model('clientes_model');
        $data = [
            'eliminado'         => '1',
            'fecha_eliminacion' => $this->functions->fecha_actual(),
            'eliminado_por'     => $this->usuario_actual
        ];
        $this->clientes_model->update($data, $id);
        $this->output->set_output(json_encode(array(
            'result' => 1
        )));
        return false;
    }

    //-----------------------------------------------------------------------------------------------------------------------------------
    // Aseguradora
    //-----------------------------------------------------------------------------------------------------------------------------------
    function insert_aseguradora(){
        //Validacion de Form
        $this->form_validation->set_rules('razon_social', 'Razón Social', 'trim|required');
        $this->form_validation->set_rules('rfc', 'R.F.C.', 'trim|required');
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');
        $this->form_validation->set_rules('calle', 'Calle', 'trim|required');
        $this->form_validation->set_rules('num_ext', 'No. Exterior', 'trim|required');
        $this->form_validation->set_rules('colonia', 'Colonia', 'trim|required');
        $this->form_validation->set_rules('municipio', 'Municipio', 'trim|required');
        $this->form_validation->set_rules('estado', 'Estado', 'trim|required');
        $this->form_validation->set_rules('fiscal_calle', 'Calle Fiscsal', 'trim|required');
        $this->form_validation->set_rules('fiscal_num_ext', 'No. Exterior Fiscal', 'trim|required');
        $this->form_validation->set_rules('fiscal_colonia', 'Colonia Fiscal', 'trim|required');
        $this->form_validation->set_rules('fiscal_municipio', 'Municipio Fiscal', 'trim|required');
        $this->form_validation->set_rules('fiscal_estado', 'Estado Fiscal', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->output->set_output(json_encode(array(
                'result' => 0,
                'error' => $this->form_validation->error_array()
            )));
            return false;
        }

        $imagen = $this->input->post('logo');

        if (file_exists(FCPATH . TMP_FOLDER . $imagen) && $imagen != '') {
            if (!is_dir(FCPATH . ASEGURADORAS_FOLDER)) {
                mkdir(FCPATH . ASEGURADORAS_FOLDER);
            }
            rename(FCPATH . TMP_FOLDER . $imagen, FCPATH . ASEGURADORAS_FOLDER . $imagen);
        }


        //Validación del correo único
        $this->load->model('aseguradoras_model');

        $result = $this->aseguradoras_model->insert(array(
            'logo'              => $imagen,
            'razon_social'      => $this->input->post('razon_social'),
            'rfc'               => $this->input->post('rfc'),
            'nombre'            => $this->input->post('nombre'),
            'descripcion'       => $this->input->post('descripcion'),
            'telefono'          => $this->input->post('telefono'),
            'email'             => $this->input->post('email'),
            'calle'             => $this->input->post('calle'),
            'num_ext'           => $this->input->post('num_ext'),
            'num_int'           => $this->input->post('num_int'),
            'colonia'           => $this->input->post('colonia'),
            'cp'                => $this->input->post('cp'),
            'municipio'         => $this->input->post('municipio'),
            'estado'            => $this->input->post('estado'),
            'fiscal_calle'      => $this->input->post('fiscal_calle'),
            'fiscal_num_ext'    => $this->input->post('fiscal_num_ext'),
            'fiscal_num_int'    => $this->input->post('fiscal_num_int'),
            'fiscal_colonia'    => $this->input->post('fiscal_colonia'),
            'fiscal_cp'         => $this->input->post('fiscal_cp'),
            'fiscal_municipio'  => $this->input->post('fiscal_municipio'),
            'fiscal_estado'     => $this->input->post('fiscal_estado'),
            'fecha_creacion'    => $this->functions->fecha_actual(),
            'creado_por'        => $this->usuario_actual
        ));
        if ($result) {
            $this->output->set_output(json_encode(array(
                'result' => 1
            )));
            return false;
        }
        return false;
    }

    function update_aseguradora(){
        //Validacion de Form
        $this->form_validation->set_rules('razon_social', 'Razón Social', 'trim|required');
        $this->form_validation->set_rules('rfc', 'R.F.C.', 'trim|required');
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');
        $this->form_validation->set_rules('calle', 'Calle', 'trim|required');
        $this->form_validation->set_rules('num_ext', 'No. Exterior', 'trim|required');
        $this->form_validation->set_rules('colonia', 'Colonia', 'trim|required');
        $this->form_validation->set_rules('municipio', 'Municipio', 'trim|required');
        $this->form_validation->set_rules('estado', 'Estado', 'trim|required');
        $this->form_validation->set_rules('fiscal_calle', 'Calle Fiscsal', 'trim|required');
        $this->form_validation->set_rules('fiscal_num_ext', 'No. Exterior Fiscal', 'trim|required');
        $this->form_validation->set_rules('fiscal_colonia', 'Colonia Fiscal', 'trim|required');
        $this->form_validation->set_rules('fiscal_municipio', 'Municipio Fiscal', 'trim|required');
        $this->form_validation->set_rules('fiscal_estado', 'Estado Fiscal', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->output->set_output(json_encode(array(
                'result' => 0,
                'error' => $this->form_validation->error_array()
            )));
            return false;
        }

        //Validación del correo único
        $this->load->model('aseguradoras_model');

        $item = $this->aseguradoras_model->get(['id_aseguradora' => $this->input->post('id')]);

        $imagen = $this->input->post('logo');

        if($item[0]['logo'] != $imagen){
            if (file_exists(FCPATH . TMP_FOLDER . $imagen) && $imagen != '') {
                if (!is_dir(FCPATH . ASEGURADORAS_FOLDER)) {
                    mkdir(FCPATH . ASEGURADORAS_FOLDER);
                }
                rename(FCPATH . TMP_FOLDER . $imagen, FCPATH . ASEGURADORAS_FOLDER . $imagen);
            }
        }

        $data = [
            'logo'              => $imagen,
            'razon_social'      => $this->input->post('razon_social'),
            'rfc'               => $this->input->post('rfc'),
            'nombre'            => $this->input->post('nombre'),
            'descripcion'       => $this->input->post('descripcion'),
            'telefono'          => $this->input->post('telefono'),
            'email'             => $this->input->post('email'),
            'calle'             => $this->input->post('calle'),
            'num_ext'           => $this->input->post('num_ext'),
            'num_int'           => $this->input->post('num_int'),
            'colonia'           => $this->input->post('colonia'),
            'cp'                => $this->input->post('cp'),
            'municipio'         => $this->input->post('municipio'),
            'estado'            => $this->input->post('estado'),
            'fiscal_calle'      => $this->input->post('fiscal_calle'),
            'fiscal_num_ext'    => $this->input->post('fiscal_num_ext'),
            'fiscal_num_int'    => $this->input->post('fiscal_num_int'),
            'fiscal_colonia'    => $this->input->post('fiscal_colonia'),
            'fiscal_cp'         => $this->input->post('fiscal_cp'),
            'fiscal_municipio'  => $this->input->post('fiscal_municipio'),
            'fiscal_estado'     => $this->input->post('fiscal_estado'),
            'modificado_por'    => $this->usuario_actual
        ];

        $this->aseguradoras_model->update($data, $this->input->post('id'));
        $this->output->set_output(json_encode(array(
            'result' => 1
        )));
    }

    function delete_aseguradora($id = NULL){
        $this->load->model('aseguradoras_model');
        $data = [
            'eliminado'         => '1',
            'fecha_eliminacion' => $this->functions->fecha_actual(),
            'eliminado_por'     => $this->usuario_actual
        ];
        $this->aseguradoras_model->update($data, $id);
        $this->output->set_output(json_encode(array(
            'result' => 1
        )));
        return false;
    }

    function insert_ajustador(){
        //Validacion de Form
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');
        $this->form_validation->set_rules('paterno', 'Paterno', 'trim|required');
        $this->form_validation->set_rules('materno', 'Materno', 'trim|required');
        $this->form_validation->set_rules('telefono', 'Teléfono', 'trim|required');
        $this->form_validation->set_rules('email', 'Correo Electrónico', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->output->set_output(json_encode(array(
                'result' => 0,
                'error' => $this->form_validation->error_array()
            )));
            return false;
        }

        //Validación del correo único
        $this->load->model('ajustadores_model');

        $result = $this->ajustadores_model->insert(array(
            'nombre'            => $this->input->post('nombre'),
            'paterno'           => $this->input->post('paterno'),
            'materno'           => $this->input->post('materno'),
            'telefono'          => $this->input->post('telefono'),
            'email'             => $this->input->post('email'),
            'id_aseguradora'    => $this->input->post('id_aseguradora'),
            'fecha_creacion'    => $this->functions->fecha_actual(),
            'creado_por'        => $this->usuario_actual
        ));
        if ($result) {
            $this->output->set_output(json_encode(array(
                'result' => 1
            )));
            return false;
        }
        return false;
    }

    function update_ajustador(){
        //Validacion de Form
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');
        $this->form_validation->set_rules('paterno', 'Paterno', 'trim|required');
        $this->form_validation->set_rules('materno', 'Materno', 'trim|required');
        $this->form_validation->set_rules('telefono', 'Teléfono', 'trim|required');
        $this->form_validation->set_rules('email', 'Correo Electrónico', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->output->set_output(json_encode(array(
                'result' => 0,
                'error' => $this->form_validation->error_array()
            )));
            return false;
        }

        //Validación del correo único
        $this->load->model('ajustadores_model');

        $data = [
            'nombre'            => $this->input->post('nombre'),
            'paterno'           => $this->input->post('paterno'),
            'materno'           => $this->input->post('materno'),
            'telefono'          => $this->input->post('telefono'),
            'email'             => $this->input->post('email'),
            'id_aseguradora'    => $this->input->post('id_aseguradora'),
            'modificado_por'    => $this->usuario_actual
        ];

        $this->ajustadores_model->update($data, $this->input->post('id'));
        $this->output->set_output(json_encode(array(
            'result' => 1
        )));
    }

    function delete_ajustador($id = NULL){
        $this->load->model('ajustadores_model');
        $data = [
            'eliminado'         => '1',
            'fecha_eliminado'   => $this->functions->fecha_actual(),
            'eliminado_por'     => $this->usuario_actual
        ];
        $this->ajustadores_model->update($data, $id);
        $this->output->set_output(json_encode(array(
            'result' => 1
        )));
        return false;
    }

    /* Ordenes */
    public function insert_orden(){
        //Validacion de Form
        $this->form_validation->set_rules('id_asesor', 'Asesor', 'trim|required');
        $this->form_validation->set_rules('id_cliente', 'Cliente', 'trim|required');
        $this->form_validation->set_rules('no_placas', 'Placas', 'trim|required');
        $this->form_validation->set_rules('marca', 'Marca', 'trim|required');
        $this->form_validation->set_rules('tipo', 'Tipo', 'trim|required');
        $this->form_validation->set_rules('color', 'Color', 'trim|required');
        $this->form_validation->set_rules('modelo', 'Modelo', 'trim|required');
        $this->form_validation->set_rules('no_serie', 'Serie', 'trim|required');
        $this->form_validation->set_rules('id_aseguradora', 'Aseguradora', 'trim|required');
        $this->form_validation->set_rules('id_ajustador', 'Ajustador', 'trim|required');
        $this->form_validation->set_rules('no_siniestro', 'No. Siniestro', 'trim|required');
        $this->form_validation->set_rules('no_poliza', 'Póliza', 'trim|required');
        $this->form_validation->set_rules('inciso', 'Inciso', 'trim');


        if ($this->form_validation->run() == false) {
            $this->output->set_output(json_encode(array(
                'result' => 0,
                'error' => $this->form_validation->error_array()
            )));
            return false;
        }

        $fecha             = explode('/',$this->input->post('fecha_recepcion'));

        $fecha_recepcion = strtotime($fecha[2].'-'.$fecha[1].'-'.$fecha[0].' '.$this->input->post('hora_recepcion'));

        $deducible      = (!is_null($this->input->post('es_deducible'))) ? ltrim(str_replace(['$', ','], ['',''], $this->input->post('deducible'))) : NULL;
        $demerito       = (!is_null($this->input->post('es_demerito'))) ? ltrim(str_replace(['$', ','], ['',''], $this->input->post('demerito'))) : NULL;
        $valuacion      = (!is_null($this->input->post('es_valuacion'))) ? ltrim(str_replace(['$', ','], ['',''], $this->input->post('valuacion'))) : NULL;
        $varios         = (!is_null($this->input->post('es_varios'))) ? ltrim(str_replace(['$', ','], ['',''], $this->input->post('varios'))) : NULL;
        $fecha_promesa = explode('/',$this->input->post('fecha_promesa'));

       /* */
        $aplica_deducible      = (!empty($this->input->post('aplica_deducible')) == 'SI') ? 1 : 0;
        /* */

        $orden = [
            'no_orden'          => $this->input->post('no_orden'),
            'status'            => $this->input->post('status'),
            'id_asesor'         => $this->input->post('id_asesor'),
            'id_cliente'        => $this->input->post('id_cliente'),
            'no_placas'         => $this->input->post('no_placas'),
            'marca'             => $this->input->post('marca'),
            'tipo'              => $this->input->post('tipo'),
            'color'             => $this->input->post('color'),
            'modelo'            => $this->input->post('modelo'),
            'no_serie'          => $this->input->post('no_serie'),
            'fecha_recepcion'   => date("Y-m-d H:i:s" , $fecha_recepcion), //FATA
            'fecha_promesa'     => date("Y-m-d H:i:s", strtotime($fecha_promesa[2].'-'.$fecha_promesa[1].'-'.$fecha_promesa[0])),
            'id_aseguradora'    => $this->input->post('id_aseguradora'),
            'id_ajustador'      => $this->input->post('id_ajustador'),
            'tipo_cliente'      => $this->input->post('tipo_cliente'),
            'no_siniestro'      => $this->input->post('no_siniestro'),
            'no_poliza'         => $this->input->post('no_poliza'),
            'inciso'            => $this->input->post('inciso'),
            'aplica_deducible'  => $aplica_deducible,
            'deducible'         => $deducible,
            'demerito'          => $demerito,
            'valuacion'         => $valuacion,
            'varios'            => $varios,
            'activo'            => '1',
            'eliminado'         => '0',
            'fecha_creacion'    => $this->functions->fecha_actual(),
            'creado_por'        => $this->usuario_actual
        ];

        $result = $this->ordenes_model->insert($orden);
        if ($result) {
            $this->load->model('orden_incidencias_model');
            $incidencia = [];
            $incidencia['id_orden']         = $result;
            $incidencia['no_sucesivo']      = '1';
            $incidencia['status']           = 'En Valuación';
            $incidencia['incidencia']       = 'Se registro la orden No.'.$this->input->post('no_orden').' con el status "En valuación"';
            $incidencia['llamada']          ='0';
            $incidencia['fecha_incidencia'] = date("Y-m-d H:i:s");
            $incidencia['activo']           = '1';
            $incidencia['eliminado']        = '0';
            $incidencia['fecha_creacion']   = date("Y-m-d H:i:s");
            $incidencia['creado_por']       = $this->usuario_actual;

            $this->orden_incidencias_model->insert($incidencia);

            $this->output->set_output(json_encode(array(
                'result' => 1
            )));
            return false;
        }

        $this->output->set_output(json_encode(array(
            'result' => 0,
            'error' => 'Lo sentimos no se pudo generar la orden'
        )));
        return false;
    }

    public function update_orden(){
        $this->load->model(['ordenes_model','orden_incidencias_model', 'usuarios_model']);
        $usuario    = $this->usuarios_model->get(['id_usuario' => $this->usuario_actual]);

        $deducible  = (!is_null($this->input->post('es_deducible'))) ? ltrim(str_replace(['$', ','], ['',''], $this->input->post('deducible'))) : NULL;
        $demerito   = (!is_null($this->input->post('es_demerito'))) ? ltrim(str_replace(['$', ','], ['',''], $this->input->post('demerito'))) : NULL;
        $valuacion  = (!is_null($this->input->post('es_valuacion'))) ? ltrim(str_replace(['$', ','], ['',''], $this->input->post('valuacion'))) : NULL;
        $varios     = (!is_null($this->input->post('es_varios'))) ? ltrim(str_replace(['$', ','], ['',''], $this->input->post('varios'))) : NULL;

        $fecha_promesa = explode('/',$this->input->post('fecha_promesa'));

        $p_fecha_promesa = $this->input->post('fecha_promesa');
        if(strpos($p_fecha_promesa, '-') == false){
            $fecha_promesa = explode('/',$p_fecha_promesa);
        }else{
            $fecha_promesa = explode('-', $p_fecha_promesa);
        }

        $id_asesor = $this->input->post('id_asesor');

        $orden = [
            'fecha_promesa'      => date("Y-m-d H:i:s", strtotime($fecha_promesa[2].'-'.$fecha_promesa[1].'-'.$fecha_promesa[0])),
            'id_cliente'         => $this->input->post('id_cliente'),
            'no_placas'          => $this->input->post('no_placas'),
            'marca'              => $this->input->post('marca'),
            'tipo'               => $this->input->post('tipo'),
            'color'              => $this->input->post('color'),
            'modelo'             => $this->input->post('modelo'),
            'no_serie'           => $this->input->post('no_serie'),
            'id_aseguradora'     => $this->input->post('id_aseguradora'),
            'id_ajustador'       => $this->input->post('id_ajustador'),
            'tipo_cliente'       => $this->input->post('tipo_cliente'),
            'no_siniestro'       => $this->input->post('no_siniestro'),
            'no_poliza'          => $this->input->post('no_poliza'),
            'inciso'             => $this->input->post('inciso'),
            'deducible'          => $deducible,
            'demerito'           => $demerito,
            'valuacion'          => $valuacion,
            'varios'             => $varios,
            'fecha_modificacion' => $this->functions->fecha_actual(),
            'modificado_por'     => $this->usuario_actual
        ];

        if($id_asesor > 0){
	        $orden['id_asesor'] = $id_asesor;
        }

        $this->ordenes_model->update($orden, $this->input->post('id'));

        $no_sucesivo = $this->orden_incidencias_model->get_no_sucesivo($this->input->post('id'));
        $result      = $this->orden_incidencias_model->insert([
            'id_orden'          => $this->input->post('id'),
            'no_sucesivo'       => $no_sucesivo,
            'status'            => '',
            'incidencia'        => 'se modificó información de la orden por el usuario:'.$usuario[0]['nombre'].' '.$usuario[0]['paterno'].' '.$usuario[0]['materno'],
            'llamada'           => '0',
            'fecha_incidencia'  => date("Y-m-d H:i:s"),
            'activo'            => '1',
            'eliminado'         => '0',
            'fecha_creacion'    => $this->functions->fecha_actual(),
            'creado_por'        => $this->usuario_actual
        ]);

        $this->output->set_output(json_encode(array(
            'status' => $this->input->post('status'),
            'result' => 1
        )));
        return false;
    }

    function delete_orden($id = NULL){
        $this->load->model('ordenes_model');
        $data = [
            'eliminado'         => '1',
            'fecha_eliminacion' => $this->functions->fecha_actual(),
            'eliminado_por'     => $this->usuario_actual
        ];
        $this->ordenes_model->update($data, $id);
        $this->output->set_output(json_encode(array(
            'result' => 1
        )));
        return false;
    }

    function update_estado_orden(){
        $this->load->model(['ordenes_model','orden_incidencias_model']);

        $id_orden       = $this->input->post('id_orden');
        $data['status'] = $this->input->post('status');

        $estados        = [
                    'VALUACION'     => 'En Valuación',
                    'REPARACION'    => 'En Reparación',
                    'CVP1'          => 'En CVP1',
                    'RESGUARDO'     => 'En CVP2',
                    'CVP3'          => 'En CVP3',
                    'TRANSITO'      => 'En Tránsito',
                    'ENTREGADO'     => 'Entregado',
                    'FACTURADO'     => 'Facturado',
                    'ARCHIVADO'     => 'Archivado',
                    'PERDIDAS'      => 'Perdidas Totales',
                    'DANOS'         => 'Pago de Daños',
        ];
        $id_grupo = $this->session->userdata('id_grupo');

        if( $id_grupo != SUPER_ADMINISTRADOR){
            if($data['status'] == 'REPARACION'){
                //Validación de los documentos
                $documentos        = TRUE;
                $docs             = '';
                $orden          = $this->ordenes_model->get(['id_orden' => $id_orden]);
                if($orden[0]['tipo_cliente'] == 'NO APLICA'){
                    /*if(is_null($orden[0]['identificacion'])){
                        $documentos    = FALSE;
                        $docs .= '- Identificación<br>';
                    }*/
                    if(is_null($orden[0]['valor_comercial'])){
                        $documentos    = FALSE;
                        $docs .= '- Valor Comercial<br>';
                    }
                    /*if(is_null($orden[0]['tarjeta_circulacion'])){
                        $documentos    = FALSE;
                        $docs .= '- Tarjeta de Circulación<br>';
                    }*/
                }
                elseif($orden[0]['tipo_cliente'] == 'TERCERO'){
                    if(is_null($orden[0]['volante'])){
                        $documentos    = FALSE;
                        $docs .= '- Volante<br>';
                    }
                    if(is_null($orden[0]['identificacion'])){
                        $documentos    = FALSE;
                        $docs .= '- Identificación<br>';
                    }
                    if(is_null($orden[0]['tarjeta_circulacion'])){
                        $documentos    = FALSE;
                        $docs .= '- Tarjeta de Circulación<br>';
                    }
                    if(is_null($orden[0]['valor_comercial'])){
                        $documentos    = FALSE;
                        $docs .= '- Valor Comercial<br>';
                    }
                }else{
                    if(is_null($orden[0]['volante'])){
                        $documentos    = FALSE;
                        $docs .= '- Volante<br>';
                    }
                    if(is_null($orden[0]['poliza'])){
                            $documentos    = FALSE;
                            $docs .= '- Póliza<br>';
                        }
                    if(is_null($orden[0]['identificacion'])){
                        $documentos    = FALSE;
                        $docs .= '- Identificación<br>';
                    }
                    if(is_null($orden[0]['tarjeta_circulacion'])){
                        $documentos    = FALSE;
                        $docs .= '- Tarjeta de Circulación<br>';
                    }
                    if(is_null($orden[0]['valor_comercial'])){
                        $documentos    = FALSE;
                        $docs .= '- Valor Comercial<br>';
                    }
                 }

                if($documentos == FALSE){
                    $this->output->set_output(json_encode(array(
                            'result' => 0,
                            'error' => 'Adjuntar los siguientes documentos para cambiar el estado de la orden:<br>'.$docs,
                        )));
                    return false;
                }
            }
        }

        $this->ordenes_model->update($data, $id_orden);

        $no_sucesivo = $this->orden_incidencias_model->get_no_sucesivo($id_orden);
        $result      = $this->orden_incidencias_model->insert([
            'id_orden'          => $id_orden,
            'no_sucesivo'       => $no_sucesivo,
            'status'            => $estados[$data['status']],
            'incidencia'        => $this->input->post('incidencia'),
            'llamada'           => '0',
            'fecha_incidencia'  => date("Y-m-d H:i:s"),
            'activo'            => '1',
            'eliminado'         => '0',
            'fecha_creacion'    => $this->functions->fecha_actual(),
            'creado_por'        => $this->usuario_actual
        ]);

        $this->output->set_output(json_encode(array(
            'status'    => $this->input->post('status'),
            'id_orden'  => $id_orden,
            'result'    => 1
        )));
        return false;
    }

    //------------------------------
    // Ordenes de trabajo
    //----------------------------
    public function insert_orden_trabajo(){
        //Validacion de Form
        $this->form_validation->set_rules('id_orden', 'Orden', 'trim|required|callback__notMatch');
        $this->form_validation->set_rules('tipo_golpe', 'Tipo de Golpe', 'trim|required|callback__notMatch');

        if ($this->form_validation->run() == false) {
            $this->output->set_output(json_encode(array(
                'result' => 0,
                'error' => $this->form_validation->error_array()
            )));
            return false;
        }

        $this->load->model(['ordenes_trabajo_model', 'usuarios_model', 'ordenes_trabajo_detalle_model', 'servicios_model', 'piezas_model', 'tipos_model', 'detalles_has_areas_model']);
        $usuario    = $this->usuarios_model->get(['id_usuario' => $this->usuario_actual]);
        //$no_sucesivo = $this->ordenes_trabajo_model->get_no_sucesivo();
        $result      = $this->ordenes_trabajo_model->insert([
            'no_orden_trabajo'   => $this->input->post('no_orden_trabajo'),//$no_sucesivo,
            'id_orden'           => $this->input->post('id_orden'),
            'tipo_golpe'         => $this->input->post('tipo_golpe'),
            'activo'             => '1',
            'eliminado'          => '0',
            'fecha_creacion'     => $this->functions->fecha_actual(),
            'creado_por'         => $this->usuario_actual
        ]);

        if($result){
            $id_trabajo     = $this->input->post('id_trabajo');
            $id_piezas      = $this->input->post('id_parte_automovil');
            $id_pintura     = $this->input->post('id_tipo_pintura');
            $id_material    = $this->input->post('id_material_especial');
            $comentario     = $this->input->post('comentario');
            $c          = count($id_trabajo);
            $item       = [];
            for($i=0;$i<$c;$i++){
                $id_detalle = $this->ordenes_trabajo_detalle_model->insert([
                    'id_orden_trabajo'      => $result,
                    'id_servicio'           => $id_trabajo[$i],
                    'trabajo'               => $this->servicios_model->get($id_trabajo[$i])[0]['nombre'],
                    'id_parte_coche'        => $id_piezas[$i],
                    'pieza_automovil'       => $this->piezas_model->get($id_piezas[$i])[0]['nombre'],
                    'id_tipo_pintura'       => empty($id_pintura[$i])?NULL:$id_pintura[$i],
                    'cobertura_pintura'     => empty($id_pintura[$i])?'No Aplica':$this->tipos_model->get($id_pintura[$i])[0]['nombre'],
                    'id_material_especial'  => empty($id_material[$i])?NULL:$id_material[$i],
                    'materiales_especiales' => empty($id_material[$i])?'No Aplica':$this->tipos_model->get($id_material[$i])[0]['nombre'],
                    'comentario'            => $comentario[$i],
                ]);

                $areas = $this->input->post('id_area');

                foreach($areas as $key => $a){
                    $this->detalles_has_areas_model->insert([
                        'id_detalle' => $id_detalle,
                        'id_area'    => $key,
                        'valor'      => ($a[$i] == 'TRUE')?1:0,
                    ]);
                }
            }

            $this->output->set_output(json_encode([
                'result' => 1,
                'id'     => $result
            ]));
            return false;
        }

        $this->output->set_output(json_encode([
            'result' => 0,
            'error' => 'Lo sentimos no se pudo generar la orden'
        ]));
        return false;
    }

    public function update_orden_trabajo(){

    }

    //------------------------------
    // Tickets
    //------------------------------
    public function insertar_ticket(){
        //Validacion de Form
        $this->form_validation->set_rules('tipo_golpe', 'Tipo de Golpe', 'trim|required');
        $this->form_validation->set_rules('id_guardia', 'Guardia', 'trim|required');
        $this->form_validation->set_rules('id_tecnico', 'Técnico', 'trim|required');
        $this->form_validation->set_rules('id_area', 'Área', 'trim|required');
        $this->form_validation->set_rules('id_orden_trabajo', 'Orden de Trabajo', 'trim|required');
        $this->form_validation->set_rules('fecha_inicio', 'Fecha de Inicio', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->output->set_output(json_encode(array(
                'result' => 0,
                'error' => $this->form_validation->error_array()
            )));
            return false;
        }

        //Validación del correo único
        $this->load->model(['tickets_model', 'detalles_has_areas_model', 'detalles_ticket_model', 'areas_model']);

        $no_ticket      = $this->tickets_model->get_no_ticket();
        $id_area        = $this->input->post('id_area');
        $fecha_inicio   = $this->input->post('fecha_inicio');


        $result = $this->tickets_model->insert([
            'no_ticket'         => $no_ticket,
            'tipo_golpe'        => $this->input->post('tipo_golpe'),
            'id_guardia'        => $this->input->post('id_guardia'),
            'id_tecnico'        => $this->input->post('id_tecnico'),
            'id_area'           => $id_area,
            'id_orden_trabajo'  => $this->input->post('id_orden_trabajo'),
            'fecha_inicio'      => date("Y-m-d H:i:s", strtotime($fecha_inicio)),
            'fecha_creacion'    => $this->functions->fecha_actual(),
        ]   );
        if ($result) {

            $detalles = $this->detalles_has_areas_model->get_by_area([['id_area' => $id_area]], $this->input->post('id_orden_trabajo'));

            $area = $this->areas_model->get($id_area);
            foreach($detalles[$id_area] as $d){
                $res = $this->detalles_ticket_model->insert([
                    'id_ticket'             => $result,
                    'aplica_trabajo'        => ($area[0]['tiene_opciones'])?0:1,
                    'trabajo'               => ($area[0]['tiene_opciones'])?NULL:$d['trabajo'],
                    'descripcion'           => $d['pieza_automovil'],
                    'cobertura_pintura'     => ($area[0]['tiene_opciones'])?$d['cobertura_pintura']:NULL,
                    'materiales_especiales' => ($area[0]['tiene_opciones'])?$d['materiales_especiales']:NULL,
                    'comentarios'           => $d['comentarios']
                ]);
            }
            $this->output->set_output(json_encode(array(
                'result'    => 1,
                'id'        => $result,
                'id_area'   => $id_area,
            )));
            return false;
        }
        return false;
    }

    public function editar_ticket(){
        if(!is_null($this->input->post('id_guardia'))){
            $this->form_validation->set_rules('id_guardia', 'Guardia', 'trim|required');
        }
        if(!is_null($this->input->post('id_tecnico'))){
            $this->form_validation->set_rules('id_tecnico', 'Técnico', 'trim|required');
        }
        if(!is_null($this->input->post('fecha_fin'))){
            $this->form_validation->set_rules('fecha_fin', 'Fecha de Término', 'trim|required');
        }

        if ($this->form_validation->run() == false) {
            $this->output->set_output(json_encode(array(
                'result' => 0,
                'error' => $this->form_validation->error_array()
            )));
            return false;
        }

        //Validación del usuario único
        $this->load->model('tickets_model');

        $sql = [];
        if(!is_null($this->input->post('id_guardia'))){
            $sql['id_guardia'] = $this->input->post('id_guardia');
        }
        if(!is_null($this->input->post('id_tecnico'))){
            $sql['id_tecnico'] = $this->input->post('id_tecnico');
        }
        if(!is_null($this->input->post('fecha_fin'))){
            $sql['fecha_fin'] = $this->input->post('fecha_fin');
        }

        $this->tickets_model->update($sql, $this->input->post('id'));
        $this->output->set_output(json_encode(array(
            'result' => 1,
            'id'     => $this->input->post('id')
        )));
    }

    //-----------------------------------------------------------------------------------------------------------------------------------
    // Incidencia
    //-----------------------------------------------------------------------------------------------------------------------------------
    function insert_incidencia(){
        //Validacion de Form
        $this->form_validation->set_rules('incidencia', 'Incidencia', 'trim|required');
        $this->form_validation->set_rules('llamada', 'Llamada', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->output->set_output(json_encode(array(
                'result' => 0,
                'error' => $this->form_validation->error_array()
            )));
            return false;
        }

        //Validación del correo único
        $this->load->model('orden_incidencias_model');

        $id_orden    = $this->input->post('id_orden');
        $no_sucesivo = $this->orden_incidencias_model->get_no_sucesivo($id_orden);

        $result = $this->orden_incidencias_model->insert(array(
            'id_orden'          => $id_orden,
            'no_sucesivo'       => $no_sucesivo,
            'incidencia'        => $this->input->post('incidencia'),
            'llamada'           => $this->input->post('llamada'),
            'fecha_incidencia'  => date("Y-m-d H:i:s"),
            'activo'            => '1',
            'eliminado'         => '0',
            'fecha_creacion'    => $this->functions->fecha_actual(),
            'creado_por'        => $this->usuario_actual
        ));
        if ($result) {
            $this->output->set_output(json_encode(array(
                'result' => 1
            )));
            return false;
        }
        return false;
    }

    public function insert_recibo(){
        //Validacion de Form
        $this->form_validation->set_rules('recibimos_de', 'Recibimos de', 'trim|required');
        $this->form_validation->set_rules('cantidad', 'Cantidad', 'trim|required');
        $this->form_validation->set_rules('concepto', 'Concepto', 'trim|required');
        $this->form_validation->set_rules('forma_pago', 'Forma de Pago', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->output->set_output(json_encode(array(
                'result' => 0,
                'error' => $this->form_validation->error_array()
            )));
            return false;
        }

        //Validación del correo único
        $this->load->model('orden_recibos_model');
        $id_orden = $this->input->post('id_orden');

        if($id_orden == '-1'){
            $id_orden = NULL;
        }

        $orden_recibo = array(
            'id_orden'          => $id_orden,
            'no_recibo'         => $this->input->post('no_recibo'),
            'fecha'             => date('Y-m-d', strtotime($this->input->post('fecha'))),
            'recibimos_de'      => $this->input->post('recibimos_de'),
            'cantidad'          => ltrim(str_replace(['$', ','], ['',''], $this->input->post('cantidad'))),
            'concepto'          => $this->input->post('concepto'),
            'forma_pago'        => $this->input->post('forma_pago'),
            'factura'           => is_null($this->input->post('factura'))?'0':'1',
            'eliminado'         => '0',
            'fecha_creacion'    => $this->functions->fecha_actual(),
            'creado_por'        => $this->usuario_actual
        );

        $result = $this->orden_recibos_model->insert($orden_recibo);

        if ($result){
            if(!is_null($id_orden)){
                $this->load->model('orden_incidencias_model');
                $incidencia                     = [];
                $incidencia['id_orden']         = $id_orden;
                $incidencia['no_sucesivo']      = $this->orden_incidencias_model->get_no_sucesivo($id_orden);
                $incidencia['status']           = '';
                $incidencia['incidencia']       = 'Se registro el recibo No.'.$this->input->post('no_recibo').' por la cantidad de '.$this->input->post('cantidad');
                $incidencia['llamada']          ='0';
                $this->crear_incidencia($incidencia);
            }


            $this->output->set_output(json_encode(array(
                'result'    => 1,
                'id_recibo' => $result,
            )));
            return false;
        }
        $this->output->set_output(json_encode(array(
            'result' => 0,
            'error' => 'No se pudo guardar el recibo de la orden. Intentar nuevamente.'
        )));
    }

    function cancel_recibo($id = NULL){
        $this->load->model('orden_recibos_model');
        $data = [
            'cancelado'         => '1',
            'fecha_cancelacion' => $this->functions->fecha_actual(),
            'cancelado_por'     => $this->usuario_actual
        ];
        $this->orden_recibos_model->update($data, $id);
        $this->output->set_output(json_encode(array(
            'result' => 1
        )));
        return false;
    }

    public function subir_archivo_orden(){
        $this->load->model(['ordenes_model','orden_incidencias_model']);

        $id_orden = $this->input->post('id_orden');
        $nombre   = $this->input->post('nombre');

        $f1 = ORDENES_PATH.sha1($id_orden);

		// If folder not exists, we created
        if(!file_exists($f1)){ mkdir($f1, 0777); }

        $folder = $f1.'/documentos/';

        // If folder not exists, we created
        if (!file_exists($folder)) { mkdir($folder, 0777); }

        $config['upload_path']          = $folder;
        $config['allowed_types']        = 'pdf';
        $config['max_size']             = 7000;
        $config['file_ext_tolower']        = TRUE;
        $config['file_name']            = time();

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('file'))
        {
            $error = array('error' => $this->upload->display_errors());
            $this->output->set_output(json_encode(array(
                'result' => 0,
                'error' => 'No se pudo guardar el archivo '.$this->archivos[$nombre].' de la orden. Intentar nuevamente.'
            )));
            return false;
        }

        $data = ['upload_data' => $this->upload->data()];
        $info[$nombre] = $data['upload_data']['file_name'];
        $this->ordenes_model->update($info, $id_orden);

        $incidencia                     = [];
        $incidencia['id_orden']         = $id_orden;
        $incidencia['no_sucesivo']      = $this->orden_incidencias_model->get_no_sucesivo($id_orden);
        $incidencia['status']           = '';
        $incidencia['incidencia']       = 'Se subió el archivo: '.$this->archivos[$nombre];
        $incidencia['llamada']          ='0';
        $this->crear_incidencia($incidencia);

        $id_grupo = $this->session->userdata('id_grupo');

        $this->output->set_output(json_encode(array(
            'result'    => 1,
            'path'         => base_url($folder),
            'file'        => $data['upload_data']['file_name'],
            'nombre'    => $nombre,
            'canDelete' => (($id_grupo == SUPER_ADMINISTRADOR) || ($id_grupo == ADMINISTRADOR) || ($id_grupo == CLIENTES_AVANZADO) ),
        )));
    }

    public function subir_imagen_orden(){
        $this->load->model(['ordenes_model','orden_incidencias_model']);

        $id_orden = $this->input->post('id_orden');
        $nombre      = $this->input->post('nombre');



        $f1 = ORDENES_PATH.sha1($id_orden);

        // If folder not exists, we created
        if(!file_exists($f1)){ mkdir($f1, 0777); }

        $folder = $f1.'/checklist/';

        // If folder not exists, we created
        if (!file_exists($folder)) { mkdir($folder, 0777); }

        $config['upload_path']          = $folder;
        $config['allowed_types']        = 'jpg|png|jpeg';
        $config['max_size']             = 7000;
        $config['file_ext_tolower']        = TRUE;
        $config['file_name']            = time();

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('file'))
        {
            $error = array('error' => $this->upload->display_errors());
            $this->output->set_output(json_encode(array(
                'result' => 0,
                'error' => 'No se pudo guardar el archivo '.$this->archivos_checklist[$nombre].' de la orden. Intentar nuevamente.'
            )));
            return false;
        }

        $data = ['upload_data' => $this->upload->data()];
        $info[$nombre] = $data['upload_data']['file_name'];
        $this->ordenes_model->update($info, $id_orden);

        $id_grupo = $this->session->userdata('id_grupo');

        $this->output->set_output(json_encode(array(
            'result'    => 1,
            'path'         => base_url($folder),
            'file'        => $data['upload_data']['file_name'],
            'nombre'    => $nombre,
            'canDelete' => (($id_grupo == SUPER_ADMINISTRADOR) || ($id_grupo == ADMINISTRADOR)),
        )));
    }

    public function delete_documento(){
        $this->load->model(['ordenes_model','orden_incidencias_model']);

        $id_orden	= $this->input->post('id_orden');
        $nombre     = $this->input->post('nombre');
        $folder     = ORDENES_PATH.sha1($id_orden).'/documentos/';
        $orden      = $this->ordenes_model->get(['id_orden' => $id_orden]);
        $doc        = $orden[0][$nombre];

        if (file_exists($folder.$doc)) {
            unlink($folder.$doc);
        }

        $this->ordenes_model->update([$nombre => NULL], $id_orden);
        $incidencia                     = [];
        $incidencia['id_orden']         = $id_orden;
        $incidencia['no_sucesivo']      = $this->orden_incidencias_model->get_no_sucesivo($id_orden);
        $incidencia['status']           = '';
        $incidencia['incidencia']       = 'Se eliminó el archivo: '.$this->archivos[$nombre];
        $incidencia['llamada']          ='0';
        $this->crear_incidencia($incidencia);

        $this->output->set_output(json_encode(array(
            'result'    => 1,
            'nombre'    => $nombre
        )));
    }

    public function delete_checklist(){
        $this->load->model(['ordenes_model','orden_incidencias_model']);
        $id_orden   = $this->input->post('id_orden');
        $nombre     = $this->input->post('nombre');
        $folder     = ORDENES_PATH.sha1($id_orden).'/checklist/';
        $orden      = $this->ordenes_model->get(['id_orden' => $id_orden]);
        $doc        = $orden[0][$nombre];

        if (file_exists($folder.$doc)) {
            unlink($folder.$doc);
        }

        $this->ordenes_model->update([$nombre => NULL], $id_orden);

        $this->output->set_output(json_encode(array(
            'result'    => 1,
            'nombre'    => $nombre
        )));
    }

    public function delete_image(){
        $this->load->model(['orden_documentos_model']);
        $imagenes   = $this->input->post('id');
        $carpeta    = '';
        $id_orden   = '';

        foreach($imagenes as $id_documento){
            $documento     = $this->orden_documentos_model->get(['id_documento' => $id_documento]);

            $carpeta    = $documento[0]['carpeta'];
            $id_orden   = $documento[0]['id_orden'];
            $file       = ORDENES_PATH.sha1($documento[0]['id_orden']).'/imagenes/'.$documento[0]['carpeta'].'/'.$documento[0]['nombre'];

            if (file_exists($file)) {
                unlink($file);
            }

            $data['eliminado']            = '1';
            $data['eliminado_por']        = $this->usuario_actual;
            $data['fecha_eliminacion']    = date("Y-m-d H:i:s");

            $this->orden_documentos_model->update($data, $id_documento);
        }

        $this->output->set_output(json_encode(array(
            'result'    => 1,
            'folder'    => $carpeta,
            'id_orden'    => $id_orden,
        )));
    }

    public function download_images(){
        $this->load->model(['orden_documentos_model']);
        $imagenes   = $this->input->post('id');
        $carpeta    = 'tmp';
        $archivo    = time().'.zip';
        $this->load->library('zip');
        $this->zip->compression_level = 5;

        foreach($imagenes as $id_documento){
            $documento     = $this->orden_documentos_model->get(['id_documento' => $id_documento]);
            $file       = ORDENES_PATH.sha1($documento[0]['id_orden']).'/imagenes/'.$documento[0]['carpeta'].'/'.$documento[0]['nombre'];
            $this->zip->read_file($file);
        }

        $this->zip->archive($carpeta."/".$archivo);

        $this->output->set_output(json_encode(array(
            'result'    => 1,
            'file'      => base_url($carpeta.'/'.$archivo),
        )));
    }

    public function upload_images($folder, $id_orden){

        $f1 = ORDENES_PATH.sha1($id_orden);

        if(!file_exists($f1)){ mkdir($f1, 0777); }

        $f2 = $f1.'/imagenes';

        // If folder not exists, we created
        if (!file_exists($f2)) { mkdir($f2, 0777); }

        $carpeta = $f2.'/'.$folder;

        if (!file_exists($carpeta)) { mkdir($carpeta, 0777); }

        $config['upload_path']          = $carpeta;
        $config['allowed_types']        = 'jpg|jpeg|png';
        $config['max_size']             = 7000;
        $config['file_ext_tolower']        = TRUE;
        $config['file_name']            = time();

        $this->load->library('upload', $config);

        $extensiones = ['.jpg', '.jpeg', '.png'];

        $orden = intval(str_replace($extensiones, "", $_FILES['file']['name']));

        if ( ! $this->upload->do_upload('file'))
        {
            $error = array('error' => $this->upload->display_errors());
            $this->output->set_output(json_encode(array(
                'result' => 0,
                'error' => 'No se pudo guardar la imagen. Intentar nuevamente.'
            )));
            return false;
        }

        $data = ['upload_data' => $this->upload->data()];
        $info['id_orden']            = $id_orden;
        $info['nombre']                = $data['upload_data']['file_name'];
        $info['orden']              = $orden;
        $info['carpeta']            = $folder;
        $info['activo']                = '1';
        $info['eliminado']            = '0';
        $info['fecha_creacion']       = date("Y-m-d H:i:s");
        $info['creado_por']          = $this->usuario_actual;
        $this->load->model(['orden_documentos_model']);
        $id = $this->orden_documentos_model->insert($info);
        $compress                     = new Compress();
        $compress->file_url         = $carpeta.'/'.$data['upload_data']['file_name'];
        $compress->new_name_image    = $data['upload_data']['file_name'];
        $compress->quality             = 80;
        $compress->pngQuality         = 9; // Exclusive for PNG files, don´t need to set
        $compress->destination         = $carpeta.'/';
        $result = $compress->compress_image();

        $this->output->set_output(json_encode(array(
            'result'    => 1,
            'folder'    => $folder,
            'id_orden'    => $id_orden,
        )));
    }

    function update_documento(){
        //Validacion de Form
        $this->form_validation->set_rules('comentario', 'Comentario', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->output->set_output(json_encode(array(
                'result' => 0,
                'error' => $this->form_validation->error_array()
            )));
            return false;
        }

        //Validación del correo único
        $this->load->model('orden_documentos_model');

        $data = [
            'comentario' => $this->input->post('comentario'),
        ];

        $this->orden_documentos_model->update($data, $this->input->post('id'));
        $this->output->set_output(json_encode(array(
            'result'     => 1,
            'comentario' => $this->input->post('comentario'),
            'id'         => $this->input->post('id'),
        )));
    }

    public function upload_expediente($id_orden){

        $f1 = ORDENES_PATH.sha1($id_orden);

        if(!file_exists($f1)){ mkdir($f1, 0777); }

        $carpeta = $f1.'/expediente';

        if (!file_exists($carpeta)) { mkdir($carpeta, 0777); }

        $config['upload_path']          = $carpeta;
        $config['allowed_types']        = 'zip|rar';
        $config['max_size']             = 7000;
        $config['file_ext_tolower']     = TRUE;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('file'))
        {
            $error = array('error' => $this->upload->display_errors());
            $this->output->set_output(json_encode(array(
                'result' => 0,
                'error' => 'No se pudo guardar el documento del expediente. Intentar nuevamente.'
            )));
            return false;
        }

        $data = ['upload_data' => $this->upload->data()];
        $info['id_orden']            = $id_orden;
        $info['nombre']                = $data['upload_data']['file_name'];
        $info['activo']                = '1';
        $info['eliminado']            = '0';
        $info['fecha_creacion']       = date("Y-m-d H:i:s");
        $info['creado_por']          = $this->usuario_actual;
        $this->load->model(['orden_expediente_model']);
        $id = $this->orden_expediente_model->insert($info);

        $this->output->set_output(json_encode(array(
            'result'    => 1,
            'id_orden'    => $id_orden,
        )));
    }

    public function delete_expediente($id){
        $this->load->model(['orden_expediente_model']);

        $documento     = $this->orden_expediente_model->get(['id_expediente' => $id]);
        $file         = ORDENES_PATH.sha1($documento[0]['id_orden']).'/expediente/'.$documento[0]['nombre'];

        if (file_exists($file)) {
            unlink($file);
        }

        $data['eliminado']            = '1';
        $data['eliminado_por']        = $this->usuario_actual;
        $data['fecha_eliminacion']    = date("Y-m-d H:i:s");

        $this->orden_expediente_model->update($data, $id);

        $this->output->set_output(json_encode(array(
            'result'    => 1,
            'id_orden'    => $documento[0]['id_orden'],
        )));
    }

    public function upload_aseguradora_documento(){
        $this->load->model(['ordenes_has_aseguradora_documentos_model']);

        $id_orden       = $this->input->post('id_orden-aseguradora');
        $id_documento    = $this->input->post('id_documento-aseguradora');

        $f1 = ORDENES_PATH.sha1($id_orden);

        if(!file_exists($f1)){ mkdir($f1, 0777); }

        $folder = $f1.'/aseguradora/';

        // If folder not exists, we created
        if (!file_exists($folder)) { mkdir($folder, 0777); }

        $config['upload_path']          = $folder;
        $config['allowed_types']        = 'pdf';
        $config['max_size']             = 7000;
        $config['file_ext_tolower']        = TRUE;
        $config['file_name']            = time();

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('file'))
        {
            $error = array('error' => $this->upload->display_errors());
            $this->output->set_output(json_encode(array(
                'result' => 0,
                'error' => 'No se pudo guardar el archivo '.$this->archivos[$nombre].' de la orden. Intentar nuevamente.'
            )));
            return false;
        }

        $data = ['upload_data' => $this->upload->data()];
        $info['id_orden']       = $id_orden;
        $info['id_documento']   = $id_documento;
        $info['activo']         = '1';
        $info['eliminado']      = '0';
        $info['fecha_creacion'] = date("Y-m-d H:i:s");
        $info['creado_por']     = $this->usuario_actual;
        $info['nombre']         = $data['upload_data']['file_name'];

        $documento = $this->ordenes_has_aseguradora_documentos_model->get(['id_orden' => $id_orden, 'id_documento' => $id_documento]);

        if(empty($documento)){
            $this->ordenes_has_aseguradora_documentos_model->insert($info);
        }else{
            $this->db->update('ordenes_has_aseguradora_documentos', $info, ['id_orden' => $id_orden, 'id_documento' => $id_documento]);
        }



        $this->output->set_output(json_encode(array(
            'result'    => 1,
            'path'         => base_url($folder),
            'file'        => $data['upload_data']['file_name'],
        )));
    }

    public function delete_documento_aseguradora(){
        $this->load->model('ordenes_has_aseguradora_documentos_model');
        $id_orden         = $this->input->post('id_orden');
        $id_documento   = $this->input->post('id_documento');
        $folder         = ORDENES_PATH.sha1($id_orden).'/aseguradora/';
        $orden             = $this->ordenes_has_aseguradora_documentos_model->get(['id_orden' => $id_orden, 'id_documento' => $id_documento]);
        $doc             = $orden[0]['nombre'];

        if (file_exists($folder.$doc)) {
            unlink($folder.$doc);
        }

        $this->db->update('ordenes_has_aseguradora_documentos', ['nombre' => NULL, 'eliminado' => 1, 'eliminado_por' => $this->usuario_actual ], ['id_orden' => $id_orden, 'id_documento' => $id_documento]);

        $this->output->set_output(json_encode(array(
            'result'        => 1,
            'id_documento'    => $id_documento
        )));
    }


    //-------------------------------------------------------------------------------------------------------------------------------
    // Correos
    //-----------------------------------------------------------------------------------------------------------------------------------
    function insert_correo(){
        //Validacion de Form
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim');
        $this->form_validation->set_rules('email', 'Correo Electrónico', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->output->set_output(json_encode(array(
                'result' => 0,
                'error' => $this->form_validation->error_array()
            )));
            return false;
        }

        //Validación del correo único
        $this->load->model('correos_model');

        $result = $this->correos_model->insert(array(
            'nombre'    => $this->input->post('nombre'),
            'email'     => $this->input->post('email'),
        ));
        if ($result) {
            $this->output->set_output(json_encode(array(
                'result' => 1
            )));
            return false;
        }
        return false;
    }

    function update_correo(){
        //Validacion de Form
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim');
        $this->form_validation->set_rules('email', 'Correo Electrónico', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->output->set_output(json_encode(array(
                'result' => 0,
                'error' => $this->form_validation->error_array()
            )));
            return false;
        }

        //Validación del correo único
        $this->load->model('correos_model');

        $data = [
            'nombre'    => $this->input->post('nombre'),
            'email'     => $this->input->post('email'),
        ];

        $this->correos_model->update($data, $this->input->post('id'));
        $this->output->set_output(json_encode(array(
            'result' => 1
        )));
    }

    function delete_correo($id = NULL){
        $this->load->model('correos_model');
        $data = [
            'eliminado'         => '1',
        ];
        $this->correos_model->update($data, $id);
        $this->output->set_output(json_encode(array(
            'result' => 1
        )));
        return false;
    }

    function insert_color(){
        //Validacion de Form
        $this->form_validation->set_rules('color', 'Color', 'trim|required');
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->output->set_output(json_encode(array(
                'result' => 0,
                'error' => $this->form_validation->error_array()
            )));
            return false;
        }

        //Validación del correo único
        $this->load->model('colores_model');

        $result = $this->colores_model->insert(array(
            'color'          => $this->input->post('color'),
            'nombre'         => $this->input->post('nombre'),
            'fecha_creacion' => $this->functions->fecha_actual(),
            'creado_por'     => $this->usuario_actual
        ));
        if ($result) {
            $this->output->set_output(json_encode(array(
                'result' => 1
            )));
            return false;
        }
        return false;
    }

    function update_color(){
        //Validacion de Form
        $this->form_validation->set_rules('color', 'Color', 'trim|required');
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->output->set_output(json_encode(array(
                'result' => 0,
                'error' => $this->form_validation->error_array()
            )));
            return false;
        }

        //Validación del correo único
        $this->load->model('colores_model');

        $data = [
            'color'             => $this->input->post('color'),
            'nombre'            => $this->input->post('nombre'),
        ];

        $this->colores_model->update($data, $this->input->post('id'));
        $this->output->set_output(json_encode(array(
            'result' => 1
        )));
    }

    function delete_color($id = NULL){
        $this->load->model('colores_model');
        $data = [
            'eliminado'         => '1',
            'fecha_eliminacion' => $this->functions->fecha_actual(),
            'eliminado_por'     => $this->usuario_actual
        ];
        $this->colores_model->update($data, $id);
        $this->output->set_output(json_encode(array(
            'result' => 1
        )));
        return false;
    }

    function insert_marca(){
        //Validacion de Form
        $this->form_validation->set_rules('logo', 'Logo', 'trim|required');
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');
        $this->form_validation->set_rules('descripcion', 'Descripción', 'trim');

        if ($this->form_validation->run() == false) {
            $this->output->set_output(json_encode(array(
                'result' => 0,
                'error' => $this->form_validation->error_array()
            )));
            return false;
        }

        $imagen = $this->input->post('logo');

        if (file_exists(FCPATH . TMP_FOLDER . $imagen) && $imagen != '') {
            if (!is_dir(FCPATH . MARCAS_FOLDER)) {
                mkdir(FCPATH . MARCAS_FOLDER);
            }
            rename(FCPATH . TMP_FOLDER . $imagen, FCPATH . MARCAS_FOLDER . $imagen);

            $source_path = $_SERVER['DOCUMENT_ROOT'] . '/assets/marcas/' . $imagen;
            $target_path = $_SERVER['DOCUMENT_ROOT'] . '/assets/marcas/';
            $config_manip = array(
                'image_library'     => 'gd2',
                'source_image'      => $source_path,
                'new_image'         => $target_path,
                'maintain_ratio'    => TRUE,
                'create_thumb'      => TRUE,
                'thumb_marker'      => '_thumb',
                'width'             => 160,
                'height'            => 90
            );
            $this->load->library('image_lib', $config_manip);
            if (!$this->image_lib->resize()) {
                echo $this->image_lib->display_errors();
            }
            // clear //
            $this->image_lib->clear();
        }

        $this->load->model('marcas_model');

        $result = $this->marcas_model->insert(array(
            'logo'           => $imagen,
            'nombre'         => $this->input->post('nombre'),
            'descripcion'    => $this->input->post('descripcion'),
            'fecha_creacion' => $this->functions->fecha_actual(),
            'creado_por'     => $this->usuario_actual
        ));
        if ($result) {
            $this->output->set_output(json_encode(array(
                'result' => 1
            )));
            return false;
        }
        return false;
    }

    function update_marca(){
        //Validacion de Form
        $this->form_validation->set_rules('logo', 'Logo', 'trim|required');
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');
        $this->form_validation->set_rules('descripcion', 'Descripción', 'trim');

        if ($this->form_validation->run() == false) {
            $this->output->set_output(json_encode(array(
                'result' => 0,
                'error' => $this->form_validation->error_array()
            )));
            return false;
        }

        //Validación del correo único
        $this->load->model('marcas_model');

        $item = $this->marcas_model->get(['id_marca' => $this->input->post('id')]);

        $imagen = $this->input->post('logo');

        if($item[0]['logo'] != $imagen){
            if (file_exists(FCPATH . TMP_FOLDER . $imagen) && $imagen != '') {
                if (!is_dir(FCPATH . MARCAS_FOLDER)) {
                    mkdir(FCPATH . MARCAS_FOLDER);
                }
                rename(FCPATH . TMP_FOLDER . $imagen, FCPATH . MARCAS_FOLDER . $imagen);

                $source_path = $_SERVER['DOCUMENT_ROOT'] . '/assets/marcas/' . $imagen;
                $target_path = $_SERVER['DOCUMENT_ROOT'] . '/assets/marcas/';
                $config_manip = array(
                    'image_library'     => 'gd2',
                    'source_image'      => $source_path,
                    'new_image'         => $target_path,
                    'maintain_ratio'    => TRUE,
                    'create_thumb'      => TRUE,
                    'thumb_marker'      => '_thumb',
                    'width'             => 160,
                    'height'            => 90
                );
                $this->load->library('image_lib', $config_manip);
                if (!$this->image_lib->resize()) {
                    echo $this->image_lib->display_errors();
                }
                // clear //
                $this->image_lib->clear();
            }
        }

        $data = [
            'logo'              => $imagen,
            'nombre'            => $this->input->post('nombre'),
            'descripcion'       => $this->input->post('descripcion'),
        ];

        $this->marcas_model->update($data, $this->input->post('id'));
        $this->output->set_output(json_encode(array(
            'result' => 1
        )));
    }

    function delete_marca($id = NULL){
        $this->load->model('marcas_model');
        $data = [
            'eliminado'         => '1',
            'fecha_eliminacion' => $this->functions->fecha_actual(),
            'eliminado_por'     => $this->usuario_actual
        ];
        $this->marcas_model->update($data, $id);
        $this->output->set_output(json_encode(array(
            'result' => 1
        )));
        return false;
    }

    function insert_modelo(){
        //Validacion de Form
        $this->form_validation->set_rules('modelo', 'Modelo', 'trim|required');
        $this->form_validation->set_rules('estilo', 'Estilo', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->output->set_output(json_encode(array(
                'result' => 0,
                'error' => $this->form_validation->error_array()
            )));
            return false;
        }

        //Validación del correo único
        $this->load->model('modelos_model');

        $result = $this->modelos_model->insert(array(
            'modelo'         => $this->input->post('modelo'),
            'estilo'         => $this->input->post('estilo'),
            'id_marca'       => $this->input->post('id_marca'),
            'fecha_creacion' => $this->functions->fecha_actual(),
            'creado_por'     => $this->usuario_actual
        ));

        if ($result) {
            $this->output->set_output(json_encode(array(
                'result' => 1
            )));
            return false;
        }
        return false;
    }

    function update_modelo(){
        //Validacion de Form
        $this->form_validation->set_rules('modelo', 'Modelo', 'trim|required');
        $this->form_validation->set_rules('estilo', 'Estilo', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->output->set_output(json_encode(array(
                'result' => 0,
                'error' => $this->form_validation->error_array()
            )));
            return false;
        }

        //Validación del correo único
        $this->load->model('modelos_model');

        $data = [
            'modelo'            => $this->input->post('modelo'),
            'estilo'            => $this->input->post('estilo'),
        ];

        $this->modelos_model->update($data, $this->input->post('id'));
        $this->output->set_output(json_encode(array(
            'result' => 1
        )));
    }

    function delete_modelo($id = NULL){
        $this->load->model('modelos_model');
        $data = [
            'eliminado'         => '1',
            'fecha_eliminacion' => $this->functions->fecha_actual(),
            'eliminado_por'     => $this->usuario_actual
        ];
        $this->modelos_model->update($data, $id);
        $this->output->set_output(json_encode(array(
            'result' => 1
        )));
        return false;
    }


    //-----------------------------------------------------------------------------------------------------------------------------------
    // Servicios
    //-----------------------------------------------------------------------------------------------------------------------------------
    function insert_servicio(){
        //Validacion de Form
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->output->set_output(json_encode(array(
                'result' => 0,
                'error' => $this->form_validation->error_array()
            )));
            return false;
        }

        //Validación del correo único
        $this->load->model('servicios_model');

        $result = $this->servicios_model->insert(array(
            'nombre'            => $this->input->post('nombre'),
            'descripcion'       => $this->input->post('descripcion'),
            'fecha_creacion'    => $this->functions->fecha_actual(),
            'creado_por'        => $this->usuario_actual
        ));
        if ($result) {
            $this->output->set_output(json_encode(array(
                'result' => 1
            )));
            return false;
        }
        return false;
    }

    function update_servicio(){
        //Validacion de Form
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->output->set_output(json_encode(array(
                'result' => 0,
                'error' => $this->form_validation->error_array()
            )));
            return false;
        }

        //Validación del correo único
        $this->load->model('servicios_model');

        $data = [
            'nombre'            => $this->input->post('nombre'),
            'descripcion'       => $this->input->post('descripcion'),
        ];

        $this->servicios_model->update($data, $this->input->post('id'));
        $this->output->set_output(json_encode(array(
            'result' => 1
        )));
    }

    function delete_servicio($id = NULL){
        $this->load->model('servicios_model');
        $data = [
            'eliminado'         => '1',
            'fecha_eliminacion' => $this->functions->fecha_actual(),
            'eliminado_por'     => $this->usuario_actual
        ];
        $this->servicios_model->update($data, $id);
        $this->output->set_output(json_encode(array(
            'result' => 1
        )));
        return false;
    }

    //-----------------------------------------------------------------------------------------------------------------------------------
    // Áreas
    //-----------------------------------------------------------------------------------------------------------------------------------
    function insert_area(){
        //Validacion de Form
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->output->set_output(json_encode(array(
                'result' => 0,
                'error' => $this->form_validation->error_array()
            )));
            return false;
        }

        //Validación del correo único
        $this->load->model('areas_model');

        $result = $this->areas_model->insert(array(
            'nombre'            => $this->input->post('nombre'),
            'descripcion'       => $this->input->post('descripcion'),
            'fecha_creacion'    => $this->functions->fecha_actual(),
            'creado_por'        => $this->usuario_actual
        ));
        if ($result) {
            $this->output->set_output(json_encode(array(
                'result' => 1
            )));
            return false;
        }
        return false;
    }

    function update_area(){
        //Validacion de Form
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->output->set_output(json_encode(array(
                'result' => 0,
                'error' => $this->form_validation->error_array()
            )));
            return false;
        }

        //Validación del correo único
        $this->load->model('areas_model');

        $data = [
            'nombre'            => $this->input->post('nombre'),
            'descripcion'       => $this->input->post('descripcion'),
        ];

        $this->areas_model->update($data, $this->input->post('id'));
        $this->output->set_output(json_encode(array(
            'result' => 1
        )));
    }

    function delete_area($id = NULL){
        $this->load->model('areas_model');
        $data = [
            'eliminado'         => '1',
            'fecha_eliminacion' => $this->functions->fecha_actual(),
            'eliminado_por'     => $this->usuario_actual
        ];
        $this->areas_model->update($data, $id);
        $this->output->set_output(json_encode(array(
            'result' => 1
        )));
        return false;
    }

    //-----------------------------------------------------------------------------------------------------------------------------------
    // Tipos de Pintura
    //-----------------------------------------------------------------------------------------------------------------------------------
    function insert_tipo(){
        //Validacion de Form
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->output->set_output(json_encode(array(
                'result' => 0,
                'error' => $this->form_validation->error_array()
            )));
            return false;
        }

        //Validación del correo único
        $this->load->model('tipos_model');

        $result = $this->tipos_model->insert(array(
            'nombre'            => $this->input->post('nombre'),
            'descripcion'       => $this->input->post('descripcion'),
            'fecha_creacion'    => $this->functions->fecha_actual(),
            'creado_por'        => $this->usuario_actual
        ));
        if ($result) {
            $this->output->set_output(json_encode(array(
                'result' => 1
            )));
            return false;
        }
        return false;
    }

    function update_tipo(){
        //Validacion de Form
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->output->set_output(json_encode(array(
                'result' => 0,
                'error' => $this->form_validation->error_array()
            )));
            return false;
        }

        //Validación del correo único
        $this->load->model('tipos_model');

        $data = [
            'nombre'            => $this->input->post('nombre'),
            'descripcion'       => $this->input->post('descripcion'),
        ];

        $this->tipos_model->update($data, $this->input->post('id'));
        $this->output->set_output(json_encode(array(
            'result' => 1
        )));
    }

    function delete_tipo($id = NULL){
        $this->load->model('tipos_model');
        $data = [
            'eliminado'         => '1',
            'fecha_eliminacion' => $this->functions->fecha_actual(),
            'eliminado_por'     => $this->usuario_actual
        ];
        $this->tipos_model->update($data, $id);
        $this->output->set_output(json_encode(array(
            'result' => 1
        )));
        return false;
    }

    //-----------------------------------------------------------------------------------------------------------------------------------
    // Materiales Especiales
    //-----------------------------------------------------------------------------------------------------------------------------------
    function insert_material(){
        //Validacion de Form
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->output->set_output(json_encode(array(
                'result' => 0,
                'error' => $this->form_validation->error_array()
            )));
            return false;
        }

        //Validación del correo único
        $this->load->model('materiales_model');

        $result = $this->materiales_model->insert(array(
            'nombre'            => $this->input->post('nombre'),
            'descripcion'       => $this->input->post('descripcion'),
            'fecha_creacion'    => $this->functions->fecha_actual(),
            'creado_por'        => $this->usuario_actual
        ));
        if ($result) {
            $this->output->set_output(json_encode(array(
                'result' => 1
            )));
            return false;
        }
        return false;
    }

    function update_material(){
        //Validacion de Form
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->output->set_output(json_encode(array(
                'result' => 0,
                'error' => $this->form_validation->error_array()
            )));
            return false;
        }

        //Validación del correo único
        $this->load->model('materiales_model');

        $data = [
            'nombre'            => $this->input->post('nombre'),
            'descripcion'       => $this->input->post('descripcion'),
        ];

        $this->materiales_model->update($data, $this->input->post('id'));
        $this->output->set_output(json_encode(array(
            'result' => 1
        )));
    }

    function delete_material($id = NULL){
        $this->load->model('materiales_model');
        $data = [
            'eliminado'         => '1',
            'fecha_eliminacion' => $this->functions->fecha_actual(),
            'eliminado_por'     => $this->usuario_actual
        ];
        $this->materiales_model->update($data, $id);
        $this->output->set_output(json_encode(array(
            'result' => 1
        )));
        return false;
    }

    //-------------------------------------------------------------------------------------------------------------------------------
    // Categorias
    //-------------------------------------------------------------------------------------------------------------------------------
    function insert_categoria(){
        //Validacion de Form
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');
        $this->form_validation->set_rules('descripcion', 'Descripción', 'trim');

        if ($this->form_validation->run() == false) {
            $this->output->set_output(json_encode(array(
                'result' => 0,
                'error' => $this->form_validation->error_array()
            )));
            return false;
        }

        //Validación del correo único
        $this->load->model('categorias_model');

        $result = $this->categorias_model->insert(array(
            'nombre'            => $this->input->post('nombre'),
            'descripcion'       => $this->input->post('descripcion'),
            'fecha_creacion' => $this->functions->fecha_actual(),
            'creado_por' => $this->usuario_actual
        ));
        if ($result) {
            $this->output->set_output(json_encode(array(
                'result' => 1
            )));
            return false;
        }
        return false;
    }

    function update_categoria(){
        //Validacion de Form
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');
        $this->form_validation->set_rules('descripcion', 'Descripción', 'trim');

        if ($this->form_validation->run() == false) {
            $this->output->set_output(json_encode(array(
                'result' => 0,
                'error' => $this->form_validation->error_array()
            )));
            return false;
        }

        //Validación del correo único
        $this->load->model('categorias_model');

        $data = [
            'nombre'            => $this->input->post('nombre'),
            'descripcion'       => $this->input->post('descripcion'),
        ];

        $this->categorias_model->update($data, $this->input->post('id'));
        $this->output->set_output(json_encode(array(
            'result' => 1
        )));
    }

    function delete_categoria($id = NULL){
        $this->load->model('categorias_model');
        $data = [
            'eliminado'         => '1',
            'fecha_eliminacion' => $this->functions->fecha_actual(),
            'eliminado_por'     => $this->usuario_actual
        ];
        $this->sucursales_model->update($data, $id);
        $this->output->set_output(json_encode(array(
            'result' => 1
        )));
        return false;
    }

    //-------------------------------------------------------------------------------------------------------------------------------
    // Piezas
    //-------------------------------------------------------------------------------------------------------------------------------
    function insert_pieza(){
        //Validacion de Form
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');
        $this->form_validation->set_rules('nombre_comercial', 'Nombre Comercial', 'trim|required');
        $this->form_validation->set_rules('id_categoria_parte', 'Nombre Comercial', 'trim|required');
        $this->form_validation->set_rules('tiempo_promedio', 'Tiempo Promedio Reparación', 'trim|required');
        $this->form_validation->set_rules('descripcion', 'Descripción', 'trim');

        if ($this->form_validation->run() == false) {
            $this->output->set_output(json_encode(array(
                'result' => 0,
                'error' => $this->form_validation->error_array()
            )));
            return false;
        }

        //Validación del correo único
        $this->load->model('piezas_model');

        $result = $this->piezas_model->insert(array(
            'nombre'                => $this->input->post('nombre'),
            'nombre_comercial'      => $this->input->post('nombre_comercial'),
            'descripcion'           => $this->input->post('descripcion'),
            'id_categoria_parte'    => $this->input->post('id_categoria_parte'),
            'tiempo_promedio'       => $this->input->post('tiempo_promedio'),
            'fecha_creacion'        => $this->functions->fecha_actual(),
            'creado_por'            => $this->usuario_actual
        ));
        if ($result) {
            $this->output->set_output(json_encode(array(
                'result' => 1
            )));
            return false;
        }
        return false;
    }

    function update_pieza(){
        //Validacion de Form
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');
        $this->form_validation->set_rules('nombre_comercial', 'Nombre Comercial', 'trim|required');
        $this->form_validation->set_rules('id_categoria_parte', 'Nombre Comercial', 'trim|required');
        $this->form_validation->set_rules('tiempo_promedio', 'Tiempo Promedio Reparación', 'trim|required');
        $this->form_validation->set_rules('descripcion', 'Descripción', 'trim');

        if ($this->form_validation->run() == false) {
            $this->output->set_output(json_encode(array(
                'result' => 0,
                'error' => $this->form_validation->error_array()
            )));
            return false;
        }

        //Validación del correo único
        $this->load->model('piezas_model');

        $data = [
            'nombre'                => $this->input->post('nombre'),
            'nombre_comercial'      => $this->input->post('nombre_comercial'),
            'descripcion'           => $this->input->post('descripcion'),
            'id_categoria_parte'    => $this->input->post('id_categoria_parte'),
            'tiempo_promedio'       => $this->input->post('tiempo_promedio'),
        ];

        $this->piezas_model->update($data, $this->input->post('id'));
        $this->output->set_output(json_encode(array(
            'result' => 1
        )));
    }

    function delete_pieza($id = NULL){
        $this->load->model('piezas_model');
        $data = [
            'eliminado'         => '1',
            'fecha_eliminacion' => $this->functions->fecha_actual(),
            'eliminado_por'     => $this->usuario_actual
        ];
        $this->piezas_model->update($data, $id);
        $this->output->set_output(json_encode(array(
            'result' => 1
        )));
        return false;
    }

    public function upload_tmp_image(){
        $config                         = [];
        $config['file_name']            = time();
        $config['upload_path']          = './assets/tmp/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 0;
        $config['max_width']            = 0;
        $config['max_height']           = 0;
        $config['file_ext_tolower']     = TRUE;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('image'))
        {
            $result = 0;
            $data = array('error' => $this->upload->display_errors());
        }
        else
        {
            $result = 1;
            $data = array('upload_data' => $this->upload->data());
        }

        $this->output->set_output(json_encode(array(
            'result' => $result,
            'data'  => $data
        )));
    }

    //-------------------------------------------------------------------------------------------------------------------------------
    // Proveedores
    //-------------------------------------------------------------------------------------------------------------------------------
    function insert_proveedor(){
        //Validacion de Form
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');
        $this->form_validation->set_rules('descripcion', 'Descripción', 'trim');

        if ($this->form_validation->run() == false) {
            $this->output->set_output(json_encode(array(
                'result' => 0,
                'error' => $this->form_validation->error_array()
            )));
            return false;
        }

        //Validación del correo único
        $this->load->model('proveedores_model');

        $result = $this->proveedores_model->insert(array(
            'nombre'            => $this->input->post('nombre'),
            'descripcion'       => $this->input->post('descripcion'),
            'fecha_creacion'    => $this->functions->fecha_actual(),
            'creado_por'        => $this->usuario_actual
        ));
        if ($result) {
            $this->output->set_output(json_encode(array(
                'result' => 1
            )));
            return false;
        }
        return false;
    }

    function update_proveedor(){
        //Validacion de Form
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');
        $this->form_validation->set_rules('descripcion', 'Descripción', 'trim');

        if ($this->form_validation->run() == false) {
            $this->output->set_output(json_encode(array(
                'result' => 0,
                'error' => $this->form_validation->error_array()
            )));
            return false;
        }

        //Validación del correo único
        $this->load->model('proveedores_model');

        $data = [
            'nombre'            => $this->input->post('nombre'),
            'descripcion'       => $this->input->post('descripcion'),
        ];

        $this->proveedores_model->update($data, $this->input->post('id'));
        $this->output->set_output(json_encode(array(
            'result' => 1
        )));
    }

    function delete_proveedor($id = NULL){
        $this->load->model('proveedores_model');
        $data = [
            'eliminado'         => '1',
            'fecha_eliminacion' => $this->functions->fecha_actual(),
            'eliminado_por'     => $this->usuario_actual
        ];
        $this->proveedores_model->update($data, $id);
        $this->output->set_output(json_encode(array(
            'result' => 1
        )));
        return false;
    }

    private function random_password()
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $password = array();
        $alpha_length = strlen($alphabet) - 1;
        for ($i = 0; $i < 8; $i++)
        {
            $n = rand(0, $alpha_length);
            $password[] = $alphabet[$n];
        }
        return implode($password);
    }

    private function crear_incidencia($data){
        $this->load->model('orden_incidencias_model');
        $incidencia = [];
        $incidencia['id_orden']         = $data['id_orden'];
        $incidencia['no_sucesivo']      = $data['no_sucesivo'];
        $incidencia['status']           = $data['status'];
        $incidencia['incidencia']       = $data['incidencia'];
        $incidencia['llamada']          = $data['llamada'];
        $incidencia['fecha_incidencia'] = date("Y-m-d H:i:s");
        $incidencia['activo']           = '1';
        $incidencia['eliminado']        = '0';
        $incidencia['fecha_creacion']   = date("Y-m-d H:i:s");
        $incidencia['creado_por']       = $this->usuario_actual;

        return $this->orden_incidencias_model->insert($incidencia);
    }

    function _notMatch($value){
       if($value == '-1'){
           $this->form_validation->set_message('_notMatch', 'Debe seleccionar al menos una opción en el campo {field}');
           return false;
       }
       return true;
    }

    public function subir_archivo_factura(){
        $nombre = time();

		// If folder not exists, we created
        if(!file_exists(TMP_FOLDER)){ mkdir(TMP_FOLDER, 0777); }

        $folder = TMP_FOLDER.'/';
        $config = [];
        $config['upload_path']          = $folder;
        $config['allowed_types']        = 'pdf|xml';
        $config['max_size']             = 7000;
        $config['file_ext_tolower']     = TRUE;
        $config['file_name']            = $nombre;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('file'))
        {
            //$error = array('error' => $this->upload->display_errors());
            $this->output->set_output(json_encode(array(
                'result' => 0,
                'error' => 'No se pudo guardar el archivo de la factura. Intentar nuevamente.'
            )));
            return false;
        }

        $data = ['upload_data' => $this->upload->data()];
        /*$info[$nombre] = $data['upload_data']['file_name'];
        $this->ordenes_model->update($info, $id_orden);

        $incidencia                     = [];
        $incidencia['id_orden']         = $id_orden;
        $incidencia['no_sucesivo']      = $this->orden_incidencias_model->get_no_sucesivo($id_orden);
        $incidencia['status']           = '';
        $incidencia['incidencia']       = 'Se subió el archivo: '.$this->archivos[$nombre];
        $incidencia['llamada']          ='0';
        $this->crear_incidencia($incidencia);

        $id_grupo = $this->session->userdata('id_grupo');*/

        $this->output->set_output(json_encode(array(
            'result'    => 1,
            'path'      => base_url($folder),
            'file'      => $data['upload_data']['file_name'],
            'nombre'    => $nombre,
            'canDelete' => TRUE,
        )));
    }

    public function insert_factura(){
	    //Validacion de Form
        $this->form_validation->set_rules('fecha', 'Fecha Factura', 'trim|required');
        $this->form_validation->set_rules('folio', 'Folio', 'trim|required');
        $this->form_validation->set_rules('monto', 'Monto', 'trim|required');
        $this->form_validation->set_rules('id_metodo_pago', 'Método de Pago', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->output->set_output(json_encode(array(
                'result' => 0,
                'error' => $this->form_validation->error_array()
            )));
            return false;
        }

        $datos_factura = [
            'no_factura'        => $this->input->post('no_factura'),
            'id_proveedor'      => $this->usuario_actual,
            'folio'         	=> $this->input->post('folio'),
            'monto'             => str_replace(['$ ', ','], ['',''], $this->input->post('monto')),
            'id_metodo_pago'    => $this->input->post('id_metodo_pago'),
            'fecha'   			=> date("Y-m-d H:i:s" , strtotime($this->input->post('fecha'))),
            'pdf'               => $this->input->post('pdf_file'),
            'xml'               => $this->input->post('xml_file'),
            'activo'            => '1',
            'eliminado'         => '0',
            'fecha_creacion'    => $this->functions->fecha_actual(),
            'creado_por'        => $this->usuario_actual
        ];
        
		$this->load->model(['facturas_proveedores_model', 'facturas_proveedor_estados_model']);
        $result = $this->facturas_proveedores_model->insert($datos_factura);
        if ($result) {
            //movemos los archivos
            if (!is_dir(FCPATH . FACTURAS_PATH.'/'.sha1($result))) {
                mkdir(FCPATH . FACTURAS_PATH.'/'.sha1($result));
            }
            rename(TMP_FOLDER.'/'.$datos_factura['pdf'], FACTURAS_PATH.'/'.sha1($result).'/'.$datos_factura['pdf']);
            rename(TMP_FOLDER.'/'.$datos_factura['xml'], FACTURAS_PATH.'/'.sha1($result).'/'.$datos_factura['xml']);
            
	        $info = [
	        	'id_factura_proveedor'	=> $result,
	        	'status'            	=> $this->input->post('status'),
	        	'fecha_estado'			=> $this->functions->fecha_actual(),
	        	'usuario_cambio_estado' => $this->usuario_actual
	        ];

	        $this->facturas_proveedor_estados_model->insert($info);
            
            $this->output->set_output(json_encode(array(
                'result' => 1
            )));
            return false;
        }
    }
}
