<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_AddDocumentInventario extends CI_Migration {

	public function up() {
		$this->dbforge->add_column('ordenes', '`inventario` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `cotizacion_particular`');
	}

	public function down() {
		$this->dbforge->drop_table('table_name',TRUE);
		$this->dbforge->drop_table('table_name',TRUE);
		$this->dbforge->drop_table('table_name',TRUE);
	}
}