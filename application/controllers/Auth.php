<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->model('User_model');
    $this->load->helper(['url','form']);
    $this->load->library(['session','form_validation']);
  }

  public function index(){
    // landing with links to login pages
    $this->load->view('auth/login_participant');
  }

  public function login()
{
    // ambil role dari URL
    $role_page = $this->input->get('role');

    // default
    if (!$role_page) {
        $role_page = 'admin';
    }

    if ($this->input->post()) {

        $username = trim($this->input->post('username'));
        $password = trim($this->input->post('password'));

        // ambil user
        $u = $this->User_model->get_by_username($username);

        // =========================
        // USERNAME TIDAK ADA
        // =========================
        if (!$u) {

            $data['error'] = 'Username tidak ditemukan';

            $this->load->view('auth/login_' . $role_page, $data);
            return;
        }

        // =========================
        // PASSWORD SALAH
        // =========================
        if (
            !password_verify($password, $u['password']) &&
            $password !== $u['password']
        ) {

            $data['error'] = 'Password salah';

            $this->load->view('auth/login_' . $role_page, $data);
            return;
        }

        // =========================
        // VALIDASI LOGIN ADMIN
        // =========================
        if ($role_page == 'admin') {

            if ($u['role'] != 'admin') {

                $data['error'] = 'Peserta tidak dapat login di halaman admin';

                $this->load->view('auth/login_admin', $data);
                return;
            }

            // set session admin
            $this->session->set_userdata([
                'user_id'  => $u['id'],
                'username' => $u['username'],
                'role'     => $u['role']
            ]);

            redirect('admin/dashboard');
        }

        // =========================
        // VALIDASI LOGIN PESERTA
        // =========================
        if ($role_page == 'participant') {

            if ($u['role'] != 'participant') {

                $data['error'] = 'Admin tidak dapat login di halaman peserta';

                $this->load->view('auth/login_participant', $data);
                return;
            }

            // set session peserta
            $this->session->set_userdata([
                'user_id'  => $u['id'],
                'username' => $u['username'],
                'role'     => $u['role']
            ]);

            redirect('peserta/dashboard');
        }
    }

    // tampilkan halaman login
    $this->load->view('auth/login_' . $role_page);
}

  public function logout()
{
    $this->session->sess_destroy();
    redirect('auth/login');
}


public function register_participant()
{
 
if ($this->input->method() !== 'post') {
    $this->load->view('auth/register_mahasiswa');
    return;
}

    $username = $this->input->post('username');
    $password_input = $this->input->post('password');
    $email_pribadi = $this->input->post('email_pribadi');
    $instansi = $this->input->post('instansi');
   

    if (empty($username) || empty($password_input) || empty($instansi)) {
        $this->session->set_flashdata('error','Semua field wajib diisi');
        $this->session->unset_userdata('register_lock');
        redirect('auth/register_participant');
        return;
    }

    $cek = $this->db->get_where('users',['username'=>$username])->row();
    if($cek){
        $this->session->set_flashdata('error','Username sudah digunakan');
        $this->session->unset_userdata('register_lock');
        redirect('auth/register_participant');
        return;
    }

    $password = password_hash($password_input, PASSWORD_DEFAULT);

    $data_user = [
        'username' => $username,
        'password' => $password,
        'email_pribadi' => $email_pribadi,
        'instansi' => $instansi,
        'role' => 'participant'
    ];

    $this->db->insert('users', $data_user);
    $user_id = $this->db->insert_id();

    $data_magang = [
        'user_id' => $user_id,
        'sekolah' => $instansi,
       
    ];

    $cek_magang = $this->db->get_where('data_magang', [
    'user_id' => $user_id
])->row();

if (!$cek_magang) {
    $this->db->insert('data_magang', $data_magang);
    $data_magang_id = $this->db->insert_id();
} else {
    $data_magang_id = $cek_magang->id;
}

    $instansi = strtolower(trim($instansi));

    if (
        !empty($instansi) &&
        (
            strpos($instansi, 'sma') !== false ||
            strpos($instansi, 'smk') !== false ||
            strpos($instansi, 'man') !== false
        )
    ) {
        $this->db->insert('bu_yuni', [
            'data_magang_id' => $data_magang_id,
            'nama_lengkap' => $username,
            'sekolah' => $instansi,
            'email_pribadi' => $email_pribadi
        ]);
    } else {
        $this->db->insert('pak_hani', [
            'data_magang_id' => $data_magang_id,
            'nama_lengkap' => $username,
            'universitas' => $instansi,
            'email_pribadi' => $email_pribadi
        ]);
    }

    

    $this->session->set_flashdata('success','Registrasi berhasil');
    redirect('auth/login?role=participant');
}
}