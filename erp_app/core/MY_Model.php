<?php

class MY_Model extends CI_Model {

    protected $table = NULL;
    protected $primary_key = NULL;

    // -----------------------------------------------------------------------------------------------------

    public function __construct() {
        parent::__construct();
    }

    // -----------------------------------------------------------------------------------------------------

    /**
     * @usage
     * All: $this->user_model->get();
     * Single: $this->user_model->get(2);
     * Custom: $this->user_model->get(array('any' => 'param'));
     */
    public function get($id = NULL, $order_by = NULL, $like = null, $desactivarComillas = null, $limit = null) {
        if (is_numeric($id)) {
            $this->db->where($this->primary_key, $id);
        }
        if (is_array($id)) {
            foreach ($id as $_key => $_value) {
                $this->db->where($_key, $_value, $desactivarComillas);
            }
        }
        if(is_string($order_by)){
            $this->db->order_by($order_by);
        }
        if (is_array($order_by)) {
            foreach ($order_by as $_value) {
                $this->db->order_by($_value);
            }
        }

        if($like != null){
        	if(is_array($like)){
        		foreach ($like as $k => $v){
        			$this->db->like($k, $v);
        		}
        	}
        }

        if($limit != null){
            $this->db->limit($limit);
        }

        $q = $this->db->get($this->table);
        return $q->result_array();
    }

    public function max($id = NULL ) {
	    if (is_numeric($id)) {
            $this->db->where($this->primary_key, $id);
        }
        if (is_array($id)) {
            foreach ($id as $_key => $_value) {
                $this->db->where($_key, $_value);
            }
        }

	    $this->db->select_max($this->primary_key);
        $q = $this->db->get($this->table);
        return $q->row();
    }

    // -----------------------------------------------------------------------------------------------------

	public function num_rows($id = NULL, $order_by = NULL, $like = null, $desactivarComillas = null) {
        if (is_numeric($id)) {
            $this->db->where($this->primary_key, $id);
        }
        if (is_array($id)) {
            foreach ($id as $_key => $_value) {
                $this->db->where($_key, $_value, $desactivarComillas);
            }
        }
        if(is_string($order_by)){
            $this->db->order_by($order_by);
        }
        if (is_array($order_by)) {
            foreach ($order_by as $_value) {
                $this->db->order_by($_value);
            }
        }

        if($like != null){
        	if(is_array($like)){
        		foreach ($like as $k => $v){
        			$this->db->like($k, $v);
        		}
        	}
        }

        $q = $this->db->get($this->table);

        return $q->num_rows();
    }
	// -----------------------------------------------------------------------------------------------------
    /**
     * @param array $data
     *
     * @usage $result = $this->user_model->insert(
     * 	array(
     * 		'login' => 'Jethro'
     * 		)
     * 	);
     */
    public function insert($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    // -----------------------------------------------------------------------------------------------------

    /**
     * @usage
     * $this->user_model->update(array('login' => 'Peggy'),3);
     * $this->user_model->update(array('name' => 'Markus'),array('date_created' => '0'));
     */
    public function update($new_data, $where) {
        if (is_numeric($where)) {
            $this->db->where($this->primary_key, $where);
        } elseif (is_array($where)) {
            foreach ($where as $_key => $_value) {
                $this->db->where($_key, $_value);
            }
        } else {
            die('You must pass a second parameter to the UPDATE() method');
        }
        $this->db->update($this->table, $new_data);

        return $this->db->affected_rows();
    }

    // -----------------------------------------------------------------------------------------------------

    /**
     * @usage
     * $this->user_model->update(array('login' => 'Peggy'),3);
     * $this->user_model->update(array('name' => 'Markus'),array('date_created' => '0'));
     */
    public function insertUpdate($data, $id = null) {
        if ($id != null) {
            $this->db->select($this->primary_key);
            $this->db->where($this->primary_key, $id);
            $q = $this->db->get($this->table, $id);
            $result = $q->num_rows();
        } else {
            $result = 0;
        }

        if ($result == 0) {
            return $this->insert($data);
        }
        $this->update($data, $id);
        return $id;
    }

    // -----------------------------------------------------------------------------------------------------

    /**
     * @usage
     * $this->user_model->update(array('login' => 'Peggy'),3);
     * $this->user_model->update(array('name' => 'Markus'),array('date_created' => '0'));
     */
    public function count($id = NULL, $order_by = NULL) {
        if (is_numeric($id)) {
            $this->db->where($this->primary_key, $id);
        }
        if (is_array($id)) {
            foreach ($id as $_key => $_value) {
                $this->db->where($_key, $_value);
            }
        }
        if(is_string($order_by)){
            $this->db->order_by($order_by);
        }
        if (is_array($order_by)) {
            foreach ($order_by as $_value) {
                $this->db->order_by($_value);
            }
        }
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }


    // -----------------------------------------------------------------------------------------------------

    /**
     * @usage
     * $this->user_model->delete(6);
     * $this->user_model->delete(array('name' => 'Markus'));
     */
    public function delete($id) {
        if (is_numeric($id)) {
            $this->db->where($this->primary_key, $id);
        } elseif (is_array($id)) {
            foreach ($id as $_key => $_value) {
                $this->db->where($_key, $_value);
            }
        } else {
            die('You must pass a parameter to the DELETE() method');
        }
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }


    // -----------------------------------------------------------------------------------------------------
    public function orden($id, $fromPosition, $toPosition, $direction, $aPosition){

    	$this->db->query("UPDATE ".$this->table." SET orden = 0          WHERE orden = '".$toPosition."'");
    	$this->db->query("UPDATE ".$this->table." SET orden = $toPosition WHERE ".$this->primary_key." = '".$id."'");
    	if($direction === "back") {
    		$this->db->query("UPDATE ".$this->table." SET orden = orden + 1 WHERE ($toPosition <= orden AND orden <= $fromPosition) and ".$this->primary_key." != $id and orden != 0 ORDER BY orden DESC;");
    	}
    	echo '<br>';
    	if($direction === "forward") {
    		$this->db->query("UPDATE ".$this->table." SET orden = orden - 1 WHERE ($fromPosition <= orden AND orden <= $toPosition) and ".$this->primary_key." != $id and orden != 0 ORDER BY orden ASC;");
    	}
    	$this->db->query("UPDATE ".$this->table." SET orden = $aPosition WHERE orden = 0;");
    }
}

?>