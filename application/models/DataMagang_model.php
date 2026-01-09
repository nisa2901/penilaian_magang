<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataMagang_model extends CI_Model {

    protected $table = 'data_magang';

    /* =====================
       DASHBOARD COUNTER
    ====================== */

    public function count_aktif(){
        $today = date('Y-m-d');
        return $this->db
            ->where('tanggal_mulai <=', $today)
            ->where('tanggal_selesai >=', $today)
            ->count_all_results($this->table);
    }

    public function count_selesai(){
        $today = date('Y-m-d');
        return $this->db
            ->where('tanggal_selesai <', $today)
            ->count_all_results($this->table);
    }

    public function count_all(){
        return $this->db->count_all($this->table);
    }

    /* =====================
       PENILAIAN TERBARU
    ====================== */
    public function get_penilaian_terbaru($limit = 10)
    {
        return $this->db
            ->select('*')
            ->from('data_magang')
            ->where('user_id IS NOT NULL', null, false)
            ->group_by('user_id') // 🔥 INI KUNCI ANTI DOUBEL
            ->order_by('tanggal_dinilai', 'DESC')
            ->limit($limit)
            ->get()
            ->result_array();
    }




    /* =====================
       SIMPAN / UPDATE
    ====================== */
   

    public function simpan_atau_update($data)
    {
        // =============================
        // SIMPAN / UPDATE data_magang
        // =============================
         $existing = $this->db
            ->get_where('data_magang', ['user_id' => $data['user_id']])
            ->row();

        if ($existing) {
            $this->db->where('id', $existing->id)->update('data_magang', $data);
            $data_magang_id = $existing->id;
        } else {
            $this->db->insert('data_magang', $data);
            $data_magang_id = $this->db->insert_id();
        }

        // =============================
        // MAHASISWA → PAK HANI
        // =============================
        if (!empty($data['universitas'])) {

            $pak_hani = [
                'data_magang_id'   => $data_magang_id,
                'nama_lengkap'     => $data['nama_lengkap'],
                'angkatan'         => $data['angkatan'],
                'universitas'      => $data['universitas'],
                'email_universitas'=> $data['email_universitas'] ?? null,
                'tanggal_mulai'    => $data['tanggal_mulai'],
                'tanggal_selesai'  => $data['tanggal_selesai'],
                'dokumen_penilaian'=> $data['dokumen_penilaian'] ?? null,
                'tanggal_dinilai'  => $data['tanggal_dinilai'] ?? null
            ];

            $cek = $this->db->get_where('pak_hani', [
                'data_magang_id' => $data_magang_id
            ])->row();

            if ($cek) {
                $this->db->where('data_magang_id', $data_magang_id)
                        ->update('pak_hani', $pak_hani);
            } else {
                $this->db->insert('pak_hani', $pak_hani);
            }
        }

        // =============================
        // SISWA → BU YUNI
        // =============================
        if (!empty($data['sekolah'])) {

            $bu_yuni = [
                'data_magang_id'   => $data_magang_id,
                'nama_lengkap'     => $data['nama_lengkap'],
                'angkatan'         => $data['angkatan'],
                'sekolah'          => $data['sekolah'],
                'email_sekolah'    => $data['email_sekolah'] ?? null,
                'tanggal_mulai'    => $data['tanggal_mulai'],
                'tanggal_selesai'  => $data['tanggal_selesai'],
                'dokumen_penilaian'=> $data['dokumen_penilaian'] ?? null,
                'tanggal_dinilai'  => $data['tanggal_dinilai'] ?? null
            ];

            $cek = $this->db->get_where('bu_yuni', [
                'data_magang_id' => $data_magang_id
            ])->row();

            if ($cek) {
                $this->db->where('data_magang_id', $data_magang_id)
                        ->update('bu_yuni', $bu_yuni);
            } else {
                $this->db->insert('bu_yuni', $bu_yuni);
            }
        }

        return $data_magang_id;
    }

    /* =====================
       DELETE
    ====================== */
    public function delete_by_nama_angkatan($nama, $angkatan)
    {
        return $this->db
            ->where('nama_lengkap', $nama)
            ->where('angkatan', $angkatan)
            ->delete($this->table);
    }

    public function update_by_user($user_id, $data)
    {
        return $this->db
            ->where('user_id', $user_id)
            ->update('data_magang', $data);
    }

    public function get_by_id($id)
    {
        return $this->db
            ->get_where('data_magang', ['id' => $id])
            ->row_array();
    }

}