<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logbook extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Logbook_model');
    }

    public function index()
    {
        $user_id = $this->session->userdata('user_id');

        $magang = $this->db
            ->get_where('data_magang', ['user_id' => $user_id])
            ->row();

        $logbook = $this->db
            ->where('data_magang_id', $magang->id)
            ->get('logbook')
            ->result();

        $total_logbook = count($logbook);

        // cek apakah semua disetujui
        $belum_disetujui = $this->db
            ->where('data_magang_id', $magang->id)
            ->where('status !=', 'disetujui')
            ->count_all_results('logbook');

        $semua_disetujui = ($belum_disetujui == 0 && $total_logbook > 0);

        // status utama logbook
        $status_logbook = $semua_disetujui ? 'disetujui' : 'menunggu';

        $data = [
            'logbook' => $logbook,
            'total_logbook' => $total_logbook,
            'status' => $status_logbook,
            'semua_disetujui' => $semua_disetujui
        ];
        
        $this->load->view('peserta/logbook', $data);
       
    }
   public function tambah()
    {
        $user_id = $this->session->userdata('user_id');

        $magang = $this->db
            ->get_where('data_magang', ['user_id' => $user_id])
            ->row();

        $data = [
            'data_magang_id' => $magang->id,
            'tanggal' => $this->input->post('tanggal'),
            'kegiatan' => $this->input->post('kegiatan'),
            'deskripsi' => $this->input->post('deskripsi'),
            'status' => 'menunggu'
        ];

        $this->Logbook_model->insert($data);
        redirect('logbook');
    }

    public function edit($id)
    {
        $data['logbook'] = $this->Logbook_model->getById($id);

        $this->load->view('peserta/edit_logbook', $data);

    }

    public function update()
    {
        $id = $this->input->post('id');

        $user_id = $this->session->userdata('user_id');

        // ambil data logbook lama
        $logbook = $this->db->get_where('logbook', [
            'id' => $id
        ])->row();

        if (!$logbook) {
            show_404();
        }

        // ambil data magang user
        $magang = $this->db->get_where('data_magang', [
            'user_id' => $user_id
        ])->row();

        if ($logbook->data_magang_id != $magang->id) {
            show_error('Akses ditolak');
        }

        // update data
        $data = [
            'tanggal'   => $this->input->post('tanggal'),
            'kegiatan'  => $this->input->post('kegiatan'),
            'deskripsi' => $this->input->post('deskripsi'),
            'status'    => 'menunggu'
        ];

        $this->db->where('id', $id);
        $this->db->update('logbook', $data);

        redirect('logbook');
    }

    public function hapus($id)
    {
        $this->Logbook_model->delete($id);
        redirect('logbook');
    }

    public function cetak()
    {
        $user_id = $this->session->userdata('user_id');

        $magang = $this->db
            ->get_where('data_magang', ['user_id' => $user_id])
            ->row();

        $logbook = $this->db
            ->where('data_magang_id', $magang->id)
            ->get('logbook')
            ->result();

        // cek validasi semua disetujui
        $belum_disetujui = $this->db
            ->where('data_magang_id', $magang->id)
            ->where('status !=', 'disetujui')
            ->count_all_results('logbook');

        if($belum_disetujui > 0){
            show_error('Logbook belum bisa dicetak karena masih ada status menunggu / ditolak.');
        }

        $data['logbook'] = $logbook;
        $data['magang'] = $magang;

        $this->load->view('peserta/cetak_logbook', $data);
    }
}
