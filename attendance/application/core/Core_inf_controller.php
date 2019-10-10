<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Core_inf_controller extends CI_Controller {

	
	public function index()
	{
		$this->load->helper('url');
		$this->load->view('common/header');
		$this->load->view('common/side_menu');
		$this->load->view('common/menu');
		$this->load->view('home/index');
		$this->load->view('common/footer');
	}
}
