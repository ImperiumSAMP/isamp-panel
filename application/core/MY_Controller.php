<?php
/**
 * A base controller with preset functions for controllers with lists and searches
 */

abstract class MY_Controller extends CI_Controller
{

	protected $_model;
	protected $_order;
	protected $_order_direction;
	protected $module;
	
	public function __construct()
    {
		$this->module=strtolower(get_class($this));
        parent::__construct();
	}
	
	public abstract function _generate_where($criteria,$by);
	public abstract function _set_table_heading($criteria);
	public abstract function _add_row_to_table($table,$rowdata);
	
	public function _query($mdl,$where,$config,$page){
		return $mdl->limit($config['per_page'],$config['per_page']*($page-1))->order_by($this->_order,$this->_order_direction)->get_many_by($where);
	}
	
	public function index(){
		$this->search();
	}
	
	public function search($by="all",$criteria="_",$page=1){
		require_level(ACCLEVEL_MODERATOR);
		$this->load->model($this->_model,"mdl");
		$this->load->library('table');
		$this->load->library('pagination');
				
		$config['base_url'] = base_url("/".$this->module."/search/$by/$criteria");
		if($by=="all" || $criteria=="_") $criteria="";
		$where=$this->_generate_where($criteria,$by);
		$total = $this->mdl->count_by($where);

		$config['total_rows'] = $total;
		$config['per_page'] = 10;
		$config['uri_segment']=5;
		$config['use_page_numbers'] = true;

		$this->pagination->initialize($config);

		$pagination=$this->pagination->create_links();
		
		$list=$this->_query($this->mdl,$where,$config,$page);
		
		if($list!=array()){			
			
			$tmpl = array ( 'table_open'  => '<table id="gradient-style">' );
			$this->table->set_template($tmpl); 
			$this->_set_table_heading($this->table);

			foreach($list as $item)
				$this->_add_row_to_table($this->table,$item);				
		
			$table=$this->table->generate();
		} else $table = "No se encontraron resultados";
		$title=$this->_list_title;
		$this->load->view("header.php",array('title'=>$title));
		$this->load->view("topbar.php");
		$data=array('table'=>$table,'module'=>$this->module,'title'=>$title, 'pagination'=>$pagination, 'searchBy'=>$by);
		$this->load->view("bans/list.php",$data);
		$this->load->view("footer.php");
	}
	
}