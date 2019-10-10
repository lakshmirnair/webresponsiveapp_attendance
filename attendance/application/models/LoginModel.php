<?php
        class LoginModel extends CI_model
        {
            public function login($name, $pass)
            {
                $this->db->select('name,password');
                $this->db->from('users');
                $this->db->where('name',$name);
                $this->db->where('password',$pass);     

                $query = $this->db->get();

                $data = array();
                $i = 0;

                if($query->num_rows() == 1)
                {
                    foreach ($query->result() as $row){
                        $data['name'] = $row->name;
                        $data['password'] = $row->password;
                        $i = $i+1;                    
                    } 
                    $this->session->set_userdata($data); 
                    return true;
                }
                else
                {
                    return false;
                }
            }
        }