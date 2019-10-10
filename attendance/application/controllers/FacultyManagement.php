<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FacultyManagement extends CI_Controller {
	function  __construct() {
        parent::__construct();
        $status = $this->load->library('core_class');
		if(!$this->core_class->check_logged()){
             redirect('Login');  
		}	
		$this->core_class->check_is_admin(); 
    }

	public function list(){
        $data = array();
        $this->load->model('FacultyModel');
		$data['faculties'] = $this->FacultyModel->getAllFaculties();
        $this->load->helper('url');
        $this->load->view('common/datatables_header');
        $this->load->view('common/menu');
        $this->load->view('faculty_management/get_all_faculties',$data);
        //$this->load->view('common/datatables_footer');
    }

	
	public function addFaculty()
	{
		if($_POST){
			$teacher_email = $this->input->post('faculty_email');
			$this->load->model('FacultyModel');
			$check_is_registered = $this->FacultyModel->checkIsAlreadyRegistered($teacher_email);
			if($check_is_registered===true){
				$this->session->set_flashdata('alert_message', 'Faculty Email is already registered');
                redirect(current_url());
			}
			$data = array(
				'teacher_email' => $this->input->post('faculty_email'),
				'teacher_name' => $this->input->post('faculty_name'),
				'teacher_code' => $this->input->post('faculty_code'),
			);
			
            $add_student = $this->FacultyModel->addFaculty($data);
            if($add_student===true){
            	redirect(base_url().'index.php/FacultyManagement/list');
            }
		} 
		$data = array();
		$this->load->view('common/header');
		$this->load->view('common/menu');
		$this->load->view('faculty_management/add_faculty',$data);
		$this->load->view('common/footer');
	}

	public function delete_faculty($id){
		$this->load->model('FacultyModel');
		$delete_dept = $this->FacultyModel->deleteFaculty($id);
		if($delete_dept){
			redirect(base_url().'index.php/FacultyManagement/list');
		}
	}

	public function assignSubject()
	{
		if($_POST){
			$data = array(
				'teacher_email' => $this->input->post('faculty_email'),
				'teacher_name' => $this->input->post('faculty_name'),
				'teacher_code' => $this->input->post('faculty_code'),
			);
			$this->load->model('FacultyModel');
            $add_student = $this->FacultyModel->addFaculty($data);
            if($add_student===true){
            	redirect(base_url().'index.php/FacultyManagement/list');
            }
		} 
		$data = array();
		$this->load->view('common/header');
		$this->load->view('common/menu');
		$this->load->view('faculty_management/assign_subject',$data);
		$this->load->view('common/footer');
	}
}
