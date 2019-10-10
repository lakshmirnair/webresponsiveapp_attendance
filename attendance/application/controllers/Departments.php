<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Departments extends CI_Controller {

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
        $data['departments'] = $this->DepartmentModel->getAllDepartments();
        $this->load->helper('url');
        $this->load->view('common/datatables_header');
        $this->load->view('common/menu');
        $this->load->view('departments/get_all_departments',$data);
       // $this->load->view('common/datatables_footer');
    }

	
	public function addDepartment()
	{
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
		print_r($subjects);
		echo "mmmm";
		die();
	}
}
