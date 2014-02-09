<?php
class Bans extends CI_Controller {


	private function player($id,$name){
		$this->load->helper('url');
		return anchor_popup("player/detail_popup/$id",$name,array());
	}
	
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
	
	public function lift($playerid){
		$this->load->model('Ban_model');
		$result=$this->Ban_model->lift_ban($playerid);
		
		if($result==true)
			echo "Ban levantado exitosamente";
		else	
			echo "Error levantando ban";
		
	}

	public function index(){
		$this->load->model('Ban_model');
		$this->load->library('table');
		
		$bans=$this->Ban_model->get_bans();
		
		
		$this->table->set_heading('Nombre', 'IP', 'Fecha inicio', 'Fecha fin', 'Raz&oacute;n', 'Admin', 'Activo?','Panel?','Acciones');
		foreach($bans as $ban)
		{
			$this->table->add_row($this->player($ban->pID,$ban->pName),$ban->pIP,$ban->banDate,$ban->banEnd,$ban->banReason,$this->player($ban->banIssuerID,$ban->banIssuerName),$this->showbool($ban->banActive),$ban->banPanel,$this->actions($ban));
		}
		echo $this->table->generate();
	}
	
}