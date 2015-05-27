<?php
class Register extends CI_Controller {

	public function index(){
		$this->load->helper(array('form', 'url'));
		$this->load->library(array('form_validation','session'));

		$this->form_validation->set_rules('name', "'Nombre (IC)'", 'required|is_unique[accounts.Name]|is_unique[registrations.name]|min_length[5]|max_length[32]|callback_name_format');
		$this->form_validation->set_rules('password', "'Contraseña'", 'required|matches[password-validation]');
		$this->form_validation->set_rules('password-validation', "'Repetir contraseña'", 'required');
		$this->form_validation->set_rules('age', "'Edad (IC)'", 'required|integer');
		$this->form_validation->set_rules('birthplace', "'Lugar de nacimiento'", 'required');
		$this->form_validation->set_rules('bio', "'Descripción física'", 'required|min_length[10]|max_length[300]');
		$this->form_validation->set_rules('realname', "'Nombre real'", 'required');
		$this->form_validation->set_rules('realage', "'Edad real'", 'required|integer');
		$this->form_validation->set_rules('email', "'E-Mail'", 'required|valid_email|is_unique[registrations.email]');
		$this->form_validation->set_rules('forumuser', "'Usuario del foro'", 'required|is_unique[registrations.forumuser]');
		$this->form_validation->set_rules('story', "'Historia del personaje'", 'required|min_length[20]|max_length[1000]');
		
		$this->form_validation->set_error_delimiters('<p class="validation-errors">* ', '</p>');
		
    	$this->load->view("header.php",array('title'=>'Registro de usuarios'));
		
		if ($this->form_validation->run() == FALSE)
		{
    		$this->load->view("register/form.php");
		}
		else
		{
		    $token=$this->_save_register();
		    if($token!=null)
			    $this->load->view('register/success',array('token'=>$token));
			else
			    $this->load->view('register/error',array('token'=>$token));
		}
		
    	$this->load->view("footer.php");
	}
	
	public function name_format($name){
        if (!preg_match('/\A[A-Z][a-zA-Z]+_[A-Z][a-zA-Z]+\z/',$name,$coincidencias))
		{
			$this->form_validation->set_message('name_format', "El nombre debe seguir el formato 'Nombre_Apellido'");
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	private function _save_register(){
	    $this->load->model("Registration_model","registration");
	    
	    $reg = $this->input->post();
	    $reg["ip"]=$this->input->ip_address();
	    $reg["regtoken"]=uniqid("",true);
	    unset($reg["password-validation"]);
	    
	    if($this->registration->insert($reg)!=null)
	        return $reg["regtoken"];
	    else {
	        return null;
	    }
	}

}