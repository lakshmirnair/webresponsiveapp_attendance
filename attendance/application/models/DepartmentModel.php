<?php
    class DepartmentModel extends CI_Model
    {
        public function __construct()
        {
                $this->load->database();
        }

        public function getAllDepartments(){
          $query = $this->db->query('SELECT * FROM `branch` WHERE status = 1');
          $data = array();
          $i = 0;
          foreach ($query->result_array() as $row) {
            $data[$i]['id'] = $row['id'];
            $data[$i]['branch_name'] = $row['branch_name'];
            $data[$i]['branch_code'] = $row['branch_code'];
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

        public function addDept($data){
          $insert = $this->db->insert('branch',$data);
          if($insert){
            return true;
          }else{
            return false;
          }
        }

        public function deleteDepartment($id){
          $this->db->set('status',0);
          $this->db->where('id',$id);
          $update_branch = $this->db->update('branch');
          if($update_branch){
            return true;
          }else{
            return false;
          }
        }

        public function getSubjectsFromDepartmentId($dept_id){
          $sql = 'SELECT * FROM `subjects` WHERE status = 1 AND branch_id = '.$dept_id;
          $query = $this->db->query($sql);
          $data = array();
          $i = 0;
          foreach ($query->result_array() as $row) {
            $data[$i]['id']=$row['id'];
            $data[$i]['subject_name']=$row['sub_name'];
            $data[$i]['subject_code']=$row['sub_code'];
            $i = $i+1;
          }
          return $data;
        }

    }
?>
