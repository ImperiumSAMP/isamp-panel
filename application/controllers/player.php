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
	
	private function actions($player){
		$acts="";
		$acts.=" Detalles";
		$acts.=" Ver en mapa";
		return $acts;
	}

	public function index(){
		require_level(ACCLEVEL_MODERATOR);
		
		$this->load->model('Account_model','account');
		$this->load->library('table');
		
		$this->account->order_by('name');
		$accounts=$this->account->get_all();
		
		$this->table->set_heading('Nombre', 'IP', 'Nivel', 'Nivel admin', 'Edad', 'Experiencia', 'Dinero en mano','Dinero en banco','Skin','Acciones');
		foreach($accounts as $acc)
		{
			$this->table->add_row($this->player($acc->Id,$acc->Name),$acc->Level,$acc->AdminLevel,$acc->Age,$acc->Exp,$acc->CashMoney,$acc->BankMoney,$this->Skin,$this->actions($acc));
		}
		echo $this->table->generate();
	}
	
	public function detail_popup($playerid){
		if($playerid==$this->session->userdata('Id'))
			require_level(ACCLEVEL_USER);
		else
			require_level(ACCLEVEL_MODERATOR);
		
		$this->load->model('Account_model','account');
		$this->load->model('Job_model','job');
		$this->load->model('Faction_model','faction');
		
		$account=$this->account->get($playerid);
		$job=$this->job->get($account->Job);
		$faction=$this->faction->get($account->Faction);
		
		$this->load->view('players/details.php',array('Player' => $account, 'Job' =>  $job, 'Faction' => $faction));
	}
	
}