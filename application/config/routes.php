<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Default Routes
|--------------------------------------------------------------------------
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
$route['login']            = 'auth/login';
$route['register']         = 'auth/register';
$route['logout']           = 'auth/logout';

/*
|--------------------------------------------------------------------------
| ADMIN DASHBOARD
|--------------------------------------------------------------------------
*/
$route['admin']            = 'admin/index';
$route['admin/dashboard']  = 'admin/dashboard';

/*
|--------------------------------------------------------------------------
| ADMIN - DATA SISWA / MAHASISWA
|--------------------------------------------------------------------------
*/
$route['admin/data_siswa'] = 'admin/data_siswa';

/*
|--------------------------------------------------------------------------
| PAK HANI (MAHASISWA)
|--------------------------------------------------------------------------
*/
$route['admin/pak_hani']                   = 'admin/pak_hani';
$route['admin/pak_hani/angkatan/(:any)']   = 'admin/pak_hani_angkatan/$1';
$route['admin/pak_hani/cetak/(:any)']      = 'admin/cetak_pak_hani/$1';
$route['admin/pak_hani/hapus/(:num)']      = 'admin/hapus_pak_hani/$1';

/*
|--------------------------------------------------------------------------
| BU YUNI (SISWA SMK)
|--------------------------------------------------------------------------
*/
$route['admin/bu_yuni']                    = 'admin/bu_yuni';
$route['admin/bu_yuni/angkatan/(:any)']    = 'admin/bu_yuni_angkatan/$1';
$route['admin/bu_yuni/cetak/(:any)']       = 'admin/cetak_bu_yuni/$1';
$route['admin/bu_yuni/hapus/(:num)']       = 'admin/hapus_bu_yuni/$1';

/*
|--------------------------------------------------------------------------
| DOWNLOAD FILE DOKUMEN
|--------------------------------------------------------------------------
*/
$route['admin/download/(:any)']            = 'admin/download/$1';

/*
|--------------------------------------------------------------------------
| EMAIL
|--------------------------------------------------------------------------
*/
$route['admin/kirim_email/(:any)/(:num)'] = 'admin/kirim_email/$1/$2';

$route['admin/edit_pak_hani/(:num)']   = 'admin/edit_pak_hani/$1';
$route['admin/update_pak_hani/(:num)'] = 'admin/update_pak_hani/$1';

$route['admin/cetak/pak-hani/(:num)'] = 'admin/cetak_pak_hani/$1';
$route['admin/cetak/bu-yuni/(:num)']  = 'admin/cetak_bu_yuni/$1';

$route['admin/hapus_pak_hani/(:num)'] = 'admin/hapus_pak_hani/$1';


$route['peserta'] = 'peserta/dashboard';
$route['peserta/upload/(:num)'] = 'peserta/upload/$1';

$route['peserta/dashboard'] = 'peserta/dashboard';
$route['peserta/simpan']    = 'peserta/simpan';

$route['logbook/edit/(:num)'] = 'logbook/edit/$1';
$route['logbook/update'] = 'logbook/update';
$route['logbook/hapus/(:num)'] = 'logbook/hapus/$1';

