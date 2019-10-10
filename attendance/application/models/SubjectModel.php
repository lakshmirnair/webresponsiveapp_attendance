<?php
  class SubjectModel extends CI_Model
  {
        public function __construct()
        {
                $this->load->database();
        }

        public function getAllSubjects($sem_id,$dept_id){
          $sql = "SELECT * FROM `subjects`";
          $query = $this->db->query($sql);
          $data = array();
          $i = 0;
          foreach ($query->result_array() as $row) {
            $data[$i]['id'] = $row['id'];
            $data[$i]['subject_name'] = $row['sub_name'];
            $i = $i+1;
          }
          return $data;
        }

        public function listSubjects(){
          $sql = "SELECT * FROM `subjects` where `status`=1";
          $query = $this->db->query($sql);
          $data = array();
          $i = 0;
          foreach ($query->result_array() as $row) {
            $data[$i]['id'] = $row['id'];
            $data[$i]['branch_id'] = self::getDepartmentNameFromId($row['branch_id']);
            $data[$i]['sem_id'] = "Semester ".$row['sem_id'];
            $data[$i]['sub_name'] = $row['sub_name'];
            $data[$i]['sub_code'] = $row['sub_code'];
            $i = $i+1;
          }
          return $data;
        }

        public function getDepartmentNameFromId($id){
          $branch_details = $this->db->query("SELECT `branch_name` FROM `branch` WHERE `id` = $id")->row();
          if($branch_details){
            return $branch_details->branch_name;
          }else{
            return;
          }
        }


        public function getSubjectNameFromId($sub_id){
          $sub_details = $this->db->query("SELECT `sub_name` FROM `subjects` WHERE `id` = $sub_id")->row();
          return $sub_details->sub_name;
        }

        public function addSubject($data){
          $insert = $this->db->insert('subjects',$data);
          if($insert){
            return true;
          }else{
            return false;
          }
        }

        public function deleteSubject($id){
          $this->db->set('status',0);
          $this->db->where('id',$id);
          $update_branch = $this->db->update('subjects');
          if($update_branch){
            return true;
          }else{
            return false;
          }
        }

        public function getAssignedSubjects(){
          $sql = "SELECT * FROM `assigned_subjects` WHERE status = 1";
          $query = $this->db->query($sql);
          $data = array();
          $i = 0;
          foreach ($query->result_array() as $row) {
            $subject_details = self::getSubjectDetailsFromId($row['subject_id']);
            // $data[$i]['id'] = $row['id'];
            // $data[$i]['subject_id'] = $row['subject_id'];
            // $data[$i]['subject_name'] = $subject_details['sub_name'];
            // $data[$i]['subject_code'] = $subject_details['sub_code'];
            // $data[$i]['semester_id'] = $subject_details['sem_id'];
            // $data[$i]['teacher_id'] = $row['teacher_id'];
            $data[$i]['id'] = $row['id'];
            $data[$i]['department_id'] = $row['department_id'];
            $data[$i]['department_name'] = self::getDepartmentNameFromId($row['department_id']);
            $teacher_details = self::getTeacherDetailsFromId($row['teacher_id']);
            $data[$i]['subject_id'] = $row['subject_id'];
            $data[$i]['subject_name'] = $subject_details['sub_name'];
            $data[$i]['subject_code'] = $subject_details['sub_code'];
            $data[$i]['teacher_id'] = $row['teacher_id'];
            $data[$i]['teacher_email'] = $teacher_details->teacher_email;
            $data[$i]['teacher_name'] = $teacher_details->teacher_name;
            // $data[$i]['subject_name'] = $subject_details['sub_name'];
            // $data[$i]['subject_code'] = $subject_details['sub_code'];
            // $data[$i]['semester_id'] = $subject_details['sem_id'];
            // $data[$i]['teacher_id'] = $row['teacher_id'];
            $i = $i+1;
          }
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

        public function getTeacherDetailsFromId($teacher_id){
          $teacher_details = $this->db->query("SELECT `teacher_email`,`teacher_name` FROM `teachers` WHERE `id` = $teacher_id")->row();
          return $teacher_details;
        }

        public function assignSubject($data){
          $insert = $this->db->insert('assigned_subjects',$data);
          if($insert){
            return true;
          }else{
            return false;
          }
        }

        public function deleteAssignedSubject($id){
          $this->db->set('status',0);
          $this->db->where('id',$id);
          $update_branch = $this->db->update('assigned_subjects');
          if($update_branch){
            return true;
          }else{
            return false;
          }
        }

        public function getAssignedSubjectsFromId($teacher_id){
          $sql = "SELECT * FROM `assigned_subjects` WHERE status = 1 AND teacher_id = $teacher_id";
          $query = $this->db->query($sql);
          $data = array();
          $i = 0;
          foreach ($query->result_array() as $row) {
             $subject_details = self::getSubjectDetailsFromId($row['subject_id']);
             $data[$i]['id'] = $row['id'];
             $data[$i]['department_id'] = $row['department_id'];
             $data[$i]['department_name'] = self::getDepartmentNameFromId($row['department_id']);
             $teacher_details = self::getTeacherDetailsFromId($row['teacher_id']);
             $data[$i]['subject_id'] = $row['subject_id'];
             $data[$i]['subject_name'] = $subject_details['sub_name'];
             $data[$i]['subject_code'] = $subject_details['sub_code'];
             $data[$i]['teacher_id'] = $row['teacher_id'];
             $data[$i]['teacher_email'] = $teacher_details->teacher_email;
             $data[$i]['teacher_name'] = $teacher_details->teacher_name;
             $i = $i+1;
          }
          return $data;
        }

        public function getAssignedSubjectDetailsFromAssignedId($id){
          $assigned_details = $this->db->query("SELECT * FROM `assigned_subjects` WHERE `id` = $id")->row();
          $data = array();
          $data['department_name'] = self::getDepartmentNameFromId($assigned_details->department_id);
          $subject_details = self::getSubjectDetailsFromId($assigned_details->subject_id);
          $data['department_id'] = $assigned_details->department_id;
          $data['subject_id'] = $assigned_details->subject_id;
          $data['teacher_id'] = $assigned_details->teacher_id;
          $data['subject_name'] = $subject_details['sub_name'];
          $data['subject_code'] = $subject_details['sub_code'];
          $data['semester_id'] = $subject_details['sem_id'];
          return $data;
        }

        public function checkIsAssigned($data){
          $department_id = $data['department_id'];
          $subject_id = $data['subject_id'];
          $teacher_id = $data['teacher_id'];

          $assigned_details = $this->db->query("SELECT * FROM `assigned_subjects` WHERE `department_id` = $department_id AND `subject_id` = $subject_id AND `teacher_id` = $teacher_id AND `status`")->row();
          if($assigned_details){
            return true;
          }else{
            return false;
          }
        }

}
?>
