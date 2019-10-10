<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TeacherHome extends CI_Controller {

	function  __construct() {
        parent::__construct();
        $status = $this->load->library('core_class');
		if(!$this->core_class->check_logged()){
             redirect('Login');  
		}	
		$this->core_class->check_is_teacher(); 
    }
	
	public function index()
	{
		$teacher_id = $this->session->userdata['user_data']['teacher_id']; 
		$this->load->model('Home_model');
		$this->load->model('SubjectModel');
		$data['assigned_subjects'] = $this->SubjectModel->getAssignedSubjectsFromId($teacher_id);
		$data['assigned_subjects_count'] = count($data['assigned_subjects']);
		$this->load->view('common/header');
		$this->load->view('common/teacher_menu');
		$this->load->view('teacher_home/index',$data);
		$this->load->view('common/footer');
	}
}
