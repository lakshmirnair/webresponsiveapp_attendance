<?php
    class FacultyModel extends CI_Model
    {
        public function __construct()
        {
                $this->load->database();
        }

        public function getAllFaculties(){
          $query = $this->db->query('SELECT * FROM `teachers` WHERE status = 1');
          $data = array();
          $i = 0;
          foreach ($query->result_array() as $row) {
            $data[$i]['id'] = $row['id'];
            $data[$i]['teacher_email'] = $row['teacher_email'];
            $data[$i]['teacher_name'] = $row['teacher_name'];
            $data[$i]['teacher_code'] = $row['teacher_code'];
            $data[$i]['position'] = $row['position'];
            $i = $i+1;
          }
          return $data;
        }

        public function getDepartmentNameFromId($department_id){
          $dept_name = $this->db->query("SELECT `branch_name` FROM `branch` WHERE `id` = $department_id")->row();
          return $dept_name->branch_name;
        }

        public function getAllPackages(){
          $query = $this->db->query('SELECT * FROM `packages` order by `id` desc');
          $data = array();
          $i = 0;
          foreach ($query->result_array() as $row) {
            $data[$i]['id'] = $row['id'];
            $data[$i]['package_name'] = $row['package_name'];
            $data[$i]['amount'] = $row['amount'];
            $data[$i]['offer'] = $row['offer'];
            $data[$i]['note'] = $row['note'];
            $data[$i]['created_date'] = $row['created_date'];
            $data[$i]['status'] = $row['status'];
            $i = $i+1;
          }
          return $data;
        }

        public function addFaculty($data){
          $login_data = array(
            'username'=>$data['teacher_email'],
            'password'=>md5($data['teacher_code']),
            'user_status'=>2
          );
          $login_insert = $this->db->insert('login_user',$login_data);
          $insert = $this->db->insert('teachers',$data);
          if($insert){
            return true;
          }else{
            return false;
          }
        }

        public function deleteFaculty($id){
          $this->db->set('status',0);
          $this->db->where('id',$id);
          $update_branch = $this->db->update('teachers');
          if($update_branch){
            return true;
          }else{
            return false;
          }
        }

        public function checkIsAlreadyRegistered($email){
           $check = $this->db->query("SELECT `id` FROM `teachers` WHERE `teacher_email` = '$email'")->row();
           if($check){
            return true;
           }else{
            return false;
           }
        }

    }
?>
