<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test_email extends CI_Controller {
    public function index() {
        $this->load->library('email');
        
        $config = array(
            'protocol'    => 'smtp',
            'smtp_host'   => 'smtp.gmail.com',
            'smtp_port'   => 465,
            'smtp_user'   => 'nizartharegi@gmail.com',
            'smtp_pass'   => 'fbhx bmug dxje dqgg',
            'smtp_crypto' => 'tls',
            'mailtype'    => 'html',
            'charset'     => 'utf-8',
            'newline'     => "\r\n",
            'crlf'        => "\r\n",
            'smtp_timeout'=> 30
        );
        
        $this->email->initialize($config);
        $this->email->from('nizartharegi@gmail.com', 'Test');
        $this->email->to('nizartharegi@gmail.com'); // kirim ke diri sendiri dulu
        $this->email->subject('Test Email');
        $this->email->message('Ini test email dari CodeIgniter');
        
        if ($this->email->send()) {
            echo '✅ Email berhasil dikirim!';
        } else {
            echo '❌ Gagal: ' . $this->email->print_debugger();
        }
    }
}