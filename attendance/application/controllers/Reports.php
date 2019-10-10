<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

	function  __construct() {
        parent::__construct();
        $status = $this->load->library('core_class');
		if(!$this->core_class->check_logged()){
             redirect('Login');  
		}	
		$this->core_class->check_is_teacher(); 
    }

	public function index(){
		$teacher_id = $this->session->userdata['user_data']['teacher_id']; 
        $data = array();
        $this->load->model('ReportModel');
        $data['reports'] = $this->ReportModel->getAllReports($teacher_id);
        $this->load->helper('url');
        $this->load->view('common/datatables_header');
        $this->load->view('common/teacher_menu');
        $this->load->view('reports/get_all_reports',$data);
    }
	
	public function addDepartment(){
		if($_POST){
			$data = array(
				'branch_name' => $this->input->post('branch_name'),
				'branch_code' => $this->input->post('branch_code'),
			);
			$this->load->model('DepartmentModel');
            $addExp = $this->DepartmentModel->addDept($data);
            if($addExp===true){
            	redirect(base_url().'index.php/Departments/list');
            }
		} 
		$this->load->view('common/header');
		$this->load->view('common/menu');
		$this->load->view('departments/add_department');
		$this->load->view('common/footer');
	}

	public function delete_department($id){
		$this->load->model('DepartmentModel');
		$delete_dept = $this->DepartmentModel->deleteDepartment($id);
		if($delete_dept){
			redirect(base_url().'index.php/Departments/list');
		}
	}

	public function getSubjectsFromDepartmentId($dept_id){
		$this->load->model('DepartmentModel');
		$subjects = $this->DepartmentModel->getSubjectsFromDepartmentId($dept_id);
		$html = '<option value="">Select a Subject</option>';
		foreach ($subjects as $row) {
			$html = $html.'<option value="'.$row['id'].'">'.$row['subject_name'].'</option>';
		}
		echo $html;
		die();
	}

	public function getDetails($id){
		$data = array();
        $this->load->model('ReportModel');
        $data['reports'] = $this->ReportModel->getDetails($id);
        $this->load->helper('url');
        $this->load->view('common/datatables_header');
        $this->load->view('common/teacher_menu');
        $this->load->view('reports/get_all_report_details',$data);
	}

	public function subjectWiseReport($id){
		$data = array();
        $this->load->model('ReportModel');
        $this->load->model('StudentsModel');
        $subject_details = $this->ReportModel->getAssignedSubjectDetails($id);

        $department_id = $subject_details['department_id'];
        $semester_id = $subject_details['sem_id'];
        $subject_id = $subject_details['subject_id'];
        $teacher_id = $subject_details['teacher_id'];

        $total_hours_class_took = $this->ReportModel->totalHoursClassTook($department_id,$semester_id,$subject_id,$teacher_id);
        $branch_id = $subject_details['department_id'];
        $sem_id = $subject_details['sem_id'];
        $student_details = $this->StudentsModel->getStudents($branch_id,$sem_id);
        $reports = array();
        $i = 0;
        foreach ($student_details as $row) {
        	$reports[$i]['id']=$row['id'];
        	$reports[$i]['student_name']=$row['student_name'];
        	$reports[$i]['roll_number']=$row['roll_number'];
        	$reports[$i]['total_hours_class_took']=$total_hours_class_took;
        	$hours_attended = $this->ReportModel->studentAttendanceFromDetails($department_id,$semester_id,$subject_id,$teacher_id,$row['id']);
        	$reports[$i]['hours_present']=$hours_attended['present'];
        	$reports[$i]['hours_absent']=$hours_attended['absent'];
        	if($hours_attended['present']==0){
        		$reports[$i]['percent_present']=0;
        	}else{
        		$reports[$i]['percent_present']=($hours_attended['present']/$total_hours_class_took)*100;
        	}
        	$i = $i+1;
        }
        $data['reports']=$reports;
        $data['subject_details']=$subject_details;
        $this->load->helper('url');
        $this->load->view('common/datatables_header');
        $this->load->view('common/teacher_menu');
        $this->load->view('reports/subject_wise_report',$data);
	}

}
