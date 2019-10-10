<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AssignedList extends CI_Controller {
	function  __construct() {
        parent::__construct();
        $status = $this->load->library('core_class');
		if(!$this->core_class->check_logged()){
             redirect('Login');  
		}	 
    }

	public function list(){
        $data = array();
        $this->load->model('SubjectModel');
        $this->load->model('TeachersModel');
		$data['assigned_subjects'] = $this->SubjectModel->getAssignedSubjects();
        $this->load->helper('url');
        $this->load->view('common/datatables_header');
        $this->load->view('common/menu');
        $this->load->view('subject_management/get_assigned_subjects',$data);
    }

	
	public function assignSubject()
	{
		$status = $this->load->library('core_class');
		if(!$this->core_class->check_logged()){
             redirect('Login');  
		}
		$this->load->model('DepartmentModel');
        $data['departments'] = $this->DepartmentModel->getAllDepartments();	
        $this->load->model('TeachersModel');
        $data['teachers'] = $this->TeachersModel->getAllTeachers();
		if($_POST){
			$data = array(
				'department_id' => $this->input->post('department_id'),
				'subject_id' => $this->input->post('subject_id'),
				'teacher_id' => $this->input->post('teacher_id'),
			);
			$this->load->model('SubjectModel');
			$check_is_assigned = $this->SubjectModel->checkIsAssigned($data);
			if($check_is_assigned===true){
				$this->session->set_flashdata('alert_message', 'The subject is already assigned to the selected to the selected teacher');
                redirect(base_url().'index.php/AssignedList/assignSubject');
			}
            $assign_subject = $this->SubjectModel->assignSubject($data);
            if($assign_subject===true){
            	redirect(base_url().'index.php/AssignedList/list');
            }
		} 
		$this->load->view('common/header');
		$this->load->view('common/menu');
		$this->load->view('subject_management/assign_subject',$data);
		$this->load->view('common/footer');
	}

	public function deleteAssignedSubject($id){
		$this->load->model('SubjectModel');
		$delete_dept = $this->SubjectModel->deleteAssignedSubject($id);
		if($delete_dept){
			redirect(base_url().'index.php/AssignedList/list');
		}
	}
}
