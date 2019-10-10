<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StudentManagement extends CI_Controller {
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
        $this->load->model('DepartmentModel');
		$this->load->model('SemesterModel');
		$data['departments'] = $this->DepartmentModel->getAllDepartments();
		$data['semesters'] = $this->SemesterModel->getAllSemesters();
		$data['students'] = array();
		if($_POST){
			$branch_id = $this->input->post('branch_id');
			$sem_code = $this->input->post('sem_code');
			$this->load->model('StudentsModel');
			$data['branch_name'] = $branch_id;
			$data['sem_code'] = $sem_code;
			$data['students'] = $this->StudentsModel->getStudents($branch_id,$sem_code);
		}
        $this->load->helper('url');
        $this->load->view('common/datatables_header');
        $this->load->view('common/menu');
        $this->load->view('student_management/get_all_students',$data);
        //$this->load->view('common/datatables_footer');
    }

	
	public function addStudent()
	{
		$this->load->model('DepartmentModel');
		$this->load->model('SemesterModel');
		$data['departments'] = $this->DepartmentModel->getAllDepartments();
		$data['semesters'] = $this->SemesterModel->getAllSemesters();

		if($_POST){
			$data = array(
				'branch_id' => $this->input->post('branch_id'),
				'sem_code' => $this->input->post('sem_code'),
				'student_name' => $this->input->post('student_name'),
				'roll_number' => $this->input->post('roll_number'),
			);
			$this->load->model('StudentsModel');
            $add_student = $this->StudentsModel->addStudent($data);
            if($add_student===true){
            	redirect(base_url().'index.php/StudentManagement/list');
            }
		} 
		$this->load->view('common/header');
		$this->load->view('common/menu');
		$this->load->view('student_management/add_student',$data);
		$this->load->view('common/footer');
	}

	public function delete_student($id){
		$this->load->model('StudentsModel');
		$delete_dept = $this->StudentsModel->deleteStudent($id);
		if($delete_dept){
			redirect(base_url().'index.php/StudentManagement/list');
		}
	}
}
