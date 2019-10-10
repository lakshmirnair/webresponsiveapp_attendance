<?php
    class Home_model extends CI_Model
    {
        public function __construct()
        {
                $this->load->database();
        }

        public function getHomeScreenDatas(){
          $data = array();

          $query = $this->db->query('SELECT `id` FROM branch where `status`=1');
          $data['departments_count'] = $query->num_rows();

          $query = $this->db->query('SELECT `id` FROM students where `status`=1');
          $data['students_count'] = $query->num_rows();

          $query = $this->db->query('SELECT `id` FROM subjects where `status`=1');
          $data['subjects_count'] = $query->num_rows();

          $query = $this->db->query('SELECT `id` FROM teachers where `status`=1');
          $data['teachers_count'] = $query->num_rows();
          
          return $data;
        }

        public function getRecentNotifications(){
          $date1 = date('Y-m-d');
          $date2 = date('Y-m-d',(strtotime ( '+1 day' , strtotime ( $date1) ) ));
          $sql1 = "SELECT * FROM `receipts` WHERE `to_date` LIKE '$date1'";
          $sql2 = "SELECT * FROM `receipts` WHERE `to_date` LIKE '$date2'";

          $query1= $this->db->query($sql1);
          $query2= $this->db->query($sql2);

          $data = array();
          $i = 0;
          foreach ($query1->result_array() as $row) {
            $data[$i]['student_id'] = $row['student_id'];
            $data[$i]['student_name'] = self::getStudentName($row['student_id']);
            $data[$i]['package_id'] = $row['package_id'];
            $data[$i]['package_name'] = self::getPackageName($row['package_id']);
            $data[$i]['day'] = 'today';
            $data[$i]['error_info'] = 'danger';
            $i = $i+1;
          }

          foreach ($query2->result_array() as $row) {
            $data[$i]['student_id'] = $row['student_id'];
            $data[$i]['student_name'] = self::getStudentName($row['student_id']);
            $data[$i]['package_id'] = $row['package_id'];
            $data[$i]['package_name'] = self::getPackageName($row['package_id']);
            $data[$i]['day'] = 'Tomorrow';
            $data[$i]['error_info'] = 'info';
            $i = $i+1;
          }

          return $data;
        }

        public function getStudentName($student_id){
          $name= $this->db->query("SELECT `first_name`,`last_name` FROM `students` WHERE `id` = $student_id")->row();
          return $name->first_name.' '.$name->last_name;
        }

        public function getPackageName($package_id){
          $package_name = $this->db->query("SELECT `package_name` FROM `packages` WHERE `id` = $package_id")->row();
          return $package_name->package_name;
        }
       
    }
?>
