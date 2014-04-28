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
		require_level(ACCLEVEL_ADMIN);
		$this->load->model('ban_model');
		$result=$this->ban_model->lift_ban($playerid);
		
		if($result==true)
			echo "Ban levantado exitosamente";
		else	
			echo "Error levantando ban";
		
	}

	public function index(){
		$this->search();
	}
	
	public function search($criteria){
		require_level(ACCLEVEL_MODERATOR);
		$this->load->model('Ban_model');
		$this->load->library('table');
		
		//$bans=$this->Ban_model->get_bans();
		$this->Ban_model->order_by('banDate','desc');
		$bans=$this->Ban_model->limit(50)->get_many_by("pName like '%$criteria%'");
		
		echo "<br/><br/><br/><br/><br/><br/><br/";
		print_r($bans);
		
		if($bans!=array()){			
			
			$tmpl = array ( 'table_open'  => '<table id="gradient-style">' );
			$this->table->set_template($tmpl); 
			
			$this->table->set_heading('Nombre', 'IP', 'Fecha inicio', 'Fecha fin', 'Raz&oacute;n', 'Admin', 'Activo?','Panel?','Acciones');

			if(count($bans)==1){
				//$ban=$bans;
				$this->table->add_row($this->player($bans->pID,$bans->pName));//,$ban->pIP,$ban->banDate,$ban->banEnd,$ban->banReason,$this->player($ban->banIssuerID,$ban->banIssuerName),$this->showbool($ban->banActive),$ban->banPanel,$this->actions($ban));
			} else {
				foreach($bans as $ban)
				{
					$this->table->add_row($this->player($ban->pID,$ban->pName),$ban->pIP,$ban->banDate,$ban->banEnd,$ban->banReason,$this->player($ban->banIssuerID,$ban->banIssuerName),$this->showbool($ban->banActive),$ban->banPanel,$this->actions($ban));
				}
			}
		
			$table=$this->table->generate();
		} else $table = "No se encontraron resultados";
		$title="Lista de Bans";
		$this->load->view("header.php",array('title'=>$title));
		$this->load->view("topbar.php");
		$data=array('table'=>$table,'module'=>'bans','title'=>$title);
		$this->load->view("bans/list.php",$data);
		$this->load->view("footer.php");
	}
	
	public function new_ban_popup(){
		require_level(ACCLEVEL_ADMIN);
		$this->load->view("bans/new_form.php");
	}
	
}