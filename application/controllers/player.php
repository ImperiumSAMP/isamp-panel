<?php
class Player extends CI_Controller {


	/*private function player($id,$name){
		$this->load->helper('url');
		return anchor_popup("player/detail_popup/$id",$name,array());
	}*/
	
	private function showbool($val){
		if($val=="yes" || $val==true || $val=="true")
			return "<div id='true'></div>";
		else
			return "<div id='false'></div>";
	}
	
	private function actions($ban){
		$acts="";
		if($ban->banActive==1)
			$acts.=anchor_popup("bans/lift/".$ban->pID,"Levantar",array());
		else
			$acts.="Reactivar";
		
		$acts.=" Detalles";
		return $acts;
	}

	public function index(){
		require_level(ACCLEVEL_MODERATOR);
		
		$this->load->model('Account_model','account');
		$this->load->library('table');
		
		$this->account->order_by('name');
		$bans=$this->account->get_all();
		
		$this->table->set_heading('Nombre', 'IP', 'Fecha inicio', 'Fecha fin', 'Raz&oacute;n', 'Admin', 'Activo?','Panel?','Acciones');
		foreach($bans as $ban)
		{
			$this->table->add_row($this->player($ban->pID,$ban->pName),$ban->pIP,$ban->banDate,$ban->banEnd,$ban->banReason,$this->player($ban->banIssuerID,$ban->banIssuerName),$this->showbool($ban->banActive),$ban->banPanel,$this->actions($ban));
		}
		echo $this->table->generate();
	}
	
	public function detail_popup($playerid){
		if($playerid==$this->session->userdata('Id'))
			require_level(ACCLEVEL_USER);
		else
			require_level(ACCLEVEL_ADMIN);
		
		$this->load->model('Account_model','account');
		print_r($this->account->get($playerid));
	}
	
}