<?php
class Bans extends MY_Controller {

	protected $_model="Ban_model";
	protected $_list_title="Lista de Bans";
	protected $_order="banDate";
	protected $_order_direction="desc";
	
	public function _generate_where($criteria){
		return "pName like '%$criteria%'";
	}
	
	public function _set_table_heading($table){
		$table->set_heading('Nombre', 'IP', 'Fecha inicio', 'Fecha fin', 'Raz&oacute;n', 'Admin', 'Activo?','Panel?','Acciones');
		return $table;
	}
	
	public function _add_row_to_table($table,$ban){
		$this->table->add_row($this->player($ban->pID,$ban->pName),$ban->pIP,$ban->banDate,$ban->banEnd,$ban->banReason,$this->player($ban->banIssuerID,$ban->banIssuerName),$this->showbool($ban->banActive),$ban->banPanel,$this->actions($ban));
	}

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
		require_level(ACCLEVEL_ADMIN);
		$this->load->model('ban_model');
		$result=$this->ban_model->lift_ban($playerid);
		
		if($result==true)
			echo "Ban levantado exitosamente";
		else	
			echo "Error levantando ban";
		
	}
		
	public function ban($playerid,$reason="",$dateEnd="NULL"){
		require_level(ACCLEVEL_ADMIN);
		$this->load->model('ban_model');
		$this->load->model('account_model');
		$player=$this->account_model->get($playerid);
		$issuer=$this->session->all_userdata();
		$result=$this->ban_model->ban($player,$issuer,$reason,$dateEnd);
		
		if($result==true)
			echo "Usuario baneado exitosamente";
		else	
			echo "Error baneando usuario";
		
	}
	
	public function new_ban_popup(){
		require_level(ACCLEVEL_ADMIN);
		$this->load->view("bans/new_form.php");
	}
	
}