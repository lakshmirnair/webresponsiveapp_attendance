<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SubjectManagement extends CI_Controller {
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
        $this->load->model('SubjectModel');
		$data['subjects'] = $this->SubjectModel->listSubjects();
        $this->load->helper('url');
        $this->load->view('common/datatables_header');
        $this->load->view('common/menu');
        $this->load->view('subject_management/get_all_subjects',$data);
       // $this->load->view('common/datatables_footer');
    }

	
	public function addSubject()
	{
		$status = $this->load->library('core_class');
		if(!$this->core_class->check_logged()){
             redirect('Login');  
		}
		$this->load->model('DepartmentModel');
        $data['departments'] = $this->DepartmentModel->getAllDepartments();	
		if($_POST){
			$data = array(
				'branch_id' => $this->input->post('department_id'),
				'sem_id' => $this->input->post('semester_id'),
				'sub_name' => $this->input->post('subject_name'),
				'sub_code' => $this->input->post('sub_code'),
				'created_date' => date('Y-m-d H:i:s')
			);
			$this->load->model('SubjectModel');
            $add_subject = $this->SubjectModel->addSubject($data);
            if($add_subject===true){
            	redirect(base_url().'index.php/SubjectManagement/list');
            }
		} 
		$this->load->view('common/header');
		$this->load->view('common/menu');
		$this->load->view('subject_management/add_subject',$data);
		$this->load->view('common/footer');
	}

	public function delete_subject($id){
		$this->load->model('SubjectModel');
		$delete_dept = $this->SubjectModel->deleteSubject($id);
		if($delete_dept){
			redirect(base_url().'index.php/SubjectManagement/list');
		}
	}
}
