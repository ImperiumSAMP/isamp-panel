<?php
class Player extends CI_Controller {


	/*private function player($id,$name){
		$this->load->helper('url');
		return anchor_popup("player/detail_popup/$id",$name,array());
	}*/
	
	private function player_detail_link($id,$name){
		$this->load->helper('url');
		return anchor_popup("player/detail_popup/$id",$name,array());
	}
	
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
		$this->search();
	}
	
	public function search($criteria=""){
		require_level(ACCLEVEL_MODERATOR);
		$this->load->model('Account_model','account');
		$this->load->library('table');
		
		$this->account->order_by('name');
		
		$where="Name like '%$criteria%'";
		
		$accounts=$this->account->limit(50)->get_many_by($where);
		$table="No se encontraron resultados";
		
		if($accounts){

			$tmpl = array ( 'table_open'  => '<table id="gradient-style">' );
			$this->table->set_template($tmpl); 
			
			$this->table->set_heading('Nombre', 'IP', 'Nivel', 'Nivel admin', 'Edad', 'Experiencia', 'Dinero en mano','Dinero en banco','Skin','Acciones');
			if(count($accounts)==1){
				$acc=$accounts;
				$this->table->add_row($this->player_detail_link($acc->Id,$acc->Name),anchor("http://who.is/whois-ip/ip-address/".$acc->Ip,$acc->Ip),$acc->Level,$acc->AdminLevel,$acc->Age,$acc->Exp,$acc->CashMoney,$acc->BankMoney,$acc->Skin,$this->actions($acc));
			}else{
				foreach($accounts as $acc)
				{
					$this->table->add_row($this->player_detail_link($acc->Id,$acc->Name),anchor("http://who.is/whois-ip/ip-address/".$acc->Ip,$acc->Ip),$acc->Level,$acc->AdminLevel,$acc->Age,$acc->Exp,$acc->CashMoney,$acc->BankMoney,$acc->Skin,$this->actions($acc));
				}
			}
			$table=$this->table->generate();
		}
			$title="Lista de usuarios";
			$this->load->view("header.php",array('title'=>$title));
			$this->load->view("topbar.php");
			$data=array('table'=>$table,'module'=>'player','title'=>$title);
			$this->load->view("bans/list.php",$data);
			$this->load->view("footer.php");

	}
	
	public function detail_popup($playerid){
		if($playerid==$this->session->userdata('Id'))
			require_level(ACCLEVEL_USER);
		else
			require_level(ACCLEVEL_MODERATOR);
		
		$this->load->model('Account_model','account');
		
		$account=$this->account->get($playerid);
		$this->_show_details($account);
	}
	
	public function user($name){
		if($name==$this->session->userdata('Name'))
			require_level(ACCLEVEL_USER);
		else
			require_level(ACCLEVEL_MODERATOR);
	
		$this->load->model('Account_model','account');
		$account=$this->account->get_by_name($name);
		$this->load->view("header.php",array('title'=>"Malos Aires Roleplay - Ficha del ciudadano $name"));
		$this->load->view("topbar.php");
		$this->_show_details($account);
		$this->load->view("footer.php");
	}
	
	public function _show_details($account){
		$this->load->model('Job_model','job');
		$this->load->model('Faction_model','faction');
		
		$job=$this->job->get($account->Job);
		$faction=$this->faction->get($account->Faction);
		
		$this->load->view('players/details.php',array('Player' => $account, 'Job' =>  $job, 'Faction' => $faction));
	}
}