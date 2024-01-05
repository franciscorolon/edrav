<?php

function paginate($table, $primaryKey, $columns, $joinQuery = NULL, $extraWhere = '', $groupBy = '') {
    $sql_details = array(
        'user'  => $this->db->username,
        'pass'  => $this->db->password,
        'db'    => $this->db->database,
        'host'  => $this->db->hostname
    );
    $this->load->library('ssp');
    echo json_encode(
            SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy)
    );
}
