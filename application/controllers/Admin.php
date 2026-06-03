<?php
use Dompdf\Dompdf;
use Dompdf\Options;

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
    } //

   public function pak_hani_angkatan($angkatan = null)
{
    if (!$angkatan) {
        redirect('admin/pak_hani'); // balik ke list angkatan
        return;
    }

    $data['angkatan'] = $angkatan;

    $this->db->select('
        pak_hani.*,
        data_magang.dokumen_pendaftaran,
        data_magang.dokumen_penilaian,
        data_magang.universitas,
        data_magang.unit_penempatan,
        data_magang.tanggal_mulai,
        data_magang.tanggal_selesai
    ');
    $this->db->from('pak_hani');
    $this->db->join('data_magang','data_magang.id = pak_hani.data_magang_id','left');
    $this->db->where('pak_hani.angkatan',$angkatan);

    $data['mahasiswa'] = $this->db->get()->result_array();

    $this->load->view('admin/pak_hani/daftar_mahasiswa', $data);
} //

    
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
    if ($this->session->userdata('role') !== 'admin') {
        redirect('auth/login');
    }

    $row = $this->PakHani_model->get_by_id($id);
    if (!$row) show_404();

    // ❗ pastikan hanya mahasiswa
    if (empty($row->universitas)) {
        show_error('Data ini bukan mahasiswa');
    }

    // ambil input
    $nama        = $this->input->post('nama_lengkap', true);
    $angkatan    = $this->input->post('angkatan', true);
    $universitas = $this->input->post('universitas', true);
    $email_pribadi     = $this->input->post('email_pribadi', true);
    $email_universitas = $this->input->post('email_universitas', true);
    $tanggal_mulai     = $this->input->post('tanggal_mulai', true);
    $tanggal_selesai   = $this->input->post('tanggal_selesai', true);
    $unit              = $this->input->post('unit_penempatan', true);

    if (empty($tanggal_mulai) || empty($tanggal_selesai)) {
        echo "<script>alert('Tanggal tidak boleh kosong');history.back();</script>";
        return;
    }

    // =====================
    // 1️⃣ UPDATE pak_hani
    // =====================
    $data = [
        'nama_lengkap'      => $nama,
        'angkatan'          => $angkatan,
        'universitas'       => $universitas,
        'email_pribadi'     => $email_pribadi,
        'email_universitas' => $email_universitas,
        'unit_penempatan'   => $unit,
        'tanggal_mulai'     => $tanggal_mulai,
        'tanggal_selesai'   => $tanggal_selesai,
    ];

    $this->PakHani_model->update($id, $data);

    // =====================
    // 2️⃣ UPDATE data_magang
    // =====================
    if (!empty($row->data_magang_id)) {

        $this->db->where('id', $row->data_magang_id);
        $this->db->update('data_magang', [
            'nama_lengkap'    => $nama,
            'angkatan'        => $angkatan,
            'universitas'     => $universitas,
            'email_pribadi'     => $email_pribadi,
            'sekolah'         => NULL,
            'email_universitas'=> $email_universitas,
            'unit_penempatan' => $unit,
            'tanggal_mulai'   => $tanggal_mulai,
            'tanggal_selesai' => $tanggal_selesai,
        ]);
    }
    // ambil user_id dari data_magang
    $dataMagang = $this->db
        ->get_where('data_magang', ['id' => $row->data_magang_id])
        ->row();

    if (!empty($dataMagang->user_id)) {

        $this->db->where('id', $dataMagang->user_id);
        $this->db->update('users', [
            'email_pribadi' => $email_pribadi
        ]);
    }
    // =====================
    // 🔄 REDIRECT KE daftar mahasiswa
    // =====================
    redirect('admin/pak_hani_angkatan/'.$angkatan);
}



  public function kirim_email($id, $tujuan)
{
    $row = $this->PakHani_model->get_by_id($id);
    if (!$row) show_404();

    $magang = $this->db
        ->get_where('data_magang', ['id' => $row->data_magang_id])
        ->row_array();

    if (!$magang) show_error('Data magang tidak ditemukan');

    // menentukan email tujuan
    $email_tujuan = ($tujuan === 'pribadi')
        ? $row->email_pribadi
        : $row->email_universitas;

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

    // load email
    $this->load->library('email');

    $this->email->from('nizartharegi@gmail.com', 'Dinas Kependudukan dan Pencatatan Sipil');
    $this->email->to($email_tujuan);
    $this->email->subject('Hasil Penilaian Magang');

    $this->email->message("
        <p>Yth. <b>{$row->nama_lengkap}</b>,</p>
        <p>Terlampir hasil penilaian magang Anda.</p>
        <p>Terima kasih.</p>
    ");

    $this->email->attach($file_path);

    if (!$this->email->send()) {
        show_error($this->email->print_debugger());
    } $this->db->where('id', $id);
    $this->db->update('pak_hani', [
        'tanggal_dinilai' => date('Y-m-d H:i:s')
    ]);

    // escape data
    $nama  = htmlspecialchars($row->nama_lengkap);
    $email = htmlspecialchars($email_tujuan);
    $link  = site_url('admin/pak_hani_angkatan/'.$row->angkatan);

echo <<<HTML
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Email Berhasil Dikirim</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<style>
body{
    margin:0;
    font-family:"Segoe UI",Tahoma,sans-serif;
    background:#f3f6fa;
}

.success-wrapper{
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
}

.success-card{
    background:#fff;
    padding:30px 36px;
    border-radius:16px;
    width:100%;
    max-width:480px;
    box-shadow:0 15px 35px rgba(0,0,0,0.15);
    text-align:center;
    border:1px solid #e0e0e0;
}

.success-icon{
    font-size:48px;
    color:#2ecc71;
    margin-bottom:10px;
}

.success-card h3{
    margin-bottom:20px;
    color:#002b5c;
}

.success-info{
    text-align:left;
    margin-bottom:25px;
}

.success-info p{
    margin:6px 0;
}

.back-btn{
    display:inline-block;
    padding:12px 22px;
    background:linear-gradient(135deg,#002b5c,#00509d);
    color:#fff;
    text-decoration:none;
    border-radius:12px;
    font-weight:600;
}

.back-btn:hover{
    background:linear-gradient(135deg,#004b9a,#0077ff);
}
</style>
</head>

<body>

<div class="success-wrapper">
<div class="success-card">

<div class="success-icon">✔</div>

<h3>Email Berhasil Dikirim</h3>

<div class="success-info">
<p><b>Nama:</b> {$nama}</p>
<p><b>Email:</b> {$email}</p>
</div>

<a class="back-btn" href="{$link}">
Kembali
</a>

</div>
</div>

</body>
</html>
HTML;

}

    public function hapus_pak_hani($id)
    {
        $row = $this->PakHani_model->get_by_id($id);

        if (!$row) {
            show_404();
        }

        $this->PakHani_model->delete($id);

        // Hapus juga data di tabel data_magang
        $this->DataMagang_model->delete_by_nama_angkatan(
            $row->nama_lengkap,
            $row->angkatan
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
        data_magang.dokumen_penilaian,
        data_magang.sekolah,
        data_magang.unit_penempatan,
        data_magang.tanggal_mulai,
        data_magang.tanggal_selesai,
        users.email_pribadi
    ');

    $this->db->from('bu_yuni');

    // JOIN ke data_magang
    $this->db->join('data_magang','data_magang.id = bu_yuni.data_magang_id','left');

    // 🔥 JOIN ke users (INI YANG KURANG)
    $this->db->join('users','users.id = data_magang.user_id','left');

    $this->db->where('bu_yuni.angkatan',$angkatan);

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

    // ❗ pastikan hanya siswa
    if (empty($row['sekolah'])) {
        show_error('Data ini bukan siswa');
    }

    $nama      = $this->input->post('nama_lengkap');
    $angkatan  = $this->input->post('angkatan');
    $sekolah   = $this->input->post('sekolah');
    $email_pribadi = $this->input->post('email_pribadi');
    $email_sekolah = $this->input->post('email_sekolah');
    $tanggal_mulai = $this->input->post('tanggal_mulai');
    $tanggal_selesai = $this->input->post('tanggal_selesai');
    $unit = $this->input->post('unit_penempatan');

    if (empty($tanggal_mulai) || empty($tanggal_selesai)) {
        echo "<script>alert('Tanggal tidak boleh kosong');history.back();</script>";
        return;
    }

    // =====================
    // 1️⃣ UPDATE bu_yuni
    // =====================
    $data = [
        'nama_lengkap'    => $nama,
        'angkatan'        => $angkatan,
        'sekolah'         => $sekolah,
        'email_pribadi'   => $email_pribadi,
        'email_sekolah'   => $email_sekolah,
        'unit_penempatan' => $unit,
        'tanggal_mulai'   => $tanggal_mulai,
        'tanggal_selesai' => $tanggal_selesai,
    ];

    $this->BuYuni_model->update($id, $data);

    // =====================
    // 2️⃣ UPDATE data_magang
    // =====================
    if (!empty($row['data_magang_id'])) {

        $this->db->where('id', $row['data_magang_id']);
        $this->db->update('data_magang', [
            'nama_lengkap'    => $nama,
            'angkatan'        => $angkatan,
            'sekolah'         => $sekolah,
            'email_pribadi'   => $email_pribadi,
            'universitas'     => NULL,
            'email_sekolah'   => $email_sekolah,
            'unit_penempatan' => $unit,
            'tanggal_mulai'   => $tanggal_mulai,
            'tanggal_selesai' => $tanggal_selesai,
        ]);
    }
    // ambil user_id dari data_magang
        $dataMagang = $this->db
        ->get_where('data_magang', ['id' => $row['data_magang_id']])
        ->row();

    if (!empty($dataMagang->user_id)) {

        $this->db->where('id', $dataMagang->user_id);
        $this->db->update('users', [
            'email_pribadi' => $email_pribadi
        ]);
    }

    // =====================
    // 🔄 REDIRECT KE UNIT
    // =====================
    redirect('admin/bu_yuni_angkatan/'.$angkatan);
}


   public function hapus_bu_yuni($id)
    {
        $row = $this->BuYuni_model->get_by_id($id);
        if (!$row) show_404();

        $this->BuYuni_model->delete($id);

        // 🔥 HAPUS DI DATA MAGANG
        $this->DataMagang_model->delete_by_nama_angkatan(
            $row->nama_lengkap,
            $row->angkatan
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
        } else {

    // ✅ SIMPAN TANGGAL DINILAI KE DATABASE
    $this->db->where('id', $id);
    $this->db->update('bu_yuni', [
        'tanggal_dinilai' => date('Y-m-d H:i:s')
    ]);
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

   public function rekap()
    {
        $tahun = $this->input->get('tahun');

        // ==========================
        // AMBIL DATA PESERTA VALID
        // ==========================
        $this->db->from('data_magang');
        $this->db->where('nama_lengkap !=', '');
        $this->db->where('tanggal_mulai IS NOT NULL', NULL, FALSE);
        $this->db->where('tanggal_selesai IS NOT NULL', NULL, FALSE);

        if ($tahun) {
            $this->db->where('YEAR(tanggal_mulai)', $tahun);
        }

        $data['rekap'] = $this->db->get()->result();

        // ==========================
        // TOTAL PESERTA
        // ==========================
        $this->db->select("
            COUNT(*) as total,
            SUM(CASE WHEN universitas IS NOT NULL AND universitas != '' THEN 1 ELSE 0 END) as mahasiswa,
            SUM(CASE WHEN sekolah IS NOT NULL AND sekolah != '' THEN 1 ELSE 0 END) as siswa
        ");

        if ($tahun) {
            $this->db->where('YEAR(tanggal_mulai)', $tahun);
        }

        $data['total'] = $this->db->get('data_magang')->row();

        // ==========================
        // STATUS AKTIF & SELESAI
        // ==========================
        $today = date('Y-m-d');

        // AKTIF
        $this->db->from('data_magang');
        if ($tahun) {
            $this->db->where('YEAR(tanggal_mulai)', $tahun);
        }
        $this->db->where('tanggal_selesai >=', $today);
        $data['aktif'] = $this->db->count_all_results();

        // SELESAI
        $this->db->from('data_magang');
        if ($tahun) {
            $this->db->where('YEAR(tanggal_mulai)', $tahun);
        }
        $this->db->where('tanggal_selesai <', $today);
        $data['selesai'] = $this->db->count_all_results();

        // ==========================
        // KIRIM TAHUN KE VIEW
        // ==========================
        $data['tahun'] = $tahun;

        // ==========================
        // LOAD VIEW
        // ==========================
        $this->load->view('admin/rekap', $data);
    }

    public function download()
        {
            $tahun = $this->input->get('tahun');

            $this->db->from('data_magang');

            if ($tahun) {
                $this->db->where('YEAR(tanggal_mulai)', $tahun);
            }

            $data['rekap'] = $this->db->get()->result();
            $data['tahun'] = $tahun;

            // langsung tampilkan view (bukan download)
            $this->load->view('admin/rekap_pdf', $data);
        }


    
    /* =========================
        LOGOUT
    ========================== */
    public function logout(){
        $this->session->sess_destroy();
        redirect('auth/login');
    }

    public function unit($unit)
{
    $data['title'] = 'Peserta Unit ' . $unit;

    $this->db->select('data_magang.*, users.username');
    $this->db->from('data_magang');
    $this->db->join('users', 'users.id = data_magang.user_id', 'left');

    $this->db->where('LOWER(unit_penempatan)', strtolower($unit));

    // FILTER AGAR DATA YANG BELUM LENGKAP TIDAK MUNCUL
    $this->db->where('nama_lengkap IS NOT NULL', NULL, FALSE);
    $this->db->where('nama_lengkap !=', '');
    $this->db->where('tanggal_mulai IS NOT NULL', NULL, FALSE);
    $this->db->where('tanggal_selesai IS NOT NULL', NULL, FALSE);

    $data['peserta'] = $this->db->get()->result();


    $this->load->view('admin/unit_view', $data);
}
   public function edit($id)
{
    $this->db->select('data_magang.*, users.email_pribadi');
    $this->db->from('data_magang');
    $this->db->join('users', 'users.id = data_magang.user_id', 'left');
    $this->db->where('data_magang.id', $id);

    $data['peserta'] = $this->db->get()->row();

    if(!$data['peserta']){
        show_404();
    }

    $this->load->view('admin/edit_peserta', $data);
}
    public function update()
{
    $id = $this->input->post('id');

    $nama        = $this->input->post('nama_lengkap');
    $angkatan    = $this->input->post('angkatan');
    $universitas = $this->input->post('universitas');
    $sekolah     = $this->input->post('sekolah');
    $unit        = $this->input->post('unit_penempatan');

    $email_universitas = $this->input->post('email_universitas');
    $email_sekolah     = $this->input->post('email_sekolah');
    $email_pribadi     = $this->input->post('email_pribadi');
    $tanggal_mulai = $this->input->post('tanggal_mulai');
    $tanggal_selesai = $this->input->post('tanggal_selesai');

    if(empty($tanggal_mulai) || empty($tanggal_selesai)){
        echo "<script>alert('Tanggal tidak boleh kosong');history.back();</script>";
        return;
    }

    $peserta = $this->db->get_where('data_magang',['id'=>$id])->row();
    
    if(!$peserta){
        show_404();
    }
    $unit_lama = $peserta->unit_penempatan;
    
    // =====================
    // UPDATE DATA_MAGANG
    // =====================
    $data = [
        'nama_lengkap' => $nama,
        'angkatan' => $angkatan,
        'universitas' => $universitas ?: NULL,
        'sekolah' => $sekolah ?: NULL,
        'email_universitas' => $email_universitas ?: NULL,
        'email_sekolah' => $email_sekolah ?: NULL,
        'unit_penempatan' => $unit,
        'email_pribadi'=>$email_pribadi,
        'tanggal_mulai' => $tanggal_mulai,
        'tanggal_selesai' => $tanggal_selesai
    ];

    $this->db->where('id',$id);
    $this->db->update('data_magang',$data);

    // =====================
    // UPDATE EMAIL USER
    // =====================
    if(!empty($peserta->user_id)){
        $this->db->where('id', $peserta->user_id);
        $this->db->update('users', [
            'email_pribadi' => $email_pribadi
        ]);
    }

    // =====================
    // JIKA MAHASISWA
    // =====================
    if(!empty($universitas))
    {
        $this->db->where('data_magang_id',$id);
        $this->db->delete('bu_yuni');

        $cek = $this->db->get_where('pak_hani',['data_magang_id'=>$id])->row();

        $data_pak_hani = [
            'data_magang_id'=>$id,
            'nama_lengkap'=>$nama,
            'angkatan'=>$angkatan,
            'universitas'=>$universitas,
            'unit_penempatan'=>$unit,
            'tanggal_mulai'=>$this->input->post('tanggal_mulai'),
            'tanggal_selesai'=>$this->input->post('tanggal_selesai'),
            'email_pribadi'=>$email_pribadi,
            'email_universitas'=>$email_universitas
        ];

        if($cek){
            $this->db->where('data_magang_id',$id);
            $this->db->update('pak_hani',$data_pak_hani);
        }else{
            $this->db->insert('pak_hani',$data_pak_hani);
        }
    }

    // =====================
    // JIKA SISWA
    // =====================
    if(!empty($sekolah))
    {
        $this->db->where('data_magang_id',$id);
        $this->db->delete('pak_hani');

        $cek = $this->db->get_where('bu_yuni',['data_magang_id'=>$id])->row();

        $data_bu_yuni = [
            'data_magang_id'=>$id,
            'nama_lengkap'=>$nama,
            'angkatan'=>$angkatan,
            'sekolah'=>$sekolah,
            'unit_penempatan'=>$unit,
            'tanggal_mulai'=>$this->input->post('tanggal_mulai'),
            'tanggal_selesai'=>$this->input->post('tanggal_selesai'),
            'email_pribadi'=>$email_pribadi,
            'email_sekolah'=>$email_sekolah
        ];

        if($cek){
            $this->db->where('data_magang_id',$id);
            $this->db->update('bu_yuni',$data_bu_yuni);
        }else{
            $this->db->insert('bu_yuni',$data_bu_yuni);
        }
    }

    redirect('admin/unit/'.$unit);
}

public function unit_penempatan($unit)
{
    $this->db->select('data_magang.*, COUNT(logbook.id_logbook) as total_logbook');
    $this->db->from('data_magang');
    $this->db->join('logbook', 'logbook.data_magang_id = data_magang.id', 'left');
    $this->db->group_by('data_magang.id');

    $data['peserta'] = $this->db->get()->result();

    $this->load->view('admin/unit',$data);
}

    public function hapus($id)
    {
        $data = $this->db->get_where('data_magang', ['id'=>$id])->row();

        $this->db->delete('data_magang', ['id'=>$id]);

        redirect('admin/unit/'.$data->unit_penempatan);
    }

  public function kirim_email_peserta($id, $tujuan)
{
    $this->db->select('data_magang.*, users.email_pribadi');
    $this->db->from('data_magang');
    $this->db->join('users', 'users.id = data_magang.user_id', 'left');
    $this->db->where('data_magang.id', $id);

    $peserta = $this->db->get()->row();

    if(!$peserta){
        show_error('Data peserta tidak ditemukan');
    }

    // menentukan email tujuan
    if($tujuan == 'pribadi'){
        $email = $peserta->email_pribadi;
    }
    elseif($tujuan == 'universitas'){
        $email = $peserta->email_universitas;
    }
    else{
        $email = $peserta->email_sekolah;
    }

    if(!$email){
        echo "<script>alert('Email tidak tersedia');history.back();</script>";
        return;
    }

    // cek dokumen penilaian
    if(empty($peserta->dokumen_penilaian)){
        show_error('Dokumen penilaian belum diupload admin');
    }

    // menentukan jenis peserta
    $jenis = (!empty($peserta->sekolah)) ? 'siswa' : 'mahasiswa';

    $file_path = FCPATH . "uploads/penilaian/$jenis/" . $peserta->dokumen_penilaian;

    if(!file_exists($file_path) || !is_readable($file_path)){
        show_error("File tidak ditemukan / tidak bisa dibaca:<br>$file_path");
    }

    // kirim email
    $this->load->library('email');

    $this->email->from('nizartharegi@gmail.com','Dinas Kependudukan dan Pencatatan Sipil');
    $this->email->to($email);
    $this->email->subject('Hasil Penilaian Magang');

    $this->email->message("
        <p>Yth. <b>{$peserta->nama_lengkap}</b>,</p>
        <p>Terlampir hasil penilaian magang Anda.</p>
        <p>Terima kasih.</p>
    ");

    $this->email->attach($file_path);

    if(!$this->email->send()){
        show_error($this->email->print_debugger());
    }

 redirect('admin/email_sukses/'.$id.'/'.$tujuan.'/'.$peserta->unit_penempatan);
}

public function email_sukses($id, $tujuan, $unit)
{
    $this->db->select('data_magang.*, users.email_pribadi');
    $this->db->from('data_magang');
    $this->db->join('users', 'users.id = data_magang.user_id', 'left');
    $this->db->where('data_magang.id', $id);

    $peserta = $this->db->get()->row();

    if(!$peserta){
        show_error('Data peserta tidak ditemukan');
    }

    // menentukan email tujuan
    if($tujuan == 'pribadi'){
        $email = $peserta->email_pribadi;
    }
    elseif($tujuan == 'universitas'){
        $email = $peserta->email_universitas;
    }
    else{
        $email = $peserta->email_sekolah;
    }

    $data['nama']  = $peserta->nama_lengkap;
    $data['email'] = $email;
    $data['unit']  = $unit;

    $this->load->view('admin/email_sukses', $data);
}


    public function logbook($id)
    {
        $this->db->where('data_magang_id', $id);
        $data['logbook'] = $this->db->get('logbook')->result();

        $data['peserta'] = $this->db
        ->get_where('data_magang', ['id' => $id])
        ->row();

        $data['data_magang_id'] = $id; // ✅ TAMBAHKAN INI

        $peserta = $this->db->get_where('data_magang', ['id'=>$id])->row();
        $data['unit'] = $peserta->unit_penempatan;

        // WAJIB pakai layout admin lengkap
        $this->load->view('admin/logbook_list', $data);
    }
    
   public function approve_logbook($data_magang_id)
    {
        $this->db->where('data_magang_id', $data_magang_id);

        // 🔥 TAMBAHAN PENTING
        $this->db->where('status', 'menunggu');

        $this->db->update('logbook', [
            'status' => 'disetujui'
        ]);

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function tolak_logbook($id)
    {
        $this->db->where('id', $id); // penting: pakai id
        $this->db->update('logbook', [
            'status' => 'ditolak'
        ]);

        redirect($_SERVER['HTTP_REFERER']);
    }

    private function generate_pdf_penilaian($magang, $nilai, $jenis)
{
    require_once FCPATH . 'vendor/autoload.php';

    $options = new Options();
    $options->set('isRemoteEnabled', true);

    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    $html = '
    <h2 style="text-align:center;">Form Penilaian Magang</h2>
    <table border="1" width="100%" cellpadding="8" cellspacing="0">
        <tr>
            <td><b>Nama</b></td>
            <td>'.$magang['nama_lengkap'].'</td>
        </tr>
        <tr>
            <td><b>Instansi</b></td>
            <td>'.(!empty($magang['universitas']) ? $magang['universitas'] : $magang['sekolah']).'</td>
        </tr>
        <tr>
            <td><b>Disiplin</b></td>
            <td>'.$nilai['disiplin'].'</td>
        </tr>
        <tr>
            <td><b>Kerjasama</b></td>
            <td>'.$nilai['kerjasama'].'</td>
        </tr>
        <tr>
            <td><b>Tanggung Jawab</b></td>
            <td>'.$nilai['tanggung_jawab'].'</td>
        </tr>
        <tr>
            <td><b>Etika</b></td>
            <td>'.$nilai['etika'].'</td>
        </tr>
        <tr>
            <td><b>Keterangan</b></td>
            <td>'.$nilai['keterangan'].'</td>
        </tr>
    </table>
    ';

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    $output = $dompdf->output();

    $filename = 'penilaian_'.$magang['id'].'_'.time().'.pdf';

    $folder = FCPATH . 'uploads/penilaian/'.$jenis.'/';

    if (!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }

    file_put_contents($folder.$filename, $output);

    return $filename;
}

    public function upload_penilaian($id)
    {
    // ambil dari GET kalau ada (lebih stabil)
    if ($this->input->get('back')) {
        $this->session->set_userdata('redirect_back', $this->input->get('back'));
    }

    // fallback: referrer
    $ref = $this->agent->referrer();

    // cegah loop ke halaman yang sama
    if ($ref && strpos($ref, 'upload_penilaian') === false) {
        $this->session->set_userdata('redirect_back', $ref);
    
    }
    if ($this->session->userdata('role') !== 'admin') {
        redirect('auth/login');
    }

    $magang = $this->db->get_where('data_magang', ['id' => $id])->row_array();
    if (!$magang) show_404();

    $jenis = (!empty($magang['universitas'])) ? 'mahasiswa' : 'siswa';
    $folder = FCPATH . "uploads/penilaian/$jenis/";

    if (!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }

    $aksi = $this->input->post('aksi');

    // ==============================
    // 1. SIMPAN FORM
    // ==============================
    if ($aksi == 'simpan_form') {

        $cek = $this->db->get_where('penilaian', [
            'magang_id' => $id
        ])->row_array();

        $data = [
            'magang_id' => $id,
            'disiplin' => $this->input->post('disiplin'),
            'kehadiran' => $this->input->post('kehadiran'),
            'tanggung_jawab' => $this->input->post('tanggung_jawab'),
            'kejujuran' => $this->input->post('kejujuran'),
            'kerjasama_tim' => $this->input->post('kerjasama_tim'),
            'inisiatif' => $this->input->post('inisiatif'),
            'kerapihan_kerja' => $this->input->post('kerapihan_kerja'),
            'kemampuan_tugas' => $this->input->post('kemampuan_tugas'),
            'penguasaan_skill' => $this->input->post('penguasaan_skill'),
            'komunikasi' => $this->input->post('komunikasi'),
            'catatan_pembimbing' => $this->input->post('catatan_pembimbing')
        ];

        if ($cek) {
            $this->db->where('magang_id', $id);
            $this->db->update('penilaian', $data);
        } else {
            $this->db->insert('penilaian', $data);
        }

        $this->session->set_flashdata('success', 'Form berhasil disimpan!');
        redirect('admin/upload_penilaian/'.$id);
    }

    // ==============================
    // 2. UPLOAD FORM → PDF
    // ==============================
    if ($aksi == 'upload_form') {

        require_once FCPATH . 'vendor/autoload.php';

        $penilaian = $this->db->get_where('penilaian', ['magang_id' => $id])->row_array();

        if (!$penilaian) {
            $this->session->set_flashdata('error', 'Simpan form dulu!');
            redirect('admin/upload_penilaian/'.$id);
        }

        $dompdf = new Dompdf();

        $logo = FCPATH . 'assets/img/logodcpl.png';

        $logoData = base64_encode(file_get_contents($logo));
        $logoSrc = 'data:image/png;base64,' . $logoData;

        $html = '
        <style>
        body{
            font-family: sans-serif;
            font-size:14px;
        }

        .header{
            text-align:center;
            margin-bottom:20px;
        }

        .header-table{
            width:100%;
        }

        .header-table td{
            vertical-align:middle;
        }

        .logo{
            width:90px;
        }

        .judul{
            text-align:center;
        }

        .judul h2{
            margin:0;
            font-size:24px;
            font-family: "Times New Roman", serif;
            font-weight: bold;
        }

        .judul h3{
            margin:5px 0 0 0;
            font-size:20px;
            font-family: "Times New Roman", serif;
            font-weight: normal;
        }

        .identitas{
            margin-top:20px;
            margin-bottom:20px;
            width:100%;
        }

        .identitas td{
            padding:6px;
        }

        .nilai-table{
            width:100%;
            border-collapse:collapse;
        }

        .nilai-table th,
        .nilai-table td{
            border:1px solid #000;
            padding:8px;
        }

        .ttd{
            margin-top:50px;
            width:100%;
        }

        .ttd td{
            text-align:left;      /* ubah dari right ke left */
            padding-left:75%;     /* geser ke kanan secukupnya */
        }

        .ttd-space{
            height:80px;
        }
        </style>

        <table class="header-table">
        <tr>
            <td width="100">
                <img src="'.$logoSrc.'" class="logo">
            </td>
            <td class="judul">
                <h2>Dinas Kependudukan dan Pencatatan Sipil Kabupaten Sleman</h2>
                <h3>Form Penilaian Peserta Magang</h3>
            </td>
        </tr>
        </table>

        <hr>

        <table class="identitas">
        <tr>
            <td width="180"><b>Nama</b></td>
            <td>: '.$magang['nama_lengkap'].'</td>
        </tr>
        <tr>
            <td><b>Jenis Peserta</b></td>
            <td>: '.(!empty($magang['universitas']) ? 'Mahasiswa' : 'Siswa SMK').'</td>
        </tr>
        <tr>
            <td><b>Asal Institusi</b></td>
            <td>: '.(!empty($magang['universitas']) ? $magang['universitas'] : $magang['sekolah']).'</td>
        </tr>
        </table>

        <table class="nilai-table">
        <tr>
            <th>No</th>
            <th>Kriteria Penilaian</th>
            <th>Nilai</th>
        </tr>

        <tr><td>1</td><td>Disiplin</td><td>'.$penilaian['disiplin'].'</td></tr>
        <tr><td>2</td><td>Kehadiran</td><td>'.$penilaian['kehadiran'].'</td></tr>
        <tr><td>3</td><td>Tanggung Jawab</td><td>'.$penilaian['tanggung_jawab'].'</td></tr>
        <tr><td>4</td><td>Kejujuran</td><td>'.$penilaian['kejujuran'].'</td></tr>
        <tr><td>5</td><td>Kerjasama Tim</td><td>'.$penilaian['kerjasama_tim'].'</td></tr>
        <tr><td>6</td><td>Inisiatif</td><td>'.$penilaian['inisiatif'].'</td></tr>
        <tr><td>7</td><td>Kerapihan Kerja</td><td>'.$penilaian['kerapihan_kerja'].'</td></tr>
        <tr><td>8</td><td>Kemampuan Tugas</td><td>'.$penilaian['kemampuan_tugas'].'</td></tr>
        <tr><td>9</td><td>Penguasaan Skill</td><td>'.$penilaian['penguasaan_skill'].'</td></tr>
        <tr><td>10</td><td>Komunikasi</td><td>'.$penilaian['komunikasi'].'</td></tr>

        </table>

<br><br>

        <table width="100%" style="border-collapse:collapse;">
        <tr>
            <td style="border:1px solid #000; padding:10px;">
                <b>Catatan Pembimbing:</b><br><br>
                '.$penilaian['catatan_pembimbing'].'
            </td>
        </tr>
        </table>
        </table>

        <table class="ttd">
        <tr>
        <td>
        Sleman, '.date('d F Y').'<br>
        Pembimbing Lapangan
        <div class="ttd-space"></div>
        (__________________)
        </td>
        </tr>
        </table>
        ';
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // ======================
        // HAPUS FILE LAMA
        // ======================
        $data_lama = $this->db
            ->get_where('data_magang', ['id' => $id])
            ->row_array();

        if (!empty($data_lama['dokumen_penilaian'])) {
            $file_lama = $folder . $data_lama['dokumen_penilaian'];

            if (file_exists($file_lama)) {
                unlink($file_lama); // hapus file lama
            }
        }

        $filename = 'penilaian_'.$id.'_'.time().'.pdf';
        file_put_contents($folder.$filename, $dompdf->output());

        $this->db->where('id', $id);
        $this->db->update('data_magang', [
            'dokumen_penilaian' => $filename,
            'tanggal_dinilai'   => date('Y-m-d H:i:s')
        ]);

        // 🔥 SYNC KE BU_YUNI
$this->db->where('data_magang_id', $id);
$this->db->update('bu_yuni', [
    'dokumen_penilaian' => $filename,
    'tanggal_dinilai'   => date('Y-m-d H:i:s')
]);

        // 🔥 SYNC KE PAK_HANI
$this->db->where('data_magang_id', $id);
$this->db->update('pak_hani', [
    'dokumen_penilaian' => $filename,
    'tanggal_dinilai'   => date('Y-m-d H:i:s')
]);

        $this->session->set_flashdata('success', 'PDF berhasil dibuat!');
        redirect('admin/upload_penilaian/'.$id);
    }

    // ==============================
    // 3. UPLOAD FILE MANUAL
    // ==============================
    if ($aksi == 'upload_file') {

        if (empty($_FILES['dokumen']['name'])) {
            $this->session->set_flashdata('error', 'Pilih file dulu!');
            redirect('admin/upload_penilaian/'.$id);
        }

        $config['upload_path'] = $folder;
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 2048;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('dokumen')) {
            $this->session->set_flashdata('error', $this->upload->display_errors());
        } else {

            $file = $this->upload->data('file_name');

            $this->db->where('id', $id);
            $this->db->update('data_magang', [
                'dokumen_penilaian' => $file,
                'tanggal_dinilai'   => date('Y-m-d H:i:s')
            ]);

            // 🔥 SYNC KE BU_YUNI
$this->db->where('data_magang_id', $id);
$this->db->update('bu_yuni', [
    'dokumen_penilaian' => $file,
    'tanggal_dinilai'   => date('Y-m-d H:i:s')
]);

            $this->db->where('data_magang_id', $id);
$this->db->update('pak_hani', [
    'dokumen_penilaian' => $file,
    'tanggal_dinilai'   => date('Y-m-d H:i:s')
]);

            $this->session->set_flashdata('success', 'File berhasil diupload!');
        }

        redirect('admin/upload_penilaian/'.$id);
    }

    // ==============================
    // LOAD VIEW
    // ==============================
    $data['magang'] = $magang;
    $data['jenis']  = $jenis;
    $data['penilaian'] = $this->db->get_where('penilaian', ['magang_id' => $id])->row_array();

    $this->load->view('admin/upload_penilaian', $data);
}
         

    public function preview_penilaian($id)
    {
        require_once FCPATH . 'vendor/autoload.php';

        $magang = $this->db
            ->get_where('data_magang', ['id' => $id])
            ->row_array();

        if (!$magang) show_404();

        $penilaian = $this->db
            ->get_where('penilaian', ['magang_id' => $id])
            ->row_array();

        if (!$penilaian) {
            echo "<script>alert('Data penilaian belum disimpan!');history.back();</script>";
            return;
        }

        $jenis = (!empty($magang['universitas'])) ? 'Mahasiswa' : 'Siswa';
        $institusi = !empty($magang['universitas'])
            ? $magang['universitas']
            : $magang['sekolah'];

        $logo = FCPATH . 'assets/img/logodcpl.png';

        $logoData = base64_encode(file_get_contents($logo));
        $logoSrc = 'data:image/png;base64,' . $logoData;

        $html = '
        <style>
        body{
            font-family: sans-serif;
            font-size:14px;
        }

        .header{
            text-align:center;
            margin-bottom:20px;
        }

        .header-table{
            width:100%;
        }

        .header-table td{
            vertical-align:middle;
        }

        .logo{
            width:90px;
        }

        .judul{
            text-align:center;
        }

        .judul h2{
            margin:0;
            font-size:24px;
            font-family: "Times New Roman", serif;
            font-weight: bold;
        }

        .judul h3{
            margin:5px 0 0 0;
            font-size:20px;
            font-family: "Times New Roman", serif;
            font-weight: normal;
        }

        .identitas{
            margin-top:20px;
            margin-bottom:20px;
            width:100%;
        }

        .identitas td{
            padding:6px;
        }

        .nilai-table{
            width:100%;
            border-collapse:collapse;
        }

        .nilai-table th,
        .nilai-table td{
            border:1px solid #000;
            padding:8px;
        }

        .ttd{
            margin-top:50px;
            width:100%;
        }

        .ttd td{
            text-align:left;      /* ubah dari right ke left */
            padding-left:75%;     /* geser ke kanan secukupnya */
        }

        .ttd-space{
            height:80px;
        }
        </style>

        <table class="header-table">
        <tr>
            <td width="100">
                <img src="'.$logoSrc.'" class="logo">
            </td>
            <td class="judul">
                <h2>Dinas Kependudukan dan Pencatatan Sipil Kabupaten Sleman</h2>
                <h3>Form Penilaian Peserta Magang</h3>
            </td>
        </tr>
        </table>

        <hr>

        <table class="identitas">
        <tr>
            <td width="180"><b>Nama</b></td>
            <td>: '.$magang['nama_lengkap'].'</td>
        </tr>
        <tr>
            <td><b>Jenis Peserta</b></td>
            <td>: '.(!empty($magang['universitas']) ? 'Mahasiswa' : 'Siswa SMK').'</td>
        </tr>
        <tr>
            <td><b>Asal Institusi</b></td>
            <td>: '.(!empty($magang['universitas']) ? $magang['universitas'] : $magang['sekolah']).'</td>
        </tr>
        </table>

        <table class="nilai-table">
        <tr>
            <th>No</th>
            <th>Kriteria Penilaian</th>
            <th>Nilai</th>
        </tr>

        <tr><td>1</td><td>Disiplin</td><td>'.$penilaian['disiplin'].'</td></tr>
        <tr><td>2</td><td>Kehadiran</td><td>'.$penilaian['kehadiran'].'</td></tr>
        <tr><td>3</td><td>Tanggung Jawab</td><td>'.$penilaian['tanggung_jawab'].'</td></tr>
        <tr><td>4</td><td>Kejujuran</td><td>'.$penilaian['kejujuran'].'</td></tr>
        <tr><td>5</td><td>Kerjasama Tim</td><td>'.$penilaian['kerjasama_tim'].'</td></tr>
        <tr><td>6</td><td>Inisiatif</td><td>'.$penilaian['inisiatif'].'</td></tr>
        <tr><td>7</td><td>Kerapihan Kerja</td><td>'.$penilaian['kerapihan_kerja'].'</td></tr>
        <tr><td>8</td><td>Kemampuan Tugas</td><td>'.$penilaian['kemampuan_tugas'].'</td></tr>
        <tr><td>9</td><td>Penguasaan Skill</td><td>'.$penilaian['penguasaan_skill'].'</td></tr>
        <tr><td>10</td><td>Komunikasi</td><td>'.$penilaian['komunikasi'].'</td></tr>

        </table>

<br><br>

        <table width="100%" style="border-collapse:collapse;">
        <tr>
            <td style="border:1px solid #000; padding:10px;">
                <b>Catatan Pembimbing:</b><br><br>
                '.$penilaian['catatan_pembimbing'].'
            </td>
        </tr>
        </table>
        </table>

        <table class="ttd">
        <tr>
        <td>
        Sleman, '.date('d F Y').'<br>
        Pembimbing Lapangan
        <div class="ttd-space"></div>
        (__________________)
        </td>
        </tr>
        </table>
        ';

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $dompdf->stream("preview_penilaian.pdf", array("Attachment" => false));
    }


    
}