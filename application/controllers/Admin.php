<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct(){
        parent::__construct();

        // Load model yang digunakan
        $this->load->model([
            'User_model',
            'PakHani_model',
            'BuYuni_model',
            'DataMagang_model'
        ]);

        $this->load->library(['session','form_validation','user_agent','email']);

        // Batasi hanya admin
        if(!$this->session->userdata('role') || $this->session->userdata('role') !== 'admin'){
            redirect('auth/login');
        }
    }

    /* =========================
        DASHBOARD
    ========================== */
  public function dashboard(){

    // ==========================
    // 🔢 JUMLAH SISWA + MAHASISWA
    // ==========================
    $jumlah_mahasiswa = $this->db->count_all('pak_hani');
    $jumlah_siswa     = $this->db->count_all('bu_yuni');

    $data['jumlah_siswa'] = $jumlah_mahasiswa + $jumlah_siswa;

    // ==========================
    // 🟢 AKTIF
    // ==========================
    $aktif_mahasiswa = $this->db
        ->where('tanggal_selesai >=', date('Y-m-d'))
        ->count_all_results('pak_hani');

    $aktif_siswa = $this->db
        ->where('tanggal_selesai >=', date('Y-m-d'))
        ->count_all_results('bu_yuni');

    $data['aktif'] = $aktif_mahasiswa + $aktif_siswa;

    // ==========================
    // 🔵 SELESAI
    // ==========================
    $selesai_mahasiswa = $this->db
        ->where('tanggal_selesai <', date('Y-m-d'))
        ->count_all_results('pak_hani');

    $selesai_siswa = $this->db
        ->where('tanggal_selesai <', date('Y-m-d'))
        ->count_all_results('bu_yuni');

    $data['selesai'] = $selesai_mahasiswa + $selesai_siswa;

    // Penilaian terbaru HANYA dari data_magang
    $data['penilaian_terbaru'] = $this->DataMagang_model->get_penilaian_terbaru(20);

    $this->load->view('admin/dashboard', $data);
    }


    /* =========================
        DATA SISWA / MAHASISWA
    ========================== */
    public function data_magang(){
        $this->load->view('admin/data_magang'); 
        // hanya tampilan pilihan Pak Hani / Bu Yuni
    }

    /* =========================
        =========================
            PAK HANI
        =========================
    ========================== */
    public function pak_hani(){
        $data['angkatan'] = $this->PakHani_model->get_angkatan();
        $this->load->view('admin/pak_hani/angkatan', $data);
    }

    public function pak_hani_angkatan($angkatan){
        $data['angkatan'] = $angkatan;
        $this->db->select('
            pak_hani.*,
            data_magang.dokumen_pendaftaran,
            data_magang.universitas,
            data_magang.tanggal_mulai,
            data_magang.tanggal_selesai
        ');
        $this->db->from('pak_hani');
        $this->db->join(
            'data_magang',
            'data_magang.id = pak_hani.data_magang_id',
            'left'
        );
        $this->db->where('pak_hani.angkatan', $angkatan);

        $data['mahasiswa'] = $this->db->get()->result_array();
        $this->load->view('admin/pak_hani/daftar_mahasiswa', $data);
    }

    
    /* =========================
        EDIT DATA PAK HANI
    ========================= */
    public function edit_pak_hani($id)
    {
        $data['row'] = $this->PakHani_model->get_by_id($id);

        if (!$data['row']) {
            show_404();
        }

        $this->load->view('admin/pak_hani/edit', $data);
    }

    /* =========================
        UPDATE DATA PAK HANI
    ========================= */
   public function update_pak_hani($id)
    {
        // 🔐 Proteksi admin
        if ($this->session->userdata('role') !== 'admin') {
            redirect('auth/login');
        }

        // Ambil data lama
        $row = $this->PakHani_model->get_by_id($id);
        if (!$row) show_404();

        // Data dari form
        $data = [
            'nama_lengkap'      => $this->input->post('nama_lengkap', true),
            'angkatan'          => $this->input->post('angkatan', true),
            'universitas'       => $this->input->post('universitas', true),
            'email_pribadi'     => $this->input->post('email_pribadi', true),
            'email_universitas' => $this->input->post('email_universitas', true),
            'tanggal_mulai'     => $this->input->post('tanggal_mulai', true),
            'tanggal_selesai'   => $this->input->post('tanggal_selesai', true),
        ];

        // 1️⃣ Update tabel pak_hani
        $this->PakHani_model->update($id, $data);

        // 2️⃣ Sinkronkan ke data_magang (TANPA INSERT)
        if (!empty($row['data_magang_id'])) {

            $this->db->where('id', $row['data_magang_id']);
            $this->db->update('data_magang', [
                'nama_lengkap'    => $data['nama_lengkap'],
                'angkatan'        => $data['angkatan'],
                'universitas'     => $data['universitas'],
                'sekolah'         => NULL,
                'tanggal_mulai'   => $data['tanggal_mulai'],
                'tanggal_selesai' => $data['tanggal_selesai'],
            ]);
        }

        // 🔄 Redirect aman
        redirect('admin/pak_hani');
    }

    

  public function kirim_email($id, $tujuan)
    {
        $row = $this->PakHani_model->get_by_id($id);
        if (!$row) show_404();

        $magang = $this->db
            ->get_where('data_magang', ['id' => $row['data_magang_id']])
            ->row_array();

        if (!$magang) show_error('Data magang tidak ditemukan');

        $email_tujuan = ($tujuan === 'pribadi')
            ? $row['email_pribadi']
            : $row['email_universitas'];

        if (!$email_tujuan) {
            echo "<script>alert('Email tidak tersedia');history.back();</script>";
            return;
        }

        if (empty($magang['dokumen_penilaian'])) {
            show_error('Dokumen penilaian belum diupload admin');
        }

        $jenis = (!empty($magang['universitas'])) ? 'mahasiswa' : 'siswa';

        $file_path = FCPATH . "uploads/penilaian/$jenis/" . $magang['dokumen_penilaian'];

        if (!file_exists($file_path) || !is_readable($file_path)) {
            show_error("File tidak ditemukan / tidak bisa dibaca:<br>$file_path");
        }

        $this->load->library('email');

        $this->email->from('nizartharegi@gmail.com', 'Dinas Kependudukan dan Pencatatan Sipil');
        $this->email->to($email_tujuan);
        $this->email->subject('Hasil Penilaian Magang');
        $this->email->message("
            <p>Yth. <b>{$row['nama_lengkap']}</b>,</p>
            <p>Terlampir hasil penilaian magang Anda.</p>
            <p>Terima kasih.</p>
        ");

        $this->email->attach($file_path);

        if (!$this->email->send()) {
            show_error($this->email->print_debugger());
        }

        echo '
        <!doctype html>
        <html lang="id">
        <head>
        <meta charset="utf-8">
        <title>Email Berhasil Dikirim</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <style>
        body {
            margin: 0;
            font-family: "Segoe UI", Tahoma, sans-serif;
            background: #f3f6fa;
        }

        /* CENTER */
        .success-wrapper {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* CARD */
        .success-card {
            background: #ffffff;
            padding: 30px 36px;
            border-radius: 16px;
            width: 100%;
            max-width: 480px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
            text-align: center;
            border: 1px solid #e0e0e0;
        }

        /* ICON */
        .success-icon {
            font-size: 48px;
            color: #2ecc71;
            margin-bottom: 10px;
        }

        /* TITLE */
        .success-card h3 {
            margin-bottom: 20px;
            color: #002b5c;
            font-weight: 700;
        }

        /* INFO */
        .success-info {
            text-align: left;
            margin-bottom: 25px;
        }
        .success-info p {
            margin: 6px 0;
            font-size: 15px;
        }
        .success-info b {
            color: #002b5c;
        }

        /* BUTTON */
        .back-btn {
            display: inline-block;
            padding: 12px 22px;
            background: linear-gradient(135deg, #002b5c, #00509d);
            color: #ffffff;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .back-btn:hover {
            background: linear-gradient(135deg, #004b9a, #0077ff);
            box-shadow: 0 10px 25px rgba(0,0,0,0.25);
            transform: translateY(-2px);
        }
        </style>
        </head>

        <body>

        <div class="success-wrapper">
            <div class="success-card">

                <div class="success-icon">✔</div>

                <h3>Email Berhasil Dikirim</h3>

                <div class="success-info">
                    <p><b>Nama:</b> '.$row['nama_lengkap'].'</p>
                    <p><b>Email:</b> '.$email_tujuan.'</p>
                </div>

                <a class="back-btn"
                href="'.site_url('admin/pak_hani_angkatan/'.$row['angkatan']).'">
                Kembali
                </a>

            </div>
        </div>

        </body>
        </html>
        ';


    }

    public function hapus_pak_hani($id)
    {
        $row = $this->PakHani_model->get_by_id($id);
        if (!$row) show_404();

        $this->PakHani_model->delete($id);

        // 🔥 HAPUS DI DATA MAGANG
        $this->DataMagang_model->delete_by_nama_angkatan(
            $row['nama_lengkap'],
            $row['angkatan']
        );

        redirect($this->agent->referrer());
    }


/* =========================
        =========================
            BU YUNI
        =========================
    ========================== */
    public function bu_yuni(){
        $data['angkatan'] = $this->BuYuni_model->get_angkatan();
        $this->load->view('admin/bu_yuni/angkatan', $data);
    }

    public function bu_yuni_angkatan($angkatan){
        $data['angkatan'] = $angkatan;
        $this->db->select('
            bu_yuni.*,
            data_magang.dokumen_pendaftaran,
            data_magang.sekolah,
            data_magang.tanggal_mulai,
            data_magang.tanggal_selesai
        ');
        $this->db->from('bu_yuni');
        $this->db->join(
            'data_magang',
            'data_magang.id = bu_yuni.data_magang_id',
            'left'
        );
        $this->db->where('bu_yuni.angkatan', $angkatan);

        $data['siswa'] = $this->db->get()->result_array();
        $this->load->view('admin/bu_yuni/daftar_siswa', $data);
    }

    public function edit_bu_yuni($id){
    $data['row'] = $this->BuYuni_model->get_by_id($id);
    $this->load->view('admin/bu_yuni/edit',$data);
    }

    public function update_bu_yuni($id)
    {
        $row = $this->BuYuni_model->get_by_id($id);
        if (!$row) show_404();

        $data = [
            'nama_lengkap'    => $this->input->post('nama_lengkap'),
            'angkatan'        => $this->input->post('angkatan'),
            'sekolah'         => $this->input->post('sekolah'),
            'email_pribadi'   => $this->input->post('email_pribadi'),
            'email_sekolah'   => $this->input->post('email_sekolah'),
            'tanggal_mulai'   => $this->input->post('tanggal_mulai'),
            'tanggal_selesai' => $this->input->post('tanggal_selesai'),
        ];

        // 1️⃣ Update bu_yuni
        $this->BuYuni_model->update($id, $data);

        // 2️⃣ Update data_magang TANPA INSERT BARU
        if (!empty($row['data_magang_id'])) {
            $this->db->where('id', $row['data_magang_id'])
                    ->update('data_magang', [
                        'nama_lengkap'    => $data['nama_lengkap'],
                        'angkatan'        => $data['angkatan'],
                        'sekolah'         => $data['sekolah'],
                        'universitas'     => NULL,
                        'tanggal_mulai'   => $data['tanggal_mulai'],
                        'tanggal_selesai' => $data['tanggal_selesai'],
                        'tanggal_dinilai' => date('Y-m-d')
                    ]);
        }

        redirect('admin/bu_yuni_angkatan/'.$data['angkatan']);
    }


   public function hapus_bu_yuni($id)
    {
        $row = $this->BuYuni_model->get_by_id($id);
        if (!$row) show_404();

        $this->BuYuni_model->delete($id);

        // 🔥 HAPUS DI DATA MAGANG
        $this->DataMagang_model->delete_by_nama_angkatan(
            $row['nama_lengkap'],
            $row['angkatan']
        );

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function kirim_email_bu_yuni($id, $tujuan)
    {
        $row = $this->BuYuni_model->get_by_id($id);
        if (!$row) show_404();

        $magang = $this->db
            ->get_where('data_magang', ['id' => $row['data_magang_id']])
            ->row_array();

        if (!$magang) show_error('Data magang tidak ditemukan');

        $email_tujuan = ($tujuan === 'pribadi')
            ? $row['email_pribadi']
            : $row['email_sekolah'];

        if (!$email_tujuan) {
            echo "<script>alert('Email tidak tersedia');history.back();</script>";
            return;
        }

        if (empty($magang['dokumen_penilaian'])) {
            show_error('Dokumen penilaian belum diupload admin');
        }

        $jenis = (!empty($magang['sekolah'])) ? 'siswa' : 'mahasiswa';

        $file_path = FCPATH . "uploads/penilaian/$jenis/" . $magang['dokumen_penilaian'];

        if (!file_exists($file_path) || !is_readable($file_path)) {
            show_error("File tidak ditemukan / tidak bisa dibaca:<br>$file_path");
        }

        $this->load->library('email');

        $this->email->from('nizartharegi@gmail.com', 'Dinas Kependudukan dan Pencatatan Sipil');
        $this->email->to($email_tujuan);
        $this->email->subject('Hasil Penilaian Magang');
        $this->email->message("
            <p>Yth. <b>{$row['nama_lengkap']}</b>,</p>
            <p>Terlampir hasil penilaian magang Anda.</p>
            <p>Terima kasih.</p>
        ");

        $this->email->attach($file_path);

        if (!$this->email->send()) {
            show_error($this->email->print_debugger());
        }

        echo'
        <!doctype html>
        <html lang="id">
        <head>
        <meta charset="utf-8">
        <title>Email Berhasil Dikirim</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <style>
        body {
            margin: 0;
            font-family: "Segoe UI", Tahoma, sans-serif;
            background: #f3f6fa;
        }
        
        /* CENTER */
        .success-wrapper {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        /* CARD */
        .success-card {
            background: #ffffff;
            padding: 30px 36px;
            border-radius: 16px;
            width: 100%;
            max-width: 480px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
            text-align: center;
            border: 1px solid #e0e0e0;
        }
        
        /* ICON */
        .success-icon {
            font-size: 48px;
            color: #2ecc71;
            margin-bottom: 10px;
        }
        
        /* TITLE */
        .success-card h3 {
            margin-bottom: 20px;
            color: #002b5c;
            font-weight: 700;
        }
        
        /* INFO */
        .success-info {
            text-align: left;
            margin-bottom: 25px;
        }
        .success-info p {
            margin: 6px 0;
            font-size: 15px;
        }
        .success-info b {
            color: #002b5c;
        }
        
        /* BUTTON */
        .back-btn {
            display: inline-block;
            padding: 12px 22px;
            background: linear-gradient(135deg, #002b5c, #00509d);
            color: #ffffff;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .back-btn:hover {
            background: linear-gradient(135deg, #004b9a, #0077ff);
            box-shadow: 0 10px 25px rgba(0,0,0,0.25);
            transform: translateY(-2px);
        }
        </style>
        </head>
        
        <body>
        
        <div class="success-wrapper">
            <div class="success-card">
        
                <div class="success-icon">✔</div>
        
                <h3>Email Berhasil Dikirim</h3>
        
                <div class="success-info">
                    <p><b>Nama:</b> '.$row['nama_lengkap'].'</p>
                    <p><b>Email:</b> '.$email_tujuan.'</p>
                </div>
        
                <a class="back-btn"
                   href="'.site_url('admin/bu_yuni_angkatan/'.$row['angkatan']).'">
                   Kembali
                </a>
        
            </div>
        </div>
        
        </body>
        </html>
        ';
        

    }


    public function upload_penilaian($id)
    {
        // 🔐 proteksi admin
        if ($this->session->userdata('role') !== 'admin') {
            redirect('auth/login');
        }

        // ambil data magang
        $magang = $this->db
            ->get_where('data_magang', ['id' => $id])
            ->row_array();

        if (!$magang) {
            show_404();
        }

        // 🔥 tentukan jenis sejak awal (WAJIB)
        $jenis = (!empty($magang['universitas'])) ? 'mahasiswa' : 'siswa';
        $tipe  = $jenis; // biar jelas

        // 📤 JIKA FORM DIKIRIM
        if (!empty($_FILES['dokumen']['name'])) {

            $path = FCPATH . "uploads/penilaian/$tipe/";

            if (!is_dir($path)) {
                mkdir($path, 0777, true);
            }

            $config['upload_path']   = $path;
            $config['allowed_types'] = 'pdf';
            $config['max_size']      = 10024;


            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('dokumen')) {

                $data['error'] = $this->upload->display_errors();

            } else {

                $file = $this->upload->data('file_name');

                $this->db->where('id', $id);
                $this->db->update('data_magang', [
                    'dokumen_penilaian' => $file,
                    'tanggal_dinilai'  => date('Y-m-d')
                ]);

                // 🚀 selesai upload → balik ke data magang
                redirect('admin/data_magang');
            }
        }

        // 🖥️ DATA VIEW (SELALU DIKIRIM)
        $data['magang'] = $magang;
        $data['jenis']  = $jenis;

        $this->load->view('admin/upload_penilaian', $data);
    }


        
    /* =========================
        LOGOUT
    ========================== */
    public function logout(){
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}
