<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migrate extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->library('session');
        /*if (!is_cli()) {
            echo "This script can only be accessed via the command line" . PHP_EOL;
            die();
        }*/
        $this->load->library('migration');
    }

	public function index() {

		if ($this->migration->current() === FALSE) //		if ($this->migration->version(0) === FALSE)
		{
			show_error($this->migration->error_string());
		} else {
			echo "Migración realizada con éxito";
		}
	}

	public function reset() {
		if ($this->migration->version($this->migration->version()-1) === FALSE) {
			show_error($this->migration->error_string());
		} else {
			echo "Migración realizada con éxito";
		}

		if ($this->migration->current() === FALSE) {
			show_error($this->migration->error_string());
		} else {
			echo "Migración realizada con éxito";
		}
	}

}