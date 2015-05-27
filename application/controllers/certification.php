<?php
class Certification extends MY_Controller {

	protected $_model="Registration_model";
	protected $_list_title="Lista de solicitudes de cuenta";
	protected $_order="name";
	protected $_order_direction="asc";
	//protected $_view="list.php";
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
		$table->set_heading('Nombre', 'IP', 'Edad', 'Usuario foro', 'Nombre real','Edad real','Estado','Última modificacion' ,'Acciones');
		return $table;
	}
	
	public function _add_row_to_table($table,$reg){
		$table->add_row($this->player_detail_link($reg->regid,$reg->name),anchor("http://who.is/whois-ip/ip-address/".$reg->ip,$reg->ip),$reg->age,anchor("http://www.pheek.net/foro/User-".$reg->forumuser,$reg->forumuser),$reg->realname,$reg->realage,$reg->status,$reg->lastedit,$this->actions($reg));
		$table->add_row(
		        array('data' => 'Bio: '.$reg->bio, 'colspan' => 3),
		        array('data' => 'Historia: '.$reg->story, 'colspan' => 6));
	}

	private function player_detail_link($id,$name){
		$this->load->helper('url');
		return anchor_popup("certification/detail_popup/$id",$name,array());
	}
	
	private function showbool($val){
		if($val=="yes" || $val==true || $val=="true")
			return "<div id='true'></div>";
		else
			return "<div id='false'></div>";
	}

	private function actions($player){
		$acts="";
		//$acts.=anchor("player/user/".$player->Name,"<img src='/gtasa-mapicons/zoom.png' width='18px' height='18px'/>");
		//$acts.=anchor_popup("bans/ban/".$player->Id,'<img src="/gtasa-mapicons/property_red.gif"/>');
		//$acts.=anchor("#",'<img src="/gtasa-mapicons/marker.gif"/>');
		return $acts;
	}

	public function index(){
		$this->search();
	}
	
	public function search($by="byNameOrIp",$criteria="_",$page=1){
		return parent::search($by,$criteria,$page);
	}
	
	public function detail_popup($id){
		require_level(ACCLEVEL_MODERATOR);
		$this->load->model("Registration_model","registration");
		$reg=$this->registration->get($id);
		$this->load->view("header.php",array('title'=>"Malos Aires Roleplay - Ficha del ciudadano $reg->name"));
		$this->_show_details($reg);
		$this->load->view("footer.php");
	}
	
	public function user($name){
		require_level(ACCLEVEL_MODERATOR);
		$this->load->model("Registration_model",'registration');
		$account=$this->registration->get_last_by_name($name);
		$this->load->view("header.php",array('title'=>"Malos Aires Roleplay - Ficha del ciudadano $name"));
		$this->load->view("topbar.php");
		$this->_show_details($account);
		$this->load->view("footer.php");
	}
	
	public function status($token){
	    $this->load->model("Registration_model",'registration');
		$account=$this->registration->get_last_by_token($token);
		$this->load->view("header.php",array('title'=>"Malos Aires Roleplay - Ficha del ciudadano $account->name"));
		$this->load->view("topbar.php");
		$this->_show_details($account);
		$this->load->view("footer.php");
	}
	
	public function _show_details($registration,$notifications=""){
		$this->load->view('register/details.php',array('Notifications' => $notifications, 'Player' => $registration));
	}
}