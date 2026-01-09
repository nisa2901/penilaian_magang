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
    $this->load->view('auth/landing');
  }

  public function login()
    {
        // role dari URL (?role=admin / ?role=peserta)
        $role_page = $this->input->get('role') ?: 'admin';

        if ($this->input->post()) {

            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $u = $this->User_model->get_by_username($username);

            if (!$u) {
                $data['error'] = 'Akun ini bukan admin, Silakan login di halaman peserta';
                $this->load->view('auth/login_' . $role_page, $data);
                return;
            }

            // 🔐 CEK PASSWORD
            if (!password_verify($password, $u['password']) && $password !== $u['password']) {
                $data['error'] = 'Username / password salah';
                $this->load->view('auth/login_' . $role_page, $data);
                return;
            }

            // 🔥 VALIDASI ROLE SESUAI HALAMAN
            if ($role_page === 'admin' && $u['role'] !== 'admin') {
                $data['error'] = 'Akun ini bukan admin';
                $this->load->view('auth/login_admin', $data);
                return;
            }

            if ($role_page === 'peserta' && $u['role'] !== 'participant') {
                $data['error'] = 'Akun ini bukan peserta';
                $this->load->view('auth/login_peserta', $data);
                return;
            }

            // ✅ SET SESSION
            $this->session->set_userdata([
                'user_id'  => $u['id'],
                'username' => $u['username'],
                'role'     => $u['role']
            ]);

            // 🚀 REDIRECT SESUAI ROLE
            if ($u['role'] === 'admin') {
                redirect('admin/dashboard');
            } else {
                redirect('peserta/dashboard');
            }
        }

        // load halaman login sesuai role
        $this->load->view('auth/login_' . $role_page);
    }

  public function logout()
{
    $this->session->sess_destroy();
    redirect('auth/login');
}


public function register_participant()
{
    if ($this->input->post()) {

        // 👉 INI BAGIAN "CONTROLLER AMBIL"
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $email    = $this->input->post('email_pribadi');
        $instansi = $this->input->post('instansi_kampus'); // ← INI YANG KAMU TANYAKAN

        // cek username dulu
$cek = $this->db
    ->where('username', $username)
    ->get('users')
    ->row();

if ($cek) {
    $this->session->set_flashdata('error', 'Username sudah digunakan, silakan pakai username lain.');
    redirect('auth/register');
    return;
}


        $data = [
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'email_pribadi' => $email,
            'instansi_kampus' => $instansi,
            'role' => 'participant'
        ];

        $this->db->insert('users', $data);

        redirect('auth/login?role=participant');
    }

    $this->load->view('auth/register_mahasiswa');
}
}
