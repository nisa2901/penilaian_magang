<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function index()
    {
        // TOTAL PESERTA
        $data['total_peserta'] = $this->db->count_all('data_magang');

        // LOAD VIEW
        $this->load->view('auth/landing', $data);
    }
}
