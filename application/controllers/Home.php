<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller{

public function index()
{
    // total peserta magang
    $data['total_peserta'] = $this->db
        ->count_all('data_magang');

    // total unit penempatan unik
    $data['total_unit'] = $this->db
        ->select('unit_penempatan')
        ->from('data_magang')
        ->where('unit_penempatan IS NOT NULL')
        ->group_by('unit_penempatan')
        ->get()
        ->num_rows();

    // tampilkan view landing.php
    $this->load->view('auth/landing', $data);
}
}