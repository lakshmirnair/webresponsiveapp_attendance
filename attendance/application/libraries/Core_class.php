<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Core_class {
	    protected $CI;

	    public function __construct()
        {
        	$this->CI =& get_instance();
        	$this->CI->load->helper('url');
        	$this->CI->load->library('session');
        }

        public function check_logged()
        {
        	if($this->CI->session->userdata('user_data') == TRUE){
                        return TRUE;
                }else{
                        return FALSE;
                }
        }

        public function check_is_admin(){
                $logged_user_data = $this->CI->session->userdata('user_data');
                $user_status = $logged_user_data['user_status'];
                if($user_status!=1){
                    echo "Only admin have the permission to access this page";
                    die();
                }
                return true;
        }

        public function check_is_teacher(){
                $logged_user_data = $this->CI->session->userdata('user_data');
                $user_status = $logged_user_data['user_status'];
                if($user_status!=2){
                    echo "Only teacher have the permission to access this page";
                    die();
                }
                return true;
        }
}