<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	public function index()
	{
		$status = $this->load->library('core_class');
		if($this->core_class->check_logged()){
             redirect('Home');  
		}
		$this->load->model('Login_model');
		if($this->input->post() && $this->validateLogin()){
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$validate_login = $this->Login_model->validateLogin($username,$password);
			if($validate_login){
				$user_data = $this->session->userdata('user_data');
				if($user_data['user_status']==1){
					redirect('Home');  
				}else{
					redirect('teacherHome'); 
				}
			}else{
				redirect('Login');
			}
		}		
		$this->load->view('login/index');
	}

	public function validateLogin(){
		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('password','Password','required');
		$result = $this->form_validation->run();
		return $result;
	}


    public function logout(){
    	$this->session->unset_userdata('user_data');
        redirect('Login/index');    
    	$this->session->unset_userdata();
        $this->session->sess_destroy();
    }


}
