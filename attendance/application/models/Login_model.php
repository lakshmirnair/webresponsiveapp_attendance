<?php
    class Login_model extends CI_Model
    {
        public function __construct()
        {
                $this->load->database();
        }

        public function validateLogin($username, $password){
            $this->db->select('id,username,status,user_status');
            $this->db->from('login_user');
            $this->db->where('username',$username);
            $this->db->where('password',md5($password));
            $this->db->where('status',1);
            $query = $this->db->get();
            if($query->num_rows() > 0){
               foreach ($query->result_array() as $row) {
                  $data['id'] = $row['id'];
                  $data['username'] = $row['username'];
                  $data['status'] = $row['status'];
                  $data['user_status'] = $row['user_status'];
                  if($row['user_status']==2){
                    $data['teacher_id'] = self::getTeacherId($row['username']);
                  }
               }
               $this->session->set_userdata('user_data',$data);
               return TRUE;
            }else{
                return FALSE;
            }
        }

        public function getTeacherId($email){
          $teacher_details = $this->db->query("SELECT `id` FROM `teachers` WHERE `teacher_email` = '$email'")->row();
          return $teacher_details->id;
        }
        
    

        
       
    }
?>
