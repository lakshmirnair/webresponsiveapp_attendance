<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BaseController extends CI_Controller {

	public function loadBaseLibraries(){
		$data = array();
		$this->load->helper('url');
		$this->load->library('form_validation');
	}

	public function checkIsLogged(){
		$this->load->library('session');
		print_r($this->session->userdata());
		die();
		die();
		if(!$this->session->userdata()){
			redirect('login/index');
		}
	}

}
