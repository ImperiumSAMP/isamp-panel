<?php
class Certification extends MY_Controller {

	protected $_model="Registration_model";
	protected $_list_title="Lista de solicitudes de cuenta";
	protected $_order="lastedit";
	protected $_order_direction="desc";
	protected $_view="register/list.php";
	private $_search_by_ip=false;
	
	public function _generate_where($criteria,$by){
	    $criteria=urldecode($criteria);
		switch($by){
		    case "byStatusOrName": return "status = '$criteria' or name like '%$criteria%'"; break;
			case "byName": return "name like '%$criteria%'"; break;
			case "byIP": return "IP like '%$criteria%'"; break;
			case "byNameOrIp": return "name like '%$criteria%' or IP like '%$criteria%'"; break;
			default: return "";
		}
	}
	
	public function _set_table_heading($table){
		$table->set_heading('Nombre', 'Edad', 'Usuario foro', 'Detalles' ,'IP','Estado','Última modificacion','Acciones');
		return $table;
	}
	
	public function _add_row_to_table($table,$reg){
		$table->add_row($this->player_detail_link($reg->regid,$reg->name),$reg->age,anchor("http://www.pheek.net/foro/User-".$reg->forumuser,$reg->forumuser),$this->player_detail_link($reg->regid,$this->_detailed_info($reg)),anchor("http://who.is/whois-ip/ip-address/".$reg->ip,$reg->ip),anchor("/certification/search/byStatusOrName/".$reg->status,$reg->status),$reg->lastedit,$this->actions($reg));
	}
	
	private function _detailed_info($reg){
	    return "<span extra-data='
	                    <ul>
	                        <li>Nombre real: ".$reg->realname."</li>
	                        <li>Edad real: " .$reg->realage."</li>
	                        <li>Bio: " .$reg->bio."</li>
	                        <li>Historia: ".$reg->story."</li>
	                   <ul>'>Ver detalles</span>";
	}

	private function player_detail_link($id,$name){
		$this->load->helper('url');
		$atts = array(
              'width'      => '1000',
              'height'     => '800',
              'scrollbars' => 'yes',
              'status'     => 'no',
              'resizable'  => 'yes',
              'screenx'    => '0',
              'screeny'    => '0'
            );

		return anchor_popup("certification/detail_popup/$id",$name,$atts);
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
	
	public function pending(){
	    return parent::search('byStatusOrName','Esperando certificacion');
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
	    $this->load->model("Registration_model",'registration');
	    $previous=$this->registration->get_all_by_token($registration->regtoken);
	    $this->load->helper(array('form', 'url'));
		$this->load->view('register/details.php',array('Notifications' => $notifications, 'Player' => $registration, 'Previous' => $previous));
	}
	
	public function certify($regid){
	    require_level(ACCLEVEL_MODERATOR);
	    
	    $this->load->model("Registration_model","registration");
	    $this->load->model("Account_model","account");
	    
	    $cert=$this->input->post();
	    
	    $reg=$this->registration->as_array()->get($regid);
	    
	    $reg['admincomments']=$cert['admincomments'];
	    $reg['adminname'] = $this->session->userdata('Name');
	    $reg['lastedit'] = null;
	   
	    if($cert['action']=='reject'){
	        $reg['status']='Rechazado';
	    } else if($cert['action']=='accept'){
	        $reg['status']='Aceptado';
	        $userid=$this->account->resetuser($reg['name'], $reg['password']);
	        $reg['accountid']=$userid;
	    }
	    
	    $this->registration->update($regid, $reg);
	    $this->detail_popup($regid);

	}
}