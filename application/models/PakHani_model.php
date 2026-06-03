<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PakHani_model extends CI_Model {

    protected $table = 'pak_hani';

    /* =====================
        DASHBOARD
    ====================== */
    public function count_all(){
        return $this->db->count_all($this->table);
    }

    public function count_aktif(){
        return $this->db
            ->where('tanggal_selesai IS NULL', null, false)
            ->count_all_results($this->table);
    }

    public function count_selesai(){
        return $this->db
            ->where('tanggal_selesai IS NOT NULL', null, false)
            ->count_all_results($this->table);
    }

    public function get_recent($limit = 5){
        return $this->db
            ->order_by('created_at','DESC')
            ->limit($limit)
            ->get($this->table)
            ->result_array();
    }

    /* =====================
        DATA MAHASISWA
    ====================== */
    public function get_angkatan(){
    return $this->db
        ->select('angkatan')
        ->where('angkatan IS NOT NULL', null, false) // filter NULL
        ->where('angkatan !=', '') // filter kosong
        ->group_by('angkatan')
        ->order_by('angkatan','DESC')
        ->get($this->table)
        ->result_array();
}

    public function get_by_angkatan($angkatan){
        return $this->db
            ->where('angkatan', $angkatan)
            ->order_by('nama_lengkap','ASC')
            ->get($this->table)
            ->result_array();
    }
   
    public function get_by_id($id)
    {
        $this->db->select('pak_hani.*, users.email_pribadi');
        $this->db->from('pak_hani');

        // join ke data_magang dulu
        $this->db->join('data_magang', 'data_magang.id = pak_hani.data_magang_id', 'left');

        // baru join ke users
        $this->db->join('users', 'users.id = data_magang.user_id', 'left');

        $this->db->where('pak_hani.id', $id);

        return $this->db->get()->row();
    }
    public function insert($data){
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data){
        return $this->db
            ->where('id', $id)
            ->update($this->table, $data);
    }

    public function delete($id){
        return $this->db
            ->where('id', $id)
            ->delete($this->table);
    }

    public function get_by_username($username){
    return $this->db
        ->where('email_pribadi', $username)
        ->or_where('email_universitas', $username)
        ->get($this->table)
        ->row_array();
}

}
