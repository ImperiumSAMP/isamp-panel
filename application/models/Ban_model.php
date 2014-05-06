<?php

class Ban_model extends MY_Model {

	protected $primary_key = 'pID';

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
	
	function ban($player,$issuer,$reason,$dateend){
		$this->pID=$player->Id;
		$this->pName=$player->Name;
		$this->pIP=$player->Ip;
		$this->banDate = date('Y-m-d H:i:s');
		$this->banEnd = $dateend;
		$this->banReason = $reason;
		$this->banIssuerID = $issuer['Id'];
		$this->banIssuerName = $issuer['Name'];
		$this->banActive=1;
		$this->banPanel='Si';
		
		$this->insert($this);
		return true;
	}
}
?>