<?php
    class StudentsModel extends CI_Model
    {
        public function __construct()
        {
                $this->load->database();
        }

        public function getStudentDetails(){
          $query = $this->db->query('SELECT * FROM `students`');
          $data = array();
          $i = 0;
          foreach ($query->result_array() as $row) {
            $data[$i]['id'] = $row['id'];
            $data[$i]['branch_id'] = $row['branch_id'];
            $data[$i]['sem_code'] = $row['sem_code'];
            $data[$i]['student_name'] = $row['student_name'];
            $data[$i]['roll_number'] = $row['roll_number'];
            $data[$i]['created_date'] = $row['created_date'];
            $i = $i+1;
          }
          return $data;
        }

        public function addStudent($data){
          $insert = $this->db->insert('students',$data);
          if($insert){
            return true;
          }else{
            return false;
          }
        }

        public function getStudents($branch_id,$sem_code){
          $query = $this->db->query("SELECT * FROM `students` WHERE `branch_id` = $branch_id AND `sem_code` LIKE '$sem_code' AND `status` = 1");
          $data = array();
          $i = 0;
          foreach ($query->result_array() as $row) {
            $data[$i]['id'] = $row['id'];
            $data[$i]['student_name'] = $row['student_name'];
            $data[$i]['roll_number'] = $row['roll_number'];
            $data[$i]['created_date'] = $row['created_date'];
            $i=$i+1;
          }
          return $data;
        }

        public function deleteStudent($id){
          $this->db->set('status',0);
          $this->db->where('id',$id);
          $update_branch = $this->db->update('students');
          if($update_branch){
            return true;
          }else{
            return false;
          }
        }
       
    }
?>
