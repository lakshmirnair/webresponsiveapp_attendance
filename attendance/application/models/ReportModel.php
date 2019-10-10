<?php
    class ReportModel extends CI_Model
    {
        public function __construct()
        {
                $this->load->database();
        }

        public function getAllReports($teacher_id){
          $query = $this->db->query("SELECT * FROM `attendance_status` WHERE `teacher_id`=$teacher_id");
          $data = array();
          $i = 0;
          $this->load->model('DepartmentModel');
          $this->load->model('SubjectModel');

          foreach ($query->result_array() as $row) {
            $data[$i]['id']=$row['id'];
            $data[$i]['department_name']=$this->DepartmentModel->getDepartmentNameFromId($row['department_id']);
            $data[$i]['semester_name']="Semester ".$row['semester_id'];
            $data[$i]['subject_name']=$this->SubjectModel->getSubjectNameFromId($row['subject_id']);
            $data[$i]['teacher_name']=$row['teacher_id'];
            $data[$i]['att_date']=$row['att_date'];
            $data[$i]['total_students']=$row['total_students'];
            $data[$i]['total_present']=$row['total_present'];
            $data[$i]['total_absent']=$row['total_absent'];
            $i = $i+1;
          }
          return $data;
        }

        public function getDetails($id){
          $query = $this->db->query("SELECT * FROM `attendance_posts` WHERE `attendance_status_id` = $id");
          $data = array();
          $i = 0;
          foreach ($query->result_array() as $row) {
            $data[$i]['id'] = $row['id'];
            $data[$i]['attendance_status_id'] = $row['attendance_status_id'];
            $data[$i]['department_id'] = $row['department_id'];
            $data[$i]['semester_id'] = $row['semester_id'];
            $data[$i]['subject_id'] = $row['subject_id'];
            $data[$i]['teacher_id'] = $row['teacher_id'];
            $data[$i]['student_id'] = $row['student_id'];
            $data[$i]['student_details'] = self::getStudentDetailsFromStudentId($row['student_id']);
            $data[$i]['attendance_value'] = $row['attendance_value'];
            $i = $i+1;
          }
          return $data;
        }

        public function getStudentDetailsFromStudentId($student_id){
          $query_data = $this->db->query("SELECT * FROM `students` where id = $student_id")->row();
          $data = array();
          $data['student_name']=$query_data->student_name;
          $data['roll_number']=$query_data->roll_number;
          return $data;
          $i = 0;
        }

        public function getAssignedSubjectDetails($id){
          $sql = "SELECT * FROM `assigned_subjects` WHERE id = $id";
          $query = $this->db->query($sql);
          $data = array();
          $i = 0;
          foreach ($query->result_array() as $row) {
             $this->load->model('SubjectModel');
             $subject_details = $this->SubjectModel->getSubjectDetailsFromId($row['subject_id']);
             $data['id'] = $row['id'];
             $data['department_id'] = $row['department_id'];
             $data['department_name'] = $this->SubjectModel->getDepartmentNameFromId($row['department_id']);
             $teacher_details = $this->SubjectModel->getTeacherDetailsFromId($row['teacher_id']);
             $data['subject_id'] = $row['subject_id'];
             $data['subject_name'] = $subject_details['sub_name'];
             $data['subject_code'] = $subject_details['sub_code'];
             $data['sem_id'] = $subject_details['sem_id'];
             $data['teacher_id'] = $row['teacher_id'];
             $data['teacher_email'] = $teacher_details->teacher_email;
             $data['teacher_name'] = $teacher_details->teacher_name;
          }
          return $data;


          $query_data = $this->db->query("SELECT * FROM `attendance_status` where id = $id")->row();
          print_r($query_data);
          die();
          $data = array();
          $data['id']=$query_data->id;
          $data['department_id']=$query_data->department_id;
          $data['semester_id']=$query_data->semester_id;
          $data['subject_id']=$query_data->subject_id;
          $data['teacher_id']=$query_data->teacher_id;
          return $data;
        }

        public function getSubjectDetailsFromId($id){
          $sub_details = $this->db->query("SELECT * FROM `subjects` where `id` = $id")->row();
          $data = array();
          $data['branch_id'] = $sub_details->branch_id;
          $data['sem_id'] = $sub_details->sem_id;
          $data['sub_name'] = $sub_details->sub_name;
          $data['sub_code'] = $sub_details->sub_code;
          return $data;
        }

        public function totalHoursClassTook($department_id,$semester_id,$subject_id,$teacher_id){
           $total_hours = $this->db->query("SELECT * FROM `attendance_status` where `department_id` = $department_id AND `semester_id` = $semester_id AND `subject_id` = $subject_id AND `teacher_id` = $teacher_id")->num_rows();
           return $total_hours;
        }

        public function studentAttendanceFromDetails($department_id,$semester_id,$subject_id,$teacher_id,$student_id){
          $query = $this->db->query("SELECT * FROM `attendance_posts` where `department_id` = $department_id AND `semester_id` = $semester_id AND `subject_id` = $subject_id AND `teacher_id` = $teacher_id AND `student_id` = $student_id");
          $present = 0;
          $absent = 0;
          foreach ($query->result_array() as $row) {
            if($row['attendance_value']==1){
              $present = $present+1;
            }else if($row['attendance_value']==2){
              $absent = $absent+1;
            }
          }
          return array(
            'present'=>$present,
            'absent'=>$absent 
          );
        }

        

    }
?>
