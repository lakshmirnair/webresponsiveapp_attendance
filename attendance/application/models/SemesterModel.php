<?php
    class SemesterModel extends CI_Model
    {
        public function __construct()
        {
                $this->load->database();
        }

        public function getAllSemesters(){
          $query = $this->db->query('SELECT * FROM `semester`');
          $data = array();
          $i = 0;
          foreach ($query->result_array() as $row) {
            $data[$i]['id'] = $row['id'];
            $data[$i]['semester_code'] = $row['semester_code'];
            $data[$i]['semester_name'] = $row['semester_name'];
            $i = $i+1;
          }
          return $data;
        }

        public function getSemesterNameFromId($semester_code){
          $sem_details = $this->db->query("SELECT * FROM `semester` WHERE `semester_code` = '$semester_code'")->row();
          return $sem_details->semester_name;
        }
       
    }
?>
