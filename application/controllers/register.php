<?php
class Register extends CI_Controller {

    public function index(){
        $this->_register_form();
    }

	public function _register_form($reg=null){
		$this->load->helper(array('form', 'url'));
		$this->load->library(array('form_validation','session'));

		$this->form_validation->set_rules('name', "'Nombre (IC)'", 'required|is_unique[accounts.Name]|min_length[5]|max_length[32]|callback_name_format');
		$this->form_validation->set_rules('password', "'Contraseña'", 'required|matches[password-validation]');
		$this->form_validation->set_rules('password-validation', "'Repetir contraseña'", 'required');
		$this->form_validation->set_rules('age', "'Edad (IC)'", 'required|integer');
		$this->form_validation->set_rules('birthplace', "'Lugar de nacimiento'", 'required');
		$this->form_validation->set_rules('bio', "'Descripción física'", 'required|min_length[10]|max_length[300]');
		$this->form_validation->set_rules('realname', "'Nombre real'", 'required');
		$this->form_validation->set_rules('realage', "'Edad real'", 'required|integer');
		$this->form_validation->set_rules('email', "'E-Mail'", 'required|valid_email');
		$this->form_validation->set_rules('forumuser', "'Usuario del foro'", 'required');
		$this->form_validation->set_rules('story', "'Historia del personaje'", 'required|min_length[20]|max_length[1000]');
		
		$this->form_validation->set_error_delimiters('<p class="validation-errors">* ', '</p>');
		
    	$this->load->view("header.php",array('title'=>'Registro de usuarios'));
		
		if ($this->form_validation->run() == FALSE)
		{
    		$this->load->view("register/form.php",isset($reg) ? array("reg" => $reg) : array());
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
	
	public function retry($regtoken){
	    $this->load->model("Registration_model","registration");
	    $reg = $this->registration->get_last_by_token($regtoken);
	    $this->_register_form($reg);
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
	    if(!isset($reg["regtoken"])) $reg["regtoken"]=uniqid("",true);
	    unset($reg["password-validation"]);
	    
	    if($this->registration->insert($reg)!=null){
	        //$this->_notify_mail($reg);
	        return $reg["regtoken"];
	    }
	    else {
	        return null;
	    }
	}
	
	private function _notify_mail($reg){
	    $this->load->library('email');
	    /*$config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
        $this->email->initialize($config);*/

        $this->email->from('webmaster@malosaires.com.ar', 'Malos Aires Roleplay');
        $this->email->to($reg['email']);

        $this->email->subject('Confirmación de registro en Malos Aires Roleplay');
        $message=$this->load->view('register/success',array('token'=>$reg['regtoken']),TRUE);
        $this->email->message($message);
        $this->email->send();
	}

}