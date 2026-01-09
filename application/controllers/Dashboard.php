<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller{
    public function index()
    {
       $penilaianTerbaru = $this->DataMagang_model->get_penilaian_terbaru();

        $dataUnik = [];
        $cek = [];

        foreach ($penilaianTerbaru as $row) {
            if (!isset($cek[$row['nama_lengkap']])) {
                $cek[$row['nama_lengkap']] = true;
                $dataUnik[] = $row;
            }
        }

        $data['penilaianTerbaru'] = $dataUnik;
        $this->load->view('dashboard', $data);


}
}