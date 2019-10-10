<?php
    class AttendanceModel extends CI_Model
    {
        public function __construct()
        {
                $this->load->database();
        }

        public function postAttendance($attendance_data,$attendance_status){
          $insert_attendance_status = $this->db->insert('attendance_status',$attendance_status);
          $insert_id = $this->db->insert_id();
          $data = array();
          $i = 0;
          foreach ($attendance_data as $row) {
            $data[$i]=$row;
            $data[$i]['attendance_status_id']=$insert_id;
            $i = $i+1;
          }
          $insert_attendance_data = $this->db->insert_batch('attendance_posts', $data);
          if($insert_attendance_status&&$insert_attendance_data){
            return true;
          }else{
            return false;
          }
        }

        

    }
?>
