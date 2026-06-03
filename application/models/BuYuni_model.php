<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BuYuni_model extends CI_Model {

    protected $table = 'bu_yuni';

    /* =========================
        HITUNG DATA (DASHBOARD)
    ========================== */
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

    /* =========================
        DATA PER ANGKATAN
    ========================== */
    public function get_angkatan(){
        return $this->db
            ->select('angkatan')
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
        $this->db->select('bu_yuni.*, users.email_pribadi');
        $this->db->from('bu_yuni');

        $this->db->join('data_magang', 'data_magang.id = bu_yuni.data_magang_id', 'left');
        $this->db->join('users', 'users.id = data_magang.user_id', 'left');

        $this->db->where('bu_yuni.id', $id);

        return $this->db->get()->row_array();
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
        ->or_where('email_sekolah', $username)
        ->get($this->table)
        ->row_array();
}

}
