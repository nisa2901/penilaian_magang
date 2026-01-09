<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    protected $table = 'users';

    public function get_by_id($id)
    {
        return $this->db
            ->where('id', $id)
            ->get($this->table)
            ->row_array();
    }

   public function get_by_username($username){
        return $this->db
            ->where('username', $username)
            ->get('users')
            ->row_array(); // ⬅️ HARUS row_array
    }

    public function create($data){
        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }

    public function insert($data){
        return $this->db->insert($this->table, $data);
    }

    public function get_by_role($role){
        return $this->db
            ->where('role', $role)
            ->get($this->table)
            ->result_array();
    }
}
