<?php

class Ban_model extends CI_Model {

    var $pID   = 0;
    var $pName = '';
    var $pIP    = '';
	var $banDate = '';
	var $banEnd = '';
	var $banReason = '';
	var $banIssuerID = 0;
	var $banIssuerName = '';
	var $banActive=0;
	var $banPanel='';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_bans()
    {
        $this->db->order_by('banDate','desc');
		$this->db->where('banActive',1);
		$query = $this->db->get('bans');
		
        return $query->result();
    }

	function lift_ban($playerid){
		$this->db->where('pID',$playerid);
		$this->db->set('banActive',0);
		$this->db->update('bans');
		
		return true;
	}
	
    function insert_ban()
    {
        $this->db->insert('bans', $this);
    }

    function update_ban()
    {
        $this->db->update('bans', $this, array('pID' => $this->pID));
    }

}
?>