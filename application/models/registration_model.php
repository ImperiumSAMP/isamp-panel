<?php

class Registration_model extends MY_Model {
    
    public $primary_key = 'regid';
    
    function get_last_by_login($username,$password){
		return @$this->order_by("lastedit","desc")->get_many_by(array('name' => $username, 'password' => $password))[0];
	}
	
	function get_last_by_name($username){
		return $this->order_by("lastedit","desc")->get_many_by(array('name' => $username))[0];
	}
	
	function get_last_by_token($token){
	    return $this->order_by("lastedit","desc")->get_many_by(array('regtoken' => $token))[0];
	}
	function get_all_by_token($token){
	    return $this->order_by("lastedit","desc")->get_many_by(array('regtoken' => $token));
	}
}