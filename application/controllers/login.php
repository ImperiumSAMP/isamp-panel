<?php
class Login extends CI_Controller {

	public function index(){
		$this->_login_form();
	}
	
	public function database(){
	    require_level(ACCLEVEL_SUPERADMIN);

	    //session_start();
	    $_SESSION['PMA_single_signon_user'] = $this->db->username;
        $_SESSION['PMA_single_signon_password'] = $this->db->password;
        $_SESSION['PMA_single_signon_host'] = $this->db->hostname;
        if (!isset($_SESSION['PMA_single_signon_token'])) {
            $_SESSION['PMA_single_signon_token'] = md5(uniqid(rand(), true));
        }
        session_write_close();
        //print_r($_SESSION);
        redirect("/phpmyadmin/index.php?server=1",303);
	}
	
	public function _login_form(){
		$this->load->helper(array('form', 'url'));
		$this->load->library(array('form_validation','session'));
		
		$this->form_validation->set_rules('username', 'Usuario', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('redirect_url',$this->session->flashdata('redirect_url'));
			$this->load->view("header.php",array('title'=>'Los Santos Roleplay - Iniciar sesi&oacute;n'));
			$this->load->view("login_form.php");
			$this->load->view("footer.php");
		}
		else
		{
			$user=$this->_process_login();
			
			if($user){
				$this->session->set_userdata($user);
				$redirect_url=$this->session->flashdata('redirect_url');
				if($redirect_url!="")
					redirect(urldecode($redirect_url));
				else
					redirect('/');
			} else {
			    $this->load->model("Registration_model","registration");
			    $username=$this->input->post('username');
		        $password=$this->input->post('password');
			    $reg=$this->registration->get_last_by_login($username,$password);
				if($reg){ 
				    redirect('/certification/status/'.$reg->regtoken);
				} else {
    				$this->session->set_flashdata( 'message', 'Login inv&aacute;lido.' );
                    $this->session->set_flashdata('redirect_url',$this->session->flashdata('redirect_url'));
    				$this->load->view("header.php",array('title'=>'Los Santos Roleplay - Iniciar sesi&oacute;n'));
    				$this->load->view("login_form.php");
    				$this->load->view("footer.php");
				}
			}
		}
		
	}
	
	public function _process_login(){
		$this->load->model('account_model','account');
		$username=$this->input->post('username');
		$password=$this->input->post('password');
		
		return $this->account->get_by_login($username,$password);
	}
	
	public function access_denied(){
		$this->load->view("header.php",array('title'=>'Los Santos Roleplay - Acceso denegado'));
		$this->load->view("topbar.php");
		$this->load->view("busted.php");
		$this->load->view("footer.php");
	}
	
	public function logout(){
		$this->load->library('session');
		$this->session->sess_destroy();
		
		$this->load->view("header.php",array('title'=>'Los Santos Roleplay - Cerrar sesión'));
		$this->load->view("topbar.php");
		$this->load->view("logout.php");
		$this->load->view("footer.php");
	}
	
}