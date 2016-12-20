<?php
class Player extends MY_Controller {

	protected $_model="Account_model";
	protected $_list_title="Lista de usuarios";
	protected $_order="name";
	protected $_order_direction="asc";
	protected $_view="players/list.php";
	private $_search_by_ip=false;
	
	public function _generate_where($criteria,$by){
		switch($by){
			case "byName": return "name like '%$criteria%'"; break;
			case "byIP": return "IP like '%$criteria%'"; break;
			case "byNameOrIp": return "name like '%$criteria%' or IP like '%$criteria%'"; break;
			default: return "";
		}
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
		
		$this->load->view("register/form.php");
		    
		$this->load->view("footer.php");
	}
	
	private function actions($player){
		$acts="";
		$acts.=anchor("player/user/".$player->Name,"<img src='/gtasa-mapicons/zoom.png' title='Detalles' width='18px' height='18px'/>");
		$acts.=anchor_popup("bans/ban/".$player->Id,'<img src="/gtasa-mapicons/property_red.gif" title="Banear"/>');
		//$acts.=anchor("#",'<img src="/gtasa-mapicons/marker.gif"/>');
		return $acts;
	}

	public function index(){
		$this->user($this->session->userdata('Name'));
	}
	
	public function search($by="byNameOrIp",$criteria="_",$page=1){
		return parent::search($by,$criteria,$page);
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
		$this->load->view("header.php",array('title'=>"Los Santos Roleplay - Ficha del ciudadano $name"));
		$this->load->view("topbar.php");
		$this->_show_details($account);
		$this->load->view("footer.php");
	}
	
	public function _show_details($account,$notifications=""){
		//$this->load->model('Job_model','job');
		$this->load->model('Faction_model','faction');
		
		//$job=$this->job->get($account->Job);
		$faction=$this->faction->get($account->Faction);
		
		$this->load->view('players/details.php',array('Notifications' => $notifications, 'Player' => $account, /*'Job' =>  $job,*/ 'Faction' => $faction));
	}
	
	public function create($name=""){
	    require_level(ACCLEVEL_MODERATOR); 
	    $this->load->model('Account_model','account');
	    $this->load->helper('string');
	    $this->load->helper('security');
	    
	    if($name=="")
	        $name=$this->input->post("name");
	    
	    if($name!=""){
	        $pass=random_string("numeric","6");
	        $userid=$this->account->resetuser($name, $pass);    
	        
	        if($userid!=FALSE){
	           		$this->load->view("header.php",array('title'=>"Los Santos Roleplay - Ficha del ciudadano $name"));
		            $this->load->view("topbar.php"); 
		            //$this->load->view('players/created.php',array('Player' => $name,'Password' => $pass));
		            $account=$this->account->get($userid);
		            $this->_show_details($account,"Registrado el usuario <b>$name</b> con password <b>$pass</b>");
		            $this->load->view("footer.php");
	        }
	    } else {
	        $this->load->helper(array('form', 'url'));
	        $this->load->view("header.php",array('title'=>"Los Santos Roleplay - Nueva ciudadan&iacute;a"));
	        $this->load->view("topbar.php");
	        $this->load->view("players/create.php");
            $this->load->view("footer.php");	    
	    }
	    
	}
}
