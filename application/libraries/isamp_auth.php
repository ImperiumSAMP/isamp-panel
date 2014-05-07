<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Isamp_auth {
	var $CI;
    public function __construct()
    {
        $this->CI=& get_instance();
		$this->CI->load->helper('url');
		$this->CI->load->library('session');
    }
	
	public function require_level($level){
		$this->require_login();
		if($this->CI->session->userdata('AdminLevel')<$level)
			$this->access_denied();
		else
			return true;
	}
	
	public function check_level($level){
		if(!$this->check_login()) return false;
		if($this->CI->session->userdata('AdminLevel')<$level) return false;
		return true;
	}
	
	public function match_level($level){
		if(!$this->check_login()) return false;
		if($this->CI->session->userdata('AdminLevel')==$level) return true;
		return false;
	}
	
	public function access_denied(){
		$this->CI->session->set_flashdata('redirect_url',current_url());
		redirect('login/access_denied');
	}
	
	public function require_login(){
		if(strlen($this->CI->session->userdata('Name'))==0){
			$this->CI->session->set_flashdata('redirect_url',current_url());		
			redirect('login');
		}
	}
	
	public function check_login(){
		if(strlen($this->CI->session->userdata('Name'))==0)
			return false;
		return true;
	}
	
	public function get_acclevel(){
		return $this->CI->session->userdata('AdminLevel');
	}
	
}