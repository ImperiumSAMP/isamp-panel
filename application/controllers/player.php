<?php
class Player extends MY_Controller {

	protected $_model="Account_model";
	protected $_list_title="Lista de usuarios";
	protected $_order="name";
	protected $_order_direction="asc";
	
	public function _generate_where($criteria){
		return "name like '%$criteria%'";
	}
	
	public function _set_table_heading($table){
		$table->set_heading('Nombre', 'IP', 'Nivel', 'Nivel admin', 'Edad', 'Experiencia', 'Dinero en mano','Dinero en banco','Skin','Acciones');
		return $table;
	}
	
	public function _add_row_to_table($table,$acc){
		$table->add_row($this->player_detail_link($acc->Id,$acc->Name),anchor("http://who.is/whois-ip/ip-address/".$acc->Ip,$acc->Ip),$acc->Level,$acc->AdminLevel,$acc->Age,$acc->Exp,$acc->CashMoney,$acc->BankMoney,$acc->Skin,$this->actions($acc));
	}


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
	
	public function register(){
		$this->load->helper(array('form', 'url'));
		$this->load->library(array('form_validation','session'));
		$this->load->view("header.php",array('title'=>'Registro de usuarios'));
		//$this->load->view("topbar.php");
		$this->load->view("register_form.php");
		$this->load->view("footer.php");
	}
	
	private function actions($player){
		$acts="";
		$acts.=anchor("player/user/".$player->Name,"<img src='/gtasa-mapicons/zoom.png' width='18px' height='18px'/>");
		$acts.=anchor_popup("bans/ban/".$player->Id,'<img src="/gtasa-mapicons/property_red.gif"/>');
		//$acts.=anchor("#",'<img src="/gtasa-mapicons/marker.gif"/>');
		return $acts;
	}

	public function index(){
		$this->user($this->session->userdata('Name'));
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