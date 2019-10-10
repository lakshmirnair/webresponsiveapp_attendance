<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function  __construct() {
        parent::__construct();
        $status = $this->load->library('core_class');
		if(!$this->core_class->check_logged()){
             redirect('Login');  
		}	
		$this->core_class->check_is_admin(); 
    }
	
	public function index()
	{
		$this->load->model('Home_model');
		$data['home_data'] = $this->Home_model->getHomeScreenDatas();
		$this->load->view('common/header');
		$this->load->view('common/menu');
		$this->load->view('home/index',$data);
		$this->load->view('common/footer');
	}
}
