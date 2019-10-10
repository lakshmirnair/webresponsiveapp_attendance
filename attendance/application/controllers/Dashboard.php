<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	
	public function index()
	{
		$status = $this->load->library('core_class');
		if(!$this->core_class->check_logged()){
             redirect('Login');  
		}		
		$this->load->helper('url');
		$this->load->view('dashboard_theme/header');
		$this->load->view('dashboard_theme/menu');
		$this->load->view('dashboard/index');
		$this->load->view('dashboard_theme/footer');
	}


}
