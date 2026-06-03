<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peserta extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('DataMagang_model');
        $this->load->library(['session','upload']);

        if ($this->session->userdata('role') !== 'participant') {
            redirect('auth/login');
        }
    }

    public function dashboard()
    {
        $user_id = $this->session->userdata('user_id');

        $data['peserta'] = $this->db
            ->get_where('data_magang', ['user_id' => $user_id])
            ->row_array();

         $data['peserta'] = $peserta;

    // 🔥 TAMBAHAN PENTING
    $data['sekolah'] = '';
    $data['universitas'] = '';

    if (!empty($peserta['sekolah'])) {
        $data['sekolah'] = $peserta['sekolah'];
    }

    if (!empty($peserta['universitas'])) {
        $data['universitas'] = $peserta['universitas'];
    }

        $this->load->view('peserta/dashboard', $data);
    }

    public function save()
    {
        
        if (!$this->session->userdata('user_id')) {
        redirect('auth/login');
    }
        $user_id = (int) $this->session->userdata('user_id');

        if ($user_id <= 0) {
            show_error("Session user tidak valid. Silakan login kembali.");
        }

        $data = [
            'user_id'           => $user_id,
            'nama_lengkap'      => $this->input->post('nama_lengkap'),
            'angkatan'          => $this->input->post('angkatan'),
            'sekolah'           => $this->input->post('sekolah'),
            'email_sekolah'     => $this->input->post('email_sekolah'),
            'universitas'       => $this->input->post('universitas'),
            'email_universitas' => $this->input->post('email_universitas'),
            'tanggal_mulai'     => $this->input->post('tanggal_mulai'),
            'tanggal_selesai'   => $this->input->post('tanggal_selesai'),
            'unit_penempatan'   => $this->input->post('unit_penempatan')

        ];

        /* ==== UPLOAD FILE ==== */
        /* ==== UPLOAD DOKUMEN PENDAFTARAN ==== */
if (!empty($_FILES['dokumen']['name'])) {

    // Tentukan jenis peserta
    $folder = (!empty($data['universitas']))
        ? FCPATH . 'uploads/pendaftaran/mahasiswa/'
        : FCPATH . 'uploads/pendaftaran/siswa/';

    $config = [
        'upload_path'   => $folder,
        'allowed_types' => 'pdf',
        'max_size'      => 10024
    ];

    $this->upload->initialize($config);

    if (!$this->upload->do_upload('dokumen')) {
        show_error($this->upload->display_errors());
        return;
    }

    if(empty($user_id)){
        show_error("User tidak valid");
}

    // SIMPAN KE KOLOM YANG BENAR
    $data['dokumen_pendaftaran'] = $this->upload->data('file_name');
}

        // Simpan atau Update data_magang
        $this->DataMagang_model->simpan_atau_update($data);

        $this->session->set_flashdata('success', 'Data berhasil disimpan.');
        redirect('peserta/dashboard');
    }

    public function reset_data()
    {
        $user_id = $this->session->userdata('user_id');

        if (!$user_id) {
            redirect('auth/register_participant');
        }

        // 🔍 Ambil data magang
        $magang = $this->db
            ->get_where('data_magang', ['user_id' => $user_id])
            ->row_array();

        if ($magang) {

            // 🧹 JIKA MAHASISWA → HAPUS DARI pak_hani
            if (!empty($magang['universitas'])) {
                $this->db->where('data_magang_id', $magang['id'])
                        ->delete('pak_hani');
            }

            // 🧹 JIKA SISWA → HAPUS DARI bu_yuni
            if (!empty($magang['sekolah'])) {
                $this->db->where('data_magang_id', $magang['id'])
                        ->delete('bu_yuni');
            }

            // 🧹 HAPUS DATA MAGANG
            $this->db->where('id', $magang['id'])
                    ->delete('data_magang');
        }

        // 🧹 HAPUS USER
        $this->db->where('id', $user_id)
                ->delete('users');

        // 🧹 HAPUS SESSION
        $this->session->sess_destroy();

        // 🚀 KEMBALI KE REGISTER
        redirect('auth/register_participant');
    }
    
    public function logout(){
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}
