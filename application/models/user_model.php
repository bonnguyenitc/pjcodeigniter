<?php
    class user_model extends CI_Model{
        function __construct()
        {
            parent::__construct();
            $this->load->database();
        }


        public function checkLogin($username, $password){
            
            $this ->db->select('id, username, level');
            $this ->db->where('username', $username);
            $this ->db->where('password', md5($password));
            $query = $this->db-> get('user');

            if($query -> num_rows() == 1)
                {
                return $query->row_array();
                }
            else
                {
                return false;
                }
    }   

        public function getAllUser(){
            $this->db->where('level','1');
            $this->db->order_by('id');
            $query=$this->db->get("user");
            return $query->result_array();
        }  

        public function countAll(){
            $this->db->where('level','1');
            $this->db->order_by('id');
            $count=$this->db->get("user")->num_rows();
            return $count;
        } 

        public function getAllUser1($record, $start){
            $this->db->where('level','1');
            $this->db->limit($record, $start);
            $this->db->order_by('id');
            $query=$this->db->get("user");
            return $query->result_array();
        }
        public function getUserById($id){
            $this->db->where('id',$id);
            $query=$this->db->get("user");
            return $query->result_array();
        }  

        public function delete_user($id){
            $this->db->where("id","$id");
            $this->db->delete("user");
    }

        public function updateUser($data_update, $id){
        $this->db->where("id", $id);
        $this->db->update('user', $data_update);
}

        public function insert($data){
            $username = $data['username'];
            $password = $data['password'];
            $level = $data['level'];
            $email = $data['email'];
            $sql = "INSERT INTO user (username, password, level, email) VALUES (".$this->db->escape($username).", ".$this->db->escape(md5($password)).",".$this->db->escape($level).",".$this->db->escape($email).")";
            $this->db->query($sql);
            return $this->db->affected_rows();
        }

        public function search($key){
               $this->db->like('name', $key);
               $this->db->or_like('phone', $key);
               return $this->db->get('user')->result_array();
        }
    
}


    



?>