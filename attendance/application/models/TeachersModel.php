<?php
  class TeachersModel extends CI_Model
  {
        public function __construct()
        {
                $this->load->database();
        }

        public function getTeachersFromSubjectId(){
          $sql = "SELECT * FROM `teachers`";
          $query = $this->db->query($sql);
          $data = array();
          $i = 0;
          foreach ($query->result_array() as $row) {
            $data[$i]['id'] = $row['id'];
            $data[$i]['teacher_name'] = $row['teacher_name'];
            $i = $i+1;
          }
          return $data;
        }

        public function getTeacherNameFromId($teacher_id){
          $teacher_details = $this->db->query("SELECT `teacher_name` FROM `teachers` WHERE `id` = '$teacher_id'")->row();
          return $teacher_details->teacher_name;
        }

        public function getAllTeachers(){
          $sql = "SELECT * FROM `teachers`";
          $query = $this->db->query($sql);
          $data = array();
          $i = 0;
          foreach ($query->result_array() as $row) {
            $data[$i]['id'] = $row['id'];
            $data[$i]['teacher_name'] = $row['teacher_name'];
            $data[$i]['teacher_email'] = $row['teacher_email'];
            $i = $i+1;
          }
          return $data;
        }




}
?>
