<?php
class Commands extends MY_Controller {

	protected $_model="Command_model";
	protected $_list_title="Lista de comandos";
	protected $_order="level,command";
	protected $_order_direction="asc";
	
	public function _generate_where($criteria,$by){
		return "command like '%$criteria%'";
	}
	
	public function _set_table_heading($table){
		$table->set_heading('Comando', 'Nivel', 'Acciones');
		return $table;
	}
	
	public function _add_row_to_table($table,$cmd){
		$this->table->add_row($cmd->command,$cmd->level,$this->actions($cmd));
	}
	
	public function search($by="command",$criteria="_",$page=1){
		require_level(ACCLEVEL_SUPERADMIN);
		
		$this->session->set_flashdata('refreshurl', current_url());
		
		return parent::search($by,$criteria,$page);
	}
	
	private function actions($cmd,$urlappend=""){
		$acts="";
		$acts.=anchor("commands/levelup/" . $cmd->command,'<img title="Subir nivel" src="/gtasa-mapicons/marker.gif"/>');
		$acts.="&nbsp;";
		$acts.=anchor("commands/leveldn/" . $cmd->command,'<img title="Bajar nivel" src="/gtasa-mapicons/marker.gif"/>');
		return $acts;
	}
	
	public function levelup($command){
		require_level(ACCLEVEL_SUPERADMIN);
		$this->mdl->levelup($command);
		redirect($this->session->get_flashdata('refreshurl'));
	}
	
	public function leveldn($command){
		require_level(ACCLEVEL_SUPERADMIN);
		$this->mdl->leveldn($command);
		redirect($this->session->get_flashdata('refreshurl'));
	}
	
}