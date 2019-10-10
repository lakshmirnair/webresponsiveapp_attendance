<?php defined('BASEPATH') OR exit('No direct script access allowed');
class AttendanceManagement extends CI_Controller
{
    function  __construct() {
        parent::__construct();
        $status = $this->load->library('core_class');
        if(!$this->core_class->check_logged()){
             redirect('Login');  
        }   
        $this->core_class->check_is_teacher(); 
    }

    public function addAttendance($assigned_id)
    {
        $report_status = '';
        $data = array();
        $this->load->model('SubjectModel');
        $data['assigned_subjects'] = $this->SubjectModel->getAssignedSubjectDetailsFromAssignedId($assigned_id);
        $this->load->view('common/header');
        $this->load->view('common/teacher_menu');
        $this->load->view('attendance_management/add_attendence',$data);
        $this->load->view('common/footer');
    }

    public function addAttendancePost(){
        if($this->input->post()){
            $date = $_POST['date'];
            $current_date = date('Y-m-d');
            if($date>$current_date){
                $this->session->set_flashdata('alert_message', 'Selected date should be less than current date');
                redirect(base_url().'index.php/AttendanceManagement/addAttendance/1');
            }
            $data = array();
            $data['department_id'] = $this->input->post('department_id');
            $data['subject_id'] = $this->input->post('subject_id');
            $data['teacher_id'] = $this->input->post('teacher_id');
            $data['semester_id'] = $this->input->post('semester_id');
            $data['att_date'] = $this->input->post('date');
            $data['hour'] = $this->input->post('hour');

            $this->load->model('DepartmentModel');
            $this->load->model('SemesterModel');
            $this->load->model('SubjectModel');
            $this->load->model('TeachersModel');
            $this->load->model('StudentsModel');
            $data['department_name'] = $this->DepartmentModel->getDepartmentNameFromId($data['department_id']);
            $data['semester_name'] = "Semester".' '.$data['semester_id'];
            $data['subject_name'] = $this->SubjectModel->getSubjectNameFromId($data['subject_id']);
            $data['teacher_name'] = $this->TeachersModel->getTeacherNameFromId($data['teacher_id']);
            $data['student_details'] = $this->StudentsModel->getStudents($data['department_id'],$data['semester_id']);

            $this->load->view('common/header');
            $this->load->view('common/teacher_menu');
            $this->load->view('attendance_management/get_details',$data);
            $this->load->view('common/footer');
        }
    }

    public function postAttendance(){
        if($_POST){
            $department_id = $_POST['department_id'];
            $semester_id = $_POST['semester_id'];
            $subject_id = $_POST['subject_id'];
            $teacher_id = $_POST['teacher_id'];
            $att_date = $_POST['att_date'];

            $this->load->model('StudentsModel');
            //$student_details = $this->StudentsModel->getStudentDetails();
            $student_details = $this->StudentsModel->getStudents($department_id,$semester_id);
            $insert_data = array();
            $i = 0;
            $created_date = date('Y-m-d H:i:s');
            $total_students = 0;
            $total_present = 0;
            $total_absent = 0;
            foreach ($student_details as $row) {
                $student_id = $row['id'];
                $attendance_value = $_POST['student_'.$row['id']];
                $insert_data[$i]['department_id']=$department_id;
                $insert_data[$i]['semester_id']=$semester_id;
                $insert_data[$i]['subject_id']=$subject_id;
                $insert_data[$i]['teacher_id']=$teacher_id;
                $insert_data[$i]['student_id']=$student_id;
                $insert_data[$i]['attendance_value']=$attendance_value;
                $insert_data[$i]['created_date']=$created_date;
                $i = $i+1;
                $total_students = $total_students+1;
                if($attendance_value==1){
                    $total_present = $total_present+1;
                }else{
                    $total_absent = $total_absent+1;
                }
            }

            $attendance_status = array(
                'department_id'=>$department_id,
                'semester_id'=>$semester_id,
                'subject_id'=>$subject_id,
                'teacher_id'=>$teacher_id,
                'att_date'=>$att_date,
                'total_students'=>$total_students,
                'total_present'=>$total_present,
                'total_absent'=>$total_absent,
            );

            $this->load->model('AttendanceModel');
            $post_attendance = $this->AttendanceModel->postAttendance($insert_data,$attendance_status);
            if($post_attendance){
                redirect(base_url().'index.php/Reports');
            }
        }

    }

    public function getSubjects(){
        $semester_id = $_POST['semester_id'];
        $dept_id = $_POST['dept_id'];
        $this->load->model('SubjectModel');
        $get_all_subjects = $this->SubjectModel->getAllSubjects($semester_id,$dept_id);

        $data = '<option value="">Select s subject</option>';
        foreach ($get_all_subjects as $row) {
            $data = $data.'<option value='.$row['id'].'>'.$row['subject_name'].'</value>';
        }
        echo $data;
        die();
    }

    public function getTeachers($id){
        $this->load->model('TeachersModel');
        $get_all_teachers = $this->TeachersModel->getTeachersFromSubjectId();
        $data = '<option value="">Select a teacher</option>';
        foreach ($get_all_teachers as $row) {
            $data = $data.'<option value='.$row['id'].'>'.$row['teacher_name'].'</value>';
        }
        echo $data;
        die();
    }
}