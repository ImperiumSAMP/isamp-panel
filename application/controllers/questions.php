<?php
class Questions extends CI_Controller {

    public function index(){
        $this->_register_form_questions();
    }
	
	public function _register_form_questions($reg=null){
	    $this->load->helper(array('form', 'url'));
	    $this->load->library(array('form_validation','session'));
		
		$this->form_validation->set_rules('MG', "'Definicion MG'", 'required|min_length[200]|max_length[1000]');
		$this->form_validation->set_rules('PG', "'Definicion PG'", 'required|min_length[200]|max_length[1000]');
		$this->form_validation->set_rules('DM', "'Definicion DM'", 'required|min_length[200]|max_length[1000]');
		$this->form_validation->set_rules('CKS', "'Definicion CK'", 'required|min_length[200]|max_length[1000]');
		$this->form_validation->set_rules('RolEntorno', "'Definicion rol entorno'", 'required|min_length[200]|max_length[1000]');
		
		$this->form_validation->set_error_delimiters('<p class="validation-errors">* ', '</p>');
		
		$this->load->view("header.php",array('title'=>'Registro de usuarios'));
		
		if ($this->form_validation->run() == FALSE)
		{
    		$this->load->view("register/formquestions.php",isset($reg) ? array("reg" => $reg) : array());
		}
		else
		{
		    $token=$this->_save_register();
		    if($token!=null){
			    $this->load->view('register/success',array('token'=>$token));
		    }
			else
			    $this->load->view('register/error',array('token'=>$token));
		}
		
    	$this->load->view("footer.php");
	}
}