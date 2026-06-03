<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logbook_model extends CI_Model {

    // ambil semua logbook
    public function get_all()
    {
        return $this->db->get('logbook')->result();
    }

    // ambil logbook berdasarkan user
    public function getByMagang($id_magang)
    {
        $this->db->where('data_magang_id', $id_magang);
        return $this->db->get('logbook')->result();
    }

    // insert data
    public function insert($data)
    {
        return $this->db->insert('logbook', $data);
    }

    // delete
    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('logbook');
    }

    // get by id
    public function getById($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('logbook')->row();
    }

    // update
    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('logbook', $data);
    }

    // hitung jumlah logbook user
    public function countByUser($id_user)
    {
        $this->db->where('user_id', $id_user);
        return $this->db->count_all_results('logbook');
    }

    // status logbook
    public function status_logbook()
    {
        $this->db->select('status');
        $this->db->from('logbook');
        $this->db->order_by('id_logbook','DESC');
        $this->db->limit(1);

        return $this->db->get()->row();
    }
}