<?php
class Login extends CI_Controller {

	public function index(){
		$this->_login_form();
	}
	
	public function _login_form(){
		$this->load->helper(array('form', 'url'));
		$this->load->library(array('form_validation','session'));
		
		$this->form_validation->set_rules('username', 'Usuario', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('redirect_url',$this->session->flashdata('redirect_url'));
			$this->load->view("login_form.php");
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
					redirect('/index');
			} else {
				$this->session->set_flashdata( 'message', 'Login inv&aacute;lido.' );
                $this->load->view("login_form.php",array('redirect_url' => $redirect_url ));
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
	}
	
	public function logout(){
		$this->load->library('session');
		$this->session->sess_destroy();
	}
	
}