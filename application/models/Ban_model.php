<?php

class Ban_model extends MY_Model {

	public $primary_key = 'pID';

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

    
    function get_bans()
    {
		$this->order_by('banDate','desc');
		return $this->get_all();
    }

	function lift_ban($playerid){
		$this->db->where('pID',$playerid);
		$this->db->set('banActive',0);
		$this->db->update('bans');
		
		return true;
	}
}
?>