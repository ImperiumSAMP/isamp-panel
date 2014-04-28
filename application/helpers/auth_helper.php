<?php

function print_if_level($level,$text){
	$CI =& get_instance();
	if($CI->isamp_auth->check_level($level))
		print $text;
}

function print_if_level_arr($arr){
	$CI =& get_instance();
	foreach($arr as $level => $text){
		if($CI->isamp_auth->match_level($level))
			print $text;
	}
}

function print_login_info(){
	$CI =& get_instance();
	if($CI->isamp_auth->check_login()){
		$CI->load->view("login_info",$CI->session->all_userdata());
	}
}

function require_level($level){
	$CI =& get_instance();	
	return $CI->isamp_auth->require_level($level);
}