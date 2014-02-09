<?php

class Admin_log_model extends CI_Model {

    var $logid   = 0;
    var $pID   = 0;
	var $pName = '';
    var $pIP    = '';
	var $date = '';
	var $text = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

	function get_logs()
    {
        $this->db->order_by('date','desc');
		$query = $this->db->get('log_admin');
		
        return $query->result();
    }
	
    function insert_log()
    {
        $this->db->insert('log_admin', $this);
    }

    function update_log()
    {
        $this->db->update('log_admin', $this, array('logid' => $this->logid));
    }
	
}